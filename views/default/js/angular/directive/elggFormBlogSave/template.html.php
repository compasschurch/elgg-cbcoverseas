<div>
<form name="$form" data-ng-submit="submit()" class="elgg-form elgg-form-alt elgg-form-blog-save">
<fieldset>
<div>
        <label for="blog_title">Title</label>
        <input type="text" data-ng-model="blog.displayName" id="blog_title" required class="elgg-input-text">
</div>

<div>
        <label for="blog_excerpt">Excerpt</label>
        <input type="text" data-ng-model="blog.excerpt" id="blog_excerpt" class="elgg-input-text">
</div>

<div>
        <label for="blog_description">Body</label>
        <textarea data-elgg-input-html id="blog_description" required name="description" data-ng-model="blog.content"></textarea>
        <div data-ng-show="$form.description.$dirty">
                <span data-ng-show="$form.description.$error.required">This field is required</span>
        </div>
</div>

<div>
        <label for="blog_comments_on">Comments</label>
        <select data-ng-model="blog.comments_on" id="blog_comments_on" class="elgg-input-dropdown">
                <option>On</option>
                <option>Off</option>
        </select>

</div>
<div>
        <label for="blog_access_id">Access</label>
        <select data-ng-model="blog.access_id" id="blog_access_id" class="elgg-input-dropdown elgg-input-access">
                <option value="1">{{'LOGGED_IN' | elggEcho}}</option>
                <option value="0">{{'PRIVATE' | elggEcho}}</option>
        </select>

</div>

<div>
        <label for="blog_status">Status</label>
        <select data-ng-model="blog.status" id="blog_status" class="elgg-input-dropdown">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
        </select>

</div>

<div class="elgg-foot">
        <div class="elgg-subtext mbm">
                Last saved:
                <span class="blog-save-status-time">
                        <span data-ng-hide="blog.updated">Never</span>
                        <time data-ng-show="blog.updated" datetime="{{blog.updated}}">{{blog.updated | fromNow}}</time>
                </span>
        </div>

        <input type="submit" value="{{'save' | elggEcho}}" class="elgg-button elgg-button-submit">
</div>
</fieldset>
</form>
</div>
