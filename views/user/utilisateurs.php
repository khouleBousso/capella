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

    <div class="row" ng-controller="UtilisateurCtrl">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DES UTILISATEURS</h5>
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
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>
                                        <th>Profil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="user in users" >
                                        <td title="" style="" role="gridcell">
                                            <div style="margin-left: 8px;">
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Fiche utilisateur">
                                                    <a ng-href="#/profil/{{user.id}}">
                                                        <span class="ui-icon ace-icon fa fa-search-plus blue"></span></a>
                                                </div>
                                                <div onmouseout="jQuery(this).removeClass('ui-state-hover')"
                                                     onmouseover="jQuery(this).addClass('ui-state-hover');"
                                                     class="ui-pg-div ui-inline-edit"
                                                     style="float: left; cursor: pointer;"
                                                     title="Modifier utilisateur">
                                                    <a ng-click="popupModUser(user.id)">
                                                        <span class="ui-icon ui-icon-pencil"></span></a>
                                                </div>

                                            </div>
                                        </td>
                                        <td>{{user.nom}}</td>
                                        <td>{{user.prenom}}</td>
                                        <td>{{user.email}}</td>
                                        <td>{{user.profil}}</td>
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
                                                <a ng-click="popupAjoutUser()" style="cursor: pointer">
                                                    <span class="ui-icon ace-icon fa fa-plus-circle purple"></span></a>
                                                <modal title="Ajout Utilisateur" visible="showAjoutUser">
                                                    <div
                                                        ng-include="gOptions.appname + 'views/user/ajout-mod-user.php'"></div> 
                                                </modal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <modal title="Modifier Utilisateur" visible="showModUser">
                                <div
                                    ng-include="gOptions.appname + 'views/user/ajout-mod-user.php'"></div> 
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
