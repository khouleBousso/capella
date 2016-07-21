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
</div><br/>
<div class="page-content">

    <div class="row" ng-controller="MatiereCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES DISCIPLINES</h5>
                    <!-- 	/section:custom/widget-box.toolbar sdds -->
                </div>

                <div class="widget-body">
                    <div class="widget-main"><br/>
                        <div class="col-sm-5">
							 <select chosen id="matiere" ng-options="classe.id_classe as classe.nom for classe in classes" data-placeholder="Choisir une matiere... "ng-model="matiere.classe" ng-change="changeClasse()">
                                                            <option value=""></option>
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
                                        <th>Code de la mati&egrave;re</th>
                                        <th>Intitule</th>
                                        <th>Coefficient</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="matiere in matieres" >
                                        <td title="" style="" role="gridcell">
                                            <div style="margin-left: 8px;">
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Modifier matiere "
                                                     ng-click="popupModifierMatiere(matiere.id_matiere)">
                                                    <a href="">
                                                        <span class="ui-icon ui-icon-pencil"></span></a>

                                                </div>
                                                <!-- 												Bouton archiver agent et ouverture du popup -->

                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Supprimer matiere">
                                                    <a ng-click="popupSupprMatiere(matiere.id_matiere)">
                                                        <span class="ui-icon ui-icon-trash"></span></a>

                                                </div>

                                            </div>
                                        </td>
                                        <td>{{matiere.code_matiere}}</td>
                                        <td>{{matiere.nom}}</td>
                                        <td>{{matiere.coef}}</td>

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
                                                class="ui-pg-div"  >
                                                <a ng-click="popupAjoutMatiere()" style="cursor: pointer">
                                                    <span class="ui-icon ace-icon fa fa-plus-circle purple"   ng-show="id_classeExist.id != null"></span></a>
                                                <modal title="Ajout Discipline" visible="showAjoutMatiere">
                                                    <div
                                                        ng-include="gOptions.appname + 'views/matiere/ajout-mod-matiere.php'"></div> 
                                                </modal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <modal title="Suppression Discipline" visible="showSupprMatiere">
                                <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                                    <br/>
                                    Voulez-vous vraiment supprimer cette discipline ?
                                    <br/>
                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn" ng-click="AnnulerSupprMatiere()">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Annuler
                                    </button>

                                    &nbsp; &nbsp; &nbsp;

                                    <button type="button" class="btn btn-info" ng-click="confirmSupprMatiere()">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Confirmer
                                    </button>
                                </div>

                            </modal>
                            <modal title="Modifier Discipline" visible="showModMatiere">
                                <div
                                    ng-include="gOptions.appname + 'views/matiere/ajout-mod-matiere.php'"></div> 
                            </modal>
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

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {


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

    });
</script>