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
    <div class="row" ng-controller="StatCtrl">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>

                <i class="ace-icon fa fa-check green"></i>

                Bienvenue &agrave;

                l'application
                <strong class="green">(Gestion des El&egrave;ves)</strong>								,
                du CSI Keur Madior.
            </div>

            <div class="row">
                <div class="space-6"></div>

                <div class="col-sm-6 infobox-container">
                    <!-- #section:pages/dashboard.infobox -->
                    <div class="infobox infobox-green">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{totaleleves}}</span>
                            <div class="infobox-content">nombre total d&apos;&eacute;l&egrave;ves</div>
                        </div>

                        <!-- #section:pages/dashboard.infobox.stat -->


                        <!-- /section:pages/dashboard.infobox.stat -->
                    </div>

                    <div class="infobox infobox-blue">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrhandicape}}</span>
                            <div class="infobox-content">Eleves handicap&eacute;s</div>
                        </div>


                    </div>

                    <div class="infobox infobox-pink">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrfilles}}</span>
                            <div class="infobox-content">nombre de filles</div>
                        </div>
                        <div class="stat stat-important" ng-if="totaleleves != 0">{{nbrfilles * 100 / totaleleves| number:0}}%</div>
                        <div class="stat stat-important" ng-if="totaleleves == 0">0%</div>
                    </div>

                    <div class="infobox infobox-red">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrgarcons}}</span>
                            <div class="infobox-content">nombres de garcons</div>
                        </div>

                        <div class="stat stat-important" ng-if="totaleleves != 0">{{nbrgarcons * 100 / totaleleves| number:0}}%</div>
                        <div class="stat stat-important" ng-if="totaleleves == 0">0%</div>
                    </div>

                    <div class="infobox infobox-orange2">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrboursiers}}</span>
                            <div class="infobox-content">nombre de boursiers</div>
                        </div>
                    </div>

                    <div class="infobox infobox-blue2">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{{nbrinscrits}}</span>
                            <div class="infobox-content">nouveaux arrivants</div>
                        </div>
                    </div>


                    <!-- /section:pages/dashboard.infobox -->
                    <div class="space-6"></div>

                </div>

                <div class="vspace-12-sm"></div>

                <div class="col-sm-5">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                Effectifs / niveaux
                            </h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <!-- #section:plugins/charts.flotchart -->
                                <div id="piechart-placeholder"></div>




                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- #section:custom/extra.hr -->
            <div class="hr hr32 hr-dotted"></div>

            <!-- /section:custom/extra.hr -->
            <div class="row">
                <div style="padding-left:76px;" class="col-sm-6">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-star orange"></i>
                                TARIFS INSCRIPTION
                            </h4>

                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding" ng-controller="TarifCtrl" >
                                <table class="table table-bordered table-striped">
                                    <thead class="thin-border-bottom">
                                        <tr>
                                            <th>
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                            </th>

                                            <th>
                                                <i class="ace-icon fa fa-caret-right blue"></i>Libelle
                                            </th>

                                            <th class="hidden-480">
                                                <i class="ace-icon fa fa-caret-right blue"></i>Prix
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr ng-repeat="tarif in tarifs">
                                            <td></td>

                                            <td>
                                                <small class="label label-info arrowed-right arrowed-in">
                                                    {{tarif.libelle}}
                                                </small>
                                            </td>

                                            <td class="hidden-480">
                                                <span class="label label-success arrowed-in arrowed-in-right">{{tarif.total | number : fractionSize}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="widget-box transparent" id="recent-box">
                        <div class="widget-header">
                            <h4 class="widget-title lighter smaller">
                                <i class="ace-icon fa fa-rss orange"></i>UTILISATEURS
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main padding-4">
                                <div id="member-tab">
                                    <!-- #section:pages/dashboard.members -->
                                    <div class="clearfix">
                                        <div class="itemdiv memberdiv" ng-repeat="user in users">

                                            <div class="user" ng-show="user.avatar == null">
                                                <img src="public/images/profils/unlogo.jpg"  width="48" height="48" class="nav-user-photo"/>
                                            </div>

                                            <div class="user" ng-show="user.avatar != null">
                                                <img ng-src="rest/avatarUsers/{{user.avatar}}" width="48" height="48"   class="nav-user-photo"/>
                                            </div>
                                            <div class="body">
                                                <div class="name">
                                                    <a href="#/profil/{{user.id}}">{{user.nom}} {{user.prenom}}</a>
                                                </div>
                                                <div class="name">
                                                    <em> {{user.profil}}</em>
                                                </div>
                                                <div ng-if="user.status == 'ON'">
                                                    <span class="label label-success label-sm arrowed-in arrowed-in-right">En ligne</span>
                                                </div>

                                                <div ng-if="user.status == 'OFF'">
                                                    <span class="label label-danger label-sm arrowed-in arrowed-in-right">Deconnect&eacute;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="center">
                                        <i class="ace-icon fa fa-users fa-2x green middle"></i>

                                        &nbsp;
                                        <a href="#/utilisateurs" class="btn btn-sm btn-white btn-info">
                                            Voir tous les membres &nbsp;
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>

                                    

                                    <!-- /section:pages/dashboard.members -->
                                </div><!-- /.#member-tab -->

                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
                 <!--  <div class="row"><div class="col-sm-7">
                            <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                            <h4 class="widget-title lighter">
                                                    <i class="ace-icon fa fa-signal"></i>
                                                    Sale Stats
                                            </h4>

                                            <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                            <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                            </div>
                                    </div>

                                    <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                    <div id="sales-charts"></div>
                                            </div> /.widget-main 
                                    </div> /.widget-body 
                            </div> /.widget-box 
		</div> /.col </div>-->
            </div><!-- /.row -->

            <div class="hr hr32 hr-dotted"></div>

            <div class="row">
            </div><!-- /.row -->

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
<script type="text/javascript">

</script>

