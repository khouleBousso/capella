<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
							 
							 
						
							 
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="inputOperaton"></label>
                            <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>

                                <input class="form-control" ng-model="periode"  type="text" placeholder="Choisir une p&eacute;riode" name="date-range-picker" id="id-date-range-picker-1" />
                            </div>

                            <!-- /section:plugins/date-time.datepicker -->
                        </div>
                            </div>
	                     
													<div class="modal-footer">
													<button type="reset" class="btn" ng-click="AnnulerPeriode()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Annuler
											</button>&nbsp; &nbsp; &nbsp;
							                 <button type="button" class="btn btn-info" target="_blank" ng-click="exportPdf()" >
												<i class="ace-icon fa fa-check bigger-110"></i>
												Imprimer
											</button>
							                        </div>
													</form> 
<script type="text/javascript">
    jQuery(function ($) {


        $('input[name=date-range-picker]').daterangepicker({
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Valider',
                cancelLabel: 'Annuler',
            }
        })
         .prev().on(ace.click_event, function () {
            $(this).next().focus();
        });

    });
</script>