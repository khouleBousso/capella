<div class="breadcrumbs" id="breadcrumbs">

	<ul class="breadcrumb">
		<li><i class="ace-icon fa fa-home home-icon"></i> <a
			href="#">Accueil</a></li>
	</ul>
</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">
	<div class="page-header">
		<h1>
			Accueil
		</h1>
	</div>
	
 <div class="row" ng-controller="MesEnfantsCtrl">
		<div class="col-xs-12 widget-container-col ui-sortable">
<!-- 			#section:custom/widget-box -->
			<div class="widget-box ui-sortable-handle">
				<div class="widget-header"
					style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
					<h5 class="widget-title">LISTE DES MES ENFANTS</h5>
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
										<th>Nom</th>
                                                                                <th>Pr&eacute;nom</th>
                                                                                 <th>Classe</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="enfant in enfants" >
										<td title="" style="" role="gridcell">
											<div style="margin-left: 8px;">
												<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
													onmouseover="jQuery(this).addClass('ui-state-hover');"
													class="ui-pg-div ui-inline-edit"
													style="float: left; cursor: pointer;"
													title="Fiche enfant">
													<a ng-href="#/fiche-eleve/{{enfant.numero_eleve}}">
													<span class="ui-icon ace-icon fa fa-search-plus grey"></span></a>
												</div>
											</div>
										</td>
										<td>{{enfant.nom}}</td>
										<td>{{enfant.prenom}}</td>
                                                                                <td>{{enfant.nomClasse}}</td>
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
