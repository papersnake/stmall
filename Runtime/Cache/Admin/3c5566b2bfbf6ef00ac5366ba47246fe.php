<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>STMALL 管理平台</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="papersnake">

	<!-- The styles -->
	<link id="bs-css" href="/Public/Admin/css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="/Public/Admin/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/Public/Admin/css/charisma-app.css" rel="stylesheet">
	<link href="/Public/Admin/css/main.css" rel="stylesheet">
	<link href="/Public/Admin/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='/Public/Admin/css/fullcalendar.css' rel='stylesheet'>
	<link href='/Public/Admin/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='/Public/Admin/css/chosen.css' rel='stylesheet'>
	<link href='/Public/Admin/css/uniform.default.css' rel='stylesheet'>
	<link href='/Public/Admin/css/colorbox.css' rel='stylesheet'>
	<link href='/Public/Admin/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='/Public/Admin/css/jquery.noty.css' rel='stylesheet'>
	<link href='/Public/Admin/css/noty_theme_default.css' rel='stylesheet'>
	<link href='/Public/Admin/css/elfinder.min.css' rel='stylesheet'>
	<link href='/Public/Admin/css/elfinder.theme.css' rel='stylesheet'>
	<link href='/Public/Admin/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='/Public/Admin/css/opa-icons.css' rel='stylesheet'>
	<link href='/Public/Admin/css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="/Public/Admin/img/favicon.ico">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>STMALL 管理平台</h2>
					<h3>吴江大润发厍星店商品在线管理平台</h3>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						请用您的用户名和密码登录.
					</div>
					<div class="alert alert-error" style="display: none">
						<button type="button" class="close" data-dismiss="alert">×</button>
						密码错误
					</div>
					<form class="form-horizontal" action="<?php echo U('login');?>" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="admin" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend input-append" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="24976904" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend input-append" title="verify" data-rel="tooltip">
								<span class="add-on"><i class="icon-pencil"></i></span><input class="span5" name="verify" id="verify" type="text" value="" />
								<span class="add-on"><a class="reloadverify" href="javascript:void(0)">换一张?</a></span>

							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<img class="verifyimg" src="<?php echo U('Public/verify');?>">
							<div class="clearfix"></div>
	
							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />下一次自动登录</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">登录</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->
	<div class="modal hide fade" id="myModal" style="display:none;">
		<img src="/Public/Admin/img/ajax-loaders/ajax-loader-7.gif" title="/Public/Admin/img/ajax-loaders/ajax-loader-7.gif">
	</div>
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="/Public/Admin/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="/Public/Admin/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="/Public/Admin/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="/Public/Admin/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="/Public/Admin/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="/Public/Admin/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="/Public/Admin/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="/Public/Admin/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="/Public/Admin/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="/Public/Admin/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="/Public/Admin/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="/Public/Admin/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="/Public/Admin/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="/Public/Admin/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="/Public/Admin/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="/Public/Admin/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='/Public/Admin/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='/Public/Admin/js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="/Public/Admin/js/excanvas.js"></script>
	<script src="/Public/Admin/js/jquery.flot.min.js"></script>
	<script src="/Public/Admin/js/jquery.flot.pie.min.js"></script>
	<script src="/Public/Admin/js/jquery.flot.stack.js"></script>
	<script src="/Public/Admin/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="/Public/Admin/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="/Public/Admin/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="/Public/Admin/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="/Public/Admin/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="/Public/Admin/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="/Public/Admin/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="/Public/Admin/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="/Public/Admin/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="/Public/Admin/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="/Public/Admin/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="/Public/Admin/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="/Public/Admin/js/charisma.js"></script>
	
	<script type="text/javascript">
	$("form").submit(function() {
		$("#myModal").modal('show').css({
			width:'auto',
			'margin-left':function(){
				return -($(this).width()/2);
			}
		});
		var self = $(this);
		$.post(self.attr("action"),self.serialize(),success,"json");
		return false

		function success(data){
			if(data.status){
				window.location.href = data.url;
			} else {
				$("#myModal").modal('hide');
				$(".login-box").prepend('<div class="alert alert-error" ><button type="button" class="close" data-dismiss="alert">×</button>'+data.info+'</div>')
				$(".reloadverify").click();
			}
		}
	});

	$(function(){
		var verifyimg = $(".verifyimg").attr("src");
		$(".reloadverify").click(function(){
			if(verifyimg.indexOf('?')>0){
				$(".verifyimg").attr("src", verifyimg+'&random'+Math.random());
			}else{
				$(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
			}
		});
	});
	</script>
		
</body>
</html>