#!/bin/sh
##################################################
# Brief       Sync your git commitment to SAE.
# Author      LiJunjie, holysoros@gmail.com
# Usage       sync-git-to-sae.sh <username> [src dir]
# Version     0.00
# Date        11-06-16 16:09:25
# modiy       papersnake,cctv5cn@gmail.com
##################################################

# username of SAE
username="$1"

# src_dir is the root directory of all things which
# you want to deploy to SAE svn repository.
if [ -z "$2" ]; then
    src_dir="."
else
    src_dir="$2"
fi

svn_dir=/var/tmp/svn_dir

# remove the deleted items from svn repository
svn_rm_deleted() {
    deleted_items=`svn status | grep ^! | awk '{ print $2}'`
    if ! [ -z "$deleted_items" ]; then
        svn rm "$deleted_items"
    fi
}

# add new items from svn repository
svn_add_new() {
    new_items=`svn status | grep ^? | awk '{ print $2}'`
    if ! [ -z "$new_items" ]; then
        svn add "$new_items"
    fi
}


echo "Checkout svn repository from SAE"
# SVN_PASSWD variable come from travis encrypted environment variables
svn co https://svn.sinaapp.com/stmall/ "$svn_dir" --username "$username" --password "$SVN_PASSWD" --no-auth-cache || exit 1


echo "Sync from git repository"

cd $src_dir
git diff --relative --no-color HEAD^..HEAD >/var/tmp/diff.patch

cd $svn_dir/2
patch -p1 < /var/tmp/diff.patch

cd $svn_dir/2
svn_rm_deleted
svn_add_new


echo "Deploy to SAE"
svn ci -m "$TRAVIS_COMMIT" --username "$username" --password "$SVN_PASSWD" --no-auth-cache || exit 1


echo "Done"
