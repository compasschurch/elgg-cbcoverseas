// <script>
define(function(require) {
	var elgg = require('elgg');
	var ActivityStreamsCollection = require('activitystreams/Collection');
	
	var Database = function($http) {
		this.$http = $http;
	};
	
	Database.prototype.getObject = function(url, data) {
		return this.$http.get(elgg.normalize_url(url), {params:data}).then(function(result) {
			return result.data;
		});
	};

	Database.prototype.getCollection = function(url, data) {
		return this.getObject(url, data).then(function(result) {
			return new ActivityStreamsCollection(result);
		});		
	};
	
	Database.prototype.getEntity = function(guid) {
		return this.getObject('/entity-json', {guid: guid});
	};

	Database.prototype.getActivity = function() {
		return this.getCollection('/activity-json');
	};
	
	Database.prototype.getUsers = function() {
		return this.getCollection('/users-json');
	};
	
	Database.prototype.getPlugin = function(id) {
		return this.getObject('/admin/plugins-json', {id:id});
	};
	
	return Database;
});