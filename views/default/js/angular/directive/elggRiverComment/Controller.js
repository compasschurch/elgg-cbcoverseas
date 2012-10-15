define(function() {
	return function($scope, showdown) {
		$scope.deleting = false;
		
		$scope.delete = function() {
	    	this.$emit('comments/delete');
		};
	
	    $scope.getContent = function() {
	        return showdown.makeHtml(this.content || '');
	    };
	};
});