// <script>
define(function(require) {
	var ActivityStreamsCollection = require('activitystreams/Collection');
	
	function CbcOverseas() {};
	
	CbcOverseas.prototype.getPosters = function() {
		return new ActivityStreamsCollection('/posters-json');
	};
	
	return CbcOverseas;
});