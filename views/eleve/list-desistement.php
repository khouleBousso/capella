<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="list-desistement">D&eacute;sistement</a></li>
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

    <div class="row" ng-controller="DesistementCtrl">
        <br/><br/><br/>
        <div class="col-xs-12">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES D&Eacute;SIST&Eacute;S</h5>
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
                                        <th>Eleve</th>
                                        <th>Date et lieu de Naissance</th>
										<th>Inscrits</th>
										<th>Motif du d&eacute;sistement</th>
										<th>Date</th>
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
                                                     title="D&eacute;sistement ">
                                                    <a ng-click="popupDesisEleve(eleve.numero_eleve)">
                                                        <span class="ui-icon ace-icon fa fa-ban green"></span></a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{eleve.prenom}}&nbsp;&nbsp;{{eleve.nom}}</td>
                                        <td>{{eleve.date_naissance}} &nbsp; &nbsp;&agrave;&nbsp; &nbsp;{{eleve.lieu_naissance}}</td>
										<td>{{eleve.classe}}</td>
										<td>{{eleve.motif}}</td>
										<td>{{eleve.date_desistement}}</td>
                                    </tr>
                                </tbody>
                            </table>
							<modal title="Vous 	&ecirc;tes sur le point restaurer cet &eacute;l&egrave;ve" visible="showDesisEleve">
							<form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
							 <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Motif</label>
                                   <div class="col-sm-9">
                                       <textarea placeholder="Motif de la restauration" ng-model="eleve.motif" required>
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