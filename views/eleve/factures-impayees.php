<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="factures-impayees">Etat des impay&eacute;s</a></li>
    </ul>
    <!-- /.breadcrumb -->


    <!-- /section:basics/content.searchbox -->
</div><br/>
<div class="page-content" ng-controller="ImpayeCtrl">
    <div class="clearfix">
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap">
                                    <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-click="addPeriode()" ng-show="classe.nom!=null">
                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        <div data-original-title="Export to PDF" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
								
                    
                        </div>
    <div class="row" >
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES IMPAY&Eacute;ES</h5>
                    <!-- 	/section:custom/widget-box.toolbar sdds -->
                </div>

                <div class="widget-body">
                    <div class="widget-main"><br/>

                        <div class="row">
                            <div class="col-sm-6" ng-controller="ListClasseCtrl">
                            <select chosen id="classe" data-placeholder="Choisir une Classe... "  ng-model="classe.nom" ng-change="changeClasse()"
                                   ng-options="clas.id_classe+':'+clas.nom as clas.nom for clas in classes">
                                  <option value=""></option>
                            </select> 
                        </div>
                            
                        </div>
                        <br/>
                        <div id="gbox_grid-table"
                             class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
                            <table datatable="ng"
                                   class="table table-striped table-bordered table-hover row-border hover">
                                <thead>
                                    <tr>


                                        <th>N° Facture</th>
                                        <th>El&egrave;ve</th>
                                        <th>Designation</th>
                                        <th>Date</th>
                                        <th>A payer</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="impaye in impayes" >
                                        <td>{{impaye.numero_facture}}</td>
                                        <td>{{impaye.prenom}} {{impaye.nom}}</td>
                                        <td>{{impaye.libelle}}</td>
                                        <td>{{impaye.date_payement}}</td>
                                        <td class="alert-danger">{{impaye.solde | number : fractionSize}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div ng-show="impayes.length != 0" style="text-align:center">

                                <strong class="alert-danger" style="font-size:18px;">TOTAL: &nbsp;&nbsp;&nbsp;{{totalImpayes  | number : fractionSize}} FCFA</strong>
                            </div>
							
							<modal title="Choisir une p&eacute;riode" visible="showInfosPeriode">
							<div
                                    ng-include="gOptions.appname + 'views/eleve/ajout-mod-periodeimpaye.php'"></div> 
                            </modal>
                            <div>
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

<!-- inline scripts related to this page -->
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