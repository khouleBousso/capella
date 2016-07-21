
<div ng-controller="MatiereEleveCtrl">
    <div class="row" >
        <div class="col-md-9" >
        </div>
        <div class="col-md-3">
            <select class=" col-xs-12" id="form-field-select-3"  ng-model="semestre" ng-change="changeSemestre()">
                <option value="1" ng-selected="true">Semestre 1</option>
                <option value="2">Semestre 2</option>
            </select> 
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" ng-repeat="matiere in matieres">
            <!-- #section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle"  ng-controller="PresenceController">
                <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">{{matiere.nom}}</h5>

                    <div class="widget-toolbar">
                        <a ng-click="popupAddPresence()" href="#" ng-if="user.id_profil  == 1">
                            <span class="ace-icon fa fa-plus-circle purple"></span></a>


                        <a data-action="collapse" href="#">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>


                    </div>


                    <!-- /section:custom/widget-box.toolbar -->
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="presences">
                            <div data-original-title="Motif : {{presence.motif_renvoi}}" 
                                 ng-class="'presence alert '+presence.classe"  ng-repeat="presence in presences" >
                                <div class="libellePresence">{{presence.type}}</div>
                                <p>
                                    <i class="fa fa-edit  bigger-130" ng-click="popupModPresence(presence.id_presence)" ng-if="user.id_profil  == 1" style="cursor: pointer"></i>
                                    <i class="fa fa-trash bigger-130"  ng-click="popupSupprPresence(presence.id_presence)"  ng-if="user.id_profil  == 1" style="cursor: pointer"></i>
                                </p>
                                <p>
                                     <div class="libellePresence">{{presence.date}}</div>
                                 </p>
                            </div>
                          
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <modal title="Ajout Pr&eacute;sence" visible="showAjoutPresence">
                    <div
                        ng-include="gOptions.appname + 'views/presence/ajout-mod-presence.php'"></div> 
                </modal>

                <modal title="Modification Pr&eacute;sence" visible="showModPresence">
                    <div
                        ng-include="gOptions.appname + 'views/presence/ajout-mod-presence.php'"></div> 
                </modal>
                <modal title="Suppression Pr&eacute;sence" visible="showSupprPresence">
                    <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                        <br/>
                        Voulez-vous vraiment supprimer cette pr&eacute;sence ou absence ?
                        <br/>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn" ng-click="annulerSupprPresence()">
                            <i class="ace-icon fa fa-undo bigger-110" ></i>
                            Annuler
                        </button>

                        &nbsp; &nbsp; &nbsp;

                        <button type="button" class="btn btn-info" ng-click="confirmSupprPresence()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Confirmer
                        </button>
                    </div>

                </modal>
            </div>

            <!-- /section:custom/widget-box -->
        </div>

    </div>

</div>
