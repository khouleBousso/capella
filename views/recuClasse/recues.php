<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="recues">Recus par classe</a></li>
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
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row"  ng-controller="NotesAllCtrl">
                <div class="col-xs-12">
                      <div class="col-sm-6" ng-controller="ListClasseCtrl">
                <select chosen id="classe" data-placeholder="Choisir une Classe... " ng-model="eleve.id_classe" ng-change="changeClasse()" ng-options="clas.id_classe as clas.nom for clas in classes">
                <option value=""></option>
              </select> 
            </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-2">
                        <!--                        <div class="btn-group btn-overlap">
                                                    <a class="btn btn-white btn-primary  btn-bold" id="pdf" title="Bulletin de Notes" target="_blank" ng-click="exportAllRec()" ng-disabled="eleve.id_classe==null">
                                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                        <div  style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                                    </a></div>-->
                        <div class="btn-group" ng-if="eleve.id_classe != null">
                            <button class="btn btn-app btn-primary btn-xs">
                                <i class="ace-icon fa fa-file-pdf-o bigger-180"></i>
                                Editer
                            </button>

                            <button class="btn btn-app btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="bigger-110 ace-icon fa fa-caret-down icon-only"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-primary">
                                <li><a ng-click="exportAllRec(10,'Octobre')" href="#">Octobre</a></li>
                                <li><a ng-click="exportAllRec(11,'Novembre')" href="#">Novembre</a></li>
                                <li><a ng-click="exportAllRec(12,'D&eacute;cembre')" href="#">D&eacute;cembre</a></li>
                                <li><a ng-click="exportAllRec(1,'Janvier')" href="#">Janvier</a></li>
                                <li><a ng-click="exportAllRec(2,'F&eacute;vrier')" href="#">F&eacute;vrier</a></li>
                                <li><a ng-click="exportAllRec(3,'Mars')" href="#">Mars</a></li>
                                <li><a ng-click="exportAllRec(4,'Avril')" href="#">Avril</a></li>
                                <li><a ng-click="exportAllRec(5,'Mai')" href="#">Mai</a></li>
                                <li><a ng-click="exportAllRec(6,'Juin')" href="#">Juin</a></li>
                                <li><a ng-click="exportAllRec(7,'Juillet')" href="#">Juillet</a></li>
                                <li><a ng-click="exportAllRec(8,'Aout')" href="#">Aout</a></li>
                                <li><a ng-click="exportAllRec(9,'Septembre')" href="#">Septembre</a></li>  

                            </ul>
                        </div>
                    </div><br/><br/><br/><br/><br/><br/>
                    <div class="row">

                        <div class="col-xs-11 col-sm-10 col-sm-offset-1">
                            <!-- #section:pages/timeline -->

                            <div class="timeline-container">
                                <div class="timeline-items">
                                    <!-- #section:pages/timeline.item -->
                                    <div class="timeline-item clearfix"   ng-repeat="eleve in eleves">
                                        <!-- #section:pages/timeline.info -->
                                        <div class="timeline-info">

                                            <img ng-show="eleve.avatar != null && eleve.avatar != ''" alt="Avatar Eleve" ng-src="rest/avatarEleves/{{eleve.avatar}}" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>


                                            <img ng-show="eleve.avatar == null || eleve.avatar == ''" alt="Avatar Eleve" src="pdf/images/unlogo.jpg" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>


                                            <span class="label label-info label-sm">{{eleve.numero_eleve}}</span>
                                        </div>
                                        <!-- /section:pages/timeline.info -->
                                        <div class="widget-box transparent collapsed">
                                            <div class="widget-header widget-header-small">
                                                <h5 class="widget-title smaller">
                                                    <a href="#" class="blue">{{eleve.nom}}</a>
                                                    <span class="grey">{{eleve.prenom}}</span>
                                                </h5>

                                                <span class="widget-toolbar">

                                                    <a href="#" data-action="collapse">
                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                                </span>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <div class="widget-toolbox clearfix">

                                                        <div ng-controller="RecuEleveAllCtrl">

                                                            <div class="clearfix">
                                                                <div class="pull-right tableTools-container">
                                                                    <div class="btn-group btn-overlap">
                                                                        <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-href="http://capella-csikm.com/pdf/liste_recus.php?numEleve={{eleve.numero_eleve}}&annee_scolaire={{anneeEnCours}}">
                                                                            <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                                            <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                                                        </a></div></div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xs-12 widget-container-col ui-sortable">
                                                                    <!-- 			#section:custom/widget-box -->
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
                                                                                                             title="Uploader la facture">
                                                                                                            <a ng-href="http://capella-csikm.com/pdf/recu.php?numRecu={{recue.id_recu}}&annee_scolaire={{anneeEnCours}}" target="_blank">
                                                                                                                <span><i class="fa fa-file-pdf-o bigger-115 grey"; style="margin-top:5px; margin-left:3px; "></i></span></a>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>{{recue.code}}</td>
                                                                                                <td>{{recue.operation}}</td>
                                                                                                <td>{{recue.libelle}}</td>
                                                                                                <td>{{recue.versement}}</td>
                                                                                                <td>{{recue.date_recu}}</td>
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

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.timeline-items -->
                            </div><!-- /.timeline-container -->
                        </div>
                        <!-- /section:pages/timeline -->
                    </div>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
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

    })
</script>
