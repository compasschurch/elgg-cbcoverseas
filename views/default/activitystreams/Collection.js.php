// <script>
define(function(require) {

	function Collection(obj) {
		this.totalItems = 0;
		this.items = [];
	}
	
	Collection.prototype.getOldestPublishedTime = function() {
    	return this.items.map(function(object) { 
    		return object.published; 
    	}).sort()[0];
	};

	return Collection;
});