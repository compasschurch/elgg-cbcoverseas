define(function(require) {
	var Collection = require('activitystreams/Collection');
	var elgg = require('elgg');
	
	return function($scope) {
		var collection = new Collection(elgg.normalize_url('/activity-json'));
		
		$scope.hasNextItems = function() {
			return !!collection.links.next;	
		};
		
		$scope.loadNextItems = function() {
			var scrollTop = window.document.body.scrollTop;
			collection.loadNextItems().always(function() {
					this.$digest();
				}.bind(this)).
				always(function() {
					window.document.body.scrollTop = scrollTop;	
				});
		};
		
		$scope.isLoadingNextItems = function() {
			return !!collection.loadingNextItems;	
		};
		
		$scope.getItems = function() {
			return collection.items;	
		};
		
		$scope.loadNextItems();
	};	
});
