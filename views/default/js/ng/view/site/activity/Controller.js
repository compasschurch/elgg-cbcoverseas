// <script>
define(function(require) {
	var elgg = require('elgg');
	var ActivityStreamsCollection = require('activitystreams/Collection');
	
	function Controller($scope, river, $http, elggUser) {
		ActivityStreamsCollection.call(this, river, $http);
		
		// Export necessary functions and models to scope
		$scope.user = elggUser;
		$scope.getItems = this.getItems.bind(this);		
		$scope.hasNextItems = this.hasNextItems.bind(this);
		$scope.isLoadingNextItems = this.isLoadingNextItems.bind(this);
		$scope.loadNextItems = function() {
			var $digest = $scope.$digest.bind($scope);
			this.loadNextItems().then($digest, $digest);
		}.bind(this);
	}
	elgg.inherit(Controller, ActivityStreamsCollection);

	Controller.$resolve = {
		river: function(elggDatabase) {
			return elggDatabase.getActivity();
		},
	};

	return Controller;
});
