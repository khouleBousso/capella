<script type="text/javascript">
    try {
    ace.settings.check('main-container', 'fixed')
    } catch (e) {
    }
</script>
<script type="text/javascript">
    function ouvrirtab(tab1, tab2, tab3, tab4, tab5, tab6,tab7) {
    btn1 = document.getElementById(tab1);
            if (btn1 != null)
            btn1.className = "tab-pane fade active in";
            var btn = $("#" + tab2).removeClass("active in");
            var btn2 = $("#" + tab3).removeClass("active in");
            var btn3 = $("#" + tab4).removeClass("active in");
            var btn4 = $("#" + tab5).removeClass("active in");
            var btn5 = $("#" + tab6).removeClass("active in");
            var btn6 = $("#" + tab7).removeClass("active in");
    }
</script>
<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="home">Accueil</a></li>

        <li class="active">Gestion</li>
    </ul>
	
	
    <!-- /.breadcrumb -->
    <!-- /section:basics/content.searchbox -->
</div>
<div ng-controller="viewEleveCtrl">
<div class="row">
    <div class="col-md-10"></div>
        <div class="col-md-1">
           <div class="clearfix" >
                            <div class="pull-right tableTools-container">
                                <div class="btn-group btn-overlap" ng-if="user.id_profil == 5" >
                                    <a  target="_blank" ng-href="chat?inf={{user.nom}};{{user.prenom}};{{user.code_profil}};{{user.id_etudiant}}">
                                        <span><i class="fa fa-weixin bigger-210 green"></i></span>
                                        <div data-original-title="Chat" title="" style="position: absolute; left: 0px; top: 0px; width: 39px; height: 35px; z-index: 99;"></div>
                                    </a></div></div>
           </div>
        </div>
</div>
<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">
    <div class="row" >
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="tabbable">
                <ul id="myTab" class="nav nav-tabs">
                    <li ng-class="{ 'active': tab == 'identite'} "><a href="#"
                                                                      data-toggle="tab" aria-expanded="false"
                                                                      onclick="ouvrirtab('identite', 'factures', 'recus', 'notes', 'presences', 'devoirs','cours')"> <i
                                class="green ace-icon fa fa-home bigger-120" ></i> Identit&eacute;
                        </a></li>

                    <li ng-class="{ 'active': tab == 'factures'}"><a href=""
                                                                     data-toggle="tab" aria-expanded="true"
                                                                     onclick="ouvrirtab('factures', 'identite', 'recus', 'notes', 'presences', 'devoirs','cours')"
                                                                     ng-if="user.id_profil != 4 && user.id_profil != 3" ><i
                                class="green ace-icon fa fa-folder-open bigger-120" ></i>  Factures
                        </a></li>

                    <li ng-class="{ 'active': tab == 'recus'}"><a href=""
                                                                  data-toggle="tab" aria-expanded="true"
                                                                  onclick="ouvrirtab('recus', 'factures', 'identite', 'notes', 'presences', 'devoirs','cours')" ng-if="user.id_profil != 4 && user.id_profil != 3"> <i
                                class="green ace-icon fa fa-credit-card bigger-120" ></i> Re&ccedil;us 
                        </a></li>

                    <li ng-class="{ 'active': tab == 'notes'}"><a href=""
                                                                  data-toggle="tab" aria-expanded="true"
                                                                  onclick="ouvrirtab('notes', 'factures', 'recus', 'identite', 'presences', 'devoirs','cours')"><i
                                class="green ace-icon fa fa-list bigger-120" ></i> Notes 
                        </a></li>

                    <li ng-class="{ 'active': tab == 'presences'}"><a href=""
                                                                      data-toggle="tab" aria-expanded="true"
                                                                      onclick="ouvrirtab('presences', 'factures', 'recus', 'identite', 'notes', 'devoirs','cours')"  ng-if="user.id_profil != 6"><i
                                class="green ace-icon fa fa-tachometer  bigger-120"></i> Pr&eacute;sences 
                        </a></li>
                    <li ng-class="{ 'active': tab == 'devoirs'}"><a href=""
                                                                    data-toggle="tab" aria-expanded="true"
                                                                    onclick="ouvrirtab('devoirs', 'presences', 'factures', 'recus', 'identite', 'notes','cours')" 
                                                                     ng-if="user.id_profil != 6"><i
                                class="green ace-icon fa  fa-list bigger-120" ></i> Devoirs
                        </a></li>
                    <li ng-class="{ 'active': tab == 'cours'}"><a href=""
                                                                    data-toggle="tab" aria-expanded="true"
                                                                    onclick="ouvrirtab('cours','devoirs', 'presences', 'factures', 'recus', 'identite', 'notes')" ng-if="user.id_profil != 6"><i
                                class="green ace-icon fa  fa-list bigger-120"  ></i> Documents
                        </a></li>    
                  
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in" id="identite"
                         ng-class="{ 'active': tab == 'identite'}">
                        <ng-include src="'views/eleve/fiche-identite.php'"></ng-include>
                    </div>
                    <div class="tab-pane fade in" id="factures"
                         ng-class="{ 'active': tab == 'factures'}">
                        <ng-include src="'views/eleve/fiche-factures.php'"></ng-include>
                    </div>
                    <div class="tab-pane fade in" id="recus"
                         ng-class="{ 'active': tab == 'recus'}">
                        <ng-include src="'views/eleve/fiche-recus.php'"></ng-include>
                    </div>
                    <div class="tab-pane fade in" id="notes"
                         ng-class="{ 'active': tab == 'notes'}">
                        <ng-include src="'views/eleve/fiche-notes.php'"></ng-include>
                    </div>

                    <div class="tab-pane fade in" id="presences"
                         ng-class="{ 'active': tab == 'presences'}">
                        <ng-include src="'views/eleve/fiche-presences.php'"></ng-include>
                    </div>

                    <div class="tab-pane fade in" id="devoirs"
                         ng-class="{ 'active': tab == 'devoirs'}">
                        <ng-include src="'views/eleve/fiche-devoirs.php'"></ng-include>
                    </div>
                    <div class="tab-pane fade in" id="cours"
                         ng-class="{ 'active': tab == 'cours'}">
                        <ng-include src="'views/eleve/fiche-cours.php'"></ng-include>
                    </div>
                </div>
            </div>
              
        </div>
    </div>

</div>
</div>