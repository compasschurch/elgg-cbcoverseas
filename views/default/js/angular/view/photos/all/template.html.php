<div class="elgg-layout elgg-layout-one-column clearfix">
	<div class="elgg-main elgg-body">
		<div class="elgg-head">
			<ul class="elgg-menu elgg-menu-title elgg-menu-hz elgg-menu-title-default">
				<li class="elgg-menu-item-add"><a href="/photos/add/36" class="elgg-button elgg-button-action">Create album</a></li>
			</ul>
			<h2 class="elgg-heading-main">All site photo albums</h2>
		</div>
		<div class="elgg-content">
			<ul class="elgg-gallery tidypics-gallery">
				<li data-ng-repeat="album in albums.items" id="elgg-object-{{album.guid}}" class="elgg-item">
					<div class="elgg-module  elgg-module-tidypics-album">
						<div class="elgg-head">
							<h3>
								<a href="{{album.url}}" class="tidypics-heading">
									{{album.displayName}}
								</a>
							</h3>
						</div>
						<div class="elgg-body">
							<a href="{{album.url}}">
								<img data-ng-src="{{album.image.url}}" class="elgg-photo " title="{{album.displayName}}" alt="{{album.displayName}}">
							</a>
						</div>
						<div class="elgg-foot">
							<a href="{{album.author.url}}">
								{{album.author.displayName}}
							</a>
							<div class="elgg-subtext">
								{{album.totalItems}} photos
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
