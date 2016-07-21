<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="recues">Notes par classe</a></li>
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
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row"  ng-controller="NotesAllCtrl">
                <div class="col-xs-12">
                      <div class="col-sm-6" ng-controller="ListClasseCtrl">
                <select chosen id="classe" data-placeholder="Choisir une Classe... " ng-model="eleve.id_classe" ng-change="changeClasseMoyenne()" ng-options="clas.id_classe as clas.nom for clas in classes">
                <option value=""></option>
              </select> 
            </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-2">
                        <!--                        <div class="btn-group btn-overlap">
                                                    <a class="btn btn-white btn-primary  btn-bold" id="pdf" title="Bulletin de Notes" target="_blank" ng-click="exportAllRec()" ng-disabled="eleve.id_classe==null">
                                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                        <div  style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                                    </a></div>-->
                       <div class="btn-group" ng-if="eleve.id_classe!=null">
                                    <button class="btn btn-app btn-primary btn-xs">
                                            <i class="ace-icon fa fa-file-pdf-o bigger-180"></i>
                                            Editer
                                    </button>

                                    <button class="btn btn-app btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="bigger-110 ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-primary">
                                            

                                            <li>
                                                    <a ng-click="exportAllBulletinNotes(1)" href="#"> Bulletin S1</a>
                                            </li>
                                           

                                            

                                            <li>
                                                    <a ng-click="exportAllBulletinNotes(2)" href="#">Bulletin S2</a>
                                            </li>

                                    </ul>
                            </div>
                    </div><br/><br/><br/><br/><br/><br/>
                    <div id="gbox_grid-table"
							class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
							<table datatable="ng"
								class="table table-striped table-bordered table-hover row-border hover">
								<thead>
									<tr>
										
										
										<th>Prenom</th>
										<th>Nom</th>
                                                                                <th>Date et lieu de Naissance</th>
                                                                                <th>Moyenne</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="eleve in eleves" >
										
										<td>{{eleve.prenom}}</td>
										<td>{{eleve.nom}}</td>
										<td> {{eleve.date_naissance}} &agrave; {{eleve.lieu_naissance}} </td>
                                                                               <td style="color:blue">{{eleve.moyenne}}</td>
									</tr>
								</tbody>
							</table>
							<div>
								<br />
							</div>
						</div>


                </div><!-- /.col -->

<modal title="Pagination" visible="showPagination">
                    <form  class="form-horizontal" style="margin-top : 10px; margin-bottom :20px; ">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="inputLibelle">Choix de tirage </label>
                            <div class="col-sm-5">
                                <select class="form-control" id="form-field-select-3" ng-options="item.label as item.label for item in itemsPagination" ng-model="eleve.limit" required>
                                </select> 
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn" ng-click="annulerPagination()">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Annuler
                            </button>

                            &nbsp; &nbsp; &nbsp;

                            <button type="button" class="btn btn-info" ng-click="confirmPagination()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Confirmer
                            </button>
                        </div>
                    </form> 
                </modal>

            </div><!-- /.row -->



        </div><!-- /.page-content -->

    </div>
</div><!-- /.main-content -->
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
