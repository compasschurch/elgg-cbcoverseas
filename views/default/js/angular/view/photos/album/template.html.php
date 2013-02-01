<div class="elgg-layout elgg-layout-one-column clearfix">
	<div class="elgg-main elgg-body">
		<div class="elgg-head">
			<ul class="elgg-menu elgg-menu-title elgg-menu-hz elgg-menu-title-default">
				<li class="elgg-menu-item-upload" data-ng-show="album.canEdit">
					<a href="/photos/upload/{{album.guid}}" class="elgg-button elgg-button-submit">
						{{ 'images:upload' | elggEcho }}
					</a>
				</li>
				<li class="elgg-menu-item-edit" data-ng-show="album.canEdit">
					<a href="/photos/edit/{{album.guid}}" class="elgg-button elgg-button-action">
						{{ 'edit' | elggEcho }}
					</a>
				</li>
				<li class="elgg-menu-item-delete" data-ng-show="album.canEdit">
					<a data-ng-click="deleteEntity(album)">
						<span class="elgg-icon elgg-icon-delete">Delete</span>
					</a>
				</li>
			</ul>
			<h2 class="elgg-heading-main">
				{{album.displayName}}
			</h2>
		</div>
		<div class="elgg-content">
			<ul class="elgg-gallery tidypics-gallery">
				<li data-ng-repeat="image in album.items" id="elgg-object-{{image.guid}}" class="elgg-item">
					<a href="{{image.url}}">
						<img data-ng-src="{{image.image.url}}" class="elgg-photo"
						     title="{{image.displayName}}" alt="{{image.displayName}}" />
					</a>
				</li>
			</ul>	
		</div>
	</div>
</div>
