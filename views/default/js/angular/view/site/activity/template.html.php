<div class="elgg-layout elgg-river-layout">
	<aside class="elgg-sidebar">
		<div data-cbc-posters></div>
	</aside>
	<aside class="elgg-sidebar-alt">
	</aside>
	<section class="elgg-main elgg-body" role="main">
		<header class="elgg-head">
			<h2 class="elgg-heading-main">Activity</h2>
		</header>
		
		<?php echo elgg_view('page/elements/composer', array('target' => elgg_get_logged_in_user_entity())); ?>
		
		<div data-elgg-river></div>
	</section>
</div>