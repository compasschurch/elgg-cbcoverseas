// <script>

define(function() {
	return function($scope, blog, elgg) {
		$scope.blog = blog;
		
		$scope.deleteEntity = function(guid) {
			elgg.action('blog/delete', {guid:guid}).then(function() {
				window.history.back();
			});
		};
	};	
});