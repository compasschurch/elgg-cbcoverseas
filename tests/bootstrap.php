<?php

date_default_timezone_set('America/Los_Angeles');

require dirname(__DIR__) . "/vendor/autoload.php";

// TODO(ewinslow): Remove these when we upgrade to Elgg 1.10
require_once dirname(__DIR__) . "/vendor/elgg/elgg/engine/lib/autoloader.php";
require_once dirname(__DIR__) . "/vendor/elgg/elgg/engine/lib/elgglib.php";
require_once dirname(__DIR__) . "/vendor/elgg/elgg/engine/lib/sessions.php";