// <script>
(function(angular, $, moment, Showdown, elgg) {
    var Elgg = angular.module('Elgg', ['ngSanitize', 'ngResource']);
    
    // Move this to a "showdown" module?
    Elgg.value('showdown', new Showdown.converter());
    
    // Move these to a "moment" module?
    Elgg.filter('fromNow', function() {
        return function(dateString) {
            return moment(new Date(dateString)).fromNow();
        };
    });
    Elgg.filter('calendar', function() {
        return function(dateString) {
            return moment(new Date(dateString)).calendar();
        };
    });
    
    // Super-handy for forcing focus based on model values
    Elgg.directive('focusOn', function($timeout) {
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
    });
    
    
    // This is apparently valuable in more than one controller!
    var getOldestPublishedTime = function(objects) {
    	return objects.items.map(function(object) { 
    		return object.published; 
    	}).sort()[0];
    };


    // Actual Elgg-specific stuff
    Elgg.value('elgg', elgg);
    Elgg.value('elggSession', {
        user: {
        	guid: elgg.session.user.guid,
        	displayName: elgg.session.user.name,
        	image: elgg.session.user.image,
        	url: elgg.session.user.url
        }
    });    
    Elgg.directive('elggRiverItem', function() {
        return {
            restrict: 'A',
            templateUrl: elgg.normalize_url("/ajax/view/ng/directive/elggRiverItem/template.html"),
            replace: true,
            link: function(scope, element, attrs) {            
                scope.$watch(attrs.elggRiverItem, function(item) {
                    $.extend(scope, item);
                });
            },
            controller: function($scope, $http, elggSession, elgg) {    
                $scope.user = elggSession.user;
                    
                var indexOfEntity = function(array, entity) {
                    var index = -1;
                    
                    array.forEach(function(item, idx) {
                        if (item.guid == entity.guid) {
                            index = idx;
                        }
                    });
                    
                    return index;                
                };
                
                var indexOfAnnotation = function(annotations, annotation) {
                	var index = -1;
                	annotations.items.forEach(function(item, idx) {
                		if (item.annotation_id == annotation.annotation_id) {
                			index = idx;
                		}
                	});
                	
                	return index;
                };
            
            
                // Likes-related //
                $scope.getLikes = function(limit) {
                	return this.object.likes.items.slice(0, 3);
                };
                
                $scope.unlike_ = function() {
                	this.object.hasLiked = false;
                    var index = indexOfEntity(this.object.likes.items, this.user);
                    if (index >= 0) {
                        this.object.likes.items.splice(index, 1);
                        this.object.likes.totalItems--;
                    }                	
                }
                
                $scope.unlike = function() {
                    this.unlike_();
                    var self = this;
                    elgg.action('likes/delete', {
                    	data: {
                    		guid: this.object.guid
                    	},
                    	error: function() {
                    		self.like_();
                    	}
                    });
                    
                };
                
                $scope.like_ = function() {
                	this.object.hasLiked = true;
					if (indexOfEntity(this.object.likes.items, this.user) == -1) {
                        this.object.likes.items.unshift(this.user);
                        this.object.likes.totalItems++;
                    }
                };
                        
                $scope.like = function() {
                    this.like_();
                    var self = this;
                    elgg.action('likes/add', {
                    	data: {
                    		'guid': this.object.guid	
                    	},
                    	error: function() {
                    		self.unlike_()
                    	}
                    	
                    });
                };
                    
				var remainingLikes = function() {
					return $scope.object.likes.totalItems - $scope.object.likes.items.length;
				};
				
            	$scope.toggleLikesDrawer = function() {
            		this.likesDrawerIsOpen = !this.likesDrawerIsOpen;
            		
            		if (remainingLikes() > 0) {
            			this.loadingLikes = true;
            			elgg.getJSON('/mod/missions.compasschurch.org/api/likes.php', {
            				data: {
            					limit: 0,
            					guid: $scope.object.guid
            				},
            				success: function(json) {
            					$scope.object.likes = json;
            				},
            				complete: function() {
            					$scope.loadingLikes = false;
            					$scope.$digest();
            				}
            			});
            		}
            	};
            
                // Comments-related //
                
                $scope.startCommenting = function() {
                	this.likesDrawerIsOpen = false;
                	this.commenting = true;
                };
                
                $scope.submitComment = function() {
                	var newComment = {
                        content: this.newComment,
                        author: this.user,
                    };
                    
                    this.object.comments.items.push(newComment);
                    this.object.comments.totalItems++;
                    
                    var self = this;
                    elgg.action('comments/add', {
                    	data: {
                    		entity_guid: this.object.guid,
                    		generic_comment: this.newComment
                    	},
                    	success: function(json) {
                    		$.extend(newComment, json.output);
                    	},
                    	complete: function() {
                    		self.$digest();
                    	}
                    });
                    
                    this.resetComment();
                };
                
                $scope.resetComment = function() {
                    this.newComment = '';
                    this.commenting = false;
                };

				$scope.$on('comments/delete', function(e) {
                	$scope.deleteComment(e.targetScope);
                });
                
                
                $scope.deleteComment = function(comment) {
                	comment.deleting = true;
            		elgg.action('comments/delete', {
            			data: {
            				'annotation_id': comment.annotation_id
            			},
            			success: function(json) {
            				if (!json.system_messages.error.length) {
			            		var idx = indexOfAnnotation($scope.object.comments, comment);
								if (idx >= 0) {
			                        $scope.object.comments.items.splice(idx, 1);
			                        $scope.object.comments.totalItems--;
			                    }
            				}
            				
            			},
            			complete: function() {
            				comment.deleting = false;
			                $scope.$digest();
            			}
            		});   
            	};
                
                $scope.remainingItems = function() {
                    return this.object.comments.totalItems - this.object.comments.items.length;
                };
                                
                $scope.loadOlderItems = function() {
                    this.loadingOlderItems = true;
                    elgg.getJSON('/mod/missions.compasschurch.org/api/comments.php', {
	                    data: {
	                    	guid: this.object.guid,
	                    	created_before: getOldestPublishedTime(this.object.comments),
	                    },
	                    success: function(newComments) {
		                	newComments.items.forEach(function(comment) {
		                		$scope.object.comments.items.push(comment);
		                	});
		                	$scope.loadingOlderItems = false;
		                },
	                    complete: function() {
	                    	$scope.loadingOlderItems = false;
	                    	$scope.$digest();
	                    }
                    });
                    
                };
            }
        };
    });
    Elgg.directive('elggRiverComment', function() {
        return {
            restrict: 'A',
            replace: true,
            controller: function($scope, showdown) {
            	$scope.deleting = false;
            	
            	$scope.delete = function() {
	            	this.$emit('comments/delete');
            	};
            
                $scope.getContent = function() {
                    return showdown.makeHtml(this.content || '');
                };
            },
            templateUrl: elgg.normalize_url("/ajax/view/ng/directive/elggRiverComment/template.html"),
            link: function(scope, element, attrs) {            
                scope.$watch(attrs.elggRiverComment, function(comment) {
                    $.extend(scope, comment);
                });
            }
        };
    });
    
    Elgg.config(function($routeProvider, $locationProvider) {
    	$routeProvider.when('/activity-new', {
    		templateUrl: elgg.normalize_url('/ajax/view/ngView/site/activity'),
    		controller: function($scope, $http) {
				$scope.totalItems = 0;
				$scope.items = [];
				
				$scope.loadOlderItems = function() {
					$scope.loadingOlderActivities = true;
					elgg.getJSON('/mod/missions.compasschurch.org/api/activity.php', {
						data: {
							created_before: getOldestPublishedTime($scope)
						}, 
						success: function(result) {
							$scope.items = result.items;
							$scope.totalItems = result.totalItems;
							$scope.loadingOlderActivities = false;						
						}
					});
				}
				
				$scope.loadOlderItems();
            }
    	});
    	
    	$locationProvider.html5Mode(true);
    });
})(angular, jQuery, moment, Showdown, elgg);