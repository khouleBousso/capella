<!-- /section:basics/content.breadcrumbs -->
<div class="page-content" ng-controller="RecuCtrl">

    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div id="rootwizard" class="tabbable tabs-left" >
                <ul class="nav nav-tabs nav-stacked">
                    <li  ng-repeat="anneeSco in anneesscolaire" ng-class="{ 'active': anneeSco.annee_scolaire == annee} "><a href="#"  data-toggle="tab" aria-expanded="false"
                                      ng-click="ouvrirTab(anneeSco.annee_scolaire)" >{{anneeSco.annee_scolaire}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane " id="tabrecu1"  ng-class="{ 'active': tabped1 == 'tabrecu1'}">
                        <!-- 			#section:custom/widget-box -->
                        <div class="clearfix">
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap">
                                    <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-href="http://capella-csikm.com/pdf/liste_recus.php?numEleve={{numero_eleve}}&annee_scolaire={{annee}}">
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
                        </div>
                        <div class="widget-box ui-sortable-handle">
                            <div class="widget-header"
                                 style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                                <h5 class="widget-title">Génération du re&ccedil;u</h5>
                                <!-- 	/section:custom/widget-box.toolbar sdds -->
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="gbox_grid-table"
                                         class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
                                        <table datatable="ng"
                                               class="table table-striped table-bordered table-hover row-border hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>№ facture</th>
                                                    <th>Opération</th>
                                                    <th>Libelle</th>
                                                    <th>Versement</th>
													<th>Genre</th>
                                                    <th>Date</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="recue in recues" >
                                                    <td title="" style="" role="gridcell">
                                                        <div style="margin-left: 8px;">
                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Modifier recu "
                                                                 ng-click="popupModifierRecu(recue.id_recu)">
                                                                <a href="" ng-if="user.id_profil == 1 || user.id_profil == 6 ">
                                                                    <span class="ui-icon ui-icon-pencil"></span></a>

                                                            </div>

                                                            <!-- 												Bouton archiver agent et ouverture du popup 

                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Supprimer facture">
                                                                <a ng-click="popupSupprRecu(recue.id_recu)" ng-if="user.id_profil != 2">
                                                                    <span class="ui-icon ui-icon-trash"></span></a>

                                                            </div>-->

                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Uploader la facture">
                                                                <a ng-href="http://capella-csikm.com/pdf/recu.php?numRecu={{recue.id_recu}}&annee_scolaire={{annee}}" target="_blank">
                                                                    <span><i class="fa fa-file-pdf-o bigger-115 grey"; style="margin-top:5px; margin-left:3px; "></i></span></a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{recue.code}}</td>
                                                    <td>{{recue.operation}}</td>
                                                    <td>{{recue.libelle}}</td>
                                                    <td>{{recue.versement}}</td>
													<td>{{recue.genre}}</td>
                                                    <td>{{recue.date_recu}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellspacing="0" cellpadding="0" border="0"
                                               style="float: left; table-layout: auto;"
                                               class="ui-pg-table navtable">
                                            <tbody>
                                                <tr>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Ajouter"><div
                                                            class="ui-pg-div">
                                                            <a ng-click="popupAjoutRecu()" style="cursor: pointer" ng-if="user.id_profil == 1 || user.id_profil == 6">
                                                                <span class="ui-icon ace-icon fa fa-plus-circle purple"></span></a>
                                                            <modal title="Ajout Recu" visible="showAjoutRecu">
                                                                <div
                                                                    ng-include="gOptions.appname + 'views/eleve/ajout-mod-recu.php'"></div> 
                                                            </modal>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <modal title="Suppression Recu" visible="showSupprRecu">
                                            <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                                                <br/>
                                                Voulez-vous vraiment supprimer ce Re&ccedil;u ?
                                                <br/>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="reset" class="btn" ng-click="AnnulerSupprRecu()">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Annuler
                                                </button>

                                                &nbsp; &nbsp; &nbsp;

                                                <button type="button" class="btn btn-info" ng-click="confirmSupprRecu()">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Confirmer
                                                </button>
                                            </div>

                                        </modal>
                                        <modal title="Modifier Recu" visible="showModRecu">
                                            <div
                                                ng-include="gOptions.appname + 'views/eleve/ajout-mod-recu.php'"></div> 
                                        </modal>
                                        <div>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	</div></div>
        <!-- /section:custom/widget-box
        PAGE CONTENT ENDS -->
    </div>
    <!-- 		/.col -->
</div>
<!-- /.row -->
</div>
