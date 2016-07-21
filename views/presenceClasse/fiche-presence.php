<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="fiche-presence">Fiche de pr&eacute;sence</a></li>
    </ul>
    <!-- /.breadcrumb -->

   
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>
        <div class="page-content">

            <div class="row"  ng-controller="NotesAllCtrl">
                <div class="col-xs-12"><br/><br/>
                    <div class="col-sm-6" ng-controller="ListClasseCtrl" >
                        <select chosen id="classe" data-placeholder="Choisir une Classe... " 
                                ng-model="eleve.id_classe" ng-change="changeClasse()" ng-options="classe.id_classe as classe.nom for classe in classes">
                                 <option value=""></option>
                        </select> 
                    </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-2">

                        <div class="btn-group" ng-if="eleve.id_classe != null && eleves.length != 0"  >
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                    <div class="btn-group btn-overlap">
                                        <a class="btn btn-white btn-primary  btn-bold" target="_blank" ng-click="exportPdfPresences()" >
                                            <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                            <div data-original-title="Export to PDF" title="Uploader la fiche de pr&eacute;sence du jour" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                        </a></div></div>
                            </div>
                        </div>
                    </div><br/><br/><br/><br/><br/><br/>
                    <div class="row">

                        <div class="col-xs-7 col-sm-8 col-sm-offset-1">
                            <!-- #section:pages/timeline -->

                            <div class="timeline-container">
                                <div class="timeline-items">
                                    <!-- #section:pages/timeline.item -->
                                    <div class="timeline-item clearfix"   ng-repeat="eleve in eleves">
                                        <!-- #section:pages/timeline.info -->
                                        <div class="timeline-info">

                                            <img ng-show="eleve.avatar != null && eleve.avatar != ''" alt="Avatar Eleve" ng-src="rest/avatarEleves/{{eleve.avatar}}" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>


                                            <img ng-show="eleve.avatar == null || eleve.avatar == ''" alt="Avatar Eleve" src="pdf/images/unlogo.jpg" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>


                                            <span class="label label-info label-sm">{{eleve.numero_eleve}}</span>
                                        </div>
                                        <!-- /section:pages/timeline.info -->
                                        <div class="widget-box transparent collapsed">
                                            <div class="widget-header widget-header-small">
                                                <h5 class="widget-title smaller">
                                                    <a href="#" class="blue">{{eleve.nom}}</a>
                                                    <span class="grey">{{eleve.prenom}}</span>
                                                </h5>
                                            </div>

                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="col-sm-12 form-inline" style="margin-left:40px">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" name="presence{{eleve.numero_eleve}}" value="1" ng-model="eleve.presence">
                                                    <span class="lbl"> Pr&eacute;sent</span>
                                                </label>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" name="presence{{eleve.numero_eleve}}" value="3" ng-model="eleve.presence">
                                                    <span class="lbl">Absent</span>
                                                </label>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" name="presence{{eleve.numero_eleve}}" value="4" ng-model="eleve.presence">
                                                    <span class="lbl">Retard</span>
                                                </label>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" name="presence{{eleve.numero_eleve}}" value="5" ng-model="eleve.presence">
                                                    <span class="lbl">Renvoi</span>
                                                </label>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="radio" ng-show="eleve.presence == 5">
                                                <textarea placeholder="Motif renvoi " ng-model="eleve.motif_absence">
                                                </textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.timeline-items -->
                            </div><!-- /.timeline-container -->
                        </div><br/>
                        <!-- /section:pages/timeline -->
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3" ng-if="eleve.id_classe != null && eleves.length != 0"><br/><br/>


                                <button class="btn btn-success btn-xs" ng-click="addPresences()"  >
                                    <i class="ace-icon fa fa-check  bigger-110 icon-only"></i> Soumettre
                                </button>
                            </div></div>

                    </div>



                </div><!-- /.col -->
                
                        <modal title="Affectation" visible="showInfosPresence">
                            <form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Mati&egrave;re</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" id="form-field-select-3" ng-options="matiere.nom for matiere in matieres" ng-model="presences.matiere">
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Semestre</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" id="form-field-select-3" ng-model="presences.semestre">
                                            <option value=""></option> 
                                            <option value="1"> Semestre 1</option> 
                                            <option value="2"> Semestre 2</option> 
                                        </select> 
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="reset" class="btn" ng-click="AnnulerPresences()">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Annuler
                                    </button>

                                    &nbsp; &nbsp; &nbsp;

                                    <button type="button" class="btn btn-info" ng-click="confirmPresences()">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Confirmer
                                    </button>
                                </div>
                            </form> 
                        </modal>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
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

    })
</script>
