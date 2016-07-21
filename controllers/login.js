angular.module('appAdmin').controller('NavCtrl', ['$rootScope', '$scope', '$location', 'Auth', function ($rootScope, $scope, $location, Auth) {
        $scope.user = Auth.user;
        $scope.userRoles = Auth.userRoles;
        $scope.accessLevels = Auth.accessLevels;

        $scope.logout = function () {
            Auth.logout(Auth.user,function () {
                if (gOptions.auth_check != undefined && !gOptions.auth_check) {
                }
                else {	  
                    $location.path('/login');
                }

            }, function () {
                $rootScope.error = "Failed to logout";
            });
        };
    }]);


angular.module('appAdmin').controller('LoginCtrl',
        ['$rootScope', '$scope', '$location', '$state', '$window','Auth', 'growl', function ($rootScope, $scope, $location, $state, $window, Auth, growl,$route) {
                $rootScope.error = "";
                $scope.login = function (user) {
                    user.code_profil = '';
                    Auth.login(user,
                            function (data) {
                                $scope.user = data.data[0];
                                if ($scope.user == null || $scope.user == '') {
//						growl.warning("This adds a warn message");
//						growl.info("This adds a info message");
//						growl.success("This adds a success message");
//						growl.error("This adds a error message");
                                    $rootScope.error = "Email ou mot de passe incorrect";
                                }
                                else {
                                    $rootScope.error = "";
                                    $scope.user.password = "";
                                    role = data.data[0].code_profil;
                                    if (role == 'directeur') {
                                        $state.go('accueil');
                                    }

                                    if (role == 'professeur') {
                                        $state.go('meseleves', {id: data.data[0].id});
                                    }
                                    if (role == 'secretaire' || role=='caisse') {
                                          $state.go('accueil');
                                        }
                                    if (role == 'etudiant') {
                                          $state.go('fiche', {id: data.data[0].id_etudiant});
                                    }
                                    else if (role == 'parent_eleve') {
                                        $state.go('accueil_parent', {id: data.data[0].id});
                                    }
                                    

                                }
								
                            },
                            function (err) {
                                $rootScope.error = "Une erreur est survenue lors du traitement de l'op\351ration.";
                            });
                };

            }]);