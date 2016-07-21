<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
	
	function ouvrirmenu(tab1, tab2, tab3, tab4, tab5, tab6,tab7, tab8, tab9, tab10, tab11, tab12,tab13, tab14, tab15, tab16, tab17, tab18,tab19, tab20, tab21,tab22) {
    
			var btn1 = $("#" + tab1).removeClass("active").addClass('active');
            var btn = $("#" + tab2).removeClass("active");
			var btn2 = $("#" + tab3).removeClass("active");
			var btn3 = $("#" + tab4).removeClass("active");
			var btn4 = $("#" + tab5).removeClass("active");
			var btn5 = $("#" + tab6).removeClass("active");
			var btn6 = $("#" + tab7).removeClass("active");
			var btn7 = $("#" + tab8).removeClass("active");
			var btn8 = $("#" + tab9).removeClass("active");
			var btn9 = $("#" + tab10).removeClass("active");
			var btn10 = $("#" + tab11).removeClass("active");
			var btn11 = $("#" + tab12).removeClass("active");
			var btn12 = $("#" + tab13).removeClass("active");
			var btn13 = $("#" + tab14).removeClass("active");
			var btn14 = $("#" + tab15).removeClass("active");
			var btn15 = $("#" + tab16).removeClass("active");
			var btn16 = $("#" + tab17).removeClass("active");
			var btn17 = $("#" + tab18).removeClass("active");
			var btn18 = $("#" + tab19).removeClass("active");
			var btn19 = $("#" + tab20).removeClass("active");
			var btn20 = $("#" + tab21).removeClass("active");
			var btn21 = $("#" + tab22).removeClass("active");
			
    }
</script>

<div ng-controller="MainCtrl">
    <ul class="nav nav-list" data-access-level-admin>
        <li class="active" id="idaccueil">
            <a  ng-href="#/accueil" onclick="ouvrirmenu('idaccueil', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil </span>
            </a>

            <b class="arrow"></b>
        </li>



        <li class="">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-users gray"></i>
                <span class="menu-text"> Gestion des &eacute;l&egrave;ves </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">
                <li class="" id="idhome">
                    <a href="#/home" onclick="ouvrirmenu('idhome', 'idaccueil', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Liste des &eacute;l&egrave;ves
                    </a>

                    <b class="arrow"></b>
                </li>

				<li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        G&eacute;n&eacute;ralit&eacute;
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idfacture">
                            <a  ng-href="#/factures" onclick="ouvrirmenu('idfacture', 'idhome', 'idaccueil','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Factures
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="idrecu">
                            <a  ng-href="#/recues" onclick="ouvrirmenu('idrecu', 'idhome', 'idfacture','idaccueil','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Re&ccedil;us
                            </a>

                            <b class="arrow"></b>
                        </li>
						<li class="" id="idnote">
                            <a  ng-href="#/notes" onclick="ouvrirmenu('idnote', 'idhome', 'idfacture','idrecu','idaccueil','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Notes
                            </a>

                            <b class="arrow"></b>
                        </li>
						<li class="" id="iddevoir">
                            <a  ng-href="#/devoirs" onclick="ouvrirmenu('iddevoir', 'idhome', 'idfacture','idrecu','idnote','idaccueil', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Devoirs
                            </a>

                            <b class="arrow"></b>
                        </li>
						 
                    </ul>
                </li>
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Situation
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idpayement">
                            <a  ng-href="#/liste-payements" onclick="ouvrirmenu('idpayement', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idaccueil','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Etats des payements
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="idimpaye">
                            <a  ng-href="#/factures-impayees" onclick="ouvrirmenu('idimpaye', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idaccueil','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Factures Impay&eacute;es
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                
				
				
                  <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Edition et Saisie
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idfichepre">
                    <a href="#/fiche-presence" onclick="ouvrirmenu('idfichepre', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idaccueil','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fiche pr&eacute;sence
                    </a>

                    <b class="arrow"></b>
                </li>
                       <li class="" id="idfichenote">
                    <a href="#/fiche-notes" onclick="ouvrirmenu('idfichenote', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idaccueil','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fiche notes
                    </a>

                    <b class="arrow"></b>
                </li>
                    </ul>
                </li>
                
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Plus
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idrecherche">
                            <a  ng-href="#/recherche" onclick="ouvrirmenu('idrecherche', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idaccueil','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Recherche rapide
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="iddesistemnt">
                            <a  ng-href="#/list-desistement" onclick="ouvrirmenu('iddesistemnt', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','idaccueil','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Archives
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>

        </li>

        <li class="" id="idtarif">
            <a  ng-href="#/tarif" onclick="ouvrirmenu('idtarif', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idaccueil','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-credit-card gray "></i>
                <span class="menu-text"> Tarifs </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="" id="divers">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-cloud gray"></i>
                <span class="menu-text">Divers </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">

                <li class="" id="idtransport">
                    <a  ng-href="#/transport" onclick="ouvrirmenu('idtransport', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idaccueil','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Transport
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="" id="idsport">
                    <a  ng-href="#/sport" onclick="ouvrirmenu('idsport', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idaccueil','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Sport
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="" id="idtenue">
                    <a  ng-href="#/tenue" onclick="ouvrirmenu('idtenue', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idaccueil','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Tenue
                    </a>

                    <b class="arrow"></b>
                </li>
 

            </ul>
        </li>
        <li class="" id="idmatiere">
            <a  ng-href="#/matiere" onclick="ouvrirmenu('idmatiere', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idaccueil','idinscription','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-tachometer gray"></i>
                <span class="menu-text"> Disciplines </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="" id="idinscription">
            <a  ng-href="#/inscription/add" onclick="ouvrirmenu('idinscription', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idaccueil','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-plus-circle gray"></i>
                <span class="menu-text"> Inscription </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-pencil-square-o gray"></i>
                <span class="menu-text"> Administrateur </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">

                <li class="" id="idlisteuser">
                    <a href="#/utilisateurs" onclick="ouvrirmenu('idlisteuser', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idaccueil','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Liste des utilisateurs
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        <li class="" id="idclasse">
            <a  ng-href="#/classe" onclick="ouvrirmenu('idclasse', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idaccueil','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa 	fa-book gray"></i>
                <span class="menu-text"> Classe </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="" id="idemploi">
            <a  ng-href="#/edt" onclick="ouvrirmenu('idemploi', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idaccueil','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>
        

		<li class="" id="idcontact" ng-hide="true">
            <a  ng-href="#/contact" onclick="ouvrirmenu('idcontact','idemploi', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idaccueil')">
                <i class="menu-icon fa fa-comment gray "></i>
                <span class="menu-text"> Contact </span>
            </a>

            <b class="arrow"></b>
        </li>
        
    </ul>
    <ul class="nav nav-list" data-access-level-parent>
        <li class="active">
            <a  ng-href="#/accueil_parent/{{user.id}}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Liste de mes enfants</span>
            </a>

            <b class="arrow"></b>
        </li>
		<li class="">
            <a  ng-href="#/tarif">
                <i class="menu-icon fa fa-credit-card gray "></i>
                <span class="menu-text"> Tarifs </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a  ng-href="#/edt" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul>

    <ul class="nav nav-list" data-access-level-professeur>
        <li class="active">
            <a  ng-href="#/meseleves/{{user.id}}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Liste de mes eleves</span>
            </a>

            <b class="arrow"></b>
        </li>
		<li class="">
            <a  ng-href="#/tarif">
                <i class="menu-icon fa fa-credit-card gray "></i>
                <span class="menu-text"> Tarifs </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a  ng-href="#/edt" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a  ng-href="#/postdocument">
                <i class="menu-icon fa fa-upload gray"></i>
                <span class="menu-text"> Mes documents </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
                            <a  ng-href="#/devoirs">
                                <i class="menu-icon fa fa-book"></i>
                                Devoirs
                            </a>

                            <b class="arrow"></b>
                        </li>
        
    </ul>
    
       <ul class="nav nav-list" data-access-level-secretaire>
        <li class="active">
            <a  ng-href="#/accueil">
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil </span>
            </a>

            <b class="arrow"></b>
        </li>



        <li class="">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-users gray"></i>
                <span class="menu-text"> Gestion des &eacute;l&egrave;ves </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">
                <li class="">
                    <a href="#/home">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Liste des &eacute;l&egrave;ves
                    </a>

                    <b class="arrow"></b>
                </li>

				<li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        G&eacute;n&eacute;ralit&eacute;
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
						<li class="">
                            <a  ng-href="#/notes">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Notes
                            </a>

                            <b class="arrow"></b>
                        </li>
						<li class="">
                            <a  ng-href="#/devoirs">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Devoirs
                            </a>

                            <b class="arrow"></b>
                        </li>
						 
                    </ul>
                </li>
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Situation
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="">
                            <a  ng-href="#/liste-payements">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Etats des payements
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a  ng-href="#/factures-impayees">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Factures Impay&eacute;es
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                
				
				
                  <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Edition et Saisie
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="">
                    <a href="#/fiche-presence">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fiche pr&eacute;sence
                    </a>

                    <b class="arrow"></b>
                </li>
                       <li class="">
                    <a href="#/fiche-notes">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fiche notes
                    </a>

                    <b class="arrow"></b>
                </li>
                    </ul>
                </li>
                
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Plus
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="">
                            <a  ng-href="#/recherche">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Recherche rapide
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a  ng-href="#/list-desistement">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Archives
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>

        </li>
        <li class="">
            <a  ng-href="#/tarif">
                <i class="menu-icon fa fa-credit-card gray "></i>
                <span class="menu-text"> Tarifs </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-cloud gray"></i>
                <span class="menu-text">Divers </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">

                <li class="">
                    <a  ng-href="#/transport">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Transport
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a  ng-href="#/sport">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Sport
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a  ng-href="#/tenue">
                        <i class="menu-icon fa fa-caret-right gray"></i>
                        Tenue
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="">
            <a  ng-href="#/matiere">
                <i class="menu-icon fa fa-tachometer gray"></i>
                <span class="menu-text"> Mati&egrave;res </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a  ng-href="#/inscription/add" style="font-weight: bold;">
                <i class="menu-icon fa fa-plus-circle gray"></i>
                <span class="menu-text"> Inscription </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="">
            <a  ng-href="#/classe" style="font-weight: bold;">
                <i class="menu-icon fa 	fa-book gray"></i>
                <span class="menu-text"> Classe </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a  ng-href="#/edt" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>

    </ul>
    
    
     <ul class="nav nav-list" data-access-level-etudiant>
          <li class="">
            <a  ng-href="#/edt" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul>
    <ul class="nav nav-list" data-access-level-caisse>
        <li class="active" id="idaccueil">
            <a  ng-href="#/accueil" onclick="ouvrirmenu('idaccueil', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil </span>
            </a>

            <b class="arrow"></b>
        </li>



        <li class="">
            <a class="dropdown-toggle" href="#" style="font-weight: bold;">
                <i class="menu-icon fa fa-users gray"></i>
                <span class="menu-text"> Gestion des &eacute;l&egrave;ves </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">
                <li class="" id="idhome">
                    <a href="#/home" onclick="ouvrirmenu('idhome', 'idaccueil', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Liste des &eacute;l&egrave;ves
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        G&eacute;n&eacute;ralit&eacute;
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idfacture">
                            <a  ng-href="#/factures" onclick="ouvrirmenu('idfacture', 'idhome', 'idaccueil','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Factures
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="idrecu">
                            <a  ng-href="#/recues" onclick="ouvrirmenu('idrecu', 'idhome', 'idfacture','idaccueil','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Re&ccedil;us
                            </a>

                            <b class="arrow"></b>
                        </li>
                     
                    </ul>
                </li>
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Situation
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idpayement">
                            <a  ng-href="#/liste-payements" onclick="ouvrirmenu('idpayement', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idaccueil','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Etats des payements
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="idimpaye">
                            <a  ng-href="#/factures-impayees" onclick="ouvrirmenu('idimpaye', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idaccueil','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Factures Impay&eacute;es
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                
                
                
                
                <li class="">
                    <a class="dropdown-toggle" href="#" style="color: blue;">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Plus
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-show" style="display: block;">
                        <li class="" id="idrecherche">
                            <a  ng-href="#/recherche" onclick="ouvrirmenu('idrecherche', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idaccueil','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Recherche rapide
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="" id="iddesistemnt">
                            <a  ng-href="#/list-desistement" onclick="ouvrirmenu('iddesistemnt', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','idaccueil','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Archives
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>

        </li>

        <li class="" id="idtarif">
            <a  ng-href="#/tarif" onclick="ouvrirmenu('idtarif', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idaccueil','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-credit-card gray "></i>
                <span class="menu-text"> Tarifs </span>
            </a>

            <b class="arrow"></b>
        </li>
       
    

        <li class="" id="idemploi">
            <a  ng-href="#/edt" onclick="ouvrirmenu('idemploi', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idaccueil','idcontact')" style="font-weight: bold;">
                <i class="menu-icon fa fa-calendar gray"></i>
                <span class="menu-text"> Emploi du temps </span>
            </a>

            <b class="arrow"></b>
        </li>
        
    </ul>
  
</div>
<!-- /.nav-list -->

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left"
       data-icon1="ace-icon fa fa-angle-double-left"
       data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'collapsed')
    } catch (e) {
    }
</script>
