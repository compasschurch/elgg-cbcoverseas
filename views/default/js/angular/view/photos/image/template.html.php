<div class="elgg-layout elgg-layout-one-column clearfix">
	<div class="elgg-main elgg-body">
		<div class="elgg-head">
			<ul class="elgg-menu elgg-menu-title elgg-menu-hz elgg-menu-title-default">
				<li class="elgg-menu-item-download">
					<a href="{{image.fullImage.url}}" class="elgg-button elgg-button-action">Download image</a>
				</li>
			</ul>
			<h2 class="elgg-heading-main">{{image.displayName}}</h2>
		</div>
		<div class="elgg-content">
			<div class="tidypics-photo-wrapper center">
				<ul class="elgg-menu elgg-menu-hz tidypics-album-nav">
					<li data-ng-show="image.prev">
						<a href="{{image.prev.url}}" rel="prev" title="{{image.prev.displayName}}">
							<span class="elgg-icon elgg-icon-arrow-left">Previous</span>
						</a>
					</li>
					<li><span>{{image.album.index}} of {{image.album.totalItems}}</span></li>
					<li data-ng-show="image.next">
						<a href="{{image.next.url}}" rel="next" title="{{image.next.displayName}}">
							<span class="elgg-icon elgg-icon-arrow-right">Next</span>
						</a>
					</li>
				</ul>

				<a href="{{image.next.url}}">
					<img data-ng-src="{{image.fullImage.url}}" class="elgg-photo tidypics-photo"
					     title="{{image.displayName}}" alt="{{image.displayName}}" />
				</a>
			</div>
		</div>
	</div>
</div>
