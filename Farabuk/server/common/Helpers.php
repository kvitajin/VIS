<?php

function combinePermissions($permission_array = []) {
	$sum = 0;
	forEach($permission_array as $permission) {
		$sum = $sum | $permission;
	};

	return $sum;
}
