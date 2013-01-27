// <script>

define(function() {
	function Controller($scope, album) {
		$scope.album = album;
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
