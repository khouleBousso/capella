
<div id="timeline-1" ng-controller="MatiereEleveCtrl">
    <div class="row">

        <div class="col-xs-11 col-sm-10 col-sm-offset-1" ng-repeat="matiere in matieres">
            <!-- #section:pages/timeline -->

            <div class="timeline-container" ng-controller="DevCtrl">
                <div class="timeline-label" >
                    <!-- #section:pages/timeline.label -->

                     <img ng-show="matiere.avatarprof != null && matiere.avatarprof != ''" alt="Avatar Professeur" ng-src="rest/avatarUsers/{{matiere.avatarprof}}" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>
                   
                    
                       <img ng-show="matiere.avatarprof == null || matiere.avatarprof == ''" alt="Avatar Professeur" src="pdf/images/unlogo.jpg" style="border-radius: 100%; border: 2px solid #c9d6e5" width="48" height="48"/>
                   
                    
                    
                    <span class="label label-success arrowed-in-right label-lg">
                        <b>{{matiere.nom}}</b>
                    </span>

                    <!-- /section:pages/timeline.label -->
                </div>
                <div class="timeline-items"   ng-repeat="dev in devs">
                    <!-- #section:pages/timeline.item -->
                    <div class="timeline-item clearfix">
                        <!-- #section:pages/timeline.info -->
                        <div class="timeline-info">
                            <span class="label label-info label-sm">{{dev.date}}</span>
                        </div>
                        <!-- /section:pages/timeline.info -->
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                                <h5 class="widget-title smaller">
                                    <a href="#" class="blue">{{dev.title}}</a>
                                </h5>

                                <span class="widget-toolbar no-border">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    Date limite de rendu : {{dev.date_rendu}}
                                </span>

                                <span class="widget-toolbar">

                                    <a href="#" data-action="collapse">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>
                                </span>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    {{dev.details}}
                                    <div class="space-6"></div>

                                    <div class="widget-toolbox clearfix">
                                        <!-- #section:custom/extra.action-buttons -->

                                        <div class="pull-left">
                                            <i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
                                            <span class="bigger-110" ng-if="dev.appreciation != null  && dev.appreciation != ''">Appr&eacute;ciation : {{dev.appreciation}}</span>
                                            <span class="bigger-110" ng-if="dev.appreciation == null || dev.appreciation == ''">Appr&eacute;ciation : Non renseign&eacute;e</span>
                                        </div>
                                        
                                         <div class="pull-right action-buttons"   ng-if="user.id_profil == 1 || user.id_profil == 3">
                                            <a href="#" ng-click="popupModDev(dev.id_devoir_eleve)">
                                                <i class="ace-icon fa fa-pencil blue bigger-125"></i>
                                            </a>
                                        </div>

                                        <!-- /section:custom/extra.action-buttons -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.timeline-items -->
                  <modal title="Modification Devoir" visible="showModDev">
                    <div
                        ng-include="gOptions.appname + 'views/devoir/ajout-mod-dev.php'"></div> 
                </modal>
            </div><!-- /.timeline-container -->
        </div>
       <!-- /section:pages/timeline -->
    </div>
</div>