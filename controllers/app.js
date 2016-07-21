var appAdmin = angular.module('appAdmin', ['ui.router', 'ui.mask', 'tarif', 'user','cgBusy','notesPresences', 'ngCookies', 'ngResource', 'datatables', 'angular-growl','autocomplete','cfp.loadingBarInterceptor','localytics.directives']);
appAdmin.run(
        function (DTDefaultOptions) {
            var oPaginate = {};
            oPaginate["sFirst"] = "|<";
            oPaginate["sPrevious"] = "<";
            oPaginate["sNext"] = ">";
            oPaginate["sLast"] = ">|";
            var oLanguage = {};
            oLanguage["oPaginate"] = oPaginate;
            oLanguage["sLengthMenu"] = "Afficher _MENU_ &eacute;l&eacute;ments";
            oLanguage["sInfo"] = "_START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments";
            oLanguage["sSearch"] = "Recherche";
            oLanguage["sProcessing"] = "Traitement en cours...";
            oLanguage["sZeroRecords"] = "Aucun &eacute;l&eacute;ment &agrave; afficher";
            oLanguage["sEmptyTable"] = "Aucune donn&eacute;e disponible dans le tableau";
            oLanguage["sInfoEmpty"] = "0 &eacute;l&eacute;ment &agrave; afficher";
            oLanguage["sInfoFiltered"] = "";
            oLanguage["sInfoPostFix"] = "";
            DTDefaultOptions.setLanguage(oLanguage);
        }).run(
        ['$rootScope', '$state', '$stateParams',
            function ($rootScope, $state, $stateParams) {
                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
            }
        ]).run(['$rootScope', '$state', 'Auth', 'growl', function ($rootScope, $state, Auth, growl,$route) {

        $rootScope.$on("$stateChangeStart", function (event, toState, toParams, fromState, fromParams) {
            if (gOptions.auth_check != undefined && !gOptions.auth_check) {
                $rootScope.isPageLogin = false;
            }
            else {
                if (toState.name != 'login') {
                    $rootScope.isPageLogin = false;

                    if (Auth.isLoggedIn()) {
                        if (toState.data != undefined && toState.data != null) {
                            if (!Auth.authorize(toState.data.access)) {

                                growl.warning("Vous n'avez pas le droit d'acc\351der \340 la page demand\351e", {ttl: 3000});
                                if (Auth.user.code_profil == 'parent_eleve') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('accueil_parent', {id: Auth.user.id});
                                }
                                else if (Auth.user.code_profil == 'professeur') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('meseleves', {id: Auth.user.id});
                                }
                                else if (Auth.user.code_profil == 'secretaire' || Auth.user.code_profil == 'caisse') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('accueil');
                                }
                                else if (Auth.user.code_profil == 'etudiant') {
                                    $rootScope.isPageLogin = false;
                                    event.preventDefault();
                                    $state.go('fiche', {id: Auth.user.id_etudiant});
                                }
                                else {
                                    $rootScope.isPageLogin = true;
                                    event.preventDefault();
                                    $state.go('login');  $route.reload();

                                }
                            }
                        }
                    }
                    else {
                        $rootScope.error = "Veuillez d'abord vous authentifier";
                        $rootScope.isPageLogin = true;
                        event.preventDefault();
                        $state.go('login');
                    }
                }
                else {
                    $rootScope.isPageLogin = true;
                }
            }
        });

    }]);
appAdmin
        .config(
                ['$stateProvider', '$urlRouterProvider', '$httpProvider',
                    function ($stateProvider, $urlRouterProvider, $httpProvider) {

                        $urlRouterProvider.otherwise('/accueil');
                        var access = routingConfig.accessLevels;
                        $stateProvider.
                                state('/', {url: "/home", templateUrl: gOptions.appname + 'views/index.php', data: {access: access.dircaissec}}).
                                state('home', {url: "/home", templateUrl: gOptions.appname + 'views/index.php', data: {access: access.dircaissec}}).
                                state('notes', {url: "/notes", templateUrl: gOptions.appname + 'views/note/notes.php', data: {access: access.secretaire}}).
                                state('factures', {url: "/factures", templateUrl: gOptions.appname + 'views/factureClasse/factures.php', data: {access: access.caisse}}).
                                state('postdocument', {url: "/postdocument", templateUrl: gOptions.appname + 'views/cours/postdocument.php', data: {access: access.professeur}}).
                                state('devoirs', {url: "/devoirs", templateUrl: gOptions.appname + 'views/devoirClasse/devoirs.php', data: {access: access.dirprofsec}}).
                                state('recues', {url: "/recues", templateUrl: gOptions.appname + 'views/recuClasse/recues.php', data: {access: access.caisse}}).
                                state('fiche-presence', {url: "/fiche-presence", templateUrl: gOptions.appname + 'views/presenceClasse/fiche-presence.php', data: {access: access.secretaire}}).
                                state('fiche-notes', {url: "/fiche-notes", templateUrl: gOptions.appname + 'views/noteClasse/fiche-note.php', data: {access: access.secretaire}}).
                                state('index', {url: "/index/:eleve", templateUrl: gOptions.appname + 'views/index.php', data: {access: access.secretaire}}).
                                state('edt', {url: "/edt", templateUrl: gOptions.appname + 'views/edt/edt.php', data: {access: access.etudiant}}).
                                state('recherche', {url: "/recherche", templateUrl: gOptions.appname + 'views/eleve/recherche.php', data: {access: access.dircaissec}}).
                                state('list-desistement', {url: "/list-desistement", templateUrl: gOptions.appname + 'views/eleve/list-desistement.php', data: {access: access.secretaire}}).
                                state('contact', {url: "/contact", templateUrl: gOptions.appname + 'views/contact.php'}).
                                 state('traitement', {url: "/traitement", templateUrl: gOptions.appname + 'views/traitement.php'}).
                                state('liste-payements', {url: "/liste-payements", templateUrl: gOptions.appname + 'views/eleve/liste-payements.php', data: {access: access.dircaissec}}).
                                state('factures-impayees', {url: "/factures-impayees", templateUrl: gOptions.appname + 'views/eleve/factures-impayees.php', data: {access: access.dircaissec}}).
                                state('meseleves', {url: "/meseleves/:id", templateUrl: gOptions.appname + 'views/meseleves.php', data: {access: access.professeur}}).
                                state('reception', {url: "/reception/:id", templateUrl: gOptions.appname + 'views/inbox/reception.php', data: {access: access.parent_eleve}}).
                                state('transport', {url: "/transport", templateUrl: gOptions.appname + 'views/transport/transport.php', data: {access: access.secretaire}}).
                                state('sport', {url: "/sport", templateUrl: gOptions.appname + 'views/sport/sport.php', data: {access: access.secretaire}}).
                                state('tenue', {url: "/tenue", templateUrl: gOptions.appname + 'views/tenue/tenue.php', data: {access: access.secretaire}}).
                                state('classe', {url: "/classe", templateUrl: gOptions.appname + 'views/classe/classe.php', data: {access: access.secretaire}}).
                                state('matiere', {url: "/matiere", templateUrl: gOptions.appname + 'views/matiere/matiere.php', data: {access: access.secretaire}}).
                                state('tarif', {url: "/tarif", templateUrl: gOptions.appname + 'views/tarifs/tarif.html', data: {access: access.allusers}}).
                                state('accueil', {url: "/accueil", templateUrl: gOptions.appname + 'views/accueil/accueil.php', data: {access: access.dircaissec}}).
                                state('inscription', {url: "/inscription/:id", templateUrl: gOptions.appname + 'views/inscription/inscription.php', data: {access: access.secretaire}}).
                                state('fiche', {url: "/fiche-eleve?:id?&:active?&:annee?", templateUrl: gOptions.appname + 'views/eleve/fiche.php', data: {access: access.etudiant}}).
                                state('login', {url: "/login", templateUrl: gOptions.appname + 'views/login.php', data: {access: access.public}}).
                                state('motdepasse', {url: "/motdepasse/:id", templateUrl: gOptions.appname + 'views/motdepasse.php', data: {access: access.etudiant}}).
                                state('utilisateurs', {url: "/utilisateurs", templateUrl: gOptions.appname + 'views/user/utilisateurs.php', data: {access: access.directeur}}).
                                state('accueil_parent', {url: "/accueil_parent/:id", templateUrl: gOptions.appname + 'views/accueil_parent.php', data: {access: access.parent_eleve}}).
                                state('profil', {url: "/profil/:id", templateUrl: gOptions.appname + 'views/user/profil.php', data: {access: access.allusers}})

                    }]).config(['$httpProvider', function($httpProvider) {

                        $httpProvider.defaults.headers.post['Content-Type'] = undefined;
                        $httpProvider.defaults.useXDomain = true;
    }
])


appAdmin.factory('getAnneeEncours', function ($http) {
    return {
        getAnnee: function () {
            return $http.get(gOptions.serveur + '/rest/LoginManager.php/getAnneeEncours');
        }
    }
});


appAdmin.controller('BodyCtrl', BodyCtrl, ['$rootScope']);
function BodyCtrl($rootScope)
{
 
     
}

appAdmin.controller('DocumentsEtudiantCtrl', DocumentsEtudiantCtrl, ['$scope', 'growl', '$http']);
function DocumentsEtudiantCtrl($http, $scope, growl, $stateParams, Auth, $state)
{
    $scope.documents = [];
    $scope.appname = gOptions.serveur;

    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        $http.get(gOptions.serveur + '/rest/DocumentManager.php/ListDocumentsEtudiant/' + $stateParams.id).
        success(function (data)
        {
            $scope.documents = data.data;
        });

    }
}


appAdmin.controller('CoursCtrl', CoursCtrl, ['$scope', 'growl', '$http']);
function CoursCtrl($http, $scope, growl, $stateParams, Auth, $state, fileUpload, getAnneeEncours)
{
    $scope.upload = {};f
    $scope.upload.cours = "";
    $scope.upload.examen = "";
    $scope.upload.corrige = "";
    $scope.validateCours = false;
    $scope.validateExamen = false;
    $scope.validateCorrige = false;
    $scope.classes = [];
    $scope.matieres = [];
    $scope.documents = [];
    $scope.user = Auth.user;
    $scope.showAjoutDocument = false;
    $scope.professeur = {};
    $scope.document = {};
    $scope.appname = gOptions.appname;
    $scope.document.cours = '';
    $scope.document.examen = '';
    $scope.document.corrige = '';

    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $scope.idProfesseur = $stateParams.id;
                $http.get(gOptions.serveur + '/rest/ClasseManager.php/getClassesByProfesseur/' + $scope.user.id).
                        success(
                                function (data)
                                {

                                    $scope.classes = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
                $http.get(gOptions.serveur + '/rest/DocumentManager.php/ListDocuments/' + $scope.user.id).
                        success(function (data)
                        {

                            $scope.documents = data.data;
                        });
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });


    $scope.launchCours = function () {
        $("#iconeCours").trigger('click');

        $("#iconeCours").change(function () {
            if ($scope.upload.cours.size > 1500000)
            {
                $("#groupeCours").removeClass("has-success");
                $("#groupeCours").addClass("has-error");
                $scope.validateCours = false;
            }
            else
            {
                if ($scope.upload.cours.type != "application/pdf")
                {
                    $("#groupeCours").removeClass("has-success");
                    $("#groupeCours").addClass("has-error");
                    $scope.validateCours = false;
                }
                else {
                    $("#groupeCours").removeClass("has-error");
                    $("#groupeCours").addClass("has-success");
                    $scope.validateCours = true;
                }
            }
        });
    }


    $scope.launchExamen = function () {
        $("#iconeExamen").trigger('click');

        $("#iconeExamen").change(function () {
            if ($scope.upload.examen.size > 1500000)
            {
                $("#groupeExamen").removeClass("has-success");
                $("#groupeExamen").addClass("has-error");
                $scope.validateExamen = false;
            }
            else
            {
                if ($scope.upload.examen.type != "application/pdf")
                {
                    $("#groupeExamen").removeClass("has-success");
                    $("#groupeExamen").addClass("has-error");
                    $scope.validateExamen = false;
                }
                else {
                    $("#groupeExamen").removeClass("has-error");
                    $("#groupeExamen").addClass("has-success");
                    $scope.validateExamen = true;
                }
            }
        });
    }


    $scope.launchCorrige = function () {
        $("#iconeCorrige").trigger('click');

        $("#iconeCorrige").change(function () {
            if ($scope.upload.corrige.size > 1500000)
            {
                $("#groupeCorrige").removeClass("has-success");
                $("#groupeCorrige").addClass("has-error");
                $scope.validateCorrige = false;
            }
            else
            {
                if ($scope.upload.corrige.type != "application/pdf")
                {
                    $("#groupeCorrige").removeClass("has-success");
                    $("#groupeCorrige").addClass("has-error");
                    $scope.validateCorrige = false;
                }
                else {
                    $("#groupeCorrige").removeClass("has-error");
                    $("#groupeCorrige").addClass("has-success");
                    $scope.validateCorrige = true;
                }
            }
        });
    }


    $scope.changeClasse = function ()
    {

        $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.document.classe.id_classe).
                success(
                        function (data)
                        {

                            $scope.matieres = data.data;
                        }).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.popupAjoutDocument = function () {
        $scope.showAjoutDocument = !$scope.showAjoutDocument;

    }

    $scope.ajoutDocument = function () {

        $scope.document.id_professeur = $scope.user.id;


        if ($scope.validateCorrige || $scope.validateExamen || $scope.validateCours)
        {

            if ($scope.validateCours)
            {

                $scope.document.cours = $scope.upload.cours.name;
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($("#iconeCours")[0].files[0], $scope.document.cours, "documents", uploadUrl);
            }


            if ($scope.validateExamen)
            {

                $scope.document.examen = $scope.upload.examen.name;
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($("#iconeExamen")[0].files[0], $scope.document.examen, "documents", uploadUrl);
            }

            if ($scope.validateCorrige)
            {

                $scope.document.corrige = $scope.upload.corrige.name;
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($("#iconeCorrige")[0].files[0], $scope.document.corrige, "documents", uploadUrl);
            }

            $http.post(gOptions.serveur + '/rest/DocumentManager.php/AddDocument', $scope.document).
                    success(function (data)
                    {

                        $scope.document = {};
                        $scope.showAjoutDocument = !$scope.showAjoutDocument;
                        growl.info('Document upload&eacute; avec succ√®s', {ttl: 3000});
                        $http.get(gOptions.serveur + '/rest/DocumentManager.php/ListDocuments/' + $scope.user.id).
                                success(function (data)
                                {

                                    $scope.documents = data.data;
                                });
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }


    $scope.annulerDocument = function () {
        $scope.document = {};
        $scope.showAjoutDocument = !$scope.showAjoutDocument;
        $("#groupeCours").removeClass("has-error").removeClass('has-success');
        $("#groupeExamen").removeClass("has-error").removeClass('has-success');
        $("#groupeCorrige").removeClass("has-error").removeClass('has-success');
        $scope.upload = {};
        $scope.upload.cours = "";
        $scope.upload.examen = "";
        $scope.upload.corrige = "";
        $scope.validateCours = false;
        $scope.validateExamen = false;
        $scope.validateCorrige = false;
    }
}

appAdmin.controller('ReceptionCtrl', ReceptionCtrl, ['$scope', 'growl', '$http']);
function ReceptionCtrl($http, $scope, growl, $stateParams, Auth, $state, fileUpload, Auth)
{

    $scope.message = {};
    $scope.user = Auth.user;
    nbrnonlue = 0;
    nbrenvoye = 0;
    nbrarchive = 0;
    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessages/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.messages = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessagesArchives/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.messagesArchives = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });


    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessagesSent/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.messagesSent = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

    var Inbox = {
        show_list: function () {

            $('.message-content').addClass('hide');
            $('.message-navbar').addClass('hide');
            $('#id-message-list-navbar').removeClass('hide');

            $('.message-footer').addClass('hide');
            $('.message-footer:not(.message-footer-style2)').removeClass('hide');

            //hide the message item / new message window and go back to list


            $('.message-list').addClass('hide').next().addClass('hide');
            $('#message-list').removeClass('hide');
        }
        ,
        show_archive: function () {

            $('.message-footer').addClass('hide');
            $('.message-footer:not(.message-footer-style2)').removeClass('hide');

            $('.message-navbar').addClass('hide');
            $('#id-message-list-navbarArchive').removeClass('hide');


            $('.message-list').addClass('hide').next().addClass('hide');
            $('#message-list-archive').removeClass('hide');

        }
        ,
        show_sent: function () {

            $('.message-footer').addClass('hide');
            $('.message-footer:not(.message-footer-style2)').removeClass('hide');

            $('.message-navbar').addClass('hide');
            $('#id-message-list-navbarSent').removeClass('hide');


            $('.message-list').addClass('hide').next().addClass('hide');
            $('#message-list-sent').removeClass('hide');

        },
        show_form: function () {

            if ($('.message-form').is(':visible'))
                return;
            if (!$scope.form_initialized) {
                initialize_form();
            }
            var message = $('.message-list');
            $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');


            setTimeout(function () {
                message.next().addClass('hide');
//                    if(messageParam !=undefined)
//                    $('.form-textarea').append(messageParam.message);   
                $('.message-container').find('.message-loading-overlay').remove();

                $('.message-list').addClass('hide');
                $('.message-footer').addClass('hide');
                $('.message-form').removeClass('hide').insertAfter('#message-list');

                $('.message-navbar').addClass('hide');
                $('#id-message-new-navbar').removeClass('hide');
            }, 300 + parseInt(Math.random() * 300));
        }
    };



    $scope.form_initialized = false;
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $stateParams.id != 'default')
    {
        $http.get(gOptions.serveur + '/rest/MessagerieManager.php/getMessage/' + $stateParams.id).
                success(
                        function (data)
                        {

                            $scope.message = data.data[0];

                            $scope.load($scope.message, 'header', 'rec');
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
    else if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && $stateParams.id == 'default')
        initInbox();



    function initInbox()
    {
        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function () {
                        $('.chosen-select').each(function () {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
            });

        }



        //handling tabs and loading/displaying relevant messages and forms
        //not needed if using the alternative view, as described in docs
        $('#inbox-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            var currentTab = $(e.target).data('target');

            if (currentTab == 'write') {
                Inbox.show_form();
            }

            if (currentTab == 'inbox') {
                Inbox.show_list();
            }

            if (currentTab == 'draft') {
                Inbox.show_archive();
            }

            if (currentTab == 'sent') {
                Inbox.show_sent();
            }
        });



        //back to message list
        $('.btn-back-message-list').on('click', function (e) {

            e.preventDefault();
            Inbox.show_list();
            $('.li-new-mail').removeClass('active');
            if (!$scope.form_initialized) {
                initialize_form();
            }

            $('#message-list input[type=checkbox]').removeAttr('checked').closest('#message-list .message-item').removeClass('selected');
            $('#inbox-tabs .reception').addClass('active');
            $('#inbox-tabs .draft').removeClass('active');
            $('#inbox-tabs .sent').removeClass('active');
        });

        $('#form_field_select_4_chosen').addClass('col-xs-5').removeAttr('style').attr('style', 'padding : 0px');



    }


    function initialize_form() {
        if ($scope.form_initialized)
            return;
        $scope.form_initialized = true;

        //intialize wysiwyg editor
        $('.message-form .wysiwyg-editor').ace_wysiwyg({
            toolbar:
                    [
                        'bold',
                        'italic',
                        'strikethrough',
                        'underline',
                        null,
                        'justifyleft',
                        'justifycenter',
                        'justifyright',
                        null,
                        'createLink',
                        'unlink',
                        null,
                        'undo',
                        'redo'
                    ]
        }).prev().addClass('wysiwyg-style1');


        //file input
        $('.message-form input[type=file]')
                .closest('.ace-file-input')
                .addClass('width-90 inline')
                .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>');

        //Add Attachment
        //the button to add a new file input
        $('#id-add-attachment')
                .on('click', function () {
                    var file = $('<input class="filePost" type="file" name="attachment[]" />').appendTo('#form-attachments');
                    file.ace_file_input();

                    file.closest('.ace-file-input')
                            .addClass('width-90 inline')
                            .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>')
                            .parent().append('<div class="action-buttons pull-right col-xs-1">\
                                                    <a href="#" data-action="delete" class="middle">\
                                                            <i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>\
                                                    </a>\
                                            </div>')
                            .find('a[data-action=delete]').on('click', function (e) {
                        //the button that removes the newly inserted file input
                        e.preventDefault();
                        $(this).closest('.file-input-container').hide(300, function () {
                            $(this).remove();
                        });
                    });
                });
    }//initialize_form

    $scope.archiverMessage = function (index, message, type)
    {
            message.nom_archive = message.nom_receiver;

        $http.post(gOptions.serveur + '/rest/MessagerieManager.php/UpdateMessageArchive', message).
                success(
                        function (data)
                        {

                            $scope.messagesArchives.push(message);
                            if (type == 'rec')
                                $scope.messages.splice(index, 1);
                            else if (type == 'sent')
                                $scope.messagesSent.splice(index, 1);

                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageNonLu/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.nbrnonlue = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });

                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageArchive/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.nbrarchive = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });

                            growl.success("Message archiv&eacute; avec succ&egraves", {ttl: 2000});
                        }
                ).
                error(function (result)
                {
                    growl.error("L'archivage du message a rencontr&eacute; des erreurs. Veuillez r&eacute;essayez ult&eacute;rieurement!!!", {ttl: 2000});
                });

    }

    $scope.SupprMessage = function (index, message, type)
    {
        $http.post(gOptions.serveur + '/rest/MessagerieManager.php/DeleteMessage', message).
                success(
                        function (data)
                        {
                            if (type == 'rec')
                                $scope.messages.splice(index, 1);
                            else if (type == 'sent')
                                $scope.messagesSent.splice(index, 1);
                            else if (type == 'arch')
                                $scope.messagesArchives.splice(index, 1);

                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageNonLu/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.nbrnonlue = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });


                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageArchive/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.nbrarchive = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageEnvoye/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.nbrenvoye = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                            growl.success("Message supprim&eacute; avec succ&egraves", {ttl: 2000});
                        }
                ).
                error(function (result)
                {
                    growl.error("La suppression du message a rencontr&eacute; des erreurs. Veuillez r&eacute;essayez ult&eacute;rieurement!!!", {ttl: 2000});
                });

    }

    $scope.replyMessage = function (message)
    {
        Inbox.show_form();
    }

    $scope.load = function (message, from, type)
    {
        initInbox();

        //We have many references attachements in one string
        // so we split that by the delimiter character :

        $scope.idsender = message.id;
        if (!$scope.form_initialized) {
            initialize_form();
        }
        $('#id-message-content .attachment-list').html('');
        $('#id-message-content .time').html('');
        $('#id-message-content .sender').html('');

        $('#id-message-content .objet').html('');
        $('#id-message-content .message-body').html('');
        $('#id-message-content .objet').append(message.objet);
        if (type == 'rec')
            $('#id-message-content .sender').append(message.nom_sender);
        else if (type == 'sent')
            $('#id-message-content .sender').append(message.nom_receiver);
        else if (type == 'arch')
            $('#id-message-content .sender').append(message.nom_archive);

        $('#id-message-content .time').append(message.date_message);

        var splitAttachements = message.attachement.split(':');

        if (message.attachement !== "" && message.attachement !== null)
        {
            for (var i = 0; i < splitAttachements.length; i++)
            {
                var attach = splitAttachements[i];
                $('#id-message-content .attachment-list').append('<li><a class="attached-file" target="_blank" href="' + gOptions.serveur + '/rest/mailFiles/' + attach + '"><i class="ace-icon fa fa-file-o bigger-110"></i>'
                        + '<span class="attached-name">' + attach + '</span>'
                        + '</a><span class="action-buttons">'
                        + '<a href="#">'
                        + '<i class="ace-icon fa fa-download bigger-125 blue"></i>'
                        + '</a></span> </li>');
            }
        }



        $('.message-content .message-body').append('<p>' + message.message + '</p>')

        /////////

        if (from == 'header')
        {
            //show the loading icon
            $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

            $('.message-inline-open').removeClass('message-inline-open').find('.message-content').remove();

            var message_list = $('#message-list');

            $('#inbox-tabs .reception').removeClass('active');
            //some waiting
            setTimeout(function () {

                //hide everything that is after .message-list (which is either .message-content or .message-form)
                message_list.next().addClass('hide');
                $('.message-container').find('.message-loading-overlay').remove();

                //close and remove the inline opened message if any!

                //hide all navbars
                $('.message-navbar').addClass('hide');
                //now show the navbar for single message item
                $('#id-message-item-navbar').removeClass('hide');

                //hide all footers
                $('.message-footer').addClass('hide');
                //now show the alternative footer
                $('.message-footer-style2').removeClass('hide');


                //move .message-content next to .message-list and hide .message-list
                $('.message-content').removeClass('hide').insertAfter(message_list.addClass('hide'));


            }, 500 + parseInt(Math.random() * 500));
        }
        //display  message in a new area
        $('.message-list .message-item .text').on('click', function () {

            //show the loading icon
            $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

            $('.message-inline-open').removeClass('message-inline-open').find('.message-content').remove();

            var message_list = $(this).closest('.message-list');

            $('#inbox-tabs .reception').removeClass('active');
            //some waiting
            setTimeout(function () {

                //hide everything that is after .message-list (which is either .message-content or .message-form)
                message_list.next().addClass('hide');
                $('.message-container').find('.message-loading-overlay').remove();

                //close and remove the inline opened message if any!

                //hide all navbars
                $('.message-navbar').addClass('hide');
                //now show the navbar for single message item
                $('#id-message-item-navbar').removeClass('hide');

                //hide all footers
                $('.message-footer').addClass('hide');
                //now show the alternative footer
                $('.message-footer-style2').removeClass('hide');


                //move .message-content next to .message-list and hide .message-list
                $('.message-content').removeClass('hide').insertAfter(message_list.addClass('hide'));

                if (message.lu == "message-unread")
                {
                    $http.post(gOptions.serveur + '/rest/MessagerieManager.php/UpdateMessageRead', message).
                            success(
                                    function (data)
                                    {

                                        $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessages/' + $scope.user.id).
                                                success(
                                                        function (data)
                                                        {

                                                            $scope.messages = data.data;
                                                        }
                                                ).
                                                error(function (result)
                                                {
                                                    console.log("error");
                                                });
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });
                }


            }, 500 + parseInt(Math.random() * 500));
        });


    }


    $scope.messageSent = {};

    $scope.sendMessage = function ()
    {
        $scope.messageSent.attachements = "";
        var firstAttachement = true;
        $('.filePost').each(function () {


            if ($(this)[0].files[0] !== undefined)
            {

                if (firstAttachement)
                {

                    $scope.messageSent.attachements = $(this)[0].files[0]['name'];
                    firstAttachement = false;
                }
                else
                    $scope.messageSent.attachements = $scope.messageSent.attachements + ":" + $(this)[0].files[0]['name'];

                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($(this)[0].files[0], $(this)[0].files[0]['name'], "mailFiles", uploadUrl);
            }

        });

        if ($scope.user.id_profil == 1)
        {
            if ($scope.messageSent.destinataires.length === 1)
            {
                var split = $scope.messageSent.destinataires[0].split(':');
                $scope.messageSent.id_receiver = split[2];
                $scope.messageSent.id_sender = 1;
                $scope.messageSent.nom_receiver = split[0] + ' ' + split[1];
                $scope.messageSent.nom_sender = 'CSI Keur Madior';

                $http.post(gOptions.serveur + '/rest/MessagerieManager.php/AddMessage', $scope.messageSent).
                        success(
                                function (data)
                                {
                                    growl.success("Votre message a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s", {ttl: 2000});
                                    $state.go('accueil');

                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            }
            else
            {

                $scope.messageSent.ids_receivers = [];
                $scope.messageSent.noms_receivers = [];
                $scope.messageSent.id_sender = 1;
                $scope.messageSent.nom_sender = 'CSI Keur Madior';
                for (var i = 0; i < $scope.messageSent.destinataires.length; i++)
                {
                    var split = $scope.messageSent.destinataires[i].split(':');
                    $scope.messageSent.ids_receivers.push({'id_receiver': '' + split[2]});
                    $scope.messageSent.noms_receivers.push({'nom_receiver': split[0] + ' ' + split[1]});
                }

                $http.post(gOptions.serveur + '/rest/MessagerieManager.php/AddMessageReplyMultiple', $scope.messageSent).
                        success(
                                function (data)
                                {
                                    growl.success("Votre message a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s", {ttl: 2000});
                                    $state.go('accueil');
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            }
        }
        else
        {
            $scope.messageSent.id_receiver = 1;
            $scope.messageSent.id_sender = $scope.user.id;
            $scope.messageSent.nom_receiver = 'CSI Keur Madior';
            $scope.messageSent.nom_sender = $scope.user.nom + ' ' + $scope.user.prenom;

            $http.post(gOptions.serveur + '/rest/MessagerieManager.php/AddMessage', $scope.messageSent).
                    success(
                            function (data)
                            {
                                growl.success("Votre message a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s", {ttl: 2000});
                                $state.go('accueil');

                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }
    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageNonLu/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.nbrnonlue = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });
    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageEnvoye/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.nbrenvoye = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });
    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountMessageArchive/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.nbrarchive = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

}


//start RechercheCtrl
appAdmin.controller('RechercheCtrl', RechercheCtrl, ['$scope', 'growl']);
function RechercheCtrl($resource, $http, $scope, $location, growl, $stateParams, getAnneeEncours)
{
    $scope.eleves = [];
    $scope.eleve = {};
    $scope.criteres = {};
    $scope.criteresRecherche = [];
    $scope.criteresRecherche.push($scope.criteres);
    $scope.criteresRecherche[0].operateur = "==";
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/EleveManager.php/ListEleves/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.eleves = data.data;
                                    $scope.elevesOld = $scope.eleves;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });


    $scope.addLineCritere = function ()
    {
        $scope.criteres = {};
        if ($scope.criteresRecherche == null)
            $scope.criteresRecherche = [];
        $scope.criteresRecherche.push($scope.criteres);

    };

    $scope.deleteLineCritere = function (criteres)
    {
        var index = $scope.criteresRecherche.indexOf(criteres);
        $scope.criteresRecherche.splice(index, 1);
        if ($scope.criteresRecherche.length == 0)
            $scope.eleves = $scope.elevesOld;
    };

    $scope.viderAllCriteres = function ()
    {
        $scope.eleves = $scope.elevesOld;
        $scope.criteresRecherche = [];
        $scope.criteresRecherche.push($scope.criteres);
        $scope.criteresRecherche[0].critere = "myac";
        $scope.criteresRecherche[0].value = "";



    }

    $scope.rechercher = function ()
    {
        $scope.elevesRecherche = [];
        $scope.eleves = $scope.elevesOld;
        var i = 0;
        var searchEx = " ";
        var critlength = $scope.criteresRecherche.length;


        // D√©finition de la condition de recherche
        while (i < critlength)
        {
            var criteres = $scope.criteresRecherche[i];

            if (criteres.operateur != undefined && criteres.critere != undefined)
            {
                if (i > 0)
                    searchEx = searchEx + "&&";

                if (criteres.critere == "nom" || criteres.critere == "prenom") //Dans le cas d'op√©ration sur des string
                {
                    searchEx = searchEx + "eleve." + criteres.critere + criteres.operateur + "('" + criteres.value + "')";
                }
                else if (criteres.critere == "numero_eleve")
                {
                    searchEx = searchEx + "eleve." + criteres.critere + criteres.operateur + "'" + criteres.value + "'";
                }

            }

            i++;
        }


        // It√©ration de v√©rification pour chacun des eleves           
        i = 0;
        while (i < $scope.eleves.length)
        {
            var eleve = $scope.eleves[i];
            if (eval(searchEx) == true)
            {
                $scope.elevesRecherche.push(eleve);
            }
            i++;
        }

        $scope.eleves = $scope.elevesRecherche;

    }
    $scope.AnnulerDesisEleve = function () {
        $scope.showDesisEleve = !$scope.showDesisEleve;
        $scope.eleve = {};
    }
    $scope.showDesisEleve = false;
    $scope.popupDesisEleve = function (eleveId) {
        idDesisEleve = eleveId;
        $scope.showDesisEleve = !$scope.showDesisEleve;
    }
    $scope.confirmDesisEleve = function () {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/Desistement/' + idDesisEleve).
                success(
                        function (data)
                        {
                            $scope.eleve.numero_eleve = idDesisEleve;
                            $http.post(gOptions.serveur + '/rest/EleveManager.php/AddMotif', $scope.eleve).
                                    success(
                                            function (data)
                                            {

                                                $scope.eleve = {};
                                                $scope.showDesisEleve = !$scope.showDesisEleve;
                                                $http.get(gOptions.serveur + '/rest/EleveManager.php/ListEleves/' + $scope.anneeEnCours).
                                                        success(
                                                                function (data)
                                                                {

                                                                    $scope.eleves = data.data;
                                                                });
                                            });

                        });
    }

}

//start DesistementCtrl
appAdmin.controller('DesistementCtrl', DesistementCtrl, ['$scope', 'growl']);
function DesistementCtrl($resource, $http, $scope, $location, growl, $stateParams, getAnneeEncours)
{
    $scope.eleves = [];
    $scope.eleve = {};
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/EleveManager.php/ListElevesDesiste/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.eleves = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });


    $scope.AnnulerDesisEleve = function () {
        $scope.showDesisEleve = !$scope.showDesisEleve;
        $scope.eleve = {};
    }
    $scope.showDesisEleve = false;
    $scope.popupDesisEleve = function (eleveId) {
        idDesisEleve = eleveId;
        $scope.showDesisEleve = !$scope.showDesisEleve;
    }
    $scope.confirmDesisEleve = function () {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/ReIntegrerEleve/' + idDesisEleve).
                success(
                        function (data)
                        {
                            $scope.eleve.numero_eleve = idDesisEleve;
                            $http.get(gOptions.serveur + '/rest/EleveManager.php/MotifReIntegrerEleve?motif=' + $scope.eleve.motif + '&numero=' + idDesisEleve).
                                    success(
                                            function (data)
                                            {

                                                $scope.eleve = {};
                                                $scope.showDesisEleve = !$scope.showDesisEleve;
                                                $http.get(gOptions.serveur + '/rest/EleveManager.php/ListElevesDesiste/' + $scope.anneeEnCours).
                                                        success(
                                                                function (data)
                                                                {

                                                                    $scope.eleves = data.data;
                                                                });
                                            });

                        });
    }

}

//start ListClasseCtrl
appAdmin.controller('ListClasseCtrl', ListClasseCtrl, ['$scope', 'growl']);
function ListClasseCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    
        $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasseBasic').
                    success(
                            function (data)
                            {
                                $scope.classes= data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
   
}


appAdmin.controller('ListTransportCtrl', ListTransportCtrl, ['$scope', 'growl']);
function ListTransportCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    
        $http.get(gOptions.serveur + '/rest/TransportManager.php/ListTransportSimple').
                    success(
                            function (data)
                            {
                                $scope.transports= data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
   
}


appAdmin.controller('ListSportCtrl', ListSportCtrl, ['$scope', 'growl']);
function ListSportCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    
        $http.get(gOptions.serveur + '/rest/SportManager.php/ListSportSimple').
                    success(
                            function (data)
                            {
                                $scope.sports= data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
   
}

appAdmin.controller('ListTenueCtrl', ListTenueCtrl, ['$scope', 'growl']);
function ListTenueCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    
        $http.get(gOptions.serveur + '/rest/TenueManager.php/ListTenueSimple').
                    success(
                            function (data)
                            {
                                $scope.tenues= data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
   
}

//start MotdepasseCtrl
appAdmin.controller('MotdepasseCtrl', MotdepasseCtrl, ['$scope', 'growl']);
function MotdepasseCtrl($resource, $http, $scope, $location, growl, $stateParams, $state)
{
    $scope.motdepasse = {};
    $scope.error = '';
    $scope.validerNewPassword = function ()
    {
        if ($scope.motdepasse.newPassword !== $scope.motdepasse.confirmPassword)
        {
            $scope.error = "Les deux mots de passe ne sont pas identiques";
        }
        else
        {
            $http.get(gOptions.serveur + '/rest/LoginManager.php/changePasswordUser?password=' + $scope.motdepasse.newPassword + '&id=' + $stateParams.id).
                    success(
                            function (data)
                            {
                                growl.success("Votre mot de passe a &eacute;t&eacute; chang&eacute; avec succ&egrave;s", {ttl: 2000});
                                $state.go('profil', {id: $stateParams.id});
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.annulerNewPassword = function ()
    {
        $state.go('profil', {id: $stateParams.id});
    }
}

//start MesEnfantsCtrl
appAdmin.controller('MesEnfantsCtrl', MesEnfantsCtrl, ['$scope', 'growl']);
function MesEnfantsCtrl($resource, $http, $scope, $location, growl, $stateParams)
{
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        $scope.enfants = [];

        $http.get(gOptions.serveur + '/rest/EleveManager.php/ListEnfants/' + $stateParams.id).
                success(
                        function (data)
                        {

                            $scope.enfants = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
}
;

//start DevCtrl
appAdmin.controller('DevCtrl', DevCtrl, ['$scope', 'growl']);
function DevCtrl($resource, $http, $scope, $location, growl, $stateParams, Auth, getAnneeEncours)
{
    $scope.user = Auth.user;
    $scope.devs = [];
    $scope.dev = {};

    function loadDevs()
    {
        $scope.dev = {};
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && 
               $stateParams.annee!= undefined && $stateParams.annee!= '' && $stateParams.annee!= -1)
                {
               
              $scope.annee = $stateParams.annee;
            $http.get(gOptions.serveur + '/rest/DevManager.php/getDevsEleveByMatiere?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {
                                //load Notes and calcul
                                $scope.devs = data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });

        }
    }

    $scope.showModDev = false;

    $scope.popupModDev = function (idDev) {
        $scope.showModDev = !$scope.showModDev;

        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {

            $http.get(gOptions.serveur + '/rest/DevManager.php/getDevByDev?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&dev=' + idDev + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {
                                $scope.dev = data.data[0];
                                $scope.dev.matiere = $scope.$parent.matiere.nom;

                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });

        }
    }


    $scope.addModDev = function () {


        //Modification Devoir
        $http.post(gOptions.serveur + '/rest/DevManager.php/modDevDev', $scope.dev).
                success(function (data)
                {
                    $scope.showModDev = !$scope.showModDev;
                    loadDevs();
                }).
                error(function (result)
                {
                    console.log("error");
                });
    }


    $scope.annulerDev = function ()
    {
        $scope.showModDev = !$scope.showModDev;
        $scope.dev = {};
    }


    $scope.dismiss = function () {
        $scope.dev = {};
    }



}

appAdmin.controller('ProfilCtrl', ProfilCtrl, ['$scope', 'growl']);
function ProfilCtrl($resource, $http, $scope, $location, growl, $stateParams)
{
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {
        $scope.user = {};

        $http.get(gOptions.serveur + '/rest/LoginManager.php/getUserById/' + $stateParams.id).
                success(
                        function (data)
                        {

                            $scope.user = data.data[0];
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
}
;


appAdmin.controller('MesElevesCtrl', MesElevesCtrl, ['$scope', 'growl']);
function MesElevesCtrl($resource, $http, $scope, $location, growl, $stateParams, getAnneeEncours)
{
    $scope.meseleves = [];
    $scope.classes = [];
    $scope.professeur = {};
    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
                {


                    $scope.idProfesseur = $stateParams.id;
                    $http.get(gOptions.serveur + '/rest/ClasseManager.php/getClassesByProfesseur/' + $stateParams.id).
                            success(
                                    function (data)
                                    {

                                        $scope.classes = data.data;
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });
                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });


    $scope.changeClasse = function () {

        console.log($scope.professeur.classe);
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.professeur.classe.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.meseleves = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }
}
;


appAdmin.controller('MainCtrl', MainCtrl, ['$scope', 'growl']);
function MainCtrl($resource, $http, $scope, $location, growl, $stateParams, Auth)
{
    $scope.user = Auth.user;
    if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
    {

        $scope.id = $stateParams.id;

    }
}
;

//start EleveCtrl
appAdmin.controller('EleveCtrl', EleveCtrl, ['$scope', 'growl']);
function EleveCtrl($resource, $http, $scope, $location, growl, $stateParams, getAnneeEncours,Auth)
{
    $scope.eleves = [];
    $scope.user = Auth.user;
    $scope.classes = [];
	$scope.inscrits = [];
	$scope.inscrit = {};
    $scope.eleve = {};
    $scope.eleve.classe = {};
    
    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
		$scope.eleve.inscrit = $scope.anneeEnCours;
                $scope.inscrit.annee = $scope.anneeEnCours;
            $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListNomClasse').
            success(
                    function (data)
                    {

                        $scope.classes = data.data;
                    }).
            error(function (result)
            {
                console.log("error");
            });

	    $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListAnneeScolaire').
            success(
                    function (data)
                    {

                        $scope.inscrits = data.data;
                    }).
            error(function (result)
            {
                console.log("error");
            });

                if ($stateParams.eleve != null && $stateParams.eleve != undefined)
                {


                    $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByNumEleve?numero_eleve=' + $stateParams.eleve + '&annee_scolaire=' + $scope.eleve.inscrit).
                            success(
                                    function (data)
                                    {

                                        $scope.eleves = data.data;
                                        $scope.eleve.classe.id_classe = data.data[0].id_classe;
                                    });


                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });



    $scope.changeClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.eleve.classe.id_classe + '&annee_scolaire=' +$scope.eleve.inscrit).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
	
    $scope.changeClasseAnnne = function ()
    {
        $scope.inscrit.annee=  $scope.eleve.inscrit;

        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByAnnee?id_classe=' + $scope.eleve.classe.id_classe + '&annee_scolaire=' + $scope.eleve.inscrit).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
$scope.exportPdfFicheClasse = function () {
        window.open(gOptions.serveur + '/pdf/ficheClasse.php?idClasse=' + $scope.eleve.classe.id_classe + '&annee_scolaire=' + $scope.eleve.inscrit, '_blank');


    }
$scope.showDesisEleve = false;
    $scope.popupDesisEleve = function (eleveId) {
       console.log(eleveId);
        idDesisEleve = eleveId;
        $scope.showDesisEleve = !$scope.showDesisEleve;
    }

$scope.AnnulerDesisEleve = function () {
        $scope.showDesisEleve = !$scope.showDesisEleve;
        $scope.eleve = {};
    }

   $scope.confirmDesisEleve = function () {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/Desistement/' + idDesisEleve).
                success(
                        function (data)
                        {

                          $scope.showDesisEleve = !$scope.showDesisEleve;
                          $scope.eleve.numero_eleve= idDesisEleve;
                           $scope.eleve.motif='';
                          $http.post(gOptions.serveur + '/rest/EleveManager.php/AddMotif', $scope.eleve).
                            success(
                             function (data)
                              {
                                 $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByAnnee?id_classe=' + $scope.eleve.classe.id_classe + '&annee_scolaire=' + $scope.eleve.inscrit).
                                     success(
                                       function (data)
                                      {

                                                $scope.eleves = data.data;
                                    });
                             });
                        });
    }

}
;

appAdmin.controller('FooterCtrl', FooterCtrl, ['$scope', 'growl']);
function FooterCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {
                
                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
             },
            function (errorPayload) {
                $log.error('failure loading annee En Cours', errorPayload);
            });

}
appAdmin.controller('StatCtrl', StatCtrl, ['$scope', 'growl']);
function StatCtrl($resource, $http, $scope, $location, growl, getAnneeEncours,cfpLoadingBar)
{
    $scope.isLoading = true;
    $scope.totaleleves = 0;
    $scope.nbrfilles = 0;
    $scope.nbrgarcons = 0;
    $scope.nbrboursiers = 0;
    $scope.percentFilles = 0;
    $scope.percentGarcons = 0;
    $scope.nbrhandicape = 0;
    $scope.nbrinscrits = 0;
    $scope.cycles = [];
    $scope.users = [];
    $scope.anneesInscrits = [];
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                // retourne le nbre de gar√ßons de l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalGarcons/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.nbrgarcons = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });

                // retourne le nbre total de handicape de l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalHandicape/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.nbrhandicape = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });

//                $http.get(gOptions.serveur + '/rest/StatManager.php/getAnneesInscrits/').
//                        success(
//                                function (data)
//                                {
//
//                                    $scope.anneesInscrits = data.data;
//                                    $scope.anneesInscritsTab = [];
//
//                                    var d1 = [];
//                                    for (var i = 0; i < $scope.anneesInscrits.length; i++) {
//                                        d1.push([$scope.anneesInscrits[i].annee_scolaire, i]);
//                                        $scope.anneesInscritsTab.push($scope.anneesInscrits[i].annee_scolaire);
//                                    }
//                                    console.log(d1[0]);
//
//
//                                    var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
//                                    $.plot("#sales-charts", [
//                                        {label: "Evolution", data: d1}
//                                    ], {
//                                        hoverable: true,
//                                        shadowSize: 0,
//                                        series: {
//                                            lines: {show: true},
//                                            points: {show: true}
//                                        },
//                                        xaxis: {
//                                            mode: "categories"
//                                        },
//                                        grid: {
//                                            backgroundColor: {colors: ["#fff", "#fff"]},
//                                            borderWidth: 1,
//                                            borderColor: '#555'
//                                        }
//                                    });
//                                }
//                        ).
//                        error(function (result)
//                        {
//                            console.log("error");
//                        });
                // retourne le nbre de gar√ßons de l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalFilles/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.nbrfilles = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
                // retourne le nbre total de l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalEleves/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.totaleleves = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
                // retourne le nbre total dinscrits l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalInscrits/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.nbrinscrits = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });

                // retourne le nbre total de boursier de l'annee en cours
                $http.get(gOptions.serveur + '/rest/StatManager.php/CountTotalBoursier/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.nbrboursiers = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });


                // retourne le nbre total de l'annee en cours par cycle
                $http.get(gOptions.serveur + '/rest/ClasseManager.php/GetCycle/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.cycles = data.data;
                                    $.resize.throttleWindow = false;


                                    var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});


                                    function drawPieChart(placeholder, data, position) {
                                        $.plot(placeholder, data, {
                                            series: {
                                                pie: {
                                                    show: true,
                                                    tilt: 0.8,
                                                    highlight: {
                                                        opacity: 0.25
                                                    },
                                                    stroke: {
                                                        color: '#fff',
                                                        width: 2
                                                    },
                                                    startAngle: 2
                                                }
                                            },
                                            legend: {
                                                show: true,
                                                position: position || "ne",
                                                labelBoxBorderColor: null,
                                                margin: [-30, 15]
                                            }
                                            ,
                                            grid: {
                                                hoverable: true,
                                                clickable: true
                                            }
                                        })
                                    }
                                    drawPieChart(placeholder, $scope.cycles);

                                    /**
                                     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
                                     so that's not needed actually.
                                     */
                                    placeholder.data('chart', $scope.cycles);
                                    placeholder.data('draw', drawPieChart);


                                    //pie chart tooltip example
                                    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
                                    var previousPoint = null;

                                    placeholder.on('plothover', function (event, pos, item) {
                                        if (item) {
                                            if (previousPoint != item.seriesIndex) {
                                                previousPoint = item.seriesIndex;
                                                var tip = item.series['label'] + " : " + Math.round(item.series['percent']) + '%';
                                                $tooltip.show().children(0).text(tip);
                                            }
                                            $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
                                        } else {
                                            $tooltip.hide();
                                            previousPoint = null;
                                        }
                                    });


                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
               
    $http.get(gOptions.serveur + '/rest/LoginManager.php/getUsers').
            success(
                    function (data)
                    {

                        $scope.users = data.data;
                    }
            ).
            error(function (result)
            {
            });
            
                $scope.isLoading = false;

            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });


}
;
appAdmin.controller('HeaderCtrl', HeaderCtrl, ['$scope', 'growl']);
function HeaderCtrl($resource, $state, $http, $scope, $location, growl, Auth)
{
    $scope.user = Auth.user;
    $scope.messages = [];

    $scope.totalmessage = 0;
    if($scope.user.id !=0)
    {
    
    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountTotalMessages/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.totalmessage = data.data[0].count;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

    $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessagesNotif/' + $scope.user.id).
            success(
                    function (data)
                    {

                        $scope.messages = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

    }
    $scope.goToInbox = function (message)
    {

        $http.post(gOptions.serveur + '/rest/MessagerieManager.php/UpdateMessageRead', message).
                success(
                        function (data)
                        {

                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/CountTotalMessages/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.totalmessage = data.data[0].count;


                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });

                            $http.get(gOptions.serveur + '/rest/MessagerieManager.php/ListMessagesNotif/' + $scope.user.id).
                                    success(
                                            function (data)
                                            {

                                                $scope.messages = data.data;
                                                $state.go('reception', {id: message.id_messagerie});
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });



    }

}
;
appAdmin.controller('TransportCtrl', TransportCtrl, ['$scope', 'growl']);
function TransportCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    $scope.transports = [];
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;

                $http.get(gOptions.serveur + '/rest/TransportManager.php/ListTransport/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.transports = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });

    $scope.showAjoutTransport = false;
    $scope.popupAjoutTransport = function () {
        $scope.showAjoutTransport = !$scope.showAjoutTransport;
    }

    $scope.transport = {};

    $scope.annulerTransport = function () {
        $scope.showAjoutTransport = !$scope.showAjoutTransport;
        $scope.transport = {};
    }

    $scope.ajoutTransport = function () {

        $http.post(gOptions.serveur + '/rest/TransportManager.php/AddTransport', $scope.transport).
                success(
                        function (data)
                        {
                            $scope.showAjoutTransport = !$scope.showAjoutTransport;
                            $scope.transport = {};
                            $http.get(gOptions.serveur + '/rest/TransportManager.php/ListTransport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.transports = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }


    $scope.showSupprTransport = false;
    $scope.popupSupprTransport = function (transportId) {
        idTransportASuppr = transportId;
        $scope.showSupprTransport = !$scope.showSupprTransport;
    }
    $scope.confirmSupprTransport = function () {
        $http.get(gOptions.serveur + '/rest/TransportManager.php/DeleteTransport/' + idTransportASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprTransport = !$scope.showSupprTransport;
                            $http.get(gOptions.serveur + '/rest/TransportManager.php/ListTransport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.transports = data.data;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }




    $scope.showModTransport = false;
    $scope.popupModifierTransport = function (transportId) {
        $scope.showModTransport = !$scope.showModTransport;
        $http.get(gOptions.serveur + '/rest/TransportManager.php/GetTransport/' + transportId).
                success(
                        function (data)
                        {

                            $scope.transport = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.modifierTransport = function ()
    {
        $http.post(gOptions.serveur + '/rest/TransportManager.php/UpdateTransport/', $scope.transport).
                success(
                        function (data)
                        {
                            $scope.showModTransport = !$scope.showModTransport;
                            $scope.transport = {};
                            $http.get(gOptions.serveur + '/rest/TransportManager.php/ListTransport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.transports = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }).
                error(function (result)
                {
                });

    }

    $scope.AnnulerSupprTransport = function () {
        $scope.showSupprTransport = !$scope.showSupprTransport;
        $scope.transport = {};
    }

    $scope.annulerModTransport = function () {
        $scope.showModTransport = !$scope.showModTransport;
        $scope.transport = {};
    }

    $scope.showliste = false;
    $scope.eleves = [];
    $scope.popupListEleves = function (transportId) {
        $scope.showliste = !$scope.showliste;
        $http.get(gOptions.serveur + '/rest/TransportManager.php/GetEleveByTransport?numero=' + transportId + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                        }
                ).
                error(function (result)
                {
                });
    }
}
;


appAdmin.controller('SportCtrl', SportCtrl, ['$scope', 'growl']);
function SportCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    $scope.sports = [];
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/SportManager.php/ListSport/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.sports = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });

    $scope.showAjoutSport = false;
    $scope.popupAjoutSport = function () {
        $scope.showAjoutSport = !$scope.showAjoutSport;
    }

    $scope.sport = {};

    $scope.annulerSport = function () {
        $scope.showAjoutSport = !$scope.showAjoutSport;
        $scope.sport = {};
    }


    $scope.ajoutSport = function () {

        $http.post(gOptions.serveur + '/rest/SportManager.php/AddSport', $scope.sport).
                success(
                        function (data)
                        {
                            $scope.showAjoutSport = !$scope.showAjoutSport;
                            $scope.sport = {};
                            $http.get(gOptions.serveur + '/rest/SportManager.php/ListSport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.sports = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }


    $scope.showSupprSport = false;
    $scope.popupSupprSport = function (sportId) {
        idSportASuppr = sportId;
        $scope.showSupprSport = !$scope.showSupprSport;
    }
    $scope.confirmSupprSport = function () {
        $http.get(gOptions.serveur + '/rest/SportManager.php/DeleteSport/' + idSportASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprSport = !$scope.showSupprSport;
                            $http.get(gOptions.serveur + '/rest/SportManager.php/ListSport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.sports = data.data;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }




    $scope.showModSport = false;
    $scope.popupModifierSport = function (sportId) {
        $scope.showModSport = !$scope.showModSport;
        $http.get(gOptions.serveur + '/rest/SportManager.php/GetSport/' + sportId).
                success(
                        function (data)
                        {

                            $scope.sport = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.modifierSport = function ()
    {
        $http.post(gOptions.serveur + '/rest/SportManager.php/UpdateSport/', $scope.sport).
                success(
                        function (data)
                        {
                            $scope.showModSport = !$scope.showModSport;
                            $scope.sport = {};
                            $http.get(gOptions.serveur + '/rest/SportManager.php/ListSport/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.sports = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }).
                error(function (result)
                {
                });

    }
    $scope.annulerModifSport = function () {
        $scope.showModSport = !$scope.showModSport;
        $scope.sport = {};
    }

    $scope.AnnulerSupprSport = function () {
        $scope.showSupprSport = !$scope.showSupprSport;
        $scope.sport = {};
    }

    $scope.showliste = false;
    $scope.eleves = [];
    $scope.popupListElevesSport = function (sportId) {
        $scope.showliste = !$scope.showliste;
        $http.get(gOptions.serveur + '/rest/SportManager.php/GetEleveBySport?numero=' + sportId + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                        }
                ).
                error(function (result)
                {
                });
    }
}
;


appAdmin.controller('TenueCtrl', TenueCtrl, ['$scope', 'growl']);
function TenueCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    $scope.tenues = [];
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/TenueManager.php/ListTenue/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.tenues = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });

    $scope.showAjoutTenue = false;
    $scope.popupAjoutTenue = function () {
        $scope.showAjoutTenue = !$scope.showAjoutTenue;
    }

    $scope.tenue = {};

    $scope.annulerTenue = function () {
        $scope.showAjoutTenue = !$scope.showAjoutTenue;
        $scope.tenue = {};
    }


    $scope.ajoutTenue = function () {

        $http.post(gOptions.serveur + '/rest/TenueManager.php/AddTenue', $scope.tenue).
                success(
                        function (data)
                        {
                            $scope.showAjoutTenue = !$scope.showAjoutTenue;
                            $scope.tenue = {};
                            $http.get(gOptions.serveur + '/rest/TenueManager.php/ListTenue/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.tenues = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }


    $scope.showSupprTenue = false;
    $scope.popupSupprTenue = function (tenueId) {
        idTenueASuppr = tenueId;
        $scope.showSupprTenue = !$scope.showSupprTenue;
    }
    $scope.confirmSupprTenue = function () {
        $http.get(gOptions.serveur + '/rest/TenueManager.php/DeleteTenue/' + idTenueASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprTenue = !$scope.showSupprTenue;
                            $http.get(gOptions.serveur + '/rest/TenueManager.php/ListTenue/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.tenues = data.data;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }




    $scope.showModTenue = false;
    $scope.popupModifierTenue = function (tenueId) {
        $scope.showModTenue = !$scope.showModTenue;
        $http.get(gOptions.serveur + '/rest/TenueManager.php/GetTenue/' + tenueId).
                success(
                        function (data)
                        {

                            $scope.tenue = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.modifierTenue = function ()
    {
        $http.post(gOptions.serveur + '/rest/TenueManager.php/UpdateTenue/', $scope.tenue).
                success(
                        function (data)
                        {
                            $scope.showModTenue = !$scope.showModTenue;
                            $scope.tenue = {};
                            $http.get(gOptions.serveur + '/rest/TenueManager.php/ListTenue/' + $scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.tenues = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }).
                error(function (result)
                {
                });

    }
    $scope.AnnulerSupprTenue = function () {
        $scope.showSupprTenue = !$scope.showSupprTenue;
        $scope.tenue = {};
    }
    $scope.annulerModifTenue = function () {
        $scope.showModTenue = !$scope.showModTenue;
        $scope.tenue = {};
    }
    $scope.showliste = false;
    $scope.eleves = [];
    $scope.popupListElevesTenue = function (tenueId) {
        $scope.showliste = !$scope.showliste;
        $http.get(gOptions.serveur + '/rest/TenueManager.php/GetEleveByTenue?numero=' + tenueId + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                        }
                ).
                error(function (result)
                {
                });
    }
}


appAdmin.controller('EdtCtrl', EdtCtrl, ['$scope', 'growl']);
function EdtCtrl($resource, $http, $scope, $location, growl, Auth, $compile)
{
    $scope.user = Auth.user;

    $scope.indexAdef = 0;
    $scope.events = [];
    $scope.eventsGood = [];
    $scope.eventsOrig = [];
    $scope.modifEffectue = false;
    loadChosenSelect();
    $scope.edt = {};

//    $scope.showModifEdt = false;
//    $scope.changeClasse = true;
//
//    $scope.annulerModifEdt = function () {
//        $scope.showModifEdt = false;
//        $scope.modifEffectue = false;
//    };
//
//    $scope.confirmModifEdt = function () {
//        $scope.showModifEdt = false;
//        addModEdtFunction();
//    };

    $scope.matieres = [];
    $scope.changeClasse = function ()
    {
        $scope.modifEffectue = false;

        $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.edt.id_classe).
                success(
                        function (data)
                        {

                            $scope.matieres = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");

                });


        $http.get(gOptions.serveur + '/rest/EdtManager.php/ListEdt/' + $scope.edt.id_classe).
                success(
                        function (data)
                        {
                            $scope.eventsGood = [];
                            $scope.events = data.data;

                            for (var i = 0; i < $scope.events.length; i++)
                            {
                                $scope.eventGood = {};
                                $scope.eventGood.id = $scope.events[i].id;
                                $scope.eventGood.title = $scope.events[i].title;
                                $scope.eventGood.start = $scope.events[i].start;
                                $scope.eventGood.end = $scope.events[i].end;
                                $scope.eventGood.className = $scope.events[i].className;
                                $scope.eventsGood.push($scope.eventGood);
                            }

                            $scope.eventsOrig = angular.copy($scope.eventsGood);

                            if ($scope.eventsGood.length !== 0)
                                $scope.indexAdef = parseInt($scope.eventsGood[$scope.eventsGood.length - 1].id) + parseInt(1);
                            else
                            {
                                for (var i = 0; i < $scope.eventsGood.length; i++)
                                {

                                    $scope.eventsGood[i].title = event.title;
                                    $scope.eventsGood[i].start = event.start.format("YYYY-MM-DDTHH:mm");

                                    var find = 'A';
                                    var re = new RegExp(find, 'g');

                                    $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                                    var find = 'P';
                                    var re = new RegExp(find, 'g');

                                    $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                                    if (event.end != null && event.end != '')
                                    {

                                        $scope.eventsGood[i].end = event.end.format("YYYY-MM-DDTHH:mm");

                                        var find = 'A';
                                        var re = new RegExp(find, 'g');

                                        $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');

                                        var find = 'P';
                                        var re = new RegExp(find, 'g');

                                        $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');
                                    }
                                    else
                                        $scope.eventsGood[i].end = null;

                                    $scope.eventsGood[i].className = event.className[0];
                                }
                            }

                            $('#calendar').fullCalendar('destroy');
                            $('#calendar').fullCalendar('render');
                            loadEdt();
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    };

    function loadChosenSelect() {
        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function () {
                        $('.chosen-select').each(function () {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }
    }

    function loadEdt() {
        $('#external-events div.external-event').each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
        /* initialize the calendar
         -----------------------------------------------------------------*/

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var dated = new Date(y, m, d, 16, 20);
        var calendar = $('#calendar').fullCalendar({
            axisFormat: 'H:mm',
            now: moment('2015-06-04').format("YYYY-MM-DDTHH:mm:ssZZ"),
            defaultDate: moment('2015-06-04').format("YYYY-MM-DDTHH:mm:ssZZ"),
            today: moment('2015-06-04').format("YYYY-MM-DDTHH:mm:ssZZ"),
            timeFormat: {
                agenda: 'H:mm'
            },
            defaultView: 'agendaWeek',
            //isRTL: true,
            buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: $scope.eventsGood,
            editable: $scope.user.id_profil == 1 || $scope.user.id_profil == 3 ? true : false,
            droppable: $scope.user.id_profil == 1 || $scope.user.id_profil == 3 ? true : false, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                $scope.modifEffectue = true;
                var originalEventObject = $(this).data('eventObject');
                var $extraEventClass = $(this).attr('data-class');
                // we need to copy it, var $extraEventClass = $(this).attr('data-class'); so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                $scope.indexAdef = parseInt($scope.indexAdef) + parseInt(1);

                copiedEventObject.id = parseInt($scope.indexAdef);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = false;
                if ($extraEventClass)
                    copiedEventObject['className'] = [$extraEventClass];


                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                var eventDropped = {};

                eventDropped.id = copiedEventObject.id;

                eventDropped.title = copiedEventObject.title;
                eventDropped.start = copiedEventObject.start.format("YYYY-MM-DDTHH:mm");

                var find = 'A';
                var re = new RegExp(find, 'g');

                eventDropped.start = eventDropped.start.replace(re, 'T');

                var find = 'P';
                var re = new RegExp(find, 'g');

                eventDropped.start = eventDropped.start.replace(re, 'T');

                if (copiedEventObject.end != null)
                {

                    eventDropped.end = copiedEventObject.end.format("YYYY-MM-DDTHH:mm");

                    var find = 'A';
                    var re = new RegExp(find, 'g');

                    eventDropped.end = eventDropped.end.replace(re, 'T');

                    var find = 'P';
                    var re = new RegExp(find, 'g');

                    eventDropped.end = eventDropped.end.replace(re, 'T');
                }
                else
                    eventDropped.end = null;

                eventDropped.className = copiedEventObject.className[0];
                $scope.eventsGood.push(eventDropped);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc) {

                if ($scope.user.id_profil == 1 || $scope.user.id_profil == 3)
                {
                    $scope.modifEffectue = true;
                    for (var i = 0; i < $scope.eventsGood.length; i++)
                    {

                        if (event.id != null && event.id == $scope.eventsGood[i].id)
                        {

                            $scope.eventsGood[i].title = event.title;
                            $scope.eventsGood[i].start = event.start.format("YYYY-MM-DDTHH:mm");

                            var find = 'A';
                            var re = new RegExp(find, 'g');

                            $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                            var find = 'P';
                            var re = new RegExp(find, 'g');

                            $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                            if (event.end != null)
                            {

                                $scope.eventsGood[i].end = event.end.format("YYYY-MM-DDTHH:mm");

                                var find = 'A';
                                var re = new RegExp(find, 'g');

                                $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');

                                var find = 'P';
                                var re = new RegExp(find, 'g');

                                $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');
                            }
                            else
                                $scope.eventsGood[i].end = null;

                            $scope.eventsGood[i].className = event.className[0];
                        }
                    }
                }
                else
                    revertFunc();
            },
            eventResize: function (event, dayDelta, minuteDelta, revertFunc)
            {

                if ($scope.user.id_profil == 1 || $scope.user.id_profil == 3)
                {
                    $scope.modifEffectue = true;
                    for (var i = 0; i < $scope.eventsGood.length; i++)
                    {

                        if (event.id != null && event.id == $scope.eventsGood[i].id)
                        {

                            $scope.eventsGood[i].title = event.title;
                            $scope.eventsGood[i].start = event.start.format("YYYY-MM-DDTHH:mm");

                            var find = 'A';
                            var re = new RegExp(find, 'g');

                            $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                            var find = 'P';
                            var re = new RegExp(find, 'g');

                            $scope.eventsGood[i].start = $scope.eventsGood[i].start.replace(re, 'T');

                            if (event.end != null)
                            {

                                $scope.eventsGood[i].end = event.end.format("YYYY-MM-DDTHH:mm");

                                var find = 'A';
                                var re = new RegExp(find, 'g');

                                $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');

                                var find = 'P';
                                var re = new RegExp(find, 'g');

                                $scope.eventsGood[i].end = $scope.eventsGood[i].end.replace(re, 'T');
                            }
                            else
                                $scope.eventsGood[i].end = null;

                            $scope.eventsGood[i].className = event.className[0];
                        }
                    }
                }
                else
                    revertFunc();
            },
            selectable: $scope.user.id_profil == 1 || $scope.user.id_profil == 3 ? true : false,
            selectHelper: $scope.user.id_profil == 1 || $scope.user.id_profil == 3 ? true : false,
            select: function (start, end) {
                $scope.matiere = {};
                var tplCrop = "<div class='row'><div class='form-group' ><label class='control-label col-sm-3'>Discipline</label>" +
                        " <div class='col-sm-4'><select class= 'form-control col-xs-12' ng-model='matiere.title' ng-options='matiere.nom as matiere.nom for matiere in matieres'></select></div></div></div>";
                var template = angular.element(tplCrop);
                var linkFn = $compile(template);
                var html = linkFn($scope);
                bootbox.dialog({
                    title: "Ajout discipline:",
                    message: html,
                    buttons: {
                        'cancel': {
                            label: 'Annuler',
                            className: 'btn-default'
                        },
                        success: {
                            label: "Valider",
                            className: "btn-success",
                            callback: function (message) {
                                $scope.indexAdef = parseInt($scope.indexAdef) + parseInt(1);
                                var copiedEventObject = {
                                    id: $scope.indexAdef,
                                    title: $scope.matiere.title,
                                    start: start,
                                    end: end,
                                    className: 'label-yellow'
                                };
                                console.log(copiedEventObject);
                                calendar.fullCalendar('renderEvent',
                                        copiedEventObject,
                                        true // make the event "stick"
                                        );


                                var eventDropped = {};

                                eventDropped.id = copiedEventObject.id;

                                eventDropped.title = copiedEventObject.title;
                                eventDropped.start = copiedEventObject.start.format("YYYY-MM-DDTHH:mm");

                                var find = 'A';
                                var re = new RegExp(find, 'g');

                                eventDropped.start = eventDropped.start.replace(re, 'T');

                                var find = 'P';
                                var re = new RegExp(find, 'g');

                                eventDropped.start = eventDropped.start.replace(re, 'T');

                                if (copiedEventObject.end != null)
                                {

                                    eventDropped.end = copiedEventObject.end.format("YYYY-MM-DDTHH:mm");

                                    var find = 'A';
                                    var re = new RegExp(find, 'g');

                                    eventDropped.end = eventDropped.end.replace(re, 'T');

                                    var find = 'P';
                                    var re = new RegExp(find, 'g');

                                    eventDropped.end = eventDropped.end.replace(re, 'T');
                                }
                                else
                                    eventDropped.end = null;

                                eventDropped.className = copiedEventObject.className;
                                $scope.eventsGood.push(eventDropped);
                            }
                        }
                    }
                });

                calendar.fullCalendar('unselect');
            },
            eventClick: function (calEvent, jsEvent, view) {
                if ($scope.user.id_profil == 1 || $scope.user.id_profil == 3)
                {
                    //display a modal
                    var modal =
                            '<div class="modal fade">\
                <div class="modal-dialog">\
                <div class="modal-content">\
                <div class="modal-body">\
                <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                <form class="no-margin">\
                <label>Nom mati&egrave;re &nbsp;</label>\
                <input class="middle" autocomplete="off" type="text" ng-disabled="true" value="' + calEvent.title + '" />\
                <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Valider</button>\
                </form>\
                </div>\
                <div class="modal-footer">\
                <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Supprimer</button>\
                <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Annuler</button>\
                </div>\
                </div>\
                </div>\
                </div>';
                    var modal = $(modal).appendTo('body');
                    modal.find('form').on('submit', function (ev) {
                        ev.preventDefault();
                        $scope.modifEffectue = true;
                        calEvent.title = $(this).find("input[type=text]").val();
                        calendar.fullCalendar('updateEvent', calEvent);
                        modal.modal("hide");
                    });
                    modal.find('button[data-action=delete]').on('click', function () {
                        calendar.fullCalendar('removeEvents', function (ev) {
                            $scope.modifEffectue = true;
                            for (var i = 0; i < $scope.eventsGood.length; i++)
                            {

                                if (calEvent.id == $scope.eventsGood[i].id)
                                {

                                    $scope.eventsGood.splice(i, 1);
                                }

                            }
                            return (ev._id == calEvent._id);
                        })
                        modal.modal("hide");
                    });
                    modal.modal('show').on('hidden', function () {
                        modal.remove();
                    });
                    //console.log(calEvent.id);
                    //console.log(jsEvent);
                    //console.log(view);

                    // change the border color just for fun
                    //$(this).css('border-color', 'red');

                }
                else
                    return false;
            }


        })

    }

    $scope.addModEdt = function () {
        addModEdtFunction();
    }


    function addModEdtFunction() {
        $scope.modifEffectue = false;
        for (var i = 0; i < $scope.eventsGood.length; i++)
        {
            var existDeja = false;

            for (var j = 0; j < $scope.eventsOrig.length; j++)
            {

                if ($scope.eventsOrig[j].id == $scope.eventsGood[i].id)
                {
                    existDeja = true;
                }
            }

            if (existDeja)
            {
                $http.post(gOptions.serveur + '/rest/EdtManager.php/modEdt',
                        $scope.eventsGood[i], {ignoreLoadingBar: true}).
                        success(function (data)
                        {

                        }).
                        error(function (result)
                        {
                            console.log("error");
                        });

            }
            else {

                $scope.eventsGood[i].id_classe = $scope.edt.id_classe;
                $http.post(gOptions.serveur + '/rest/EdtManager.php/addEdt', $scope.eventsGood[i]).
                        success(function (data)
                        {

                        }).
                        error(function (result)
                        {
                            console.log("error");
                        });

            }
            growl.success("Emploi du temps modifi&eacute; avec succ&egrave;s", {ttl: 3000});

        }





        for (var i = 0; i < $scope.eventsOrig.length; i++)
        {
            var adelete = true;

            for (var j = 0; j < $scope.eventsGood.length; j++)
            {

                if ($scope.eventsOrig[i].id == $scope.eventsGood[j].id)
                {
                    adelete = false;
                }
            }

            if (adelete)
            {
                $http.get(gOptions.serveur + '/rest/EdtManager.php/deleteEdt/' + $scope.eventsOrig[i].id).
                        success(function (data)
                        {

                        }).
                        error(function (result)
                        {
                            console.log("error");
                        });

            }
        }
    } //function addModEdtFunction


}


appAdmin.controller('MatiereCtrl', MatiereCtrl, ['$scope', 'growl']);
function MatiereCtrl($resource, $http, $scope, $location, growl,getAnneeEncours)
{
    $scope.id_classeExist = {};
    $scope.matieres = [];
	$scope.classes = [];
    $scope.professeurs = [];

var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
$http.get(gOptions.serveur + '/rest/LoginManager.php/getProfesseurs').
            success(
                    function (data)
                    {
                        $scope.professeurs = data.data;
                    }).
            error(function (result)
            {
            });
			
			  $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasse/'+$scope.anneeEnCours).
            success(
                    function (data)
                    {
                        $scope.classes = data.data;
                    }).
            error(function (result)
            {
            });
            });


    

    $scope.showAjoutMatiere = false;
    $scope.popupAjoutMatiere = function () {
        $scope.showAjoutMatiere = !$scope.showAjoutMatiere;
    }


    $scope.showSupprMatiere = false;
    $scope.popupSupprMatiere = function (matiereId) {
        $scope.showSupprMatiere = !$scope.showSupprMatiere;
        $http.get(gOptions.serveur + '/rest/MatiereManager.php/GetMatiere/' + matiereId).
                success(
                        function (data)
                        {
							$scope.oldClasse = $scope.matiere.classe;
                            $scope.matiere = data.data[0];
							$scope.matiere.classe = $scope.oldClasse;
						    console.log($scope.matiere.classe);
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.confirmSupprMatiere = function () {
        $http.get(gOptions.serveur + '/rest/MatiereManager.php/DeleteMatiere/' + $scope.matiere.id_matiere).
                success(
                        function (data)
                        {
                            $scope.showSupprMatiere = !$scope.showSupprMatiere;
                            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.matiere.classe).
                                    success(
                                            function (data)
                                            {

                                                $scope.matieres = data.data;
												$scope.oldClasse = $scope.matiere.classe;
												$scope.matiere = {};
												$scope.matiere.classe = $scope.oldClasse;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.ajoutMatiere = function () {

        $http.post(gOptions.serveur + '/rest/MatiereManager.php/AddMatiere', $scope.matiere).
                success(
                        function (data)
                        {

                            $scope.showAjoutMatiere = !$scope.showAjoutMatiere;
                            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.matiere.classe).
                                    success(
                                            function (data)
                                            {
                                                $scope.matieres = data.data;
												$scope.oldClasse = $scope.matiere.classe;
												$scope.matiere = {};
												$scope.matiere.classe = $scope.oldClasse;
                                            });


                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.changeClasse = function ()
    {
        $scope.id_classeExist.id = 1;
        $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.matiere.classe).
                success(
                        function (data)
                        {

                            $scope.matieres = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.showModMatiere = false;
    $scope.popupModifierMatiere = function (matiereId) {
        $scope.showModMatiere = !$scope.showModMatiere;
        $http.get(gOptions.serveur + '/rest/MatiereManager.php/GetMatiere/' + matiereId).
                success(
                        function (data)
                        {

                            $scope.oldClasse = $scope.matiere.classe;
                            $scope.matiere = data.data[0];
							$scope.matiere.classe = $scope.oldClasse;
						    console.log($scope.matiere.classe);
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.modifierMatiere = function ()
    {

        $http.post(gOptions.serveur + '/rest/MatiereManager.php/UpdateMatiere/', $scope.matiere).
                success(
                        function (data)
                        {

                            $scope.showModMatiere = !$scope.showModMatiere;
                            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.matiere.classe).
                                    success(
                                            function (data)
                                            {

                                                
                                                $scope.matieres = data.data;
												$scope.oldClasse = $scope.matiere.classe;
												$scope.matiere = {};
												$scope.matiere.classe = $scope.oldClasse;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });


                        });
    }


    $scope.annulerModifMatiere = function () {
        $scope.showModMatiere = !$scope.showModMatiere;
        $scope.oldClasse = $scope.matiere.classe;
        $scope.matiere = {};
		$scope.matiere.classe = $scope.oldClasse;
    }

    $scope.annulerMatiere = function () {
        $scope.showAjoutMatiere = !$scope.showAjoutMatiere;
		$scope.oldClasse = $scope.matiere.classe;
        $scope.matiere = {};
		$scope.matiere.classe = $scope.oldClasse;
    }

    $scope.AnnulerSupprMatiere = function () {
        $scope.showSupprMatiere = !$scope.showSupprMatiere;
        $scope.oldClasse = $scope.matiere.classe;
        $scope.matiere = {};
		$scope.matiere.classe = $scope.oldClasse;
    }

    $scope.dismiss = function () {
        $scope.oldClasse = $scope.matiere.classe;
        $scope.matiere = {};
		$scope.matiere.classe = $scope.oldClasse;
    }

}
;


appAdmin.controller('ClasseCtrl', ClasseCtrl, ['$scope', 'growl']);
function ClasseCtrl($resource, $http, $scope, $location, growl,getAnneeEncours)
{
    $scope.classes = [];
    $scope.classe = {};

    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
  $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasse/'+$scope.anneeEnCours).
            success(
                    function (data)
                    {

                        $scope.classes = data.data;
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

            });


  

    $scope.showAjoutClasse = false;
    $scope.popupAjoutClasse = function () {
        $scope.showAjoutClasse = !$scope.showAjoutClasse;
    }



    $scope.ajoutClasse = function () {

        $http.post(gOptions.serveur + '/rest/ClasseManager.php/AddClasse', $scope.classe).
                success(
                        function (data)
                        {
                            $scope.showAjoutClasse = !$scope.showAjoutClasse;
                            $scope.classe = {};
                            $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasse/'+$scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.classes = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.showSupprClasse = false;
    $scope.popupSupprClasse = function (classeId) {
        idClasseASuppr = classeId;
        $scope.showSupprClasse = !$scope.showSupprClasse;
    }

    $scope.confirmSupprClasse = function () {
        $scope.classe.id_classe = idClasseASuppr ;
        $scope.classe.annee_scolaire = $scope.anneeEnCours;
        $http.post(gOptions.serveur + '/rest/ClasseManager.php/DeleteClasse',$scope.classe).
                success(
                        function (data)
                        {
                            $scope.showSupprClasse = !$scope.showSupprClasse;
                            $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasse/'+$scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.classes = data.data;
                                                $scope.classe={};
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.showModClasse = false;
    $scope.popupModifierClasse = function (classeId) {
        $scope.showModClasse = !$scope.showModClasse;
        $http.get(gOptions.serveur + '/rest/ClasseManager.php/GetClasse/' + classeId).
                success(
                        function (data)
                        {

                            $scope.classe = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.annulerSupprClasse = function ()
    {
        $scope.showSupprClasse = !$scope.showSupprClasse;
    }

    $scope.modifierClasse = function ()
    {
        $http.post(gOptions.serveur + '/rest/ClasseManager.php/UpdateClasse/', $scope.classe).
                success(
                        function (data)
                        {
                            $scope.showModClasse = !$scope.showModClasse;
                            $scope.classe = {};
                            $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListClasse/'+$scope.anneeEnCours).
                                    success(
                                            function (data)
                                            {

                                                $scope.classes = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }).
                error(function (result)
                {
                });

    }

    $scope.annulerClasse = function () {
        $scope.showAjoutClasse = !$scope.showAjoutClasse;
        $scope.classe = {};
    }

    $scope.annulerModifClasse = function () {
        $scope.showModClasse = !$scope.showModClasse;
        $scope.classe = {};
    }

}
;

appAdmin.controller('viewEleveCtrl', viewEleveCtrl, ['$scope']);
function viewEleveCtrl($resource, $http, $scope, $location, $stateParams, Auth, getAnneeEncours)
{

    $scope.user = Auth.user;
    console.log($scope.user);
    $scope.tab = typeof $stateParams.active != 'undefined' ? $stateParams.active : 'identite';
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && 
                  $stateParams.annee!= undefined && $stateParams.annee!= '' && $stateParams.annee!= -1)
                {
               
                    $scope.annee = $stateParams.annee;
                    $http.get(gOptions.serveur + '/rest/EleveManager.php/getEleves?numero=' + $stateParams.id + '&annee_scolaire=' + $scope.annee).
                            success(
                                    function (data)
                                    {

                                        $scope.eleve = data.data[0];
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });
                }
            });
}

appAdmin.controller('ImpayeCtrl', ImpayeCtrl, ['$scope', 'growl']);
function ImpayeCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    $scope.impayes = [];
    $scope.classe= {};
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/FactureManager.php/getAllFacture/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.impayes = data.data;
                                    $scope.totalImpayes = 0;
                                    for (var i = 0; i < data.data.length; i++)
                                    {
                                        $scope.totalImpayes = parseInt($scope.totalImpayes) + parseInt(data.data[i].solde);
                                    }
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });

    $scope.showAjoutImpaye = false;
    $scope.popupAjoutImpaye = function () {
        $scope.showAjoutImpaye = !$scope.showAjoutImpaye;
    }
    $scope.showSupprImpaye = false;
    $scope.popupSupprImpaye = function (impayeId) {
        idImpayeASuppr = impayeId;
        $scope.showSupprImpaye = !$scope.showSupprImpaye;
    }

    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;

            });



    $scope.confirmSupprImpaye = function () {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/DeleteFacturesImpayeEleves/' + idImpayeASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprImpaye = !$scope.showSupprImpaye;
                            $http.get(gOptions.serveur + '/rest/FactureManager.php/ListImpayes').
                                    success(
                                            function (data)
                                            {

                                                $scope.impayes = data.data;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }


    $scope.changeClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/getFactureByCodeClasse?id_classe=' + $scope.classe.nom.split(':')[0] + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.impayes = data.data;
                            $scope.totalImpayes = 0;
                            for (var i = 0; i < data.data.length; i++)
                            {
                                $scope.totalImpayes = parseInt($scope.totalImpayes) + parseInt(data.data[i].solde);
                            }

                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.exportPdf = function () {
	$scope.showInfosPeriode = !$scope.showInfosPeriode;
        window.open(gOptions.serveur + '/pdf/impayes.php?valueperiode=' + $('input[name=date-range-picker]').val() + '&idClasse=' + $scope.classe.nom+'&annee_scolaire='+$scope.anneeEnCours, '_blank');
		
    //   $('input[name=date-range-picker]').val('');
    }
	$scope.showInfosPeriode = false;
    $scope.addPeriode = function ()
    {

        $scope.showInfosPeriode = !$scope.showInfosPeriode;
    }
	
	$scope.AnnulerPeriode = function ()
    {
        $scope.showInfosPeriode = !$scope.showInfosPeriode;
      //   $('input[name=date-range-picker]').val('');
    }
	

}
;
appAdmin.controller('FactureClasseCtrl', FactureClasseCtrl, ['$scope', 'growl']);
function FactureClasseCtrl($resource, $http, $scope, $location, growl, getAnneeEncours)
{
    $scope.factures = [];
    $scope.classe  = {};
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/FactureManager.php/getAllRecu/' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.factures = data.data;
                                    $scope.totalVersements = 0;
                                    for (var i = 0; i < data.data.length; i++)
                                    {
                                        $scope.totalVersements = parseInt($scope.totalVersements) + parseInt(data.data[i].versement);
                                    }
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading idExamen', errorPayload);
            });

    $scope.user = $scope.$parent.user;
    $scope.anneeEnCours = 0;
    $scope.showAjoutFacture = false;
    $scope.popupAjoutFacture = function () {
        $scope.showAjoutFacture = !$scope.showAjoutFacture;
    }
    $scope.showSupprFacture = false;
    $scope.popupSupprFacture = function (factureId) {
        idFactureASupprASuppr = factureId;
        $scope.showSupprFacture = !$scope.showSupprFacture;
    }


    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;

            });

    $scope.confirmSupprFacture = function () {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/DeleteFacturesImpayeEleves/' + idImpayeASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprImpaye = !$scope.showSupprImpaye;
                            $http.get(gOptions.serveur + '/rest/FactureManager.php/ListImpayes').
                                    success(
                                            function (data)
                                            {

                                                $scope.impayes = data.data;
                                            }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }


    $scope.changeClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/getRecuByCodeClasse?id_classe=' + $scope.classe.nom.split(':')[0] + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.factures = data.data;
                            $scope.totalVersements = 0;
                            for (var i = 0; i < data.data.length; i++)
                            {
                                $scope.totalVersements = parseInt($scope.totalVersements) + parseInt(data.data[i].versement);
                            }
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    
	
	$scope.showInfosPeriode = false;
    $scope.addPeriode = function ()
    {

        $scope.showInfosPeriode = !$scope.showInfosPeriode;
    }
	
	$scope.AnnulerPeriode = function ()
    {
        $scope.showInfosPeriode = !$scope.showInfosPeriode;
      //   $('input[name=date-range-picker]').val('');
    }
	
	 $scope.exportPdf = function () {
	$scope.showInfosPeriode = !$scope.showInfosPeriode;
        window.open(gOptions.serveur + '/pdf/encaissement.php?valueperiode=' + $('input[name=date-range-picker]').val() + '&idClasse=' + $scope.classe.nom+'&annee_scolaire='+$scope.anneeEnCours, '_blank');
		
    //   $('input[name=date-range-picker]').val('');
    }

}
;
appAdmin.controller('FactureCtrl', FactureCtrl, ['$scope']);
function FactureCtrl($resource, $http, $scope, $location, $stateParams, getAnneeEncours)
{
    totalsolde = 0;
    $scope.tabped = typeof $stateParams.active != 'undefined' ? $stateParams.active : 'tab1';
	
    var id = -1;

    $scope.facture = {};
    $scope.anneeSco = {};
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.factures = [];
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1
                && $stateParams.annee!= undefined && $stateParams.annee!= '' && $stateParams.annee!= -1)
                {
                    id = $stateParams.id;
                    $scope.numero_eleve = id;

                    $scope.annee =  $stateParams.annee;

                    $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                            success(
                                    function (data)
                                    {

                                        $scope.factures = data.data;
                                    }
                            ).
                            error(function (result)
                            {
                            });
                    $http.get(gOptions.serveur + '/rest/FactureManager.php/GetTotalSolde?numero=' + id + '&annee_scolaire=' + $scope.annee).
                            success(
                                    function (data)
                                    {

                                        $scope.totalsolde = data.data[0].totalsolde;
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });

                }
            });


    $scope.showAjoutFacture = false;

    $scope.popupAjoutFacture = function () {
        $scope.showAjoutFacture = !$scope.showAjoutFacture;

    }

    $scope.showSupprFacture = false;
    $scope.popupSupprFacture = function (factureId) {
        idFactureASuppr = factureId;
        $scope.showSupprFacture = !$scope.showSupprFacture;

    }

    $scope.BolTotalversement = false;
    $scope.idFactureAModifier = 0;
    $scope.changeMontant = function () {

        if ($scope.idFactureAModifier != 0)
        {

            $http.get(gOptions.serveur + '/rest/FactureManager.php/GetSommeVersement/' + $scope.idFactureAModifier).
                    success(
                            function (data)
                            {

                                $scope.totalversement = data.data[0].totalversement;
                                if (parseInt($scope.facture.montant) < parseInt($scope.totalversement))
                                {
                                    console.log("ddsfsd");
                                    $scope.BolTotalversement = true;
                                }
                                else
                                    $scope.BolTotalversement = false;
                            }
                    ).
                    error(function (result)
                    {
                    });


            return  !$scope.BolTotalversement;
        }
        else
        {
            var filter = "!@#$%^&*()+=[]\\;./{_}|\":<>?";
            var refilter = /(^\s+|^-|[a-z A-Z]|^\')/;
            var nom = $("#Montant");
            $("#groupeMontant").addClass("has-error");
            console.log("sdsdss");
            var bon = 1;
            if (nom.val().length == 0) {
                $("#groupeMontant").removeClass("has-success");
                return false;
            }
            else {
                for (var i = 0; i < nom.val().length; i++) {
                    if ((filter.indexOf(nom.val().charAt(i)) != -1))
                    {
                        $("#groupeMontant").removeClass("has-success");
                        $("#groupeMontant").addClass("has-error");
                        bon = -1;
                        return false;
                    }
                }

                if (refilter.test(nom.val())) {
                    $("#groupeMontant").removeClass("has-success");
                    $("#groupeMontant").addClass("has-error");
                    bon = -1;
                    return false;
                }

                if (bon == 1) {
                    var a = nom.val();
                    a = a.replace(/\s+$/g, '');
                    $("#groupeMontant").removeClass("has-error").addClass("has-success");
                    return true;
                }
            }
            return false;

        }
    }

    $scope.confirmSupprFacture = function () {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/DeleteFacture/' + idFactureASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprFacture = !$scope.showSupprFacture;
                            $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                    success(
                                            function (data)
                                            {
                                                $scope.facture = {};
                                                $scope.factures = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }




    $scope.ajoutFacture = function ()
    {
        if ($scope.changeMontant())
        {
            $scope.facture.anneeScolaire = $scope.annee;
            $scope.facture.numero_eleve = id;
            $http.post(gOptions.serveur + '/rest/FactureManager.php/AddFacture', $scope.facture).
                    success(
                            function (data)
                            {
                                $scope.showAjoutFacture = !$scope.showAjoutFacture;
                                $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                        success(
                                                function (data)
                                                {

                                                    $scope.facture = {};
                                                    $scope.factures = data.data;
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });
                                $http.get(gOptions.serveur + '/rest/FactureManager.php/GetTotalSolde?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                        success(
                                                function (data)
                                                {

                                                    $scope.totalsolde = data.data[0].totalsolde;
                                                }
                                        ).
                                        error(function (result)
                                        {
                                            console.log("error");
                                        });

                            }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.ouvrirTab = function (annee_scolaire)
    {
        $scope.annee = annee_scolaire;
        $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + $stateParams.id + '&annee_scolaire=' + annee_scolaire).
                success(
                        function (data)
                        {

                            $scope.factures = data.data;
                        }
                ).
                error(function (result)
                {
                });
        $http.get(gOptions.serveur + '/rest/FactureManager.php/GetTotalSolde?numero=' + id + '&annee_scolaire=' + annee_scolaire).
                success(
                        function (data)
                        {

                            $scope.totalsolde = data.data[0].totalsolde;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.showModFacture = false;
    $scope.popupModifierFacture = function (factureId) {
        $scope.idFactureAModifier = factureId;
        $scope.showModFacture = !$scope.showModFacture;
        $http.get(gOptions.serveur + '/rest/FactureManager.php/GetFacture/' + factureId).
                success(
                        function (data)
                        {

                            $scope.facture = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }
 

    $scope.modifierFacture = function ()
    {
        if ($scope.changeMontant())
        {     
             
            $http.post(gOptions.serveur + '/rest/FactureManager.php/UpdateFacture/', $scope.facture).
                    success(
                            function (data)
                            {
                                $scope.showModFacture = !$scope.showModFacture;
                                $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                        success(
                                                function (data)
                                                {
                                                    $scope.facture = {};
                                                    $scope.factures = data.data;
                                                }
                                        ).
                                        error(function (result)
                                        {
                                        });
                                $http.get(gOptions.serveur + '/rest/FactureManager.php/GetTotalSolde?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                        success(
                                                function (data)
                                                {

                                                    $scope.totalsolde = data.data[0].totalsolde;
                                                }
                                        ).
                                        error(function (result)
                                        {
                                            console.log("error");
                                        });
                            }).
                    error(function (result)
                    {
                    });
        }


    }
    $scope.annulerModifFacture = function () {
        $scope.showModFacture = !$scope.showModFacture;
        $scope.facture = {};
    }

    $scope.annulerFacture = function () {
        $scope.showAjoutFacture = !$scope.showAjoutFacture;
        $scope.recue = {};
    }

    $scope.dismiss = function () {
        $scope.facture = {};
    }

    $scope.refreshFactures = function ()
    {
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {
            $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {

                                $scope.factures = data.data;
                            }
                    ).
                    error(function (result)
                    {
                    });
            $http.get(gOptions.serveur + '/rest/FactureManager.php/GetTotalSolde?numero=' + id + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {

                                $scope.totalsolde = data.data[0].totalsolde;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }
}
;

appAdmin.controller('RecuCtrl', RecuCtrl, ['$scope']);
function RecuCtrl($resource, $http, $scope, $location, $stateParams, getAnneeEncours)
{
    $scope.tabped1 = typeof $stateParams.active != 'undefined' ? $stateParams.active : 'tabrecu1';
    var id = -1;

    $scope.user = $scope.$parent.user;

    $scope.recue = {};
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

               
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 &&
                    $stateParams.annee!= undefined && $stateParams.annee!= '' && $stateParams.annee!= -1)
                {
               
                    $scope.annee = $stateParams.annee;

                    id = $stateParams.id;
                    $scope.recues = [];
                    $scope.numero_eleve = id;
                    $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                            success(
                                    function (data)
                                    {

                                        $scope.recues = data.data;
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });



                }
            });


    $scope.validateNumber = function (idInput, idFormGroup)
    {
        if ($scope.eleve.versement == false)
            return true;
        else
        {
            var filter = "!@#$%^&*()+=[]\\;./{_}|\":<>?";
            var refilter = /(^\s+|^-|[a-z A-Z]|^\')/;
            console.log(idInput);
            var nom = $("#" + idInput);
            $("#" + idFormGroup).addClass("has-error");

            var bon = 1;
            if (nom.val().length == 0) {
                $("#" + idFormGroup).removeClass("has-success");
                return false;
            }
            else {
                for (var i = 0; i < nom.val().length; i++) {
                    if ((filter.indexOf(nom.val().charAt(i)) != -1))
                    {
                        $("#" + idFormGroup).removeClass("has-success");
                        $("#" + idFormGroup).addClass("has-error");
                        bon = -1;
                        return false;
                    }
                }

                if (refilter.test(nom.val())) {
                    $("#" + idFormGroup).removeClass("has-success");
                    $("#" + idFormGroup).addClass("has-error");
                    bon = -1;
                    return false;
                }

                if (bon == 1) {
                    var a = nom.val();
                    a = a.replace(/\s+$/g, '');
                    $("#" + idFormGroup).removeClass("has-error").addClass("has-success");
                    return true;
                }
            }
            return false;
        }

    }
    $scope.factureChosen = [];

    $scope.showAjoutRecu = false;
    $scope.ouvrirTab = function (annee_scolaire)
    {
        $scope.annee = annee_scolaire;
        $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                success(
                        function (data)
                        {

                            $scope.recues = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }


    $scope.getSolde = function () {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/GetSolde/' + $scope.recue.facture.numero_facture).
                success(
                        function (data)
                        {

                            $scope.recue.solde = parseInt(data.data[0].solde) * -1;
                        }
                ).
                error(function (result)
                {
                });
    }

    $scope.popupAjoutRecu = function () {
        $scope.showAjoutRecu = !$scope.showAjoutRecu;

    }

    $scope.AnnulerSupprRecu = function () {
        $scope.showSupprRecu = !$scope.showSupprRecu;
        $scope.recue = {};
    }

    $scope.showSupprRecu = false;
    $scope.popupSupprRecu = function (recuId) {
        idRecuASuppr = recuId;
        $scope.showSupprRecu = !$scope.showSupprRecu;

    }


    $scope.confirmSupprRecu = function () {
        $http.get(gOptions.serveur + '/rest/RecuManager.php/DeleteRecu/' + idRecuASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprRecu = !$scope.showSupprRecu;
                            $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                    success(
                                            function (data)
                                            {

                                                $scope.recues = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }



    $scope.ajoutRecu = function ()
    {

        $scope.recue.numero_eleve = id;
        $scope.recue.anneeScolaire = $scope.annee;

        if ($scope.validateNumber('versement', 'groupeMontantVersement'))

        {
            $http.post(gOptions.serveur + '/rest/RecuManager.php/AddRecu', $scope.recue).
                    success(
                            function (data)
                            {
                                $scope.showAjoutRecu = !$scope.showAjoutRecu;
                                $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                        success(
                                                function (data)
                                                {
                                                    $scope.recue = {};
                                                    $scope.recues = data.data;
                                                }
                                        ).
                                        error(function (result)
                                        {
                                            console.log("error");
                                        });

                            }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.showModRecu = false;
    $scope.popupModifierRecu = function (recuId) {
        $scope.showModRecu = !$scope.showModRecu;
        $http.get(gOptions.serveur + '/rest/RecuManager.php/GetRecu/' + recuId).
                success(
                        function (data)
                        {

                            $scope.recue = data.data[0];
                        }
                ).
                error(function (result)
                {
                });
    }


    $scope.modifierRecu = function ()
    {

        $http.post(gOptions.serveur + '/rest/RecuManager.php/UpdateRecu/', $scope.recue).
                success(
                        function (data)
                        {
                            $scope.showModRecu = !$scope.showModRecu;
                            $scope.recue = {};
                            $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + id + '&annee_scolaire=' + $scope.annee).
                                    success(
                                            function (data)
                                            {

                                                $scope.recues = data.data;
                                            }
                                    ).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }).
                error(function (result)
                {
                });

    }
    $scope.annulerModifRecu = function () {
        $scope.showModRecu = !$scope.showModRecu;
        $scope.recue = {};
    }

    $scope.annulerRecu = function () {
        $scope.showAjoutRecu = !$scope.showAjoutRecu;
        $scope.recue = {};
    }

    $scope.dismiss = function () {
        $scope.recue = {};
    }

    $scope.choseRecu = function ()
    {

        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {
            $http.get(gOptions.serveur + '/rest/FactureManager.php/GetFactureByOperation?num_eleve=' + $stateParams.id + '&operation=' + $scope.recue.operation + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {

                                $scope.factureChosen = data.data;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

}
;



appAdmin.controller('ListNomClasse', ListNomClasse, ['$scope']);
function ListNomClasse($http, $scope)
{
    $http.get(gOptions.serveur + '/rest/ClasseManager.php/ListNomClasse').
            success(
                    function (data)
                    {

                        $scope.nomClasses = data.data;
                    }).
            error(function (result)
            {
                console.log("error");
            });


}
;


appAdmin.controller('InscriptionCtrl', InscriptionCtrl, ['$scope', '$state', 'growl']);
function InscriptionCtrl($http, $scope, $state, $stateParams, growl, fileUpload, getAnneeEncours)
{

    $scope.showTuteurExist = false;
    $scope.showAnneeExist = false;
    $scope.confirmTuteurExist = false;
    $scope.userFind = {};
    $scope.eleve = {};
    $scope.eleve.existParent = false;
    $scope.upload = {};
    $scope.upload.avatar = "";
    $scope.validateAvatar = false;
    $scope.chargemodfile = false;
    $scope.eleve.user = {};
    $scope.disabledAnnee = false;
    $scope.disabledInsReins = false;
    $scope.users = [];

    $scope.eleve.frais_inscription = 0;
    $scope.eleve.montant_transport = 0;
    $scope.eleve.frais_tenue = 0;
    $scope.eleve.frais_sport = 0;
    $scope.eleve.taux_reduction = 0;
    $scope.eleve.montant_du = 0;
    $scope.eleve.tarif = '';

    $scope.$watch('numero_eleve',function(newValue,oldValue){
        $scope.chargeEleve();
    });
    
    $scope.validateNumber = function (idInput, idFormGroup)
    {
        if ($scope.eleve.boursier == false)
            return true;
        else
        {
            var filter = "!@#$%^&*()+=[]\\;./{_}|\":<>?";
            var refilter = /(^\s+|^-|[a-z A-Z]|^\')/;
            console.log(idInput);
            var nom = $("#" + idInput);
            $("#" + idFormGroup).addClass("has-error");

            var bon = 1;
            if (nom.val().length == 0) {
                $("#" + idFormGroup).removeClass("has-success");
                return false;
            }
            else {
                for (var i = 0; i < nom.val().length; i++) {
                    if ((filter.indexOf(nom.val().charAt(i)) != -1))
                    {
                        $("#" + idFormGroup).removeClass("has-success");
                        $("#" + idFormGroup).addClass("has-error");
                        bon = -1;
                        return false;
                    }
                }

                if (refilter.test(nom.val())) {
                    $("#" + idFormGroup).removeClass("has-success");
                    $("#" + idFormGroup).addClass("has-error");
                    bon = -1;
                    return false;
                }

                if (bon == 1) {
                    var a = nom.val();
                    a = a.replace(/\s+$/g, '');
                    $("#" + idFormGroup).removeClass("has-error").addClass("has-success");
                    return true;
                }
            }
            return false;
        }

    }


    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.annee = payload.data.data[0].annee_en_cours;

                if ($stateParams.id != "add" && $stateParams.id != null && $stateParams.id != undefined)
                {

                    $scope.disabledAnnee = true;
                    $scope.disabledInsReins = true;
                    $http.get(gOptions.serveur + '/rest/EleveManager.php/getEleves?numero=' + $stateParams.id + '&annee_scolaire=' + $scope.annee).
                            success(function (data)
                            {


                                $scope.eleve = data.data[0];
                                $scope.eleve.user = {};
                                $scope.eleve.user.nom = data.data[0].nomtuteur;
                                $scope.eleve.user.prenom = data.data[0].prenomtuteur;
                                $scope.eleve.user.email = data.data[0].emailtuteur;
                                $scope.eleve.user.adresse = data.data[0].adressetuteur;
                                $scope.eleve.user.telephone = data.data[0].telephonetuteur;
                                $scope.eleve.user.profession_tuteur = data.data[0].professiontuteur;
                                $scope.eleve.user.societe_tuteur = data.data[0].societetuteur;
                                $scope.eleve.user.region_tuteur = data.data[0].regiontuteur;
                                $scope.eleve.user.autorite_parentale = data.data[0].autoriteparentale;
                                $scope.eleve.name = data.data[0].avatar;
                                $scope.eleve.anc_classe_demande = $scope.eleve.classe_demande;

                            }).
                            error(function (result)
                            {
                                console.log("error");
                            });

                }

                $http.get(gOptions.serveur + '/rest/LoginManager.php/getUsersAll').
                        success(
                                function (data)
                                {

                                    $scope.users = data.data;
                                }).
                        error(function (result)
                        {
                            console.log("error");
                        });
            });

    $scope.chargeEleve = function ()
    {
        if ($scope.numero_eleve != undefined || $scope.numero_eleve.toString() != '' || $scope.numero_eleve != null)
        {
            console.log($scope.numero_eleve);
            $http.get(gOptions.serveur + '/rest/EleveManager.php/getEleves?numero=' + $scope.numero_eleve + '&annee_scolaire=' + $scope.annee).
                    success(
                            function (data)
                            {

                                $scope.eleve = data.data[0];
                                $scope.eleve.user = {};
                                $scope.eleve.user.nom = $scope.eleve.nomtuteur;
                                $scope.eleve.user.prenom = $scope.eleve.prenomtuteur;
                                $scope.eleve.user.email = $scope.eleve.emailtuteur;
                                $scope.eleve.user.adresse = $scope.eleve.adressetuteur;
                                $scope.eleve.user.telephone = $scope.eleve.telephonetuteur;
                                $scope.eleve.user.profession_tuteur = $scope.eleve.professiontuteur;
                                $scope.eleve.user.societe_tuteur = $scope.eleve.societetuteur;
                                $scope.eleve.user.region_tuteur = $scope.eleve.regiontuteur;
                                $scope.eleve.user.autorite_parentale = $scope.eleve.autoriteparentale;
                                $scope.eleve.name = $scope.eleve.avatar;
                                $scope.eleve.oldAnneeScolaire = $scope.eleve.annee_scolaire;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");   
                    });
        }
        else
        {
            $scope.eleve = {};
        }
    }


    $scope.launch = function () {
        $("#icone").trigger('click');


        $("#icone").change(function () {
            if ($scope.upload.avatar.size > 1500000)
            {
                growl.error("La taille de l'image ne doit pas excedee 1,50 Mo");
                $scope.validateAvatar = false;
            }
            else
            {
                if ($scope.upload.avatar.type != "image/jpeg" && $scope.upload.avatar.type != "image/jpg" && $scope.upload.avatar.type != "image/png")
                {
                    growl.error("L'image doit √™tre au format png ou jpg/jpeg");
                    $scope.validateAvatar = false;
                }
                else {
                    // console.log($( '#icone')[0].files[0]);
                    $scope.eleve.avatar = null;
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#avatarImg').attr('src', e.target.result);

                    }
                    $scope.chargemodfile = true;
                    // Enfin, nous demandons a notre reader de charger l'image
                    reader.readAsDataURL($('#icone')[0].files[0]);
                    $scope.validateAvatar = true;
                }
            }
        });
    }

    $scope.confirmTuteur = function () {
        $scope.eleve.user = {};
        $scope.confirmTuteurExist = true;
        $scope.showTuteurExist = !$scope.showTuteurExist;
        $scope.eleve.user = $scope.userFind;
        $scope.eleve.existParent = true;
        $scope.eleve.id_parent = $scope.userFind.id;
    }

    $scope.annulerTuteur = function () {
        $scope.confirmTuteurExist = false;
        $scope.showTuteurExist = !$scope.showTuteurExist;
    }

    $scope.SelonInput = function () {
        if ($scope.eleve.boursier == false || $scope.eleve.boursier == 'NON')
            $scope.eleve.montant_bourse = "";

        if ($scope.eleve.handicape == false || $scope.eleve.handicape == 'NON')
            $scope.eleve.type_handicape = "";
        if ($scope.eleve.sport == false || $scope.eleve.sport == "NON") {
            $scope.eleve.frais_sport = 0;
            $scope.calculTotal();
            $scope.eleve.type_sport = "";
        }
        if ($scope.eleve.tenue == false || $scope.eleve.tenue == "NON") {
            $scope.eleve.frais_tenue = 0;
            $scope.calculTotal();
            $scope.eleve.type_tenue = "";
        }
        if ($scope.eleve.transport == false || $scope.eleve.transport == "NON") {
            $scope.eleve.montant_transport = 0;
            $scope.calculTotal();
            $scope.eleve.id_transport = "";
        }
    }
    
    $scope.confirmAnneeScolaire = function(){
        $scope.showAnneeExist = !$scope.showAnneeExist;
    }

    $scope.ajoutModEleve = function () {


        if (($scope.eleve.numero_eleve == undefined && $stateParams.id == "add")
                || ($stateParams.id == "add" && $scope.eleve.numero_eleve != undefined))
        {



            if ($scope.confirmTuteurExist == false && $stateParams.id == "add" && $scope.eleve.numero_eleve == undefined) {

                for (var i = 0; i < $scope.users.length; i++) {

                    if (new String($scope.users[i].telephone).valueOf() == new String($scope.eleve.user['telephone']).valueOf())
                    {

                        $scope.showTuteurExist = true;
                        $scope.userFind = $scope.users[i];
                        $scope.numTuteurFind = $scope.users[i].telephone;
                        $scope.nomTuteurFind = $scope.users[i].nom;
                        $scope.prenomTuteurFind = $scope.users[i].prenom;
                    }
                }
            }
            
            if(new String($scope.eleve.oldAnneeScolaire).valueOf() == new String($scope.eleve.annee_scolaire).valueOf())
            {
                $scope.showAnneeExist = true;
            }

            if (!$scope.showTuteurExist && !$scope.showAnneeExist)
            {
                  console.log(new String($scope.eleve.oldAnneeScolaire).valueOf() +":"+new String($scope.eleve.annee_scolaire).valueOf());
                if ($scope.validateAvatar)
                {

                    $scope.nameTemp = $scope.eleve.nom + $scope.eleve.prenom + $scope.eleve.user.telephone;
                    $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                    if ($scope.formatAvatar == "jpeg")
                        $scope.formatAvatar = "jpg";

                    $scope.eleve.name = $scope.nameTemp + "." + $scope.formatAvatar;
                    //Ajout Eleve
                    var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                    fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.eleve.name, "avatarEleves", uploadUrl);
                    fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.eleve.name, "avatarUsers", uploadUrl);
                }
                else if($scope.eleve.avatar !='' || $scope.eleve.avatar !=null)
                    $scope.eleve.name = $scope.eleve.avatar;
                else 
                    $scope.eleve.name = '';
                promise = $http.post(gOptions.serveur + '/rest/InscriptionManager.php/AddEleve', $scope.eleve).
                        then(
                                function (data)
                                {
                                    $state.go('inscription');
                                    $scope.eleve = {};
                                    growl.info('Etudiant inscrit avec succËs', {ttl: 3000});
                       
                                },
                                function (result)
                                {
                                     growl.error('Erreur lors de l\'insciption. Veuillez rÈessayez', {ttl: 3000});
                                });
            }
        }
        else if (($stateParams.id != "add" && $stateParams.id != null && $stateParams.id != undefined && $scope.eleve.numero_eleve != null)
                ) {
            //Modfier Eleve


            if ($scope.validateAvatar)
            {
                $scope.nameTemp = $scope.eleve.nom + $scope.eleve.prenom + $scope.eleve.user.telephone
                $scope.formatAvatar = $scope.upload.avatar.type.split('/')[1];
                if ($scope.formatAvatar == "jpeg")
                    $scope.formatAvatar = "jpg";

                $scope.eleve.name = $scope.nameTemp + "." + $scope.formatAvatar;
                //Ajout Eleve
                var uploadUrl = gOptions.serveur + '/rest/InscriptionManager.php/stockAvatar';
                fileUpload.uploadFileToUrl($('#icone')[0].files[0], $scope.eleve.name, "avatarEleves", uploadUrl);
            }
            else
                $scope.eleve.name = $scope.eleve.avatar;

               promise =   $http.post(gOptions.serveur + '/rest/InscriptionManager.php/UpdateEleve', $scope.eleve).
                    then(function (data)
                    {
                        $state.go('index', {eleve: $scope.eleve.numero_eleve});
                         growl.info('Etudiant modifiÈ avec succËs', {ttl: 3000});
                    },function (result)
                    {
                           growl.error('Erreur lors de la modification des informations de l\'Ètudiant. Veuillez rÈessayez', {ttl: 3000});
                    });
        }

    }

    $scope.calculMensualiteSport = function ()
    {
        $http.get(gOptions.serveur + '/rest/SportManager.php/getMensualiteByType/' + $scope.eleve.type_sport).
                success(function (data)
                {
                    $scope.eleve.frais_sport = data.data[0].mensualite;

                    $scope.calculTotal();
                }).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.calculMensualiteTenue = function ()
    {
        $http.get(gOptions.serveur + '/rest/TenueManager.php/getMensualiteByType/' + $scope.eleve.type_tenue).
                success(function (data)
                {
                    $scope.eleve.frais_tenue = data.data[0].mensualite* parseInt($scope.eleve.nombre);

                    $scope.calculTotal();
                }).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.calculMensualiteTransport = function ()
    {
        $http.get(gOptions.serveur + '/rest/TransportManager.php/getMensualiteByItineraire/' + $scope.eleve.id_transport).
                success(function (data)
                {
                    $scope.eleve.montant_transport = data.data[0].mensualite;

                    $scope.calculTotal();
                }).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.calculMensualiteClasse = function ()
    {
        $scope.calculTotal();

    }

    $scope.calculTotal = function ()
    {
        var splitTarif = $scope.eleve.tarif.split(':');
        var frais_inscription = splitTarif[1];
        $scope.eleve.montant_du = ((parseInt(frais_inscription) + parseInt($scope.eleve.montant_transport) +
                parseInt($scope.eleve.frais_tenue) + parseInt($scope.eleve.frais_sport)) * (100 - parseInt($scope.eleve.taux_reduction))) / 100;
    }


    $scope.viderTransport = function ()
    {
        $("#transportSelect").val(" ");
    }

    $scope.annulerModifEleve = function ()
    {
        $scope.eleve = {};
        $state.go('accueil');
    }
}
;
appAdmin.controller('autocompleteCtrl', autocompleteCtrl, ['$scope', '$state', 'growl']);
function autocompleteCtrl($http, $scope, $state, $stateParams, growl, fileUpload)
{
    $scope.etab = [];
 
	
        $http.get(gOptions.serveur + '/rest/InscriptionManager.php/GetAncEtab').
                success(
                        function (data)
                        {

                            $scope.ancEtab = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
				
    $scope.filtrerEtab = function (typedthings)
    {
	
		$scope.etab = [];
		formationsAutocompleteFormated = [];
		if (typedthings != "") {
			selectedTagsFormations = [];
			len = typedthings.length - 1;
			if (typedthings.indexOf("\"") == 0
					&& typedthings.lastIndexOf("\"") == len) {
				selectedTagsFormations.push(typedthings.substr(1, (len - 1)));
				isTag = true;
			} else {
				selectedTagsFormations = typedthings.split(' ');
				isTag = false;
			}
			for (var i = 0; i < $scope.ancEtab.length; i++) {
				if(formationsAutocompleteFormated.length == 10){
					break;
				}
				objFormtion = $scope.ancEtab[i].ancEtab;
				trouve = 1;
				for (var j = 0; j < selectedTagsFormations.length; j++) {
					tag = selectedTagsFormations[j];
					if (objFormtion.toLowerCase().search(
							tag.toLowerCase()) == -1) {
						trouve = 0;
						break;
					}
				}

				if(trouve == 1){
					libelleFormated = (objFormtion.toLowerCase());
					if(formationsAutocompleteFormated.indexOf(libelleFormated) == -1){
						formationsAutocompleteFormated.push(libelleFormated);
						$scope.etab.push(objFormtion);
					}
				}
			}
		}
    }

$scope.Getinfo = function (typedthings)
{
     $http.get(gOptions.serveur + '/rest/InscriptionManager.php/GetInfoAncEtab/'+typedthings).
                success(
                        function (data)
                        {

                            $scope.eleveTemp = data.data[0];
							$scope.$parent.eleve.adresse_dernier_ecole = $scope.eleveTemp.adresse_dernier_ecole; 
							$scope.$parent.eleve.region_dernier_ecole = $scope.eleveTemp.region_dernier_ecole; 
							$scope.$parent.eleve.telephone_dernier_ecole = $scope.eleveTemp.telephone_dernier_ecole; 
							$scope.$parent.eleve.email_dernier_ecole = $scope.eleveTemp.email_dernier_ecole;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
}

}


appAdmin.directive('bareNavigation', function () {
    return {
        restrict: 'E',
        templateUrl: 'header.php'
    };
});

appAdmin.directive('footer', function () {
    return {
        restrict: 'E',
        templateUrl: 'footer.php'
    };
});

appAdmin.directive('menu', function () {
    return {
        restrict: 'E',
        templateUrl: 'menu.php'
    };

});


appAdmin.directive('modal', function () {
    return {
        template: '<div class="modal fade" >' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header lighter block green">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="dismiss()">&times;</button>' +
                '<h4 class="modal-title">{{ title }}</h4>' +
                '</div>' +
                '<div ng-transclude></div>' +
                '</div>' +
                '</div>' +
                '</div>',
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: true,
        link: function postLink(scope, element, attrs) {
            scope.title = attrs.title;

            scope.$watch(attrs.visible, function (value) {
                if (value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });

            $(element).on('shown.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = true;
                });
            });



            $(element).on('hidden.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});




appAdmin.directive("fileavatar", [function () {
        return {
            scope: {
                fileavatar: "="
            },
            link: function (scope, element, attributes) {
                element.bind("change", function (changeEvent) {
                    scope.$apply(function () {
                        scope.fileavatar = changeEvent.target.files[0];
                        // or all selected files:
                        // scope.fileread = changeEvent.target.files;
                    });
                });
            }
        }
    }]);

appAdmin.service('fileUpload', ['$http', function ($http) {
        this.uploadFileToUrl = function (file, nom, dossier, uploadUrl) {
            var fd = new FormData();
            fd.append('icone', file);
            fd.append('nom', nom);
            fd.append('dossier', dossier);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
                    .success(function (data) {
                        return data;
                    })
                    .error(function () {
                    });
        }
    }])
	