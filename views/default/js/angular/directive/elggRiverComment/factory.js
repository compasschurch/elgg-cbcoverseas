define(function(require) {
	var $ = require('jquery');
	
	return function() {
        return {
            restrict: 'A',
            replace: true,
			template: require("text!./template.html"),
            controller: require('./Controller'),
            link: function(scope, element, attrs) {            
                scope.$watch(attrs.elggRiverComment, function(comment) {
                    $.extend(scope, comment);
                });
            }
        };
    };
});