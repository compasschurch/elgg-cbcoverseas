// <script>
define(function(require) {
	var ActivityStreamsCollection = require('activitystreams/Collection');
	
	function River() {}
	
	River.prototype.getActivity = function() {
		return new ActivityStreamsCollection('/activity-json');	
	};
	
	return River;
});