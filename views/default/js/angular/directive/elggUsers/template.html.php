<div>
	<div class="pbs">
		<input type="search" data-ng-model="q" placeholder="Search..." />
	</div>
	<table class="elgg-table elgg-table-fixed">
		<style scoped>
			.elgg-col-email { max-width: 25%; width: 25%; }
			.elgg-col-location { max-width: 15%; width: 15%; }
			.elgg-col-timestamp { max-width: 12%; width: 12%; }
			.elgg-col-status { max-width: 8%; width: 8%; }
		</style>
		<thead>
			<th colspan=2>Name</th>
			<th class="elgg-col-email">Email</th>
			<th class="elgg-col-location">Location</th>
			<th class="elgg-col-timestamp">Registered</th>
			<th class="elgg-col-timestamp">Activity</th>
			<th class="elgg-col-status">Status</th>
		</thead>
		<tbody data-when-scrolled="hasNextItems() && !isLoadingNextItems() && loadNextItems()">
			<tr data-ng-repeat="user in getItems() | filter:q">
				<td style="width:1%">
					<a href="{{user.url}}" class="elgg-avatar">
						<img data-ng-src="{{user.image.url}}" width=25 height=25 alt="" />
					</a>
				</td>
				<td class="elgg-col-name">
					<h3><a href="{{user.url}}">{{user.displayName}}</a> <small>({{user.username}})</small></h3>
					<div data-ng-show="!!user.summary" class="elgg-subtext">{{user.summary}}</div>
				</td>
				<td class="elgg-col-email">
					{{user.email}}
				</td>
				<td class="elgg-col-location">
					{{user.location.displayName}}
				</td>
				<td class="elgg-col-timestamp">
					<time datetime="{{user.published}}" title="{{user.published | calendar}}">
						{{user.published | fromNow}}
					</time>
				</td>
				<td class="elgg-col-timestamp">
					<time datatime="{{user.last_action}}" title="{{user.last_action | calendar}}" data-ng-show="user.last_action">
						{{user.last_action | fromNow}}
					</time>
					<span data-ng-show="!user.last_action">Never</span>
				</td>
				<td class="elgg-col-status">
					<span data-ng-show="user.banned" title="{{user.ban_reason}}">Banned</span>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="center">
		<button class="link"
		        data-ng-click="loadNextItems()"
		        data-ng-show="hasNextItems() && !isLoadingNextItems()">
			See more...
		</button>
		<div class="elgg-ajax-loader centered"
		     data-ng-show="isLoadingNextItems()">
		</div>
    </div>
</div>