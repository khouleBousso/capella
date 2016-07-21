			<form method="POST" class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
															<!-- #section:elements.form.input-state -->
															
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="type">Type de Sport</label>

																<div class="col-sm-9">
																	<input  type="text" ng-model="sport.type"  name="type_sport" placeholder="Type">
																</div>
															</div>
															
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="inputMensualite">Mensualite</label>

																<div class="col-sm-9">
																	<input  type="text" ng-model="sport.mensualite"  name="mensualite" placeholder="Montant">
																</div>
															</div>
															
															
								   <div class="clearfix" style="margin-top : 50px">
										<div class="col-md-offset-3 col-md-9" ng-show="sport.id_sport==null">
											<button type="button" class="btn btn-info" ng-click="ajoutSport()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Ajouter
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn" ng-click="annulerSport()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>
										</div>
										
										<div class="col-md-offset-3 col-md-9" ng-show="sport.id_sport!=null">
											<button type="button" class="btn btn-info" ng-click="modifierSport()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Modifier
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn" ng-click="annulerModifSport()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>
										</div>
									</div>
	         </form>
			 	