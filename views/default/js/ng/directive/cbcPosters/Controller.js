// <script>
define(function() {
	return function($scope, cbcOverseas) {
		$scope.posters = cbcOverseas.getPosters();
	};
});