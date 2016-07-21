<!-- /section:basics/content.breadcrumbs -->
<div class="page-content" ng-controller="FactureCtrl">

    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div id="rootwizard" class="tabbable tabs-left" >
                <ul class="nav nav-tabs nav-stacked">
                    <li  ng-repeat="anneeSco in anneesscolaire" ng-class="{ 'active': anneeSco.annee_scolaire == annee} "><a href="#"  data-toggle="tab" aria-expanded="false"
                                                                                                                             ng-click="ouvrirTab(anneeSco.annee_scolaire)" >{{anneeSco.annee_scolaire}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" >
                        <!-- 			#section:custom/widget-box -->
                        <div class="clearfix">
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap">
                                    <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-href="http://capella-csikm.com/pdf/liste_facture.php?numEleve={{numero_eleve}}&annee_scolaire={{annee}}">
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
                        </div>

                        <div class="widget-box ui-sortable-handle">
                            <div class="widget-header"
                                 style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                                <h5 class="widget-title">Génération de la facture</h5>
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
                                                    <th>Montant</th>
                                                    <th>Date</th>
                                                    <th>Solde</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="facture in factures" >
                                                    <td title="" style="" role="gridcell">
                                                        <div style="margin-left: 8px;">
                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Modifier facture "
                                                                 ng-click="popupModifierFacture(facture.numero_facture)">
                                                                <a href="" ng-if="user.id_profil == 1 || user.id_profil == 6 ">
                                                                    <span class="ui-icon ui-icon-pencil"></span></a>

                                                            </div>

                                                            <!-- 												Bouton archiver agent et ouverture du popup 

                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Supprimer facture">
                                                                <a ng-click="popupSupprFacture(facture.numero_facture)" ng-if="user.id_profil != 2">
                                                                    <span class="ui-icon ui-icon-trash"></span></a>

                                                            </div>-->

                                                            <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                 onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                 class="ui-pg-div ui-inline-edit"
                                                                 style="float: left; cursor: pointer;"
                                                                 title="Uploader la facture">
                                                                <a ng-href="http://capella-csikm.com/pdf/facture.php?numFacture={{facture.numero_facture}}&annee_scolaire={{annee}}" target="_blank">
                                                                    <span><i class="fa fa-file-pdf-o bigger-115 grey" style="margin-top:5px; margin-left:3px; "></i></span></a>

                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>{{facture.code}}</td>
                                                    <td>{{facture.libelle}}</td>
                                                    <td>{{facture.description}}</td>
                                                    <td>{{facture.montant}}</td>
                                                    <td>{{facture.datee}}</td>
                                                    <td>{{facture.solde}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table cellspacing="0" cellpadding="0" border="0"
                                               style="float: left; table-layout: auto;"
                                               class="ui-pg-table navtable">
                                            <tbody>
                                                <tr>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Add new row"><div
                                                            class="ui-pg-div">
                                                            <a ng-click="popupAjoutFacture()" style="cursor: pointer" ng-if="user.id_profil == 1 || user.id_profil == 6">
                                                                <span class="ui-icon ace-icon fa fa-plus-circle purple"></span></a>
                                                            <modal title="Ajout Facture" visible="showAjoutFacture">
                                                                <div
                                                                    ng-include="gOptions.appname + 'views/eleve/ajout-mod-facture.php'"></div> 
                                                            </modal>
                                                        </div>
                                                    </td>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Actualiser"><div
                                                            class="ui-pg-div">
                                                            <a ng-click="refreshFactures()" style="cursor: pointer">
                                                                <span class="ui-icon ace-icon fa fa-refresh green"></span></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div ng-show="factures.length != 0" style="text-align:center">
                                            <strong ng-class="{ 'alert-danger': totalsolde < 0 , 'alert-success': totalsolde >= 0  }" style="font-size:18px;">Solde : &nbsp;&nbsp;&nbsp;{{totalsolde| number : fractionSize}} FCFA</strong>
                                        </div>
                                        <modal title="Suppression Facture" visible="showSupprFacture">
                                            <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                                                <br/>
                                                Voulez-vous vraiment supprimer cette Facture ?
                                                <br/>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="reset" class="btn" ng-click="AnnulerSupprFacture()">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Annuler
                                                </button>

                                                &nbsp; &nbsp; &nbsp;

                                                <button type="button" class="btn btn-info" ng-click="confirmSupprFacture()">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Confirmer
                                                </button>
                                            </div>

                                        </modal>
                                        <modal title="Modifier Facture" visible="showModFacture">
                                            <div
                                                ng-include="gOptions.appname + 'views/eleve/ajout-mod-facture.php'"></div> 
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

