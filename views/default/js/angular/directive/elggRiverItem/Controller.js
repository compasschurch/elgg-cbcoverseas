define(function(require) {
	var Collection = require('activitystreams/Collection');
	
	function Controller($scope, $http, elggSession, elgg, moment) {    
        $scope.user = elggSession.user;
    
        // Likes-related //
        $scope.getLikes = function(limit) {
        	return this.object.likes.items.slice(0, 3);
        };
        
        $scope.unlike_ = function() {
        	if (this.object.hasLiked) {
                this.object.likes.totalItems--;                	
        	}
        	
            var index = Collection.prototype.indexOfEntity.call(this.object.likes, this.user);
            if (index >= 0) {
                this.object.likes.items.splice(index, 1);
            }                	
			
			this.object.hasLiked = false;
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
			if (!this.hasLiked) {
				this.object.likes.totalItems++;
			}
			
			if (Collection.prototype.indexOfEntity.call(this.object.likes, this.user) == -1) {
                this.object.likes.items.unshift(this.user);
            }
        	
        	this.object.hasLiked = true;
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
    			elgg.getJSON('/likes-json', {
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
                published: moment().format(),
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
				'annotation_id': comment.annotation_id
			}).then(function(json) {
				if (!json.system_messages.error.length) {
            		var idx = Collection.prototype.indexOfAnnotation.call($scope.object.comments, comment);
					if (idx >= 0) {
                        $scope.object.comments.items.splice(idx, 1);
                        $scope.object.comments.totalItems--;
                    }
				}
			}).done(function() {
				comment.deleting = false;
                $scope.$digest();
			});   
    	};
        
        $scope.remainingItems = function() {
            return this.object.comments.totalItems - this.object.comments.items.length;
        };
                        
        $scope.loadOlderItems = function() {
            this.loadingOlderItems = true;
            elgg.getJSON('/comments-json', {
            	guid: this.object.guid,
            	created_before: Collection.prototype.getOldestPublishedTime.call(this.object.comments),
            }).then(function(newComments) {
            	newComments.items.forEach(function(comment) {
            		$scope.object.comments.items.push(comment);
            	});
            	$scope.loadingOlderItems = false;
            }).done(function() {
            	$scope.loadingOlderItems = false;
            	$scope.$digest();
            });
            
        };
    }
    
    return Controller;
});