<div class="elgg-image-block elgg-river-item">
    <a href="{{actor.url}}" class="elgg-image">
        <img data-ng-src="{{actor.image.url}}" alt="" width="60" height="60" />                    
    </a>
    <div class="elgg-body pas">
		<!-- Main content -->
		<div class="elgg-river-summary">
			<span data-ng-bind-html="title"></span>
			<time datetime="{{published}}" class="elgg-river-timestamp" title="{{published | calendar}}">
				{{published | fromNow}}
			</time>
		</div>
		<div class="elgg-river-message" ng-bind-html="object.content"></div>
		
		<img data-ng-src="{{getMediaAttachment().fullImage.url}}" width="100%" data-ng-show="!!getMediaAttachment()" />
		
		<ul class="tidypics-river-list" data-ng-show="!!getMediaAttachments().length">
			<li class="tidypics-photo-item" data-ng-repeat="media in getMediaAttachments()">
				<a href="{{media.url}}">
					<img data-ng-src="{{media.image.url}}" width="88" height="88" class="elgg-photo"
					     alt="{{media.displayName}}" title="{{media.displayName}}" />
				</a>
			</li>
		</ul>
		
		<div data-elgg-responses data-object="object"></div>
    </div>
</div>