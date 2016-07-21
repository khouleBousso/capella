var userModule = angular.module('user', ['ui.router']);


//start UtilisateurCtrl
userModule.controller('UtilisateurCtrl', UtilisateurCtrl, ['$scope']);
function UtilisateurCtrl($resource, $http, $scope, $location, growl,fileUpload)
{
    $scope.users = [];
    $scope.profils = [];
    $scope.user = {};
    $scope.upload = {};
    $scope.upload.avatar = "";
    $scope.validateAvatar = false;

    $http.get(gOptions.serveur + '/rest/LoginManager.php/getAllUsers').
            success(
                    function (data)
                    {

                        $scope.users = data.data;
                    }
            ).
            error(function (result)
            {
            });

    $scope.showAjoutUser = false;
    $scope.popupAjoutUser = function () {
         $scope.user = {};
        $scope.showAjoutUser = !$scope.showAjoutUser;
    }

    $scope.showModUser = false;
    $scope.popupModUser = function (idUser) {
        $scope.showModUser = !$scope.showModUser;
        $http.get(gOptions.serveur + '/rest/LoginManager.php/getUserById/' + idUser).
                success(
                        function (data)
                        {

                            $scope.user = data.data[0];
                            $scope.upload.avatar.name = $scope.user.avatar;
                        }
                ).
                error(function (result)
                {
                });

    }

    $scope.launch = function () {
        $("#icone").trigger('click');


        $("#icone").change(function () {
            if ($scope.upload.avatar.size > 1500000)
            {
                $("#groupeAvatar").removeClass("has-success");
                $("#groupeAvatar").addClass("has-error");
                $scope.validateAvatar = false;
            }
            else
            {
                if ($scope.upload.avatar.type != "image/jpeg" && $scope.upload.avatar.type != "image/jpg" && $scope.upload.avatar.type != "image/png")
                {
                    $("#groupeAvatar").removeClass("has-success");
                    $("#groupeAvatar").addClass("has-error");
                    $scope.validateAvatar = false;
                }
                else {
                    $("#groupeAvatar").removeClass("has-error");
                    $("#groupeAvatar").addClass("has-success");
                    $scope.validateAvatar = true;
                }
            }
        });
    }

    $scope.ajoutModUser = function () {
        $scope.invalidMail = false;
        for (var i = 0; i < $scope.users.length; i++) {
            if ($scope.users[i].email == $scope.user.email && $scope.users[i].id != $scope.user.id) {
                $scope.invalidMail = true;
            }
        }

        
        if ($scope.user.id == null && $scope.invalidMail == false)
        {
            if($scope.validateAvatar == true)
            {
                
                $scope.nameTemp = $scope.user.email;
                $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                if ($scope.formatAvatar == "jpeg")
                    $scope.formatAvatar = "jpg";

                $scope.user.name = $scope.nameTemp + "." + $scope.formatAvatar;
                //Ajout Eleve
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.user.name,"avatarUsers", uploadUrl);
            }
                
            $http.post(gOptions.serveur + '/rest/LoginManager.php/addUser', $scope.user).
                    success(function (data)
                    {
                        $scope.showAjoutUser = !$scope.showAjoutUser;
                        $scope.user = {};
                        $http.get(gOptions.serveur + '/rest/LoginManager.php/getAllUsers').
                                success(
                                        function (data)
                                        {

                                            $scope.users = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.user.id != null && $scope.invalidMail == false) {
            //Modfier Utilisateur
            
             if($scope.validateAvatar == true)
            {
                
                $scope.nameTemp = $scope.user.email;
                $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                if ($scope.formatAvatar == "jpeg")
                    $scope.formatAvatar = "jpg";

                $scope.user.name = $scope.nameTemp + "." + $scope.formatAvatar;
                //Ajout Eleve
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.user.name,"avatarUsers", uploadUrl);
            }
            else
                 $scope.user.name  =  $scope.user.avatar;
             
                
            $http.post(gOptions.serveur + '/rest/LoginManager.php/modUser', $scope.user).
                    success(function (data)
                    {
                        $scope.showModUser = !$scope.showModUser;
                        $scope.user = {};
                        $http.get(gOptions.serveur + '/rest/LoginManager.php/getAllUsers').
                                success(
                                        function (data)
                                        {

                                            $scope.users = data.data;
                                        }
                                ).
                                error(function (result)
                                {
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }
    
    $scope.annulerUser = function()
    {
        if($scope.user.id ==null)
        $scope.showAjoutUser = !$scope.showAjoutUser;
    
        if($scope.user.id !=null)
          $scope.showModUser = !$scope.showModUser; 
      
      $scope.user = {};
    }
    
    $scope.dismiss = function(){
          $scope.user = {};
    }
}