// <script>
define(function() {
	return function($scope, river, elggLoggedInUser) {
		$scope.river = river;
		$scope.user = elggLoggedInUser;
		
		$scope.loadNextItems = function() {
			this.river.loadNextItems().always(function() {
				$scope.$digest();
			});
		};
	};	
});