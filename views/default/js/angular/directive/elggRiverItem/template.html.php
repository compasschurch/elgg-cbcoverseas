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
					<img data-ng-src="{{media.image.url}}" width="80" height="80" class="elgg-photo"
					     alt="{{media.displayName}}" title="{{media.displayName}}" />
				</a>
			</li>
		</ul>
		
        <!-- Action buttons -->
        <ul class="elgg-menu elgg-menu-hz elgg-menu-river elgg-menu-river-default float">
            <li class="elgg-item" data-ng-show="!object.hasLiked">
                <button class="link" data-ng-click="like()">
                    Like
                </button>
            </li>
            <li class="elgg-item" data-ng-show="object.hasLiked">
                <button class="link" data-ng-click="unlike()">
                    Unlike
                </button>
            </li>
            <li class="elgg-item">
                <button class="link" data-ng-click="startCommenting()">
                    Comment
                </button>
            </li>
        </ul>

		<!-- Activity indicators -->
		<ul class="elgg-menu elgg-menu-hz elgg-menu-river elgg-menu-river-alt float-alt" data-ng-show="object.likes.totalItems > 0">
            <li class="elgg-item" data-ng-repeat="liker in getLikes(3)">
                <img data-ng-src="{{liker.image.url}}" alt="{{liker.displayName}}" title="{{liker.displayName}}" width="16" height="16" />
            </li>
            <li class="elgg-item">
                <button class="link" title="See who likes this"
                        data-ng-click="toggleLikesDrawer()">
                    +{{object.likes.totalItems}}
                </button>
            </li>
        </ul>

		<!-- Likes drawer -->
        <div class="elgg-river-likes-drawer clearfloat" data-ng-show="likesDrawerIsOpen">
        	<div class="elgg-river-more">
	        	<button class="link" data-ng-click="toggleLikesDrawer()">
	        		&laquo; Hide likes
	        	</button>        		
        	</div>
        	<div style="background: #EEE; padding: 5px">
	        	<ul class="elgg-list elgg-list-likes">
	        		<li class="elgg-item" data-ng-repeat="liker in object.likes.items">
	        			<div class="elgg-image-block">
	        				<a href="{{liker.url}}" class="elgg-image">
								<img data-ng-src="{{liker.image.url}}" width="25" height="25" />
	        				</a>
	        				<div class="elgg-body">
	        					<a href="{{liker.url}}">{{liker.displayName}}</a>
	        				</div>
	        			</div>
	        		</li>
	        	</ul>
	        	<div class="elgg-ajax-loader centered" data-ng-show="loadingLikes"></div>
        	</div>
        </div>
        
        <!-- Comments drawer -->
		<div class="elgg-river-comments-drawer clearfloat" data-ng-hide="likesDrawerIsOpen">
            <div class="elgg-river-more" data-ng-show="remainingItems() > 0 && !loadingOlderItems">
                <button class="link" data-ng-click="loadOlderItems()">
                    +{{remainingItems()}} more
                </button>
            </div>
            <div class="elgg-ajax-loader centered" data-ng-show="loadingOlderItems"></div>
            <ul class="elgg-list elgg-river-comments">
                <li data-ng-repeat="comment in object.comments.items | orderBy:'published'">
                    <div data-elgg-river-comment="comment"></div>
                </li>
            </ul>
            <div data-ng-hide="commenting" style="background-color: #EEE; padding:5px">
                <button class="elgg-input-text"
                        data-ng-click="commenting = true">
                    Leave a comment...
                </button>
			</div>
            <form class="elgg-image-block elgg-form elgg-form-comments-add" 
                  data-ng-show="commenting" 
                  data-ng-submit="submitComment()">
                  
                <div class="elgg-image">
                    <img data-ng-src="{{user.image.url}}" width="40" height="40" />                                    
                </div>
                <div class="elgg-body">
				<textarea required data-ng-model="newComment"
                                       data-focus-on="commenting">
				</textarea>
                    <button class="elgg-button elgg-button-submit">
                        Comment
                    </button>
                    <button class="elgg-button elgg-button-cancel" 
                            data-ng-click="resetComment()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>