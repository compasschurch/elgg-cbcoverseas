define(function() {
	return function($timeout) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                scope.$watch(attrs.focusOn, function(value){
                    if (attrs.focusOn) {
                        $timeout(function(){
                            element.focus();
                        }, 0);
                    }
                }, true);
            }
        };
    };
});