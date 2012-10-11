<div class="elgg-layout elgg-river-layout">
	<!-- TODO: sidebar -->
	<div class="elgg-main elgg-body" role="main">
		<header class="elgg-head">
			<h2 class="elgg-heading-main">Activity</h2>
		</header>
		
		<!-- TODO: Put the composer here ... -->
		
		<ul class="elgg-list elgg-list-river elgg-river">
			<li data-ng-repeat="item in collection.items">
				<div data-elgg-river-item="item"></div>
			</li>
		</ul>
		
		<div class="center">
			<button class="link"
			        data-ng-click="loadOlderItems()"
			        data-ng-show="!loadingOlderActivities">
				See more...
			</button>
			<div class="elgg-ajax-loader centered"
			     data-ng-show="loadingOlderActivities">
			</div>
	    </div>
	</div>
</div>