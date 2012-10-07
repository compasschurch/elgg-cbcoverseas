<?php
/**
 * Routing is handled by Angular on the client, so we just mark the page body
 * as the view and load all the possible javascripts we could need up front.
 * 
 */

elgg_load_js('showdown');
elgg_load_js('moment');
elgg_load_js('angular');
elgg_load_js('angular/module/ngResource');
elgg_load_js('angular/module/ngSanitize');
elgg_load_js('angular/module/Elgg');

echo elgg_view('page/angular');
