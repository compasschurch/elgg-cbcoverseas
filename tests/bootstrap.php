<?php

$plugin_root = dirname(__DIR__);

date_default_timezone_set('America/Los_Angeles');

// Elgg 1.9 compat
@include_once "$plugin_root/.Elgg/engine/lib/autoloader.php";

// Bare minimum of engine needed to run tests
require_once "$plugin_root/.Elgg/engine/lib/elgglib.php";

// Needed for ElggEntity
require_once "$plugin_root/.Elgg/engine/lib/sessions.php";

// Mocked elgg_normalize_url required for ElggMenuItem
function elgg_normalize_url($url) {
    return $url;
}

elgg_register_classes("$plugin_root/.Elgg/mod/evan/classes");
elgg_register_classes("$plugin_root/classes");
