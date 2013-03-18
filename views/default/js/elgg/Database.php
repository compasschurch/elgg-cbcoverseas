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

	Database.prototype.getActivity = function(data) {
		return this.getCollection('/activity-json', data);
	};
	
	Database.prototype.getUsers = function(data) {
		return this.getCollection('/users-json', data);
	};
	
	Database.prototype.getPlugin = function(id) {
		return this.getObject('/admin/plugins-json', {id:id});
	};

	Database.prototype.getAlbums = function(data) {
		return this.getCollection('/albums-json', data);
	};
	
	return Database;
});
