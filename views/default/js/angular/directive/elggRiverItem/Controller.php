// <script>
define(function(require) {
	var Collection = require('activitystreams/Collection');
	
	return function($scope, $http, elggSession, elgg, moment) {    
        $scope.user = elggSession.user;

		$scope.getMediaAttachment = function() {
			var index = -1;
			
			this.object.attachments.forEach(function(item, idx) {
				if (item.fullImage) {
					index = idx;
				}
			});
			
			if (index == -1) {
				return null;
			}

			return this.object.attachments[index];
		};
		
		$scope.getMediaAttachments = function() {
			return this.object.attachments.filter(function(item) {
				return !!item.image;
			});
		};
    };
});