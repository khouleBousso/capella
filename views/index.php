<div class="breadcrumbs" id="breadcrumbs">

	<ul class="breadcrumb">
		<li><i class="ace-icon fa fa-home home-icon"></i> <a
			ui-sref="home">Accueil</a></li>
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

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">	
 <div class="row" ng-controller="EleveCtrl">
		<div class="col-xs-12 widget-container-col ui-sortable">
<!-- 			#section:custom/widget-box -->
			<div class="widget-box ui-sortable-handle">
				<div class="widget-header"
					style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
					<h5 class="widget-title">LISTE DES ELEVES</h5>
				<!-- 	/section:custom/widget-box.toolbar sdds -->
				</div>
				<div class="widget-body">
					<div class="widget-main"><br/>
					<div class="col-sm-6">
					 <select chosen id="classe" data-placeholder="Choisir une Classe... " ng-options="classe.nom for classe in classes" ng-model="eleve.classe" ng-change="changeClasse()"><option value=""></option> </select> 
					  </div>
					  <div class="col-sm-3"> </div>
					  <div class="col-sm-5 pull-right" >
					 <select chosen id="classe" data-placeholder="Ann&eacute;e en cours ... "  ng-options="inscrit.annee_scolaire  as inscrit.annee_scolaire for inscrit in inscrits" ng-model="eleve.inscrit" ng-change="changeClasseAnnne()" > </select> 
					  </div>
						<br/><br/><br/>
                                 <div class="row"> 
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
						 <div class="btn-group" ng-if="eleve.classe.id_classe != null ">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                    <div class="btn-group btn-overlap">
                                        <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-click="exportPdfFicheClasse()" >
                                            <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                            <div data-original-title="Export to PDF" title="Telecharger la fiche de classe" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                        </a></div></div>
                            </div>
                        </div>
						</div>
						
						</div>
						<div id="gbox_grid-table"
							class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
							<table datatable="ng"
								class="table table-striped table-bordered table-hover row-border hover">
								<thead>
									<tr>
										
										<th></th>
                                                                                <th>Numero</th>
										<th>Nom</th>
										<th>Prenom</th>
										<th>Adresse</th>
										<th>Lieu Naissance</th>
                                                                                <th>Date de Naissance</th>
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
													<a ng-href="#/fiche-eleve?id={{eleve.numero_eleve}}&annee={{inscrit.annee}}">
													<span class="ui-icon ace-icon fa fa-search-plus blue"></span></a>
												</div>
												<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
													onmouseover="jQuery(this).addClass('ui-state-hover');"
													class="ui-pg-div ui-inline-edit"
													style="float: left; cursor: pointer;"
													title="Modifier eleve " >
													
													<a ng-href="#/inscription/{{eleve.numero_eleve}}"  ng-if="user.id_profil != 6" >
													<span class="ui-icon ui-icon-pencil"></span></a>
													
												</div>
												<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
													onmouseover="jQuery(this).addClass('ui-state-hover');"
													class="ui-pg-div ui-inline-edit"
													style="float: left; cursor: pointer;"
													title="Uploader la carte">
													<a ng-href="http://www.capella-csikm.com/pdf/carte-etudiant.php?numEleve={{eleve.numero_eleve}}&annee_scolaire={{anneeEnCours}}" target="_blank">
													<span><i class="fa fa-file-pdf-o bigger-115 blue" style="margin-top:5px; margin-left:3px; "></i></span></a>
													
												</div>
                                                                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                                                                   onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                                                                   class="ui-pg-div ui-inline-edit"
                                                                                                   style="float: left; cursor: pointer;"
                                                                                                   title="Supprim&eacute;">&nbsp;&nbsp;
                                                                                                   <a ng-click="popupDesisEleve(eleve.numero_eleve)"  ng-if="user.id_profil != 6">
                                                                                                  <span class="ace-icon fa fa-times blue bigger-120"></span></a>
                                                                                                </div>
											</div>
										</td>
                                                                                <td>{{eleve.numero_eleve}}</td>
										<td>{{eleve.nom}}</td>
										<td>{{eleve.prenom}}</td>
										<td>{{eleve.adresseParent}}</td>
										<td>{{eleve.lieu_naissance}}</td>
                                         <td>{{eleve.date_naissance}}</td>
									</tr>
								</tbody>
							</table>
							<modal title="Vous &ecirc;tes sur le point d'archiver cet &eacute;l&egrave;ve" visible="showDesisEleve">
							<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
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
			jQuery(function($) {
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
				}
			
			});
		</script>