<?php

$user = elgg_get_logged_in_user_entity();

if ($user instanceof ElggUser) {
	$image = $user->getIconURL('medium');
	echo "elgg.session.user.image = '$image';";
}
