// <script>
define(function(require) {
	var elgg = require('elgg');
	var Collection = require('activitystreams/Collection');
	
	return function($scope) {
		$scope.collection = {
			totalItems: 0,
			items: []
		};
		
		$scope.loadOlderItems = function() {
			$scope.loadingOlderActivities = true;
			elgg.getJSON('/activity-json', {
				data: {
					created_before: Collection.prototype.getOldestPublishedTime.call($scope.collection)
				}, 
				success: function(result) {
					$scope.collection.totalItems = result.totalItems;
					result.items.forEach(function(item) {
						$scope.collection.items.push(item);
					});
					$scope.collection.items = $scope.collection.items.concat(result.items);
					$scope.loadingOlderActivities = false;						
				}
			});
		};
		
		$scope.loadOlderItems();
	};	
});
