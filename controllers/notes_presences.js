var notesPresences = angular.module('notesPresences', ['ui.router']);


//start MatiereEleveCtrl
notesPresences.controller('MatiereEleveCtrl', MatiereEleveCtrl, ['$scope']);
function MatiereEleveCtrl($resource, $http, $scope, $location, $stateParams, Auth, getAnneeEncours)
{
    $scope.tabped2 = typeof $stateParams.active != 'undefined' ? $stateParams.active : 'tabnote1';
    $scope.matiere = {};
    $scope.user = Auth.user;
    $scope.semestre = 1;
    $scope.anneesscolaire = [];


    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $http.get(gOptions.serveur + '/rest/NoteManager.php/getAnneesScolaire/' + $stateParams.id).
                            success(
                                    function (data)
                                    {
                                        $scope.anneesscolaire = data.data;
                                    }
                            ).
                            error(function (result)
                            {
                                console.log("error");
                            });
                if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 &&
                     $stateParams.annee!= undefined && $stateParams.annee!= '' && $stateParams.annee!= -1)
                {

                    $scope.annee =$stateParams.annee;
                    $scope.matieres = [];

                    $http.get(gOptions.serveur + '/rest/EleveManager.php/getMatieresByEleve?numero_eleve=' + $stateParams.id + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.annee).
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
            });

    $scope.changeSemestre = function () {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getMatieresByEleve?numero_eleve=' + $stateParams.id + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.annee).
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

    $scope.ouvrirTab = function (annee_scolaire)
    {
        $scope.annee = annee_scolaire;
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getMatieresByEleve?numero_eleve=' + $stateParams.id + '&semestre=' + $scope.semestre + '&annee_scolaire=' + annee_scolaire).
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

    $scope.exportBulletinNotes = function () {

        window.open(gOptions.serveur + '/pdf/note.php?numero_eleve=' + $stateParams.id + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.annee, '_blank');

    }
}
notesPresences.controller('MatiereEleveAllCtrl', MatiereEleveAllCtrl, ['$scope']);
function MatiereEleveAllCtrl($resource, $http, $scope, $location, $stateParams, Auth, getAnneeEncours)
{
    $scope.matiere = {};
    $scope.user = Auth.user;
    $scope.semestre = 1;

    $scope.matieres = [];
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.matiere.anneeScolaire = payload.data.data[0].annee_en_cours;

                $http.get(gOptions.serveur + '/rest/EleveManager.php/getMatieresByEleve?numero_eleve=' + $scope.$parent.eleve.numero_eleve + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.matiere.anneeScolaire).
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
            });


    $scope.changeSemestre = function () {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getMatieresByEleve?numero_eleve=' + $scope.$parent.eleve.numero_eleve + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.matiere.anneeScolaire).
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

    $scope.exportBulletinNotes = function () {

        window.open(gOptions.serveur + '/pdf/note.php?numero_eleve=' + $scope.$parent.eleve.numero_eleve + '&semestre=' + $scope.semestre + '&annee_scolaire=' + $scope.matiere.anneeScolaire, '_blank');

    }

}

//start NoteController
notesPresences.controller('NotesAllCtrl', NotesAllCtrl, ['$scope']);
function NotesAllCtrl($resource, $http, $scope, $location, $stateParams, getAnneeEncours, growl, $state, Auth)
{

    $scope.eleves = [];
    $scope.eleve = {};
    $scope.user = Auth.user;
    var promise = getAnneeEncours.getAnnee();
    $scope.showPagination = false;
    $scope.itemsPagination=[];
    promise.then(
            function (payload) {
                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });

    $scope.confirmPagination = function(){ 
            var limits = $scope.eleve.limit.split('-');
            var limit = limits[0]-1;
            $scope.showPagination=!$scope.showPagination;
            $scope.itemsPagination=[];
            window.open(gOptions.serveur + '/pdf/notes.php?idclasse=' + $scope.eleve.id_classe + '&semestre=' + $scope.eleve.semestre + '&annee_scolaire=' + $scope.anneeEnCours +'&limit='+ limit, '_blank');
        
    }
    
    $scope.annulerPagination= function(){
           $scope.showPagination=!$scope.showPagination;
    }

    $scope.exportAllBulletinNotes = function (semestre) {
 $scope.itemsPagination=[];
 $scope.eleve.limit='';
        $scope.eleve.semestre=semestre;
        if($scope.eleves.length<=20)
           window.open(gOptions.serveur + '/pdf/notes.php?idclasse=' + $scope.eleve.id_classe + '&semestre=' + semestre + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');
        else
        {
          $scope.showPagination = true;
          var restpagin = $scope.eleves.length;
          var mincurrent = 1;
          var maxcurrent =20;
          while(true){
            $scope.itemsPagination.push({'label':mincurrent+'-'+maxcurrent});
            restpagin = restpagin-20;
            mincurrent = maxcurrent+1;
            if(restpagin < 20)     
            {
               maxcurrent = maxcurrent+restpagin;
               $scope.itemsPagination.push({'label':mincurrent+'-'+maxcurrent});
               break;
            }
            else maxcurrent = maxcurrent+20;

          }
        } 
    }

   $scope.exportAllBulletinRecap= function (semestre) {
        window.open(gOptions.serveur + '/pdf/recapitulatif.php?idclasse=' + $scope.eleve.id_classe + '&semestre=' + semestre + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');


    }

    $scope.validateNumber = function (idInput, idFormGroup)
    {
        var filter = "!@#$%^&*()+=[]\\;,/{_}|\":<>?";
        var refilter = /(^\s+|^-|[a-z A-Z]|^\')/;
        var nom = $("#" + idInput);
        $("#" + idFormGroup).addClass("has-error");

        var bon = 1;
        if (nom.val().length == 0) {
            $("#" + idFormGroup).removeClass("has-success").removeClass("has-error");
            return true;
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
				if (parseInt(a) >20 ||  parseInt(a) <0)
				 return false;
                $("#" + idFormGroup).removeClass("has-error").addClass("has-success");
                return true;
            }
        }
        return false;
    }


    $scope.exportPdfNotes = function () {
        window.open(gOptions.serveur + '/pdf/notepdf.php?idClasse=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');


    }


    $scope.exportAllRec = function (month, monthLibelle) {
        window.open(gOptions.serveur + '/pdf/recus.php?idclasse=' + $scope.eleve.id_classe + '&month=' + month + '&monthLibelle=' + monthLibelle + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');


    }

    $scope.exportPdfPresences = function () {
        window.open(gOptions.serveur + '/pdf/presencepdf.php?idClasse=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');


    }

    $scope.popupAjoutAllDevoirs = function () {
        $scope.showAjoutAllDevoir = !$scope.showAjoutAllDevoir;
        $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.eleve.id_classe).
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

    $scope.annulerAlldev = function () {
        $scope.showAjoutAllDevoir = !$scope.showAjoutAllDevoir;
        $scope.dev = {};
    }
    $scope.dev = {};
    $scope.ajoutAlldev = function ()
    {

        $scope.dev.numero_eleves = [];
        $scope.dev.anneeScolaire = $scope.anneeEnCours;
        for (var i = 0; i < $scope.eleves.length; i++)
        {

            $scope.dev.numero_eleves.push({'numero_eleve': $scope.eleves[i].numero_eleve});
        }
        
        $http.post(gOptions.serveur + '/rest/DevManager.php/addAllDev', $scope.dev).
                success(
                        function (data)
                        {
                            growl.success("Devoir ajouté avec success", {ttl: 2000});
                            $scope.showAjoutAllDevoir = !$scope.showAjoutAllDevoir;
                            $state.go('accueil');

                        }
                ).
                error(function (result)
                {
                });
    }
    $scope.showInfosPresence = false;
    $scope.addPresences = function ()
    {
        $scope.matieres = [];
        if ($scope.showInfosPresence == false)
        {

            $scope.showInfosPresence = true
            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.eleve.id_classe).
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

    }

    $scope.presences = {};

    $scope.AnnulerPresences = function ()
    {
        $scope.showInfosPresence = !$scope.showInfosPresence;
        $scope.presences = {};
    }
    
    $scope.confirmPresences = function ()
    {

        $scope.presences.type_presences = [];
        $scope.presences.motifs = [];
        $scope.presences.numero_eleves = [];
        $scope.presences.annee_scolaire = $scope.anneeEnCours;
        for (var i = 0; i < $scope.eleves.length; i++)
        {

            $scope.presences.type_presences.push({'presence': $scope.eleves[i].presence});
            $scope.presences.motifs.push({'motif_renvoi': $scope.eleves[i].motif_renvoi});
            $scope.presences.numero_eleves.push({'numero_eleve': $scope.eleves[i].numero_eleve});
        }

        $http.post(gOptions.serveur + '/rest/NoteManager.php/addAllPresences', $scope.presences).
                success(
                        function (data)
                        {
                            growl.success("Fiche de pr&eacute;sence soumise avec succ&egrave;s", {ttl: 2000});
                            $scope.presences = {};
                            $scope.eleve = {};
                            $scope.eleves = [];
                            $scope.showInfosPresence = !$scope.showInfosPresence;
                            $state.go('fiche-presence');

                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }
    $scope.showInfosNotes = false;
    $scope.addNotes = function ()
    {
        $scope.matieres = [];
        console.log($scope.valideFicheNotes());
        if ($scope.showInfosNotes == false && $scope.valideFicheNotes())
        {

            $scope.showInfosNotes = true;
            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.eleve.id_classe).
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

    }

    $scope.notes = {};

    $scope.AnnulerNotes = function ()
    {
        $scope.showInfosNotes = !$scope.showInfosNotes;
        $scope.notes = {};
    }

    $scope.confirmNotes = function ()
    {
        $scope.notes.notes = [];
        $scope.notes.numero_eleves = [];
        $scope.notes.annee_scolaire = $scope.anneeEnCours;

        $scope.notes.user = $scope.user.prenom + " " + $scope.user.nom;
        for (var i = 0; i < $scope.eleves.length; i++)
        {
            if($scope.eleves[i].note !=undefined)
            {
            $scope.notes.notes.push({'note': $scope.eleves[i].note});

            $scope.notes.numero_eleves.push({'numero_eleve': $scope.eleves[i].numero_eleve});}
        }

        $http.post(gOptions.serveur + '/rest/NoteManager.php/addAllNote', $scope.notes).
                success(
                        function (data)
                        {
                            growl.success("Fiche de note soumise avec succ&egrave;s", {ttl: 2000});
                            $scope.showInfosNotes = !$scope.showInfosNotes;
                             $scope.eleves = [];
                              $scope.eleve = {};
                              $scope.notes = {};
                            $state.go('fiche-notes');

                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.valideFicheNotes = function ()
    {
        for (var i = 0; i < $scope.eleves.length; i++)
        {
            if ($scope.validateNumber('note' + $scope.eleves[i].numero_eleve, 'groupeNote' + $scope.eleves[i].numero_eleve) == false)
            {
                return false;
            }
        }

        return true;
    }

    $scope.changeClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                            if ($scope.eleves.length != 0)
                                $scope.step = $scope.eleves[0].numero_eleve;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.changeClasseMoyenne= function ()
    {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesMoyenneByCodeClasse?id_classe=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                            
                            if ($scope.eleves.length != 0)
                                $scope.step = $scope.eleves[0].numero_eleve;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
}
//start NoteController
notesPresences.controller('NoteAllController', NoteAllController, ['$scope']);
function NoteAllController($resource, $http, $scope, $location, $stateParams, getNoteMoyByEleveService, getExamenByNote, getAnneeEncours)
{
    $scope.allNoteForOneMatiere = [];
    $scope.notesCC = [];
    $scope.noteFinaleObject = {};
    $scope.noteFinaleObject.noteFinale = -1;
    $scope.noteCompObject = {};
    $scope.noteCompObject.noteComp = -1;
    $scope.noteMoyCCObject = {};
    $scope.noteMoyCCObject.noteMoyCC = -1;
    $scope.note = {};

    $scope.showAjoutNote = false;
    $scope.popupAddNote = function () {
        $scope.note = {};

        $scope.note.matiere = $scope.$parent.matiere.nom;
        $scope.showAjoutNote = !$scope.showAjoutNote;
    }

    $scope.showSupprNote = false;
    $scope.popupSupprNote = function (noteId) {
        idNoteASuppr = noteId;
        $scope.showSupprNote = !$scope.showSupprNote;
    }


    function loadToolBars()
    {
        // activate the tooltips
        $("[data-original-title]").tooltip({
            placement: "bottom",
            html: true
        });


        //tooltips
        $("#pdf").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });

    }

    $scope.confirmSupprNote = function () {

        var promise =
                getExamenByNote.getExamenNote(idNoteASuppr);
        promise.then(
                function (payload) {

                    $scope.idExamenAsuppr = payload.data.data[0].id_examen;
                    $http.get(gOptions.serveur + '/rest/NoteManager.php/DeleteNote?idnote=' + idNoteASuppr).
                            success(
                                    function (data)
                                    {
                                        $scope.showSupprNote = !$scope.showSupprNote;
                                        loadNotes();
                                        loadToolBars();
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
    }

    $scope.annulerSupprNote = function ()
    {
        console.log("error");
        $scope.showSupprNote = !$scope.showSupprNote;
        $scope.note = {};
    }

    $scope.showModNote = false;
    $scope.popupModNote = function (idNote) {
        $scope.showModNote = !$scope.showModNote;

        $http.get(gOptions.serveur + '/rest/NoteManager.php/getNoteByNote?numero_eleve=' + $scope.$parent.$parent.eleve.numero_eleve + '&matiere=' + $scope.$parent.matiere.id_matiere + '&note=' + idNote + '&annee_scolaire='
                + $scope.annee + '&semestre=' + $scope.$parent.semestre).
                success(
                        function (data)
                        {
                            //load Notes and calcul
                            $scope.note = data.data[0];
                            $scope.note.matiere = $scope.$parent.matiere.nom;

                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }

    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.annee = payload.data.data[0].annee_en_cours;
                loadNotes();
                loadToolBars();


            });


    $scope.addModNote = function () {

        loadToolBars();
        if ($scope.note.id == null)
        {
            $scope.note.numero_eleve = $scope.$parent.$parent.eleve.numero_eleve;
            $scope.note.id_matiere = $scope.$parent.matiere.id_matiere;
            $scope.note.annee_scolaire = $scope.annee;
            $scope.note.semestre = $scope.$parent.semestre;
            $scope.note.user = $scope.$parent.user.prenom + " " + $scope.$parent.user.nom;
            //Ajout Note
            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNote', $scope.note).
                    success(function (data)
                    {
                        $scope.showAjoutNote = !$scope.showAjoutNote;
                        loadNotes();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.note.id != null) {

            //Modification Note
            $scope.note.user = $scope.$parent.user.prenom + " " + $scope.$parent.user.nom;
            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNote', $scope.note).
                    success(function (data)
                    {
                        $scope.showModNote = !$scope.showModNote;
                        loadNotes();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }

    }

    function loadNotes()
    {

        $scope.note = {};

        $http.get(gOptions.serveur + '/rest/NoteManager.php/getNotesEleveByMatiere?numero_eleve=' + $scope.$parent.$parent.eleve.numero_eleve + '&matiere=' + $scope.$parent.matiere.id_matiere + '&annee_scolaire='
                + $scope.annee + '&semestre=' + $scope.$parent.semestre).
                success(
                        function (data)
                        {
                            //load Notes and calcul
                            $scope.allNoteForOneMatiere = data.data;
                            calculNote($scope.allNoteForOneMatiere);
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }


    function calculNote(allNoteForOneMatiere)
    {
        loadToolBars();
        $scope.notesCC = [];
        $scope.noteFinaleObject = {};
        $scope.noteFinaleObject.noteFinale = -1;
        $scope.noteFinaleObject.rang = 1;
        $scope.noteCompObject = {};
        $scope.noteCompObject.noteComp = -1;
        $scope.noteMoyCCObject = {};
        $scope.noteMoyCCObject.noteMoyCC = -1;

        for (var i = 0; i < allNoteForOneMatiere.length; i++) {
            if (allNoteForOneMatiere[i].type === "CC")
                $scope.notesCC.push(allNoteForOneMatiere[i]);

            if (allNoteForOneMatiere[i].type === "Composition")
            {
                $scope.noteCompObject.libelle = allNoteForOneMatiere[i].libelle;
                $scope.noteCompObject.id_note = allNoteForOneMatiere[i].id_note;
                $scope.noteCompObject.noteComp = parseFloat(allNoteForOneMatiere[i].note);
                $scope.noteCompObject.user = allNoteForOneMatiere[i].user;
                $scope.noteCompObject.date_modification = allNoteForOneMatiere[i].date_modification;

                if ($scope.noteCompObject.noteComp < 10)
                    $scope.noteCompObject.classe = "alert-danger";

                if ($scope.noteCompObject.noteComp >= 10 && $scope.noteCompObject.noteComp < 12)
                    $scope.noteCompObject.classe = "alert-warning";


                if ($scope.noteCompObject.noteComp >= 12 && $scope.noteCompObject.noteComp < 16)
                    $scope.noteCompObject.classe = "alert-success";

                if ($scope.noteCompObject.noteComp >= 16)
                    $scope.noteCompObject.classe = "alert-info";
            }
        }


        $scope.noteTempCC = 0;

        for (var i = 0; i < $scope.notesCC.length; i++) {
            if ($scope.notesCC[i].note < 10)
                $scope.notesCC[i].classe = "alert-danger";

            if ($scope.notesCC[i].note >= 10 && $scope.notesCC[i].note < 12)
                $scope.notesCC[i].classe = "alert-warning";


            if ($scope.notesCC[i].note >= 12 && $scope.notesCC[i].note < 16)
                $scope.notesCC[i].classe = "alert-success";

            if ($scope.notesCC[i].note >= 16)
                $scope.notesCC[i].classe = "alert-info";

            $scope.noteTempCC = parseFloat($scope.noteTempCC) + parseFloat($scope.notesCC[i].note)
        }

        if ($scope.notesCC.length > 1)
        {
            $scope.noteMoyCCObject.noteMoyCC = parseFloat($scope.noteTempCC) / $scope.notesCC.length;

            var promise =
                    getNoteMoyByEleveService.getNoteMoyByEleve($scope.$parent.$parent.eleve.numero_eleve, $scope.$parent.matiere.id_matiere, 64, $scope.annee, $scope.$parent.semestre);
            promise.then(
                    function (payload) {

                        $scope.noteMoys = payload.data.data;
                        if ($scope.noteMoys.length == 0)
                        {
                            $scope.noteMoy = {};
                            $scope.noteMoy.note = $scope.noteMoyCCObject.noteMoyCC;
                            $scope.noteMoy.id_matiere = $scope.$parent.matiere.id_matiere;
                            $scope.noteMoy.annee_scolaire = $scope.annee;
                            $scope.noteMoy.semestre = $scope.$parent.semestre;
                            $scope.noteMoy.typemoy = 64;
                            $scope.noteMoy.numero_eleve = $scope.$parent.$parent.eleve.numero_eleve;

                            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        console.log("addnotemoy");

                                        loadToolBars();
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                        else {

                            $scope.noteMoy = $scope.noteMoys[0];
                            $scope.noteMoy.id_notemoy = $scope.noteMoys[0].id_notemoy;
                            $scope.noteMoy.note = $scope.noteMoyCCObject.noteMoyCC;
                            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        console.log("modnotemoy");

                                        loadToolBars();
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading movie', errorPayload);
                    });




            if ($scope.noteMoyCCObject.noteMoyCC < 10)
                $scope.noteMoyCCObject.classe = "alert-danger";

            if ($scope.noteMoyCCObject.noteMoyCC >= 10 && $scope.noteMoyCCObject.noteMoyCC < 12)
                $scope.noteMoyCCObject.classe = "alert-warning";


            if ($scope.noteMoyCCObject.noteMoyCC >= 12 && $scope.noteMoyCCObject.noteMoyCC < 16)
                $scope.noteMoyCCObject.classe = "alert-success";

            if ($scope.noteMoyCCObject.noteMoyCC >= 16)
                $scope.noteMoyCCObject.classe = "alert-info";
        }
        else if ($scope.notesCC.length <= 1)
            $scope.noteMoyCCObject.noteMoyCC = -1;


        if ($scope.noteCompObject.noteComp != -1)
        {
              if($scope.noteMoyCCObject.noteMoyCC != -1)
                $scope.noteFinaleObject.noteFinale = (parseFloat($scope.noteCompObject.noteComp) + parseFloat($scope.noteMoyCCObject.noteMoyCC)) / parseInt(2);
              else 
                 $scope.noteFinaleObject.noteFinale = parseFloat($scope.noteCompObject.noteComp);
              
            if ($scope.noteFinaleObject.noteFinale < 10)
                $scope.noteFinaleObject.classe = "alert-danger";

            if ($scope.noteFinaleObject.noteFinale >= 10 && $scope.noteFinaleObject.noteFinale < 12)
                $scope.noteFinaleObject.classe = "alert-warning";


            if ($scope.noteFinaleObject.noteFinale >= 12 && $scope.noteFinaleObject.noteFinale < 16)
                $scope.noteFinaleObject.classe = "alert-success";

            if ($scope.noteFinaleObject.noteFinale >= 16)
                $scope.noteFinaleObject.classe = "alert-info";
            //todo
            var promise =
                    getNoteMoyByEleveService.getNoteMoyByEleve($scope.$parent.$parent.eleve.numero_eleve, $scope.$parent.matiere.id_matiere, 65, $scope.annee, $scope.$parent.semestre);
            promise.then(
                    function (payload) {

                        $scope.noteMoys = payload.data.data;

                        console.log($scope.noteMoys);
                        if ($scope.noteMoys.length == 0)
                        {
                            $scope.noteMoy = {};
                            $scope.noteMoy.note = $scope.noteFinaleObject.noteFinale;
                            $scope.noteMoy.id_matiere = $scope.$parent.matiere.id_matiere;
                            $scope.noteMoy.annee_scolaire = $scope.annee;
                            $scope.noteMoy.semestre = $scope.$parent.semestre;
                            $scope.noteMoy.typemoy = 65;
                            $scope.noteMoy.numero_eleve = $scope.$parent.$parent.eleve.numero_eleve;

                            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        loadToolBars();
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });

                        }
                        else {

                            $scope.noteMoy = $scope.noteMoys[0];
                            $scope.noteMoy.id_notemoy = $scope.noteMoys[0].id_notemoy;
                            $scope.noteMoy.note = $scope.noteFinaleObject.noteFinale;
                            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {

                                        loadToolBars();
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }

                        $http.get(gOptions.serveur + '/rest/NoteManager.php/getRangMoy?numero_eleve=' + $scope.$parent.$parent.eleve.numero_eleve + '&matiere=' + $scope.$parent.matiere.id_matiere + '&typeMoy=' + 65
                                + '&annee_scolaire=' + $scope.annee + '&semestre=' + $scope.$parent.semestre).
                                success(function (data)
                                {
                                    $scope.noteFinaleObject.rang = data.data[0].rang;

                                }).
                                error(function (result)
                                {
                                    console.log("error");
                                });
                    },
                    function (errorPayload) {
                        $log.error('failure loading movie', errorPayload);
                    });
        }
    }


    $scope.annulerNote = function ()
    {
        if ($scope.note.id_note == null)
            $scope.showAjoutNote = !$scope.showAjoutNote;

        if ($scope.note.id_note != null)
        {
            $scope.showModNote = !$scope.showModNote;
        }
        $scope.note = {};
    }


    $scope.dismiss = function () {
        $scope.note = {};
    }
}


//start NoteController
notesPresences.controller('NoteController', NoteController, ['$scope']);
function NoteController($resource, $http, $scope, $location, $stateParams, getNoteMoyByEleveService, getExamenByNote)
{
    $scope.allNoteForOneMatiere = [];
    $scope.notesCC = [];
    $scope.noteFinaleObject = {};
    $scope.noteFinaleObject.noteFinale = -1;
    $scope.noteCompObject = {};
    $scope.noteCompObject.noteComp = -1;
    $scope.noteMoyCCObject = {};
    $scope.noteMoyCCObject.noteMoyCC = -1;
    $scope.note = {};

    $scope.showAjoutNote = false;
    $scope.popupAddNote = function () {
        $scope.note = {};

        $scope.note.matiere = $scope.$parent.matiere.nom;
        $scope.showAjoutNote = !$scope.showAjoutNote;
    }

    $scope.showSupprNote = false;
    $scope.popupSupprNote = function (noteId) {
        idNoteASuppr = noteId;
        $scope.showSupprNote = !$scope.showSupprNote;
    }

    loadNotes();
    loadToolBars();

    function loadToolBars()
    {
        // activate the tooltips
        $("[data-original-title]").tooltip({
            placement: "bottom",
            html: true
        });


        //tooltips
        $("#pdf").tooltip({
            placement: "bottom",
            show: {
                effect: "slideDown",
                delay: 250
            }
        });

    }

    $scope.confirmSupprNote = function () {

        var promise =
                getExamenByNote.getExamenNote(idNoteASuppr);
        promise.then(
                function (payload) {

                    $scope.idExamenAsuppr = payload.data.data[0].id_examen;
                    $http.get(gOptions.serveur + '/rest/NoteManager.php/DeleteNote?idnote=' + idNoteASuppr).
                            success(
                                    function (data)
                                    {
                                        $scope.showSupprNote = !$scope.showSupprNote;
                                        loadNotes();
                                        loadToolBars();
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
    }

    $scope.annulerSupprNote = function ()
    {
        console.log("error");
        $scope.showSupprNote = !$scope.showSupprNote;
        $scope.note = {};
    }

    $scope.showModNote = false;
    $scope.popupModNote = function (idNote) {
        $scope.showModNote = !$scope.showModNote;
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {

            $http.get(gOptions.serveur + '/rest/NoteManager.php/getNoteByNote?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&note=' + idNote + '&annee_scolaire='
                    + $scope.$parent.annee + '&semestre=' + $scope.$parent.semestre).
                    success(
                            function (data)
                            {
                                //load Notes and calcul
                                $scope.note = data.data[0];
                                $scope.note.matiere = $scope.$parent.matiere.nom;

                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });

        }
    }



    $scope.addModNote = function () {

        loadToolBars();
        if ($scope.note.id == null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {
            $scope.note.numero_eleve = $stateParams.id;
            $scope.note.semestre = $scope.$parent.semestre;
            $scope.note.id_matiere = $scope.$parent.matiere.id_matiere;
            $scope.note.annee_scolaire = $scope.$parent.annee;
            $scope.note.user = $scope.$parent.user.prenom + " " + $scope.$parent.user.nom;
            //Ajout Note
            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNote', $scope.note).
                    success(function (data)
                    {
                        $scope.showAjoutNote = !$scope.showAjoutNote;
                        loadNotes();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.note.id != null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1) {

            //Modification Note
            $scope.note.user = $scope.$parent.user.prenom + " " + $scope.$parent.user.nom;
            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNote', $scope.note).
                    success(function (data)
                    {
                        $scope.showModNote = !$scope.showModNote;
                        loadNotes();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }

    }

    function loadNotes()
    {

        $scope.note = {};
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {

            $http.get(gOptions.serveur + '/rest/NoteManager.php/getNotesEleveByMatiere?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&annee_scolaire='
                    + $scope.$parent.annee + '&semestre=' + $scope.$parent.semestre).
                    success(
                            function (data)
                            {
                                //load Notes and calcul
                                $scope.allNoteForOneMatiere = data.data;
                                calculNote($scope.allNoteForOneMatiere);
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });

        }
    }


    function calculNote(allNoteForOneMatiere)
    {
        loadToolBars();
        $scope.notesCC = [];
        $scope.noteFinaleObject = {};
        $scope.noteFinaleObject.noteFinale = -1;
        $scope.noteFinaleObject.rang = 1;
        $scope.noteCompObject = {};
        $scope.noteCompObject.noteComp = -1;
        $scope.noteMoyCCObject = {};
        $scope.noteMoyCCObject.noteMoyCC = -1;

        for (var i = 0; i < allNoteForOneMatiere.length; i++) {
            if (allNoteForOneMatiere[i].type === "CC")
                $scope.notesCC.push(allNoteForOneMatiere[i]);

            if (allNoteForOneMatiere[i].type === "Composition")
            {
                $scope.noteCompObject.libelle = allNoteForOneMatiere[i].libelle;
                $scope.noteCompObject.id_note = allNoteForOneMatiere[i].id_note;
                $scope.noteCompObject.noteComp = parseFloat(allNoteForOneMatiere[i].note);
                $scope.noteCompObject.user = allNoteForOneMatiere[i].user;
                $scope.noteCompObject.date_modification = allNoteForOneMatiere[i].date_modification;

                if ($scope.noteCompObject.noteComp < 10)
                    $scope.noteCompObject.classe = "alert-danger";

                if ($scope.noteCompObject.noteComp >= 10 && $scope.noteCompObject.noteComp < 12)
                    $scope.noteCompObject.classe = "alert-warning";


                if ($scope.noteCompObject.noteComp >= 12 && $scope.noteCompObject.noteComp < 16)
                    $scope.noteCompObject.classe = "alert-success";

                if ($scope.noteCompObject.noteComp >= 16)
                    $scope.noteCompObject.classe = "alert-info";
            }
        }


        $scope.noteTempCC = 0;

        for (var i = 0; i < $scope.notesCC.length; i++) {
            if ($scope.notesCC[i].note < 10)
                $scope.notesCC[i].classe = "alert-danger";

            if ($scope.notesCC[i].note >= 10 && $scope.notesCC[i].note < 12)
                $scope.notesCC[i].classe = "alert-warning";


            if ($scope.notesCC[i].note >= 12 && $scope.notesCC[i].note < 16)
                $scope.notesCC[i].classe = "alert-success";

            if ($scope.notesCC[i].note >= 16)
                $scope.notesCC[i].classe = "alert-info";

            $scope.noteTempCC = parseFloat($scope.noteTempCC) + parseFloat($scope.notesCC[i].note)
        }

        if ($scope.notesCC.length > 1)
        {
            $scope.noteMoyCCObject.noteMoyCC = parseFloat($scope.noteTempCC) / $scope.notesCC.length;

            var promise =
                    getNoteMoyByEleveService.getNoteMoyByEleve($stateParams.id, $scope.$parent.matiere.id_matiere, 64, $scope.$parent.annee, $scope.$parent.semestre);
            promise.then(
                    function (payload) {

                        $scope.noteMoys = payload.data.data;
                        if ($scope.noteMoys.length == 0)
                        {
                            $scope.noteMoy = {};
                            $scope.noteMoy.note = $scope.noteMoyCCObject.noteMoyCC;
                            $scope.noteMoy.id_matiere = $scope.$parent.matiere.id_matiere;
                            $scope.noteMoy.semestre = $scope.$parent.semestre;
                            $scope.noteMoy.annee_scolaire = $scope.$parent.annee;
                            $scope.noteMoy.typemoy = 64;
                            $scope.noteMoy.numero_eleve = $stateParams.id;

                            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        console.log("addnotemoy");
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                        else {

                            $scope.noteMoy = $scope.noteMoys[0];
                            $scope.noteMoy.id_notemoy = $scope.noteMoys[0].id_notemoy;
                            $scope.noteMoy.note = $scope.noteMoyCCObject.noteMoyCC;
                            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        console.log("modnotemoy");
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading movie', errorPayload);
                    });




            if ($scope.noteMoyCCObject.noteMoyCC < 10)
                $scope.noteMoyCCObject.classe = "alert-danger";

            if ($scope.noteMoyCCObject.noteMoyCC >= 10 && $scope.noteMoyCCObject.noteMoyCC < 12)
                $scope.noteMoyCCObject.classe = "alert-warning";


            if ($scope.noteMoyCCObject.noteMoyCC >= 12 && $scope.noteMoyCCObject.noteMoyCC < 16)
                $scope.noteMoyCCObject.classe = "alert-success";

            if ($scope.noteMoyCCObject.noteMoyCC >= 16)
                $scope.noteMoyCCObject.classe = "alert-info";
        }
        else if ($scope.notesCC.length <= 1)
            $scope.noteMoyCCObject.noteMoyCC = -1;


        if ($scope.noteCompObject.noteComp != -1 )
        {
            if($scope.noteMoyCCObject.noteMoyCC != -1)
              $scope.noteFinaleObject.noteFinale = (parseFloat($scope.noteCompObject.noteComp) + parseFloat($scope.noteMoyCCObject.noteMoyCC)) / parseInt(2);
            else  $scope.noteFinaleObject.noteFinale = parseFloat($scope.noteCompObject.noteComp);

            if ($scope.noteFinaleObject.noteFinale < 10)
                $scope.noteFinaleObject.classe = "alert-danger";

            if ($scope.noteFinaleObject.noteFinale >= 10 && $scope.noteFinaleObject.noteFinale < 12)
                $scope.noteFinaleObject.classe = "alert-warning";


            if ($scope.noteFinaleObject.noteFinale >= 12 && $scope.noteFinaleObject.noteFinale < 16)
                $scope.noteFinaleObject.classe = "alert-success";

            if ($scope.noteFinaleObject.noteFinale >= 16)
                $scope.noteFinaleObject.classe = "alert-info";
            //todo
            var promise =
                    getNoteMoyByEleveService.getNoteMoyByEleve($stateParams.id, $scope.$parent.matiere.id_matiere, 65, $scope.$parent.annee, $scope.$parent.semestre);
            promise.then(
                    function (payload) {

                        $scope.noteMoys = payload.data.data;

                        console.log($scope.noteMoys);
                        if ($scope.noteMoys.length == 0)
                        {
                            $scope.noteMoy = {};
                            $scope.noteMoy.note = $scope.noteFinaleObject.noteFinale;
                            $scope.noteMoy.id_matiere = $scope.$parent.matiere.id_matiere;
                            $scope.noteMoy.annee_scolaire = $scope.$parent.annee;
                            $scope.noteMoy.semestre = $scope.$parent.semestre;
                            $scope.noteMoy.typemoy = 65;
                            $scope.noteMoy.numero_eleve = $stateParams.id;

                            $http.post(gOptions.serveur + '/rest/NoteManager.php/addNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {

                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });

                        }
                        else {

                            $scope.noteMoy = $scope.noteMoys[0];
                            $scope.noteMoy.id_notemoy = $scope.noteMoys[0].id_notemoy;
                            $scope.noteMoy.note = $scope.noteFinaleObject.noteFinale;
                            $http.post(gOptions.serveur + '/rest/NoteManager.php/modNoteMoy', $scope.noteMoy).
                                    success(function (data)
                                    {
                                        console.log("modnotemoy");
                                    }).
                                    error(function (result)
                                    {
                                        console.log("error");
                                    });
                        }

                        $http.get(gOptions.serveur + '/rest/NoteManager.php/getRangMoy?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&typeMoy=' + 65 + '&annee_scolaire='
                                + $scope.$parent.annee + '&semestre=' + $scope.$parent.semestre).
                                success(function (data)
                                {
                                    $scope.noteFinaleObject.rang = data.data[0].rang;

                                }).
                                error(function (result)
                                {
                                    console.log("error");
                                });
                    },
                    function (errorPayload) {
                        $log.error('failure loading movie', errorPayload);
                    });
        }
    }


    $scope.annulerNote = function ()
    {
        if ($scope.note.id_note == null)
            $scope.showAjoutNote = !$scope.showAjoutNote;

        if ($scope.note.id_note != null)
        {
            $scope.showModNote = !$scope.showModNote;
        }
        $scope.note = {};
    }


    $scope.dismiss = function () {
        $scope.note = {};
    }
}


notesPresences.factory('getNoteMoyByEleveService', function ($http) {
    return {
        getNoteMoyByEleve: function (numero_eleve, matiere, typeMoy, annee, semestre) {
            return $http.get(gOptions.serveur + '/rest/NoteManager.php/getNoteMoyByEleve?numero_eleve=' + numero_eleve + '&matiere=' + matiere + '&typeMoy=' + typeMoy + '&annee_scolaire=' + annee + '&semestre=' + semestre);
        }
    }
});



notesPresences.factory('getExamenByNote', function ($http) {
    return {
        getExamenNote: function (idnote) {
            return $http.get(gOptions.serveur + '/rest/NoteManager.php/GetIdExamenByNote/' + idnote);
        }
    }
});


//start PresenceController


notesPresences.controller('PresenceController', PresenceController, ['$scope']);
function PresenceController($resource, $http, $scope, $location, $stateParams, getAnneeEncours)
{
    $scope.presences = [];
    $scope.presence = {};
    
    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {
                loadPresences();
                loadToolBars();
            });
            

    function loadToolBars()
    {
        // activate the tooltips
        $("[data-original-title]").tooltip({
            placement: "bottom",
            html: true
        });


    }
    
    function loadPresences()
    {

        $scope.presence = {};
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1 && 
            $stateParams.annee!= undefined && $stateParams.annee != '' && $stateParams.annee!= -1)
        {
            $scope.annee =  $stateParams.annee;
            $http.get(gOptions.serveur + '/rest/NoteManager.php/getPresencesEleveByMatiere?numero_eleve=' + $stateParams.id + '&matiere=' +
                    $scope.$parent.matiere.id_matiere
                    + '&annee_scolaire=' + $scope.annee + '&semestre=' + $scope.$parent.semestre).
                    success(
                            function (data)
                            {
                                //load Notes and calcul
                                $scope.presences = data.data;
                                for (var i = 0; i < $scope.presences.length; i++) {
                                    if ($scope.presences[i].type === "PRST")
                                        $scope.presences[i].classe = "alert-success";
                                    if ($scope.presences[i].type === "ABJ")
                                        $scope.presences[i].classe = "alert-info";
                                    if ($scope.presences[i].type === "ABINJ")
                                        $scope.presences[i].classe = "alert-danger";
                                    if ($scope.presences[i].type === "RETARD")
                                        $scope.presences[i].classe = "alert-danger";
                                    if ($scope.presences[i].type === "RENVOI")
                                        $scope.presences[i].classe = "alert-danger";
                                }

                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }

    $scope.showAjoutPresence = false;
    $scope.popupAddPresence = function () {
        $scope.presence = {};
        $scope.presence.matiere = $scope.$parent.matiere.nom;
        $scope.showAjoutPresence = !$scope.showAjoutPresence;
    }

    $scope.showModPresence = false;
    $scope.popupModPresence = function (idPresence) {
        $scope.showModPresence = !$scope.showModPresence;
        if ($stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {

            $http.get(gOptions.serveur + '/rest/NoteManager.php/getPresencesByPresence?numero_eleve=' + $stateParams.id + '&matiere=' + $scope.$parent.matiere.id_matiere + '&presence=' + idPresence +
                    '&annee_scolaire=' + $scope.annee + '&semestre=' + $scope.$parent.semestre).
                    success(
                            function (data)
                            {
                                $scope.presence = data.data[0];
                                $scope.presence.matiere = $scope.$parent.matiere.nom;
                            }
                    ).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
    }


    $scope.addModPresence = function () {

        if ($scope.presence.id_presence == null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1)
        {
            $scope.presence.numero_eleve = $stateParams.id;
            $scope.presence.id_matiere = $scope.$parent.matiere.id_matiere;
            $scope.presence.semestre = $scope.$parent.semestre;
            $scope.presence.annee_scolaire = $scope.annee;
            //Ajout Presence
            $http.post(gOptions.serveur + '/rest/NoteManager.php/addPresence', $scope.presence).
                    success(function (data)
                    {
                        $scope.showAjoutPresence = !$scope.showAjoutPresence;
                        loadPresences();
                        loadToolBars();
                
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.presence.id_presence != null && $stateParams.id != undefined && $stateParams.id != '' && $stateParams.id != -1) {

            //Modification Presence
            $http.post(gOptions.serveur + '/rest/NoteManager.php/modPresence', $scope.presence).
                    success(function (data)
                    {
                        $scope.showModPresence = !$scope.showModPresence;
                        loadPresences();
                        loadToolBars();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }

    }

    $scope.annulerPresence = function ()
    {
        if ($scope.presence.id_presence == null)
            $scope.showAjoutPresence = !$scope.showAjoutPresence;
        if ($scope.presence.id_presence != null)
        {
            $scope.showModPresence = !$scope.showModPresence;
        }
        $scope.presence = {};
    }


    $scope.dismiss = function () {
        $scope.presence = {};
    }


    $scope.showSupprPresence = false;
    $scope.popupSupprPresence = function (presenceId) {
        idPresenceASuppr = presenceId;
        $scope.showSupprPresence = !$scope.showSupprPresence;
    }


    $scope.confirmSupprPresence = function () {
        $http.get(gOptions.serveur + '/rest/NoteManager.php/DeletePresence/' + idPresenceASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprPresence = !$scope.showSupprPresence;
                            loadPresences();
                            loadToolBars();
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.annulerSupprPresence = function ()
    {
        $scope.showSupprPresence = !$scope.showSupprPresence;
        $scope.presence = {};
    }

}



notesPresences.controller('BulletindeNotesCtrl', BulletindeNotesCtrl, ['$scope']);
function BulletindeNotesCtrl($http, $scope, $location, $stateParams)
{

    $scope.anneesscolaire = [];

    $http.get(gOptions.serveur + '/rest/NoteManager.php/getAnneesScolaire/' + $stateParams.id).
            success(
                    function (data)
                    {
                        $scope.anneesscolaire = data.data;
                        loadBulletinsNotes();
                    }
            ).
            error(function (result)
            {
                console.log("error");
            });

    $scope.exportBulletinNotes = function (semestre, annee_scolaire) {

        window.open(gOptions.serveur + '/pdf/note.php?numero_eleve=' + $stateParams.id + '&semestre=' + semestre + '&annee_scolaire=' + annee_scolaire, '_blank');

    }

    function loadBulletinsNotes()
    {
        var sampleData = initiateDemoData();//see below



        $('#tree').ace_tree({
            dataSource: sampleData['dataSource'],
            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
            'open-icon': 'ace-icon fa fa-folder-open',
            'close-icon': 'ace-icon fa fa-folder',
            'selectable': false,
            multiSelect: false,
            'selected-icon': null,
            'unselected-icon': null
        });
    }


    /**
     //please refer to docs for more info
     $('#tree1')
     .on('loaded.fu.tree', function(e) {
     })
     .on('updated.fu.tree', function(e, result) {
     })
     .on('selected.fu.tree', function(e) {
     })
     .on('deselected.fu.tree', function(e) {
     })
     .on('opened.fu.tree', function(e) {
     })
     .on('closed.fu.tree', function(e) {
     });
     */

    function initiateDemoData() {

        var tree_data = {};
        for (var i = 0; i < $scope.anneesscolaire.length; i++)
        {
            var item = {text: $scope.anneesscolaire[i].annee_scolaire, type: 'folder', 'icon-class': 'green'};

            tree_data[$scope.anneesscolaire[i].annee_scolaire] = item;
            tree_data[$scope.anneesscolaire[i].annee_scolaire]['additionalParameters'] = {
                'children': [
                    {text: '<a href="' + gOptions.serveur + '/pdf/note.php?numero_eleve=' + $stateParams.id + '&semestre=' + 1 + '&annee_scolaire=' + $scope.anneesscolaire[i].annee_scolaire + '" target ="_blank" style="text-decoration :none"><i class="ace-icon fa fa-file-text red" ></i> semestre1.pdf</a>', type: 'item'},
                    {text: '<a href="' + gOptions.serveur + '/pdf/note.php?numero_eleve=' + $stateParams.id + '&semestre=' + 2 + '&annee_scolaire=' + $scope.anneesscolaire[i].annee_scolaire + '" target ="_blank" style="text-decoration :none"><i class="ace-icon fa fa-file-text red" ></i> semestre2.pdf</a>', type: 'item'},
                ]
            }
        }



        var dataSource = function (options, callback) {
            var $data = null
            if (!("text" in options) && !("type" in options)) {
                $data = tree_data;//the root tree
                callback({data: $data});
                return;
            }
            else if ("type" in options && options.type == "folder") {
                if ("additionalParameters" in options && "children" in options.additionalParameters)
                    $data = options.additionalParameters.children || {};
                else
                    $data = {}//no data
            }

            if ($data != null)//this setTimeout is only for mimicking some random delay
                setTimeout(function () {
                    callback({data: $data});
                }, parseInt(Math.random() * 500) + 200);

            //we have used static data here
            //but you can retrieve your data dynamically from a server using ajax call
            //checkout examples/treeview.html and examples/treeview.js for more info
        }


        return {'dataSource': dataSource}
    }
}



notesPresences.controller('DevsAllCtrl', DevsAllCtrl, ['$scope']);
function DevsAllCtrl($resource, $http, $scope, $location, $stateParams, getAnneeEncours, growl, $state, Auth)
{

    $scope.user = Auth.user;
    $scope.devs = [];
    $scope.dev = {};
    $scope.classe = $scope.$parent.eleve.id_classe;

    var promise =
            getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.annee = payload.data.data[0].annee_en_cours;
                loadDevs();
            });
    $scope.showAjoutDev = false;
    $scope.showModDev = false;

    $scope.popupModDev = function (idDev) {
        $scope.showModDev = !$scope.showModDev;
        $http.get(gOptions.serveur + '/rest/DevManager.php/getDevByDevClasse?id_classe=' + $scope.$parent.eleve.id_classe + '&matiere=' + $scope.$parent.matiere.id_matiere + '&dev=' + idDev + '&annee_scolaire=' + $scope.annee).
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

    $scope.popupAddDev = function () {
        $scope.dev = {};
        $scope.dev.matiere = $scope.$parent.matiere.nom;
        $scope.showAjoutDev = !$scope.showAjoutDev;
    }

    $scope.showSupprDev = false;
    $scope.popupSupprDev = function (devId) {
        idDevASuppr = devId;
        $scope.showSupprDev = !$scope.showSupprDev;
    }

    $scope.confirmSupprDev = function () {


        $http.get(gOptions.serveur + '/rest/DevManager.php/DeleteDev/' + idDevASuppr).
                success(
                        function (data)
                        {
                            $scope.showSupprDev = !$scope.showSupprDev;
                            loadDevs();
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });

    }

    $scope.addModDev = function () {

        if ($scope.dev.id_devoir == null)
        {
            $scope.dev.annee_scolaire = $scope.annee;
            $scope.dev.id_classe = $scope.$parent.eleve.id_classe;
            $scope.dev.id_matiere = $scope.$parent.matiere.id_matiere;
            $scope.dev.numero_eleves = [];
            for (var i = 0; i < $scope.$parent.eleves.length; i++)
            {

                $scope.dev.numero_eleves.push({'numero_eleve': $scope.$parent.eleves[i].numero_eleve});
            }
            //Ajout Devoir
            $http.post(gOptions.serveur + '/rest/DevManager.php/addAllDev', $scope.dev).
                    success(function (data)
                    {
                        $scope.showAjoutDev = !$scope.showAjoutDev;
                        loadDevs();
                    }).
                    error(function (result)
                    {
                        console.log("error");
                    });
        }
        else if ($scope.dev.id_devoir != null) {

            //Modification Devoir
            $http.post(gOptions.serveur + '/rest/DevManager.php/modDev', $scope.dev).
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
    }

    $scope.annulerSupprDev = function ()
    {
        $scope.showSupprDev = !$scope.showSupprDev;
        $scope.dev = {};
    }



    function loadDevs()
    {
        $scope.dev = {};
        $http.get(gOptions.serveur + '/rest/DevManager.php/getDevsClasseByMatiere?id_classe=' + $scope.$parent.eleve.id_classe + '&matiere=' + $scope.$parent.matiere.id_matiere + '&annee_scolaire=' + $scope.annee).
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

    $scope.annulerDev = function ()
    {
        if ($scope.dev.id_devoir == null)
            $scope.showAjoutDev = !$scope.showAjoutDev;

        if ($scope.dev.id_devoir != null)
        {
            $scope.showModDev = !$scope.showModDev;
        }

        $scope.dev = {};
    };


    $scope.dismiss = function () {
        $scope.dev = {};
    };
}


//start NoteController
notesPresences.controller('FacturesAllCtrl', FacturesAllCtrl, ['$scope']);
function FacturesAllCtrl($resource, $http, $scope, $location, $stateParams, getAnneeEncours, growl, $state)
{
    $scope.eleves = [];
    $scope.matieres = [];
    $scope.eleve = {};
    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });


    $scope.exportAllFactures = function (month, monthLibelle) {
        window.open(gOptions.serveur + '/pdf/factures.php?idclasse=' + $scope.eleve.id_classe + '&month=' + month + '&monthLibelle=' + monthLibelle + '&annee_scolaire=' + $scope.anneeEnCours, '_blank');


    }

    $scope.changeClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.eleves = data.data;
                            if ($scope.eleves.length != 0)
                                $scope.step = $scope.eleves[0].numero_eleve;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }


 $scope.Updatepaye = function (fac) {
        idFactureAUpdate = fac;
        
         $http.get(gOptions.serveur + '/rest/FactureManager.php/Updatepayement/' + idFactureAUpdate).
                success(
                        function (data)
                        {

                            console.log("ok");
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }



    $scope.changeDevClasse = function ()
    {
        $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.eleve.id_classe).
                success(
                        function (data)
                        {

                            $scope.matieres = data.data;
                            $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
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
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }

    $scope.showAjoutAllFacture = false;

    $scope.popupAjoutAllFacture = function () {
        $scope.showAjoutAllFacture = !$scope.showAjoutAllFacture;

    }

    $scope.facture = {};
    $scope.ajoutAllFacture = function ()
    {

        $scope.facture.numero_eleves = [];
        $scope.facture.anneeScolaire = $scope.anneeEnCours;
        for (var i = 0; i < $scope.eleves.length; i++)
        {

            $scope.facture.numero_eleves.push({'numero_eleve': $scope.eleves[i].numero_eleve});
        }
        $http.post(gOptions.serveur + '/rest/FactureManager.php/AddAllFacture', $scope.facture).
                success(
                        function (data)
                        {
                            growl.success("Facture ajoutée avec success", {ttl: 2000});
                            $scope.showAjoutAllFacture = !$scope.showAjoutAllFacture;
                              $scope.facture = {};
                            $http.get(gOptions.serveur + '/rest/DispenseManager.php/getMatieresByCodeClasse/' + $scope.eleve.id_classe).
                success(
                        function (data)
                        {

                            $scope.matieres = data.data;
                            $http.get(gOptions.serveur + '/rest/EleveManager.php/getElevesByCodeClasse?id_classe=' + $scope.eleve.id_classe + '&annee_scolaire=' + $scope.anneeEnCours).
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
                ).
                error(function (result)
                {
                    console.log("error");
                });

                        }
                ).
                error(function (result)
                {
                });
    }

    $scope.annulerAllFacture = function () {
        $scope.showAjoutAllFacture = !$scope.showAjoutAllFacture;
        $scope.facture = {};
    }

    $scope.dismiss = function () {
        $scope.facture = {};
    }
$scope.changeMontant = function () {

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
}

notesPresences.controller('FactureEleveAllCtrl', FactureEleveAllCtrl, ['$scope']);
function FactureEleveAllCtrl($resource, $http, $scope, $location, Auth, getAnneeEncours)
{
    $scope.factures = [];
    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + $scope.$parent.eleve.numero_eleve + '&annee_scolaire=' + $scope.anneeEnCours).
                        success(
                                function (data)
                                {

                                    $scope.factures = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });



    $scope.refreshFactures = function ()
    {
        $http.get(gOptions.serveur + '/rest/FactureManager.php/ListFacturesEleves?numero=' + $scope.$parent.eleve.numero_eleve + '&annee_scolaire=' + $scope.anneeEnCours).
                success(
                        function (data)
                        {

                            $scope.factures = data.data;
                        }
                ).
                error(function (result)
                {
                    console.log("error");
                });
    }
}
;
notesPresences.controller('RecuEleveAllCtrl', RecuEleveAllCtrl, ['$scope']);
function RecuEleveAllCtrl($resource, $http, $scope, $location, getAnneeEncours)
{
    var id = -1;


    $scope.recues = [];
    $scope.factureChosen = [];
    $scope.factures = [];
    var promise = getAnneeEncours.getAnnee();
    promise.then(
            function (payload) {

                $scope.anneeEnCours = payload.data.data[0].annee_en_cours;
                $http.get(gOptions.serveur + '/rest/RecuManager.php/ListRecuEleves?numero=' + $scope.$parent.eleve.numero_eleve + '&annee_scolaire=' + $scope.anneeEnCours).
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

                $http.get(gOptions.serveur + '/rest/FactureManager.php/GetFactureByNumEleve/' + $scope.$parent.eleve.numero_eleve).
                        success(
                                function (data)
                                {

                                    $scope.factures = data.data;
                                }
                        ).
                        error(function (result)
                        {
                            console.log("error");
                        });
            });



}
;









	