<div class="elgg-layout elgg-layout-one-column clearfix">
	<div role="main" class="elgg-main elgg-body">
		<div class="elgg-head">
			<h2 class="elgg-heading-main">Add blog post</h2>
		</div>
		<div class="elgg-content">

<form id="blog-post-edit" class="elgg-form elgg-form-alt elgg-form-blog-save" data-ng-submit="save()">
<fieldset>
	<div class="elgg-input-wrapper">
		<label for="blog_title">Title</label>
		<input type="text" data-ng-model="blog.displayName" id="blog_title" class="elgg-input-text">
	</div>

	<div class="elgg-input-wrapper">
		<label for="blog_excerpt">Excerpt</label>
		<input type="text" data-ng-model="blog.summary" id="blog_excerpt" class="elgg-input-text">
	</div>

	<div class="elgg-input-wrapper">
		<label for="blog_description">Body</label>
		<textarea elgg-input-html rows="10" cols="50" id="blog_description" data-ng-model="blog.content">
		</textarea>

	</div>

	<div class="elgg-input-wrapper">
		<label for="blog_tags">Tags</label>
		<input type="text" data-ng-model="blog.contentTags" id="blog_tags" class="elgg-input-tags">
	</div>

	<div class="elgg-input-wrapper">
		<label for="blog_comments_on">Comments</label>
		<select data-ng-model="blog.comments_on" id="blog_comments_on" class="elgg-input-dropdown">
			<option>On</option>
			<option>Off</option>
		</select>

	</div>

	<div class="elgg-input-wrapper">
		<label for="blog_access_id">Access</label>
		<select data-ng-model="blog.access_id" id="blog_access_id" class="elgg-input-dropdown elgg-input-access">
			<option value="1">Logged in users</option>
			<option value="0">Private</option>
		</select>
	</div>

	<div class="elgg-foot">
		<input type="submit" value="Save draft" class="elgg-button elgg-button-action" data-ng-class="{'elgg-state-disabled': isSaving}" data-ng-disabled="isSaving" data-ng-hide="blog.status == 'published'" />
		<input type="submit" value="Publish" class="elgg-button elgg-button-submit" data-ng-class="{'elgg-state-disabled': isSaving}" data-ng-disabled="isSaving" data-ng-hide="blog.status == 'published'" />
		<input type="submit" value="Save" class="elgg-button elgg-button-submit" data-ng-disabled="isSaving" data-ng-show="blog.status == 'published'"
		on
		<input type="datetime" data-ng-model="blog.published" style="max-width: 200px"/>
		
		<span class="elgg-subtext mbm">
			<span data-ng-show="isSaving">Saving...</span>
			<span data-ng-hide="isSaving">
				Last saved:  <span class="blog-save-status-time">{{(blog.updated | fromNow) || 'Never'}}</span>
			</span>
		</span>
	</div>
</fieldset>
</form>

		</div>
	</div>
</div>
