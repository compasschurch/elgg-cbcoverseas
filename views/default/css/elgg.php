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

$cssDir = __DIR__;

/* Base CSS */
include "$cssDir/reset.css";
include "$cssDir/forms.css";
include "$cssDir/typography.css";

include "$cssDir/elgg/core.css";
include "$cssDir/elgg/grid.css";


/* Skin CSS */
include "$cssDir/elgg/typography.css";
include "$cssDir/elgg/heading.css";
include "$cssDir/elgg/friends/picker.css";
include "$cssDir/elgg/friends/collections.css";
include "$cssDir/elgg/form.css";
include "$cssDir/elgg/input.css";

/* jquery-ui stuff */
include "$cssDir/ui/datepicker.css";
include "$cssDir/ui/autocomplete.css";

/* buttons */
include "$cssDir/elgg/button.css";
include "$cssDir/elgg/button/cancel.css";
include "$cssDir/elgg/button/submit.css";
include "$cssDir/elgg/button/action.css";
include "$cssDir/elgg/button/delete.css";
include "$cssDir/elgg/button/dropdown.css";

/* icons */
include "$cssDir/elgg/icon.css";
include "$cssDir/elgg/avatar.css";

/* composer */
include "$cssDir/elgg/composer.css";
include "$cssDir/elgg/menu/composer.css";

/* photos */
include "$cssDir/tidypics.css";
include "$cssDir/uploadify.css";

/* navigation */
include "$cssDir/elgg/menu/entity.css";
include "$cssDir/elgg/menu/extras.css";
include "$cssDir/elgg/menu/filter.css";
include "$cssDir/elgg/menu/footer.css";
include "$cssDir/elgg/menu/general.css";
include "$cssDir/elgg/menu/hover.css";
include "$cssDir/elgg/menu/longtext.css";
include "$cssDir/elgg/menu/owner-block.css";
include "$cssDir/elgg/menu/page.css";
include "$cssDir/elgg/menu/river.css";
include "$cssDir/elgg/menu/site.css";
include "$cssDir/elgg/menu/title.css";
include "$cssDir/elgg/menu/topbar.css";
include "$cssDir/elgg/menu/widget.css";
include "$cssDir/elgg/breadcrumbs.css";
include "$cssDir/elgg/pagination.css";
include "$cssDir/elgg/tabs.css";

/* modules + widgets */
include "$cssDir/elgg/module.css";
include "$cssDir/elgg/module/aside.css";
include "$cssDir/elgg/module/dropdown.css";
include "$cssDir/elgg/module/featured.css";
include "$cssDir/elgg/module/info.css";
include "$cssDir/elgg/module/popup.css";
include "$cssDir/elgg/module/widget.css";
include "$cssDir/elgg/widget.css";
include "$cssDir/elgg/widgets.css";

/* components */
include "$cssDir/elgg/components.css";
include "$cssDir/elgg/gallery.css";
include "$cssDir/elgg/image-block.css";
include "$cssDir/elgg/list.css";
include "$cssDir/elgg/message.css";
include "$cssDir/elgg/river.css";
include "$cssDir/elgg/river/item.css";
include "$cssDir/elgg/river/comments.css";
include "$cssDir/elgg/river/response.css";
include "$cssDir/elgg/tags.css";
include "$cssDir/elgg/table.css";

/* layout */
include "$cssDir/elgg/layout.css";
include "$cssDir/elgg/page.css";
include "$cssDir/elgg/system-messages.css";

// included last to have higher priority
include "$cssDir/elgg/helpers.css";
include "$cssDir/spacing.css";

// in case plugins are still extending the old "css" view, display it
echo elgg_view("css", $vars);
