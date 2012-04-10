<?php
/**
 * Elgg primary CSS view
 *
 * @package Elgg.Core
 * @subpackage UI
 */

/* 
 * Colors:
 *  #4690D6 - elgg light blue
 *  #0054A7 - elgg dark blue
 *  #e4ecf5 - elgg very light blue
 */

// check if there is a theme overriding the old css view and use it, if it exists
$old_css_view = elgg_get_view_location('css');
if ($old_css_view != elgg_get_config('viewpath')) {
	echo elgg_view('css', $vars);
	return true;
}


/*******************************************************************************

Base CSS
 * CSS reset
 * core
 * helpers (moved to end to have a higher priority)
 * grid

*******************************************************************************/
echo elgg_view('css/elements/reset', $vars);

include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/core.css';

echo elgg_view('css/elements/grid', $vars);


/*******************************************************************************

Skin CSS
 * typography     - fonts, line spacing
 * forms          - forms, inputs
 * buttons        - action, cancel, delete, submit, dropdown, special
 * navigation     - menus, breadcrumbs, pagination
 * icons          - icons, sprites, graphics
 * modules        - modules, widgets
 * layout_objects - lists, content blocks, notifications, avatars
 * layout         - page layout
 * misc           - to be removed/redone

*******************************************************************************/
echo elgg_view('css/elements/typography', $vars);
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/typography.css';
echo elgg_view('css/elements/forms', $vars);

/* buttons */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button/cancel.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button/submit.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button/action.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button/delete.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/button/dropdown.css';

/* icons */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/icon.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/avatar.css';

/* navigation */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/entity.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/extras.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/filter.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/footer.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/general.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/hover.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/longtext.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/owner-block.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/page.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/river.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/site.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/title.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/topbar.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/menu/widget.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/breadcrumbs.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/pagination.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/tabs.css';

/* modules + widgets */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/aside.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/dropdown.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/featured.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/info.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/popup.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/module/widget.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/widget.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/widgets.css';

/* components */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/components.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/message.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/tags.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/table.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/river.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/river/item.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/river/comments.css';

/* layout */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/layout.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/page.css';
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/system-messages.css';

/* misc */
include elgg_get_plugins_path() . 'missions.compasschurch.org/static/css/misc.css';

// included last to have higher priority
echo elgg_view('css/elements/helpers', $vars);


// in case plugins are still extending the old 'css' view, display it
echo elgg_view('css', $vars);
