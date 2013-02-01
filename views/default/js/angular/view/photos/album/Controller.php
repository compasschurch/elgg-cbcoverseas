// <script>

define(function() {
	function Controller($scope, album, $window) {
		$scope.album = album;
		
		$scope.deleteEntity = function(album) {
			if ($window.confirm('Are you sure?')) {
				
			}
		};
	}

	Controller.$resolve = {
		album: function(elggDatabase, $route) {
			return elggDatabase.getCollection('/album-json', {
				guid: $route.current.params.guid
			});
		}
	};

	return Controller;
});
