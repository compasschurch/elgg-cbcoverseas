// <script>

define(function() {
	function Controller($scope, container, elgg, $timeout) {
		$scope.blog = {
			container: container,
			status: 'draft',
			comments_on: 'On',
			access_id: 0,
		};

		$scope.save = function($event) {
			this.isSaving = true;
			$timeout(function() {
				$scope.isSaving = false;
			}, 500);

			$event.preventDefault();
		};
	}

	Controller.$resolve = {
		container: function(elggDatabase, $route) {
			return elggDatabase.getEntity($route.current.params.container_guid);
		},
	};

	return Controller;
});
