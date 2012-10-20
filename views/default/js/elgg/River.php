// <script>
define(function(require) {
	var Collection = require('activitystreams/Collection');
	
	function River() {}
	
	River.prototype.getActivity = function() {
		return new Collection('/activity-json');	
	};
	
	return River;
});