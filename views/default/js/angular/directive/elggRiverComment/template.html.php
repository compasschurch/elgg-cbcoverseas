<div class="elgg-image-block"
     data-ng-mouseenter="hovering = true" 
     data-ng-mouseleave="hovering = false">
     
    <div class="elgg-image">
        <img data-ng-src="{{author.image.url}}" width="40" height="40" />                    
    </div>
    <div class="elgg-body">
        <button class="elgg-icon elgg-icon-delete float-alt"
                title="Delete this comment"
                data-ng-show="hovering && canDelete && !deleting" 
                data-ng-click="delete()">
        </button>
        <div class="elgg-ajax-loader float-alt" data-ng-show="deleting"></div>
        <div>
            <a href="{{author.url}}">{{author.displayName}}</a>
            <time datetime="{{published}}" class="elgg-subtext" title="{{published | calendar}}">
                {{published | fromNow}}
            </time>
        </div>
        <div data-ng-bind-html="getContent()"></div>                   
    </div>
</div>