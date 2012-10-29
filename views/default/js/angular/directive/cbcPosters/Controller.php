// <script>
define(function() {
	return function($scope, cbcOverseas) {
		var posters = cbcOverseas.getPosters();
		
		$scope.getPosters = function() {
			return posters.items;
		};
	
		posters.loadNextItems();
		
	};
});