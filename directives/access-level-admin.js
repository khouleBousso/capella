angular.module('appAdmin')
.directive('accessLevelAdmin', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 2};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelParent', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 32};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelProfesseur', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 16};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelSecretaire', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 8};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelEtudiant', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 64};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]).directive('accessLevelCaisse', ['Auth', function(Auth) {
    return {
        restrict: 'A',
        link: function($scope, element, attrs) {
            var prevDisp = element.css('display') , userRole  , accessLevel;

            $scope.user = Auth.user;
            $scope.$watch('user', function(user) {
                
                if(user.code_profil)
                    userRole = user.code_profil;
                
                updateCSS();
            }, true);
            
            accessLevel = {bitMask: 4};

            function updateCSS() {   
                if(userRole && accessLevel) {
                    if(!Auth.authorize(accessLevel, userRole)){
                        element.css('display', 'none');
                    }
                    else{
                        element.css('display', prevDisp);
                    }
                }
            }
        }
    };
}]);