<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a></li>
    </ul>
    <!-- /.breadcrumb -->

    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
        <form class="form-search">
            <span class="input-icon"> <input type="text"
                                             placeholder="Rechercher ..." class="nav-search-input"
                                             id="nav-search-input" autocomplete="off" /> <i
                                             class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        </form>
    </div>
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>

<div class="page-content" ng-controller="EdtCtrl">
    <!-- #section:settings.box -->

    <!-- /section:settings.box --><br/><br/>
    <div class="row">
        <div class="col-xs-12">
      <div class="alert alert-block alert-success"  ng-hide="edt.id_classe == null" ng-if="user.id_profil != 2 && user.id_profil != 4 && user.id_profil != 5 && user.id_profil != 6">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                Veuillez valider vos modifications effectu&eacute;es en cliquant sur le bouton Valider ci-dessous.
            </div>
    </div>
  </div>  
    <div class="row">
        <div class="col-sm-5" ng-controller="ListClasseCtrl">
            <select chosen id="classe"  ng-model="edt.id_classe" ng-change="changeClasse()" data-placeholder="Choisir une Classe... "
                    ng-options="clas.id_classe as clas.nom for clas in classes"> <option value=""></option>
            </select> 
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-1">


            <button class="btn btn-success btn-xs" ng-click="addModEdt()"  ng-hide="edt.id_classe ==null" ng-if="user.id_profil !=2 && user.id_profil !=4 && user.id_profil != 5 && && user.id_profil != 6" >
                <i class="ace-icon fa fa-check  bigger-110 icon-only"></i> Valider
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-sm-9">
                    <div class="space"></div>

                    <!-- #section:plugins/data-time.calendar -->
                    <div id="calendar"></div>

                    <!-- /section:plugins/data-time.calendar -->
                </div>

                <div class="col-sm-3" ng-hide="edt.id_classe ==null" ng-if="user.id_profil !=2 && user.id_profil !=4 && user.id_profil != 5 && && user.id_profil != 6">
                    <div class="widget-box transparent">
                        <div class="widget-header">
                            <h4>Mati&egrave;res dispens&eacute;es</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <div id="external-events">
                                    <div data-class="label-yellow" class="external-event label-yellow ui-draggable ui-draggable-handle" style="position: relative;" ng-repeat="matiere in matieres">
                                        <i class="ace-icon fa fa-arrows"></i>
                                        {{matiere.nom}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        
<!--        <modal title="Question" visible="showModifEdt">
                    <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                        <br/>
                        Le calendrier a &eacute;t&eacute; modifi&eacute;. Voulez-vous enregistrer les modifications effectu&eacute;es ?
                        <br/>
                    </div>

                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-info" ng-click="confirmModifEdt()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Confirmer
                        </button>
                      
                        &nbsp; &nbsp; &nbsp;
  
                        <button type="reset" class="btn"  ng-click="annulerModifEdt()">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Annuler
                        </button>

                    </div>

                </modal>-->
    </div><!-- /.page-content -->
