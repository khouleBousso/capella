<div class="page-content" ng-controller="CoursCtrl">
    <div class="page-header">
        <h1>
            Accueil <small> <i class="ace-icon fa fa-angle-double-right"></i>
                Documents
            </small>
        </h1>
    </div>
    <div class="row" >
        <div class="col-xs-12 widget-container-col ui-sortable">
            <!-- 			#section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header"
                     style="background: none repeat scroll 0 0 #438eb9; color: #ffffff">
                    <h5 class="widget-title">LISTE DE MES DOCUMENTS</h5>
                    <!-- 	/section:custom/widget-box.toolbar sdds -->
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="col-sm-3">


                        </div>
                        <br/><br/><br/>
                        <div id="gbox_grid-table"
                             class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
                            <table datatable="ng"
                                   class="table table-striped table-bordered table-hover row-border hover">
                                <thead>
                                    <tr>
                                        <th>Intitul&eacute;</th>
                                        <th>Cours</th>
                                        <th>Examen</th>
                                        <th>Corrig&eacute;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="document in documents" >
                                        <td>{{document.intitule}}</td>
                                        <td>
                                            <a  ng-show="document.cours != null && document.cours != '' " 
                                                target="_blank" ng-href="{{appname}}/rest/documents/{{document.cours}}">{{document.cours}}</a>
                                        </td>
                                        <td>
                                            <a  ng-show="document.examen != null && document.examen != '' " 
                                                target="_blank" ng-href="{{appname}}/rest/documents/{{document.examen}}">{{document.examen}}</a>
                                        </td>
                                        <td>
                                            <a  ng-show="document.corrige != null && document.corrige != '' " 
                                                target="_blank" ng-href="{{appname}}/rest/documents/{{document.corrige}}">{{document.corrige}}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           <table cellspacing="0" cellpadding="0" border="0"
                                               style="float: left; table-layout: auto;"
                                               class="ui-pg-table navtable" >
                                            <tbody>
                                                <tr>
                                                    <td class="ui-pg-button ui-corner-all" title=""
                                                        id="add_grid-table" data-original-title="Ajouter"><div
                                                            class="ui-pg-div">
                                                <a ng-click="popupAjoutDocument()" style="cursor: pointer" ng-if="user.id_profil == 4">
                                                    <span class="ui-icon ace-icon fa fa-plus-circle purple"></span></a>
                                                <modal title="Ajout Document" visible="showAjoutDocument">
                                                    <div
                                                        ng-include="gOptions.appname + 'views/cours/ajoutmod-document.php'"></div> 
                                                </modal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>   
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

</div>