<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="recherche">Recherche</a></li>
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

    <div class="row" ng-controller="RechercheCtrl">
        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header">
                    <h5 class="widget-title">Recherche</h5>
                    <div class="widget-toolbar">
                        <a ng-click="addLineCritere()" href="#">
                            <span class="ace-icon fa fa-plus-circle purple" ></span></a>
                    </div>


                    <!-- /section:custom/widget-box.toolbar -->
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row"  style="margin-top: 10px" ng-repeat="criteres in criteresRecherche">
                            <div class="col-sm-4">
                                <select class="col-xs-12" ng-model="criteres.critere">
                                    <option selected="selected" value="myac"></option>
                                    <option value="numero_eleve">Num&eacute;ro El&egrave;ve</option>
                                    <option value="nom">Nom</option>
                                    <option value="prenom">Pr&eacute;nom</option>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <select class="col-xs-12" ng-model="criteres.operateur">
                                    <option selected="selected" value="==">egale &agrave;</option>
                                    <option value="<" ng-if="criteres.critere == 'numero_eleve'">inf&eacute;rieur &agrave;</option>
                                    <option value="<=" ng-if="criteres.critere == 'numero_eleve'">inf&eacute;rieur ou egale &agrave;</option>
                                    <option value=">" ng-if="criteres.critere == 'inumero_eleved'">sup&eacute;rieur &agrave;</option>
                                    <option value=">=" ng-if="criteres.critere == 'numero_eleve'">sup&eacute;rieur ou egale &agrave;</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" id="jqg4" style="width: 98%;" role="textbox" class="input-elm" ng-model="criteres.value">
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px"><a ng-click="deleteLineCritere(criteres)" href="#">
                                    <i class="ace-icon fa fa-times red bigger-120"></i>
                                </a></div>
                        </div>
                    </div>
                    <div class="widget-toolbox padding-8 clearfix">
                        <button ng-click="viderAllCriteres()" class="btn btn-xs btn-danger pull-left" ng-disabled="criteresRecherche.length ==0">
                            <i class="ace-icon fa fa-retweet"></i>
                            <span class="bigger-110">Vider</span>
                        </button>

                        <button ng-click="rechercher()" class="btn btn-xs btn-success pull-right" ng-disabled="criteresRecherche.length ==0">
                            
                            <i class="ace-icon fa fa-search"></i>
                            <span class="bigger-110">Rechercher</span>

                        </button>
                    </div>
                </div>

            </div>

        </div> <br/><br/><br/>
        <div class="col-xs-12">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES ELEVES</h5>
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
                                        <th>Num&eacute;ro El&egrave;ve</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Adresse</th>
                                        <th>Lieu Naissance</th>
                                        <th>Date de Naissance</th>
										<th>Classe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="eleve in eleves" >
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
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Modifier ">

                                                    <a ng-href="#/inscription/{{eleve.numero_eleve}}">
                                                        <span class="ui-icon ui-icon-pencil grey" ></span></a>

                                                </div>
						<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="D&eacute;sistement ">
                                                    <a ng-click="popupDesisEleve(eleve.numero_eleve)">
                                                        <span class="ui-icon ace-icon fa fa-ban"></span></a>

                                                </div>
                                            </div>
                                        </td>
                                         <td>{{eleve.numero_eleve}}</td>
                                        <td>{{eleve.nom}}</td>
                                        <td>{{eleve.prenom}}</td>
                                        <td>{{eleve.adresseParent}}</td>
                                        <td>{{eleve.lieu_naissance}}</td>
                                        <td>{{eleve.date_naissance}}</td>
										<td>{{eleve.classe}}</td>
                                    </tr>
                                </tbody>
                            </table>
							<modal title="Vous 	&ecirc;tes sur le point d'archiver cet &eacute;l&egrave;ve" visible="showDesisEleve">
							<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
							 <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Motif</label>
                                   <div class="col-sm-9">
                                       <textarea placeholder="Motif de l'archivage" ng-model="eleve.motif" required>
                                        </textarea>
                                    </div>
                              </div>
							                        
													
													<div class="modal-footer">
													<button type="reset" class="btn" ng-click="AnnulerDesisEleve()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>

											&nbsp; &nbsp; &nbsp;
											
							                 <button type="button" class="btn btn-info" ng-click="confirmDesisEleve()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Confirmer
											</button>
							                        </div>
													</form> 
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