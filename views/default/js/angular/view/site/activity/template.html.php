<div class="elgg-layout elgg-river-layout">
	<!-- TODO: sidebar -->
	<div class="elgg-main elgg-body" role="main">
		<header class="elgg-head">
			<h2 class="elgg-heading-main">Activity</h2>
		</header>
		
		<?php echo elgg_view_menu('composer', array('entity' => $user, 'class' => 'elgg-menu-hz')); ?>
		
		<ul class="elgg-list elgg-list-river elgg-river">
			<li data-ng-repeat="item in getItems()">
				<div data-elgg-river-item="item"></div>
			</li>
		</ul>
		
		<div class="center">
			<button class="link"
			        data-ng-click="loadNextItems()"
			        data-ng-show="hasNextItems() && !isLoadingNextItems()">
				See more...
			</button>
			<div class="elgg-ajax-loader centered"
			     data-ng-show="isLoadingNextItems()">
			</div>
	    </div>
	</div>
</div>