// <script>
define(function(require) {
	return function() {
		return {
			restrict: 'A',
			replace: true,
			template: require("text!./template.html"),
			controller: require('./Controller'),
			scope: {
				comment: '='
			}
		};
	};
});
