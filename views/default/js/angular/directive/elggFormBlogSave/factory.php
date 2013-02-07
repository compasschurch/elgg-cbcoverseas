define(function(require) {
	return function() {
		return {
			restrict: 'AE',
			replace: true,
			scope: {
				blog: '=',
			},
			controller: require('./Controller'),
			template: require('text!./template.html'),
		};
	};
});
