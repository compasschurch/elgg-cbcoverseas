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
$old_css_view = elgg_get_view_location("css");
if ($old_css_view != elgg_get_config("viewpath")) {
	echo elgg_view("css", $vars);
	return true;
}

/*******************************************************************************

Base CSS
 * CSS reset
 * core
 * helpers (moved to end to have a higher priority)
 * grid

*******************************************************************************/
include __DIR__ . "/reset.css";
include __DIR__ . "/forms.css";
include __DIR__ . "/elgg/core.css";
include __DIR__ . "/elgg/grid.css";


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
include __DIR__ . "/elgg/typography.css";
include __DIR__ . "/elgg/friends/picker.css";
include __DIR__ . "/elgg/friends/collections.css";

/* jquery-ui stuff */
include __DIR__ . "/ui/datepicker.css";
include __DIR__ . "/ui/autocomplete.css";

/* buttons */
include __DIR__ . "/elgg/button.css";
include __DIR__ . "/elgg/button/cancel.css";
include __DIR__ . "/elgg/button/submit.css";
include __DIR__ . "/elgg/button/action.css";
include __DIR__ . "/elgg/button/delete.css";
include __DIR__ . "/elgg/button/dropdown.css";

/* icons */
include __DIR__ . "/elgg/icon.css";
include __DIR__ . "/elgg/avatar.css";

/* navigation */
include __DIR__ . "/elgg/menu/entity.css";
include __DIR__ . "/elgg/menu/extras.css";
include __DIR__ . "/elgg/menu/filter.css";
include __DIR__ . "/elgg/menu/footer.css";
include __DIR__ . "/elgg/menu/general.css";
include __DIR__ . "/elgg/menu/hover.css";
include __DIR__ . "/elgg/menu/longtext.css";
include __DIR__ . "/elgg/menu/owner-block.css";
include __DIR__ . "/elgg/menu/page.css";
include __DIR__ . "/elgg/menu/river.css";
include __DIR__ . "/elgg/menu/site.css";
include __DIR__ . "/elgg/menu/title.css";
include __DIR__ . "/elgg/menu/topbar.css";
include __DIR__ . "/elgg/menu/widget.css";
include __DIR__ . "/elgg/breadcrumbs.css";
include __DIR__ . "/elgg/pagination.css";
include __DIR__ . "/elgg/tabs.css";

/* modules + widgets */
include __DIR__ . "/elgg/module.css";
include __DIR__ . "/elgg/module/aside.css";
include __DIR__ . "/elgg/module/dropdown.css";
include __DIR__ . "/elgg/module/featured.css";
include __DIR__ . "/elgg/module/info.css";
include __DIR__ . "/elgg/module/popup.css";
include __DIR__ . "/elgg/module/widget.css";
include __DIR__ . "/elgg/widget.css";
include __DIR__ . "/elgg/widgets.css";

/* components */
include __DIR__ . "/elgg/components.css";
include __DIR__ . "/elgg/message.css";
include __DIR__ . "/elgg/tags.css";
include __DIR__ . "/elgg/table.css";
include __DIR__ . "/elgg/river.css";
include __DIR__ . "/elgg/river/item.css";
include __DIR__ . "/elgg/river/comments.css";

/* layout */
include __DIR__ . "/elgg/layout.css";
include __DIR__ . "/elgg/page.css";
include __DIR__ . "/elgg/system-messages.css";

/* misc */

// included last to have higher priority
echo elgg_view("css/elements/helpers", $vars);
include __DIR__ . "/spacing.css";

// in case plugins are still extending the old "css" view, display it
echo elgg_view("css", $vars);
