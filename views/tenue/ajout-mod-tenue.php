			<form method="POST" class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
															<!-- #section:elements.form.input-state -->
															
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="type">Type de Tenue</label>

																<div class="col-sm-9">
																	<input  type="text" ng-model="tenue.type_tenue"  name="type_tenue" placeholder="Type">
																</div>
															</div>
															
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="inputMensualite">Mensualite</label>

																<div class="col-sm-9">
																	<input  type="text" ng-model="tenue.mensualite"  name="mensualite" placeholder="Montant">
																</div>
															</div>
															
															
								   <div class="clearfix" style="margin-top : 50px">
										<div class="col-md-offset-3 col-md-9" ng-show="tenue.id_tenue==null">
											<button type="button" class="btn btn-info" ng-click="ajoutTenue()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Ajouter
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn" ng-click="annulerTenue()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>
										</div>
										
										<div class="col-md-offset-3 col-md-9" ng-show="tenue.id_tenue!=null">
											<button type="button" class="btn btn-info" ng-click="modifierTenue()">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Modifier
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn" ng-click="annulerModifTenue()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>
										</div>
									</div>
	         </form>
			 	