// <script>
define(function(require) {
	var elgg = require('elgg');
	var ElggDatabase = require('elgg/Database');
	
	function CbcOverseas($http) {
		ElggDatabase.call(this, $http);
	}
	elgg.inherit(CbcOverseas, ElggDatabase);
	
	CbcOverseas.prototype.getPosters = function() {
		return this.getCollection('/posters-json');
	};
	
	return CbcOverseas;
});