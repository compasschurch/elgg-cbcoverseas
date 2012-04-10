<?php
/**
 * Listens to the access:collections:write, user hook and defines what acls the user is allowed to use on
 * a given piece of content.
 */

return array(
	ACCESS_LOGGED_IN => elgg_echo('LOGGED_IN'),
	ACCESS_PRIVATE => elgg_echo('PRIVATE'),
);
