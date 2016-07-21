
<div ng-controller="MatiereEleveCtrl">


    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div id="rootwizard" class="tabbable tabs-left" >
                <ul class="nav nav-tabs nav-stacked">
                    <li  ng-repeat="anneeSco in anneesscolaire" ng-class="{ 'active': anneeSco.annee_scolaire == anneeScolaire} "><a href="#"  data-toggle="tab" aria-expanded="false"
                                                              ng-click="ouvrirTab(anneeSco.annee_scolaire)" >{{anneeSco.annee_scolaire}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active">
                        <div class="clearfix">
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap">
                                    <a class="btn btn-white btn-primary  btn-bold" id="pdf" title="Bulletin de Notes" target="_blank" ng-click="exportBulletinNotes()">
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div  style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
                        </div>

                        <div class="row" >
                            <div class="col-md-9" >


                                <p>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <select class=" col-xs-12" id="form-field-select-3"  ng-model="semestre" ng-change="changeSemestre()">
                                    <option value="1" ng-selected="true">Semestre 1</option>
                                    <option value="2">Semestre 2</option>
                                </select> 
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6" ng-repeat="matiere in matieres">

                            <!-- #section:custom/widget-box -->
                            <div class="widget-box" ng-controller="NoteController">
                                <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">{{matiere.nom}}</h5>
                                    <div class="widget-toolbar">
                                        <a ng-click="popupAddNote()" href="#" ng-if="user.id_profil == 1">
                                            <span class="ace-icon fa fa-plus-circle purple" ></span></a>

                                        <a data-action="collapse" href="#">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>


                                    </div>


                                    <!-- /section:custom/widget-box.toolbar -->
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div id="notesEleve">
                                            <div id="notesFinale" ng-show="noteFinaleObject.noteFinale != - 1" >
                                                <div data-original-title="Rang: {{noteFinaleObject.rang}}"  ng-class="'noteFinale alert ' + noteFinaleObject.classe">
                                                    <div ><span class="libellePresence">Note Finale : </span> {{noteFinaleObject.noteFinale| number :2}}/20</div>

                                                </div>
                                            </div>

                                            <div id="notesCCComp">
                                                <div id="notesCCMoy">
                                                    <div id="moyCC"  ng-show="noteMoyCCObject.noteMoyCC != - 1">
                                                        <div  ng-class="'noteMoyCC alert ' + noteMoyCCObject.classe">
                                                            <div ><span class="libellePresence">Moy CC : </span> {{noteMoyCCObject.noteMoyCC| number :2}}/20</div>

                                                        </div>
                                                    </div>
                                                    <div id="notesCC" ng-show="notesCC.length != 0" ng-repeat="noteCC in notesCC">
                                                        <div data-original-title="Date de dernière modification : {{noteCC.date_modification}}Par : {{noteCC.user}}"  ng-class="'noteCC alert ' + noteCC.classe" >
                                                            <div class="libellePresence">{{noteCC.libelle}}</div>
                                                            <div class="libellePresence">{{noteCC.note}}/20</div>
                                                            <p>
                                                                <i class="fa fa-edit  bigger-130" ng-click="popupModNote(noteCC.id_note)" ng-if="user.id_profil == 1" style="cursor: pointer"></i>
                                                                <i class="fa fa-trash bigger-130"  ng-click="popupSupprNote(noteCC.id_note)"  ng-if="user.id_profil == 1" style="cursor: pointer"></i>
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div id="notesComp" ng-if="noteCompObject.noteComp != - 1" >
                                                    <div data-original-title="Date de dernière modification : {{noteCompObject.date_modification}} Par : {{noteCompObject.user}}"
                                                         ng-class="'noteComp alert ' + noteCompObject.classe"> 
                                                        <div class="libellePresence">{{noteCompObject.libelle}}</div>
                                                        <div class="libellePresence">{{noteCompObject.noteComp}}/20</div>
                                                        <p>
                                                            <i class="fa fa-edit  bigger-130" ng-click="popupModNote(noteCompObject.id_note)"   ng-if="user.id_profil == 1" style="cursor: pointer"></i>
                                                            <i class="fa fa-trash bigger-130" ng-click="popupSupprNote(noteCompObject.id_note)"  ng-if=" user.id_profil == 1" style="cursor: pointer"></i>
                                                        </p>
                                                    </div>

                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <modal title="Ajout Note" visible="showAjoutNote">
                                    <div
                                        ng-include="gOptions.appname + 'views/note/ajout-mod-note.php'"></div> 
                                </modal>

                                <modal title="Modification Note" visible="showModNote">
                                    <div
                                        ng-include="gOptions.appname + 'views/note/ajout-mod-note.php'"></div> 
                                </modal>
                                <modal title="Suppression Note" visible="showSupprNote">
                                    <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                                        <br/>
                                        Vous êtes sur le point de SUPPRIMER une note ! Voulez-vous vraiment supprimer cette note ?
                                        <br/>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" class="btn"  ng-click="annulerSupprNote()">
                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                            Annuler
                                        </button>

                                        &nbsp; &nbsp; &nbsp;

                                        <button type="button" class="btn btn-info" ng-click="confirmSupprNote()">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Confirmer
                                        </button>
                                    </div>

                                </modal>
                            </div></div>

                        <!-- /section:custom/widget-box -->

                    </div>

                </div></div></div></div></div>