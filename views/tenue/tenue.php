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
 <div class="row" ng-controller="TenueCtrl">
		<div class="col-xs-12 widget-container-col ui-sortable">
<!-- 			#section:custom/widget-box -->
			<div class="widget-box ui-sortable-handle">
				<div class="widget-header"
					style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
					<h5 class="widget-title">LISTE DES TENUES PROPOSES</h5>
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
										<th>Tenue</th>
										<th>Mensualite</th>
										<th>Adh&eacute;rants</th>
										<th>Liste</th>
										
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="tenue in tenues" >
										<td title="" style="" role="gridcell">
											<div style="margin-left: 8px;">
												<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
													onmouseover="jQuery(this).addClass('ui-state-hover');"
													class="ui-pg-div ui-inline-edit"
													style="float: left; cursor: pointer;"
													title="Modifier tenue">
													<a ng-click="popupModifierTenue(tenue.id_tenue)">
													<span class="ui-icon ui-icon-pencil"></span></a>
													
												</div>

<!-- 												Bouton archiver agent et ouverture du popup -->
												
												<div onmouseout="jQuery(this).removeClass('ui-state-hover')"
													onmouseover="jQuery(this).addClass('ui-state-hover');"
													class="ui-pg-div ui-inline-edit"
													style="float: left; cursor: pointer;"
													title="Supprimer tenue">
													<a ng-click="popupSupprTenue(tenue.id_tenue)">
													<span class="ui-icon ui-icon-trash"></span></a>
													
												</div>
												
											</div>
										</td>
										<td>{{tenue.type_tenue}}</td>
										<td>{{tenue.mensualite | number : fractionSize}}</td>
										<td>{{tenue.nb}}</td>
										<td title="" style="" role="gridcell">
												<div style="float: left; cursor: pointer;" title="Liste des inscrits"
													ng-click="popupListElevesTenue(tenue.id_tenue)">
													<a href="">
													<span class="fa fa-user"></span></a>
													
												</div>	
										</td>
										
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
													<a ng-click="popupAjoutTenue()" style="cursor: pointer">
													<span class="ui-icon ace-icon fa fa-plus-circle purple"></span></a>
													<modal title="Ajout Tenue" visible="showAjoutTenue">
													<div
												  ng-include="gOptions.appname+'views/tenue/ajout-mod-tenue.php'"></div> 
													</modal>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<modal title="Suppression Tenue" visible="showSupprTenue">
							                        <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
							                           <br/>
													   Voulez-vous vraiment supprimer cette Tenue ?
													    <br/>
							                        </div>
													
													<div class="modal-footer">
													<button type="reset" class="btn" ng-click="AnnulerSupprTenue()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>

											&nbsp; &nbsp; &nbsp;
											
							                 <button type="button" class="btn btn-info" ng-click="confirmSupprTenue()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Confirmer
											</button>
							                        </div>
													 
                            </modal>
							<modal title="Modifier Tenue" visible="showModTenue">
													<div
												  ng-include="gOptions.appname+'views/tenue/ajout-mod-tenue.php'"></div> 
							</modal>
							<modal title="Liste Eleves" visible="showliste">
													<div class="row" style="margin-bottom : 25px"> 
												<div class="col-md-12">
													<div class="profile-user-info profile-user-info-striped">
														<div class="profile-info-row" ng-repeat="eleve in eleves">
															<div class="profile-info-name">{{eleve.numero_eleve}}</div>

															<div class="profile-info-value">
																<span id="username" class="editable editable-click"><strong>{{eleve.nom}}  {{eleve.prenom}}</strong> inscrit en <strong>{{eleve.classe}}</strong></span>
															</div>
														</div></div></div></div>
			
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