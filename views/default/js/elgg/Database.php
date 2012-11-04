// <script>
define(function(require) {
	var ActivityStreamsCollection = require('activitystreams/Collection');
	
	function Database() {}
	
	Database.prototype.getActivity = function() {
		return new ActivityStreamsCollection('/activity-json');	
	};
	
	Database.prototype.getUsers = function() {
		return new ActivityStreamsCollection('/users-json');
	}
	
	return Database;
});