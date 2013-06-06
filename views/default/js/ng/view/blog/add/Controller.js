// <script>

define(function() {
	return function($scope, $routeParams, elgg, $location, $rootScope) {
		$scope.blog = {
			guid: 0,
			container: {
				guid: $routeParams.guid
			},
			access_id: 0,
			status: 'draft',
			comments_on: 'On',
		};
		
		$scope.submit = function() {
                        elgg.action('blog/save', {
                                guid: this.blog.guid,
                                container_guid: this.blog.container.guid,
                                title: this.blog.displayName,
                                description: this.blog.content,
                                access_id: this.blog.access_id,
                                excerpt: this.blog.excerpt,
                                comments_on: this.blog.comments_on,
                        }).success(function(result) {
                                if (result.status == 0) {
                                        $location.url(result.forward_url.slice(elgg.config.wwwroot.length));
                                }

                                $rootScope.$digest();
                        });
                };
	};
});
