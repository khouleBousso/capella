<div class="page-content"  ng-controller="ChangePasseCtrl">
	<div class="page-header">
		<h1>
			Accueil <small> <i class="ace-icon fa fa-angle-double-right"></i>
				Changer M
			</small>
		</h1>
	</div>	

<form class="form-horizontal" role="form" enctype="multipart/form-data" name="Inscrtiption" ng-submit="ajoutModEleve()" >
								
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">Identit&eacute; et information sur l'&eacute;leve</h4>

													<div class="widget-toolbar">
														<a data-action="collapse" href="#">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
										                   <label class="col-sm-1 control-label no-padding-right" for="nom"> Nom :</label>
                                                               <div class="col-sm-4">
                                                                   <input ng-model="eleve.nom" id="nom" class="col-xs-12 col-sm-12" type="text"  placeholder="Nom" required >
                                                              </div>
                                                           <label class="col-sm-1 control-label no-padding-right" for="prenom"> Prenom :</label>
                                                               <div class="col-sm-4">
                                                                   <input ng-model="eleve.prenom" id="prenom" class="col-xs-12 col-sm-12" type="text" placeholder="Prenom" required>
                                                              </div>
									                    </div>
												