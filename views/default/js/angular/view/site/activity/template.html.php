<div class="elgg-layout elgg-river-layout">
	<!-- TODO: sidebar -->
	<div class="elgg-main elgg-body" role="main">
		<header class="elgg-head">
			<h2 class="elgg-heading-main">Activity</h2>
		</header>
		
		<?php echo elgg_view_menu('composer', array('entity' => $user, 'class' => 'elgg-menu-hz')); ?>
		
		<div data-elgg-river></div>
	</div>
</div>