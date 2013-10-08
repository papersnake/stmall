<?php

function check_verify($code, $id = 1) {
	$verify = new \COM\Verify();
	return $verify->check($code, $id);
}