<div class="breadcrumbs" id="breadcrumbs" ng-controller="MesElevesCtrl">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ng-href="#">Accueil</a></li>
    </ul>
    <!-- /.breadcrumb -->

    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">

    <div class="row" ng-controller="MesElevesCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DE MES ELEVES</h5>
                    <!-- 	/section:custom/widget-box.toolbar sdds -->
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="col-sm-3">
                            <select  id="form-field-select-3" 
             ng-model="professeur.classe" ng-options="classe.nom  for classe in classes"
             ng-change="changeClasse()"
             >
            <option value="">-- choisir une de vos classes --</option>
    </select> 

                        
                        </div>
                        <br/><br/><br/>
                        <div id="gbox_grid-table"
                             class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
                            <table datatable="ng"
                                   class="table table-striped table-bordered table-hover row-border hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="eleve in meseleves" >
                                        <td title="" style="" role="gridcell">
                                            <div style="margin-left: 8px;">
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Fiche eleve">
                                                    <a ng-href="#/fiche-eleve/{{eleve.numero_eleve}}">
                                                        <span class="ui-icon ace-icon fa fa-search-plus grey"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{eleve.nom}}</td>
                                        <td>{{eleve.prenom}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /section:custom/widget-box
            PAGE CONTENT ENDS -->
        </div>
        <!-- 		/.col -->
    </div>
    <!-- /.row -->
</div>
