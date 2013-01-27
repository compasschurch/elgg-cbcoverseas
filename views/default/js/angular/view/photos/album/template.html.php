<div class="elgg-layout elgg-layout-one-column clearfix">
	<div class="elgg-main elgg-body">
		<div class="elgg-head">
			<ul class="elgg-menu elgg-menu-title elgg-menu-hz elgg-menu-title-default">
				<!-- Insert menu items here -->
			</ul>
			<h2 class="elgg-heading-main">{{album.displayName}}</h2>
		</div>
		<div class="elgg-content">
			<ul class="elgg-gallery tidypics-gallery">
				<li data-ng-repeat="image in album.items" id="elgg-object-{{image.guid}}" class="elgg-item">
					<a href="{{image.url}}">
						<img data-ng-src="{{image.image.url}}" class="elgg-photo " title="{{image.displayName}}" alt="{{image.displayName}}">
					</a>
				</li>
			</ul>	
		</div>
	</div>
</div>
