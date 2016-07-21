angular.module('appAdmin')
        .factory('Auth', function ($http, $cookieStore) {
            var accessLevels = routingConfig.accessLevels
                    , userRoles = routingConfig.userRoles
                    , currentUser = $cookieStore.get('user') || {id: 0, nom: '', prenom: '', login: '', adresse: '', telephone: '', code_profil: userRoles.public, numero_eleve: -1};

            //$cookieStore.remove('user');
            var bitMask = 0;
            function changeUser(user) {
                angular.extend(currentUser, user);
            }

            return {
                authorize: function (accessLevel, role) {
                    if (role === undefined) {
                        role = currentUser.code_profil;
                    }

                    if (role == "parent_eleve")
                    {
                        bitMask = userRoles['parent_eleve'].bitMask;
                    }

                    if (role == "directeur")
                        bitMask = userRoles['directeur'].bitMask;

                    if (role == "professeur")
                        bitMask = userRoles['professeur'].bitMask;

                    if (role == "secretaire")
                        bitMask = userRoles['secretaire'].bitMask;


                    if (role == "public")
                        bitMask = userRoles['public'].bitMask;

                    if (role == "etudiant")
                    {
                        bitMask = userRoles['etudiant'].bitMask;
                    }

                    if (role == "caisse")
                        bitMask = userRoles['caisse'].bitMask;

                    console.log(accessLevel.bitMask);

                    return accessLevel.bitMask & bitMask;
                },
                isLoggedIn: function (user) {
                    if (user === undefined) {
                        user = currentUser;
                    }
                    return user.code_profil === userRoles.directeur.title || user.code_profil === userRoles.parent_eleve.title
                            || user.code_profil === userRoles.professeur.title || user.code_profil === userRoles.secretaire.title || user.code_profil === userRoles.etudiant.title
                           || user.code_profil === userRoles.caisse.title;

                },
                login: function (user, success, error) {
                    $http({
                        url: gOptions.serveur + '/rest/LoginManager.php/login',
                        method: 'GET',
                        params: {
                            login: user.login,
                            password: user.password
                        }
                    }).success(function (user) {
                        if (user.data[0] != null && user.data[0] != undefined)
                        {
                            $http.get(gOptions.serveur + '/rest/LoginManager.php/updateUser/' + user.data[0].id).
                                    success(
                                            function (data)
                                            {
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }
                        changeUser(user.data[0]);
                        $cookieStore.put('user', user.data[0]);
                        success(user);
                    }).error(error);

                },
                logout: function (user, success, error) {
                    if (user != null && user != undefined)
                    {
                        $http.get(gOptions.serveur + '/rest/LoginManager.php/updateUserDeconnect/' + user.id).
                                success(
                                        function (data)
                                        {
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }

                    changeUser({
                        id: 0,
                        nom: '',
                        prenom: '',
                        email: '',
                        adresse: '',
                        telephone: '',
                        code_profil: userRoles.public,
                        numero_eleve: -1
                    });
                    $cookieStore.remove('user');
                    bitMask = 0;
                    success();
                },
                accessLevels: accessLevels,
                userRoles: userRoles,
                user: currentUser,
            };
        });