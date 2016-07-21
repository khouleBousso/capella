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
                                             placeholder="Rechercher ..." class="nav-search-input"te
                                             id="nav-search-input" autocomplete="off" /> <i
                                             class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        </form>
    </div>
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div><br/>
<div class="page-content"  ng-controller="InscriptionCtrl">

    <div class="row" cg-busy="promise">
        <div class="col-md-2">
            <span class="profile-picture" ng-show="eleve.avatar == null || eleve.avatar == ''">
                <img src="public/images/profils/unlogo.jpg" style="width:140px; cursor : pointer;border: solid 2px grey;" id="avatarImg" class="imghover"    ng-click="launch()"/>
            </span>

            <span class="profile-picture" ng-show="eleve.avatar != null && eleve.avatar != ''">
                <img ng-src="rest/avatarEleves/{{eleve.avatar}}" style="width:140px; cursor : pointer; border: solid 2px grey;" id="avatarImg" class="imghover" ng-click="launch()"/>
            </span>


        </div>
        <div class="col-xs-10">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" enctype="multipart/form-data" name="Inscrtiption" ng-submit="ajoutModEleve()" >

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Identit&eacute; et information sur l'&eacute;leve</h4>

                                <div class="widget-toolbar">
                                    <a data-action="collapse" href="#">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> № &eacute;l&egrave;ve </label>
                                        <div class="col-sm-2">
                                            <div class="input-group ol-xs-12 col-sm-12">
                                                <input type="text" id="form-field-mask-1" ng-model="numero_eleve" class="form-control">
                                            </div>
                                        </div>
                                        <label class="col-sm-3 control-label no-padding-right" style="font-size:10px;font-style:italic;font-weight: bold;"> S'il s'agit d'une ré-inscription </label>

                                    </div><br/>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Nom </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.nom" id="nom" class="col-xs-12 col-sm-12" type="text"  placeholder="Nom" required >
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom"> Prenom </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.prenom" id="prenom" class="col-xs-12 col-sm-12" type="text" placeholder="Prenom" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="date_naissance"> N&eacute;(e) le  </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.date_naissance" type="text" id="date_naissance" class="form-control" ui-mask="99/99/9999"  model-view-value="true" ui-mask-placeholder ui-mask-placeholder-char="_" required>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="lieu"> Lieu </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.lieu_naissance" id="lieu" class="col-xs-12 col-sm-12" type="text" placeholder="Lieu" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Sexe</label>

                                        <div class="col-sm-4 form-inline" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="M" name="sexe" ng-model="eleve.civilite" required>
                                                    <span class="lbl"> M-Masculin</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="F" name="sexe" ng-model="eleve.civilite" required>
                                                    <span class="lbl" > F-Feminin</span>
                                                </label>
                                            </div>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="nationalite"> Nationalit&eacute;</label>
                                        <div class="col-sm-6" ng-show="eleve.numero_eleve == null">
                                            <select chosen id="nationalite" data-placeholder="Choisir une nationalite..."  ng-model="eleve.nationalite">
                                                <option value=""></option><option value="France">France </option><option value="Afghanistan">Afghanistan </option><option value="Afrique_Centrale">Afrique_Centrale </option><option value="Afrique_du_sud">Afrique_du_Sud </option><option value="Albanie">Albanie </option><option value="Algerie">Algerie </option><option value="Allemagne">Allemagne </option><option value="Andorre">Andorre </option><option value="Angola">Angola </option><option value="Anguilla">Anguilla </option><option value="Arabie_Saoudite">Arabie_Saoudite </option><option value="Argentine">Argentine </option><option value="Armenie">Armenie </option><option value="Australie">Australie </option><option value="Autriche">Autriche </option><option value="Azerbaidjan">Azerbaidjan </option><option value="Bahamas">Bahamas </option><option value="Bangladesh">Bangladesh </option><option value="Barbade">Barbade </option><option value="Bahrein">Bahrein </option><option value="Belgique">Belgique </option><option value="Belize">Belize </option><option value="Benin">Benin </option><option value="Bermudes">Bermudes </option><option value="Bielorussie">Bielorussie </option><option value="Bolivie">Bolivie </option><option value="Botswana">Botswana </option><option value="Bhoutan">Bhoutan </option><option value="Boznie_Herzegovine">Boznie_Herzegovine </option><option value="Bresil">Bresil </option><option value="Brunei">Brunei </option><option value="Bulgarie">Bulgarie </option><option value="Burkina_Faso">Burkina_Faso </option><option value="Burundi">Burundi </option><option value="Caiman">Caiman </option><option value="Cambodge">Cambodge </option><option value="Cameroun">Cameroun </option><option value="Canada">Canada </option><option value="Canaries">Canaries </option><option value="Cap_vert">Cap_Vert </option><option value="Chili">Chili </option><option value="Chine">Chine </option><option value="Chypre">Chypre </option><option value="Colombie">Colombie </option><option value="Comores">Colombie </option><option value="Congo">Congo </option><option value="Congo_democratique">Congo_democratique </option><option value="Cook">Cook </option><option value="Coree_du_Nord">Coree_du_Nord </option><option value="Coree_du_Sud">Coree_du_Sud </option><option value="Costa_Rica">Costa_Rica </option><option value="Cote_d_Ivoire">Côte_d_Ivoire </option><option value="Croatie">Croatie </option><option value="Cuba">Cuba </option><option value="Danemark">Danemark </option><option value="Djibouti">Djibouti </option><option value="Dominique">Dominique </option><option value="Egypte">Egypte </option><option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option><option value="Equateur">Equateur </option><option value="Erythree">Erythree </option><option value="Espagne">Espagne </option><option value="Estonie">Estonie </option><option value="Etats_Unis">Etats_Unis </option><option value="Ethiopie">Ethiopie </option><option value="Falkland">Falkland </option><option value="Feroe">Feroe </option><option value="Fidji">Fidji </option><option value="Finlande">Finlande </option><option value="France">France </option><option value="Gabon">Gabon </option><option value="Gambie">Gambie </option><option value="Georgie">Georgie </option><option value="Ghana">Ghana </option><option value="Gibraltar">Gibraltar </option><option value="Grece">Grece </option><option value="Grenade">Grenade </option><option value="Groenland">Groenland </option><option value="Guadeloupe">Guadeloupe </option><option value="Guam">Guam </option><option value="Guatemala">Guatemala</option><option value="Guernesey">Guernesey </option><option value="Guinee">Guinee </option><option value="Guinee_Bissau">Guinee_Bissau </option><option value="Guinee equatoriale">Guinee_Equatoriale </option><option value="Guyana">Guyana </option><option value="Guyane_Francaise ">Guyane_Francaise </option><option value="Haiti">Haiti </option><option value="Hawaii">Hawaii </option><option value="Honduras">Honduras </option><option value="Hong_Kong">Hong_Kong </option><option value="Hongrie">Hongrie </option><option value="Inde">Inde </option><option value="Indonesie">Indonesie </option><option value="Iran">Iran </option><option value="Iraq">Iraq </option><option value="Irlande">Irlande </option><option value="Islande">Islande </option><option value="Israel">Israel </option><option value="Italie">italie </option><option value="Jamaique">Jamaique </option><option value="Jan Mayen">Jan Mayen </option><option value="Japon">Japon </option><option value="Jersey">Jersey </option><option value="Jordanie">Jordanie </option><option value="Kazakhstan">Kazakhstan </option><option value="Kenya">Kenya </option><option value="Kirghizstan">Kirghizistan </option><option value="Kiribati">Kiribati </option><option value="Koweit">Koweit </option><option value="Laos">Laos </option><option value="Lesotho">Lesotho </option><option value="Lettonie">Lettonie </option><option value="Liban">Liban </option><option value="Liberia">Liberia </option><option value="Liechtenstein">Liechtenstein </option><option value="Lituanie">Lituanie </option><option value="Luxembourg">Luxembourg </option><option value="Lybie">Lybie </option><option value="Macao">Macao </option><option value="Macedoine">Macedoine </option><option value="Madagascar">Madagascar </option><option value="Madère">Madère </option><option value="Malaisie">Malaisie </option><option value="Malawi">Malawi </option><option value="Maldives">Maldives </option><option value="Mali">Mali </option><option value="Malte">Malte </option><option value="Man">Man </option><option value="Mariannes du Nord">Mariannes du Nord </option><option value="Maroc">Maroc </option><option value="Marshall">Marshall </option><option value="Martinique">Martinique </option><option value="Maurice">Maurice </option><option value="Mauritanie">Mauritanie </option><option value="Mayotte">Mayotte </option><option value="Mexique">Mexique </option><option value="Micronesie">Micronesie </option><option value="Midway">Midway </option><option value="Moldavie">Moldavie </option><option value="Monaco">Monaco </option><option value="Mongolie">Mongolie </option><option value="Montserrat">Montserrat </option><option value="Mozambique">Mozambique </option><option value="Namibie">Namibie </option><option value="Nauru">Nauru </option><option value="Nepal">Nepal </option><option value="Nicaragua">Nicaragua </option><option value="Niger">Niger </option><option value="Nigeria">Nigeria </option><option value="Niue">Niue </option><option value="Norfolk">Norfolk </option><option value="Norvege">Norvege </option><option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option><option value="Nouvelle_Zelande">Nouvelle_Zelande </option><option value="Oman">Oman </option><option value="Ouganda">Ouganda </option><option value="Ouzbekistan">Ouzbekistan </option><option value="Pakistan">Pakistan </option><option value="Palau">Palau </option><option value="Palestine">Palestine </option><option value="Panama">Panama </option><option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option><option value="Paraguay">Paraguay </option><option value="Pays_Bas">Pays_Bas </option><option value="Perou">Perou </option><option value="Philippines">Philippines </option><option value="Pologne">Pologne </option><option value="Polynesie">Polynesie </option><option value="Porto_Rico">Porto_Rico </option><option value="Portugal">Portugal </option><option value="Qatar">Qatar </option><option value="Republique_Dominicaine">Republique_Dominicaine </option><option value="Republique_Tcheque">Republique_Tcheque </option><option value="Reunion">Reunion </option><option value="Roumanie">Roumanie </option><option value="Royaume_Uni">Royaume_Uni </option><option value="Russie">Russie </option><option value="Rwanda">Rwanda </option><option value="Sahara Occidental">Sahara Occidental </option><option value="Sainte_Lucie">Sainte_Lucie </option><option value="Saint_Marin">Saint_Marin </option><option value="Salomon">Salomon </option><option value="Salvador">Salvador </option><option value="Samoa_Occidentales">Samoa_Occidentales</option><option value="Samoa_Americaine">Samoa_Americaine </option><option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option><option value="Senegal">Senegal </option><option value="Seychelles">Seychelles </option><option value="Sierra Leone">Sierra Leone </option><option value="Singapour">Singapour </option><option value="Slovaquie">Slovaquie </option><option value="Slovenie">Slovenie</option><option value="Somalie">Somalie </option><option value="Soudan">Soudan </option><option value="Sri_Lanka">Sri_Lanka </option><option value="Suede">Suede </option><option value="Suisse">Suisse </option><option value="Surinam">Surinam </option><option value="Swaziland">Swaziland </option><option value="Syrie">Syrie </option><option value="Tadjikistan">Tadjikistan </option><option value="Taiwan">Taiwan </option><option value="Tonga">Tonga </option><option value="Tanzanie">Tanzanie </option><option value="Tchad">Tchad </option><option value="Thailande">Thailande </option><option value="Tibet">Tibet </option><option value="Timor_Oriental">Timor_Oriental </option><option value="Togo">Togo </option><option value="Trinite_et_Tobago">Trinite_et_Tobago </option><option value="Tristan da cunha">Tristan de cuncha </option><option value="Tunisie">Tunisie </option><option value="Turkmenistan">Turmenistan </option><option value="Turquie">Turquie </option><option value="Ukraine">Ukraine </option><option value="Uruguay">Uruguay </option><option value="Vanuatu">Vanuatu </option><option value="Vatican">Vatican </option><option value="Venezuela">Venezuela </option><option value="Vierges_Americaines">Vierges_Americaines </option><option value="Vierges_Britanniques">Vierges_Britanniques </option><option value="Vietnam">Vietnam </option><option value="Wake">Wake </option><option value="Wallis et Futuma">Wallis et Futuma </option><option value="Yemen">Yemen </option><option value="Yougoslavie">Yougoslavie </option><option value="Zambie">Zambie </option><option value="Zimbabwe">Zimbabwe </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" ng-show="eleve.numero_eleve != null">
                                            <select class="form-control" id="form-field-select-3" ng-model="eleve.nationalite">
                                                <option value=""></option><option value="France">France </option><option value="Afghanistan">Afghanistan </option><option value="Afrique_Centrale">Afrique_Centrale </option><option value="Afrique_du_sud">Afrique_du_Sud </option><option value="Albanie">Albanie </option><option value="Algerie">Algerie </option><option value="Allemagne">Allemagne </option><option value="Andorre">Andorre </option><option value="Angola">Angola </option><option value="Anguilla">Anguilla </option><option value="Arabie_Saoudite">Arabie_Saoudite </option><option value="Argentine">Argentine </option><option value="Armenie">Armenie </option><option value="Australie">Australie </option><option value="Autriche">Autriche </option><option value="Azerbaidjan">Azerbaidjan </option><option value="Bahamas">Bahamas </option><option value="Bangladesh">Bangladesh </option><option value="Barbade">Barbade </option><option value="Bahrein">Bahrein </option><option value="Belgique">Belgique </option><option value="Belize">Belize </option><option value="Benin">Benin </option><option value="Bermudes">Bermudes </option><option value="Bielorussie">Bielorussie </option><option value="Bolivie">Bolivie </option><option value="Botswana">Botswana </option><option value="Bhoutan">Bhoutan </option><option value="Boznie_Herzegovine">Boznie_Herzegovine </option><option value="Bresil">Bresil </option><option value="Brunei">Brunei </option><option value="Bulgarie">Bulgarie </option><option value="Burkina_Faso">Burkina_Faso </option><option value="Burundi">Burundi </option><option value="Caiman">Caiman </option><option value="Cambodge">Cambodge </option><option value="Cameroun">Cameroun </option><option value="Canada">Canada </option><option value="Canaries">Canaries </option><option value="Cap_vert">Cap_Vert </option><option value="Chili">Chili </option><option value="Chine">Chine </option><option value="Chypre">Chypre </option><option value="Colombie">Colombie </option><option value="Comores">Colombie </option><option value="Congo">Congo </option><option value="Congo_democratique">Congo_democratique </option><option value="Cook">Cook </option><option value="Coree_du_Nord">Coree_du_Nord </option><option value="Coree_du_Sud">Coree_du_Sud </option><option value="Costa_Rica">Costa_Rica </option><option value="Cote_d_Ivoire">C�te_d_Ivoire </option><option value="Croatie">Croatie </option><option value="Cuba">Cuba </option><option value="Danemark">Danemark </option><option value="Djibouti">Djibouti </option><option value="Dominique">Dominique </option><option value="Egypte">Egypte </option><option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option><option value="Equateur">Equateur </option><option value="Erythree">Erythree </option><option value="Espagne">Espagne </option><option value="Estonie">Estonie </option><option value="Etats_Unis">Etats_Unis </option><option value="Ethiopie">Ethiopie </option><option value="Falkland">Falkland </option><option value="Feroe">Feroe </option><option value="Fidji">Fidji </option><option value="Finlande">Finlande </option><option value="France">France </option><option value="Gabon">Gabon </option><option value="Gambie">Gambie </option><option value="Georgie">Georgie </option><option value="Ghana">Ghana </option><option value="Gibraltar">Gibraltar </option><option value="Grece">Grece </option><option value="Grenade">Grenade </option><option value="Groenland">Groenland </option><option value="Guadeloupe">Guadeloupe </option><option value="Guam">Guam </option><option value="Guatemala">Guatemala</option><option value="Guernesey">Guernesey </option><option value="Guinee">Guinee </option><option value="Guinee_Bissau">Guinee_Bissau </option><option value="Guinee equatoriale">Guinee_Equatoriale </option><option value="Guyana">Guyana </option><option value="Guyane_Francaise ">Guyane_Francaise </option><option value="Haiti">Haiti </option><option value="Hawaii">Hawaii </option><option value="Honduras">Honduras </option><option value="Hong_Kong">Hong_Kong </option><option value="Hongrie">Hongrie </option><option value="Inde">Inde </option><option value="Indonesie">Indonesie </option><option value="Iran">Iran </option><option value="Iraq">Iraq </option><option value="Irlande">Irlande </option><option value="Islande">Islande </option><option value="Israel">Israel </option><option value="Italie">italie </option><option value="Jamaique">Jamaique </option><option value="Jan Mayen">Jan Mayen </option><option value="Japon">Japon </option><option value="Jersey">Jersey </option><option value="Jordanie">Jordanie </option><option value="Kazakhstan">Kazakhstan </option><option value="Kenya">Kenya </option><option value="Kirghizstan">Kirghizistan </option><option value="Kiribati">Kiribati </option><option value="Koweit">Koweit </option><option value="Laos">Laos </option><option value="Lesotho">Lesotho </option><option value="Lettonie">Lettonie </option><option value="Liban">Liban </option><option value="Liberia">Liberia </option><option value="Liechtenstein">Liechtenstein </option><option value="Lituanie">Lituanie </option><option value="Luxembourg">Luxembourg </option><option value="Lybie">Lybie </option><option value="Macao">Macao </option><option value="Macedoine">Macedoine </option><option value="Madagascar">Madagascar </option><option value="Mad�re">Mad�re </option><option value="Malaisie">Malaisie </option><option value="Malawi">Malawi </option><option value="Maldives">Maldives </option><option value="Mali">Mali </option><option value="Malte">Malte </option><option value="Man">Man </option><option value="Mariannes du Nord">Mariannes du Nord </option><option value="Maroc">Maroc </option><option value="Marshall">Marshall </option><option value="Martinique">Martinique </option><option value="Maurice">Maurice </option><option value="Mauritanie">Mauritanie </option><option value="Mayotte">Mayotte </option><option value="Mexique">Mexique </option><option value="Micronesie">Micronesie </option><option value="Midway">Midway </option><option value="Moldavie">Moldavie </option><option value="Monaco">Monaco </option><option value="Mongolie">Mongolie </option><option value="Montserrat">Montserrat </option><option value="Mozambique">Mozambique </option><option value="Namibie">Namibie </option><option value="Nauru">Nauru </option><option value="Nepal">Nepal </option><option value="Nicaragua">Nicaragua </option><option value="Niger">Niger </option><option value="Nigeria">Nigeria </option><option value="Niue">Niue </option><option value="Norfolk">Norfolk </option><option value="Norvege">Norvege </option><option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option><option value="Nouvelle_Zelande">Nouvelle_Zelande </option><option value="Oman">Oman </option><option value="Ouganda">Ouganda </option><option value="Ouzbekistan">Ouzbekistan </option><option value="Pakistan">Pakistan </option><option value="Palau">Palau </option><option value="Palestine">Palestine </option><option value="Panama">Panama </option><option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option><option value="Paraguay">Paraguay </option><option value="Pays_Bas">Pays_Bas </option><option value="Perou">Perou </option><option value="Philippines">Philippines </option><option value="Pologne">Pologne </option><option value="Polynesie">Polynesie </option><option value="Porto_Rico">Porto_Rico </option><option value="Portugal">Portugal </option><option value="Qatar">Qatar </option><option value="Republique_Dominicaine">Republique_Dominicaine </option><option value="Republique_Tcheque">Republique_Tcheque </option><option value="Reunion">Reunion </option><option value="Roumanie">Roumanie </option><option value="Royaume_Uni">Royaume_Uni </option><option value="Russie">Russie </option><option value="Rwanda">Rwanda </option><option value="Sahara Occidental">Sahara Occidental </option><option value="Sainte_Lucie">Sainte_Lucie </option><option value="Saint_Marin">Saint_Marin </option><option value="Salomon">Salomon </option><option value="Salvador">Salvador </option><option value="Samoa_Occidentales">Samoa_Occidentales</option><option value="Samoa_Americaine">Samoa_Americaine </option><option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option><option value="Senegal">Senegal </option><option value="Seychelles">Seychelles </option><option value="Sierra Leone">Sierra Leone </option><option value="Singapour">Singapour </option><option value="Slovaquie">Slovaquie </option><option value="Slovenie">Slovenie</option><option value="Somalie">Somalie </option><option value="Soudan">Soudan </option><option value="Sri_Lanka">Sri_Lanka </option><option value="Suede">Suede </option><option value="Suisse">Suisse </option><option value="Surinam">Surinam </option><option value="Swaziland">Swaziland </option><option value="Syrie">Syrie </option><option value="Tadjikistan">Tadjikistan </option><option value="Taiwan">Taiwan </option><option value="Tonga">Tonga </option><option value="Tanzanie">Tanzanie </option><option value="Tchad">Tchad </option><option value="Thailande">Thailande </option><option value="Tibet">Tibet </option><option value="Timor_Oriental">Timor_Oriental </option><option value="Togo">Togo </option><option value="Trinite_et_Tobago">Trinite_et_Tobago </option><option value="Tristan da cunha">Tristan de cuncha </option><option value="Tunisie">Tunisie </option><option value="Turkmenistan">Turmenistan </option><option value="Turquie">Turquie </option><option value="Ukraine">Ukraine </option><option value="Uruguay">Uruguay </option><option value="Vanuatu">Vanuatu </option><option value="Vatican">Vatican </option><option value="Venezuela">Venezuela </option><option value="Vierges_Americaines">Vierges_Americaines </option><option value="Vierges_Britanniques">Vierges_Britanniques </option><option value="Vietnam">Vietnam </option><option value="Wake">Wake </option><option value="Wallis et Futuma">Wallis et Futuma </option><option value="Yemen">Yemen </option><option value="Yougoslavie">Yougoslavie </option><option value="Zambie">Zambie </option><option value="Zimbabwe">Zimbabwe </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Bourse</label>
                                        <div class="col-sm-4" ng-show="eleve.numero_eleve == null">
                                            <label>
                                                <input   type="checkbox" name="bourse" class="ace ace-switch ace-switch-5" ng-model="eleve.boursier" ng-change="SelonInput()" >
                                                <span class="lbl"></span>
                                            </label>
                                        </div>

                                        <div class="col-sm-4 form-inline" ng-show="eleve.numero_eleve != null" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="OUI" name="bourse" ng-model="eleve.boursier" ng-change="SelonInput()" >
                                                    <span class="lbl"> OUI</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="NON" name="bourse" ng-model="eleve.boursier" ng-change="SelonInput()" >
                                                    <span class="lbl">NON</span>
                                                </label>
                                            </div>
                                        </div>

                                        <label class="col-sm-1 control-label no-padding-right" for="montant_bourse" ng-show="eleve.boursier==true || eleve.boursier == 'OUI'"> Montant </label>
                                        <div class="form-group" id="groupeMontantBourse">
                                            <div class="col-sm-4" >
                                                <input ng-model="eleve.montant_bourse" id="montant_bourse"  name="montant_bourse" ng-change="validateNumber('montant_bourse', 'groupeMontantBourse')" class="col-xs-12 col-sm-12" type="text" placeholder="Montant bourse" ng-show="eleve.boursier==true || eleve.boursier == 'OUI'">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <label class="control-label col-sm-1">Handicap</label>
                                        <div class="col-sm-4" ng-show="eleve.numero_eleve == null">
                                            <label>
                                                <input   type="checkbox" name="handicape" class="ace ace-switch ace-switch-5" ng-model="eleve.handicape" ng-change="SelonInput()" >
                                                <span class="lbl"></span>
                                            </label>
                                        </div>

                                        <div class="col-sm-4 form-inline" ng-show="eleve.numero_eleve != null" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="OUI" name="handicape" ng-model="eleve.handicape" ng-change="SelonInput()" >
                                                    <span class="lbl">OUI</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="NON" name="handicape" ng-model="eleve.handicape" ng-change="SelonInput()" >
                                                    <span class="lbl">NON</span>
                                                </label>
                                            </div>
                                        </div>

                                        <label class="col-sm-1 control-label no-padding-right" for="Descriptif" ng-show="eleve.handicape==true || eleve.handicape == 'OUI'"> Descriptif  </label>
                                        <div class="col-sm-4" ng-show="eleve.handicape ==true || eleve.handicape == 'OUI'">
                                            <textarea placeholder="" ng-model="eleve.type_handicape">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="eleve.numero_eleve == null">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                           <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Dernier &eacute;tablissement frequent&eacute;</h4>

                                <div class="widget-toolbar">
                                    <a data-action="collapse" href="#">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="ancien_etablissement"> Nom </label>
                                        <div class="col-sm-4">
                                        <div class="col-md-12" ng-controller="autocompleteCtrl">
                                                                <autocomplete ng-model="eleve.ancEtab"
                                                                    attr-input-class="form-control"
                                                                    attr-placeholder="Nom &eacute;tablissement""
                                                                    on-type="filtrerEtab" width="70%" cursor="pointer"
                                                                    data="etab"
                                                                    on-select="Getinfo"> </autocomplete>
                                        </div>
                                          <!--  <input ng-model="eleve.ancEtab" id="ancien_etablissement" class="col-xs-12 col-sm-12" type="text" placeholder="Nom &eacute;tablissement"> --> 
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="date_arr_anc">De </label>
                                        <div class="col-sm-2">
                                            <input ng-model="eleve.date_arr_anc" type="text" id="date_arr_anc" class="form-control" ui-mask="99/99/9999"  ui-mask-placeholder ui-mask-placeholder-char="_" model-view-value="true">
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="date_fin_anc"> &agrave; </label>
                                        <div class="col-sm-2">
                                            <input ng-model="eleve.date_fin_anc" type="text" id="date_fin_anc" class="form-control" ui-mask="99/99/9999" ui-mask-placeholder ui-mask-placeholder-char="_" model-view-value="true">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="date_naissance"> Adresse  </label>
                                        <div class="col-sm-4">
                                            <textarea placeholder="Libell&eacute" ng-model="eleve.adresse_dernier_ecole">
                                            </textarea>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="lieu"> R&eacute;gion </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.region_dernier_ecole" id="lieu" class="col-xs-12 col-sm-12" type="text" placeholder="Lieu">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="email"> Email </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.email_dernier_ecole" id="email" class="col-xs-12 col-sm-12" type="email" placeholder="Email" >
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="tel"> T&eacute;l&eacute;phone</label><i class="ace-icon fa fa-phone"></i>
                                        <div class="col-sm-4">

                                            <input ng-model="eleve.telephone_dernier_ecole" id="form-field-mask-2" class="form-control col-xs-12 col-sm-12" type="text" ui-mask="99 999-99-99" model-view-value="true" placeholder="T&eacute;l&egrave;phone" ui-mask-placeholder ui-mask-placeholder-char="_">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Parents / Tuteurs</h4>

                                <div class="widget-toolbar">
                                    <a data-action="collapse" href="#">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="nomtuteur"> Nom </label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.nom" id="nomtuteur" class="col-xs-12 col-sm-12" type="text" placeholder="Nom du tuteur"  >
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenomtuteur"> Prenom </label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.prenom" id="prenomtuteur" class="col-xs-12 col-sm-12" type="text" placeholder="Prenom du tuteur" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="professiontuteur"> Profession</label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.profession_tuteur" id="professiontuteur" class="col-xs-12 col-sm-12" type="text" placeholder="Profession" >
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="societetuteur"> Soci&eacute;t&eacute; :</label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.societe_tuteur" id="societetuteur" class="col-xs-12 col-sm-12" type="text" placeholder="Societe" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="adresse_domicile"> Adresse  </label>
                                        <div class="col-sm-4">
                                            <textarea placeholder="Adresse de domicile"  ng-model="eleve.user.adresse" >
                                            </textarea>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="lieu"> R&eacute;gion </label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.region_tuteur" id="lieu" class="col-xs-12 col-sm-12" type="text" placeholder="Lieu" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="emailtuteur"> Email </label>
                                        <div class="col-sm-4">
                                            <input  ng-model="eleve.user.email" id="emailtuteur" class="col-xs-12 col-sm-12" type="text" placeholder="Email" >
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="teltuteur"> T&eacute;l&egrave;phone</label><i class="ace-icon fa fa-phone"></i>
                                        <div class="col-sm-4">
                                            <input ng-disabled="eleve.numero_eleve != null"  ng-model="eleve.user.telephone" id="form-field-mask-2" class="form-control col-xs-12 col-sm-12"  ui-mask="99 999-99-99" model-view-value="true"  type="text" placeholder="T&eacute;l&egrave;phone du tuteur" ui-mask-placeholder ui-mask-placeholder-char="_" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Qui d&eacute;tient l'autorit&eacute; parentale?</label>

                                        <div class="col-sm-8 form-inline">
                                            <div class="radio" style="margin-right:20px">
                                                <label>
                                                    <input ng-model="eleve.user.autorite_parentale" type="radio" class="ace" value="1" name="gender" >
                                                    <span class="lbl"> Le père / Tuteur</span>
                                                </label>
                                            </div>

                                            <div class="radio" style="margin-right:20px">
                                                <label >
                                                    <input  ng-model="eleve.user.autorite_parentale" type="radio" class="ace" value="2" name="gender" >
                                                    <span class="lbl">La Mère / Tutrice</span>
                                                </label>
                                            </div>
                                            <div class="radio" style="margin-right:20px">
                                                <label >
                                                    <input  ng-model="eleve.user.autorite_parentale" type="radio" class="ace" value="3" ng-model="autresRadio" name="gender" >
                                                    <span class="lbl">Autres</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Dossier d'inscription</h4>

                                <div class="widget-toolbar">
                                    <a data-action="collapse" href="#">
                                        <i class="ace-icon fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="form-group"> 
                                        <label class="control-label col-sm-4"></label>

                                        <div class="col-sm-4 form-inline">
                                            <div class="radio" style="margin-right:20px"  ng-hide="disabledAnnee">
                                                <label>
                                                    <input ng-model="eleve.type_demande" type="radio" class="ace" value="Inscription" name="typedinscritp"  >
                                                    <span class="lbl">Inscription</span>
                                                </label>
                                            </div>

                                            <div class="radio" style="margin-right:20px"  ng-hide="disabledAnnee">
                                                <label >
                                                    <input ng-model="eleve.type_demande" type="radio" class="ace" value="Reinscription" name="typedinscritp" >
                                                    <span class="lbl">R&eacute;inscription</span>
                                                </label>
                                            </div>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="teltuteur"> Ann&eacute;e</label>
                                        <div class="col-sm-2">
                                            <input ng-model="eleve.annee_scolaire"  id="form-field-mask-2" class="form-control col-xs-12 col-sm-12" type="text" ui-mask="9999-9999" placeholder="YYYY-YYYY" ui-mask-placeholder ui-mask-placeholder-char="_" ng-disabled="disabledAnnee" model-view-value="true" required>
                                        </div>
                                    </div><br/><br/>

                                    <div class="form-group" >
                                        <label class="control-label col-sm-1" for="inputOperaton">Classe demand&eacute;</label>

                                        <div class="col-sm-4" ng-controller="ListClasseCtrl">
                                            <select class=" form-control"  id="form-field-select-3" ng-model="eleve.classe_demande" ng-options="clas.id_classe as clas.nom for clas in classes" ng-change="calculMensualiteClasse()">
                                                <option value=""> Choisir une classe</option>
                                               
                                            </select> 
                                        </div>
                                        <div ng-controller="ListTarifCtrl">
                                            <label class="col-sm-1 control-label no-padding-right" for="prenom" ng-show="eleve.type_demande"> Tarif </label>
                                            <div class="col-sm-4" ng-show="eleve.type_demande == 'Inscription'" >
                                                <select  class="form-control"  id="form-field-select-3" ng-model="eleve.tarif" ng-disabled="disabledAnnee" ng-change="calculMensualiteClasse()" 
                                                         ng-options="ta.id_tarif+':'+ta.total as 'Niveau: '+ta.libelle+'  Prix:  '+ta.total for ta in tarifsIns ">
                                                      <option value=""> Choisir un tarif  </option>
                                               </select> 
                                            </div>

                                            <div class="col-sm-4" ng-show="eleve.type_demande == 'Reinscription'">
                                                <select  class="form-control"  id="form-field-select-3"  ng-model="eleve.tarif" ng-disabled="disabledAnnee" ng-change="calculMensualiteClasse()" 
                                                         ng-options="tarifRe.id_tarif+':'+tarifRe.total_re as 'Niveau: &nbsp;'+tarifRe.libelle_re+'&nbsp; &nbsp; Prix: &nbsp;'+tarifRe.total_re for tarifRe in tarifsReIns ">
                                                <option value=""> Choisir un tarif  </option>
                                               </select> 
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Transport</label>
                                    <div class="col-sm-4" ng-show="eleve.numero_eleve == null">
                                            <label>
                                                <input   type="checkbox" name="transport" class="ace ace-switch ace-switch-5" ng-model="eleve.transport" ng-change="SelonInput()">
                                                <span class="lbl"></span>
                                            </label>
                                    </div>
                                    <div class="col-sm-4 form-inline" ng-show="eleve.numero_eleve != null" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="OUI" name="transport" ng-model="eleve.transport" ng-change="SelonInput()">
                                                    <span class="lbl"> OUI</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="NON" name="transport" ng-model="eleve.transport" ng-change="SelonInput()">
                                                    <span class="lbl">NON</span>
                                                </label>
                                            </div>
                                    </div>


                                    </div>
                                    <div ng-controller="ListTransportCtrl">
                                    <div class="form-group" ng-show="eleve.numero_eleve == null && eleve.transport == true" >
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Itineraire</label>
                                        <div class="col-sm-6">
                                            <select chosen id="trajet" data-placeholder="Choisir un Trajet..."  ng-model="eleve.id_transport"
                                                    ng-change="calculMensualiteTransport()" ng-options="trans.code_transport as trans.code_transport for trans in transports ">
                                               <option value=""></option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom" > Tarif </label>
                                        <div class="col-sm-4" >
                                            <input ng-model="eleve.montant_transport" value="0"  id="montant_transport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>

                                   <div class="form-group"  ng-show="eleve.numero_eleve != null && eleve.transport == 'OUI'" >
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Itineraire</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="form-field-select-3" data-placeholder="Choisir un Trajet..."  ng-model="eleve.id_transport"  
                                                    ng-change="calculMensualiteTransport()" ng-options="trans.code_transport as trans.code_transport for trans in transports ">
                                            </select>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom" > Tarif</label>
                                        <div class="col-sm-4" >
                                            <input ng-model="eleve.montant_transport" value="0"  id="montant_transport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>
                                    </div>
                  
                  <div class="form-group">
                                        <label class="control-label col-sm-1">Sport</label>
                                        <div class="col-sm-4" ng-show="eleve.numero_eleve == null">
                                            <label>
                                                <input   type="checkbox" name="sport" class="ace ace-switch ace-switch-5" ng-model="eleve.sport" ng-change="SelonInput()">
                                                <span class="lbl"></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-4 form-inline" ng-show="eleve.numero_eleve != null" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="OUI" name="sport" ng-model="eleve.sport" ng-change="SelonInput()">
                                                    <span class="lbl"> OUI</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="NON" name="sport" ng-model="eleve.sport" ng-change="SelonInput()">
                                                    <span class="lbl">NON</span>
                                                </label>
                                            </div>
                                        </div>


                                    </div>
                                    <div ng-controller="ListSportCtrl">
                                    <div class="form-group" ng-show="eleve.numero_eleve == null && eleve.sport==true">
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Type :</label>
                                        <div class="col-sm-6">
                                            <select  chosen id="sport" data-placeholder="Choisir un Sport..."  ng-model="eleve.type_sport"
                                                    ng-change="calculMensualiteSport()" ng-options="sp.type as sp.type for sp in sports ">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom" > Tarif </label>
                                        <div class="col-sm-4" >
                                            <input ng-model="eleve.frais_sport" value="0" id="montant_sport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>


                                    <div class="form-group" ng-show="eleve.numero_eleve != null && eleve.sport == 'OUI'">
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Type</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="form-field-select-3" data-placeholder="Choisir un Sport..."  ng-model="eleve.type_sport"  
                                                    ng-change="calculMensualiteSport()" ng-options="sp.type as sp.type for sp in sports ">
                                               
                                            </select>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom" > Tarif</label>
                                        <div class="col-sm-4" >
                                            <input ng-model="eleve.frais_sport" value="0" id="montant_sport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Tenue</label>
                                        <div class="col-sm-4" ng-show="eleve.numero_eleve == null">
                                            <label>
                                                <input   type="checkbox" name="tenue" class="ace ace-switch ace-switch-5" ng-model="eleve.tenue" ng-change="SelonInput()">
                                                <span class="lbl"></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-4 form-inline" ng-show="eleve.numero_eleve != null" >
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="ace" value="OUI" name="tenue" ng-model="eleve.tenue" ng-change="SelonInput()">
                                                    <span class="lbl"> OUI</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label >
                                                    <input type="radio" class="ace" value="NON" name="tenue" ng-model="eleve.tenue" ng-change="SelonInput()">
                                                    <span class="lbl">NON</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div ng-controller="ListTenueCtrl">
                                    <div class="form-group" ng-show="eleve.tenue==true && eleve.numero_eleve == null" >
                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Type </label>
                                        <div class="col-sm-5">
                                            <select chosen id="tenue" data-placeholder="Choisir une Tenue..."  
                                                    ng-model="eleve.type_tenue"   ng-options="ten.type_tenue as ten.type_tenue for ten in tenues ">
                                                 <option value=""></option>
                                            </select>
                                        </div>
										<label class="col-sm-1 control-label no-padding-right" for="prenom" >nombre :</label>
                                        <div class="col-sm-1" >
                                            <input ng-model="eleve.nombre" value="0" id="montant_transport" class="col-xs-12 col-sm-12" type="text" ng-change="calculMensualiteTenue()">
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom" > Tarif :</label>
                                        <div class="col-sm-3" >
                                            <input ng-model="eleve.frais_tenue" value="0" id="montant_transport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group" ng-show="eleve.tenue == 'OUI' && eleve.numero_eleve != null" >

                                        <label class="col-sm-1 control-label no-padding-right" for="nom"> Type </label>
                                        <div class="col-sm-6">
                                            <select chosen id="tenue" data-placeholder="Choisir une Tenue..."  ng-model="eleve.type_tenue"  ng-change="calculMensualiteTenue()"
                                                    ng-options="ten.type_tenue as ten.type_tenue for ten in tenues" >
                                            </select>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right" for="prenom"> Tarif </label>
                                        <div class="col-sm-4" >
                                            <input ng-model="eleve.frais_tenue" value="0" id="montant_transport" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>
                                    </div>
                                   </div>         
                                    <div class="form-group" >
                                        <label class="col-sm-1 control-label no-padding-right" for="montant"> Taux de r&eacute;duction </label>
                                        <div class="col-sm-4">
                                            <div class="ace-spinner middle" style="width: 125px;">
                                                <div class="input-group">
                                                    <input ng-model="eleve.taux_reduction" type="text" id="" class="spinbox-input form-control text-center" ng-change="calculTotal()">
                                                    <div class="spinbox-buttons input-group-btn btn-group-vertical">            


                                                    </div></div></div>
                                        </div>
                                        <label class="col-sm-1 control-label no-padding-right">Total </label>
                                        <div class="col-sm-4">
                                            <input ng-model="eleve.montant_du" class="col-xs-12 col-sm-12" type="text" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                 
                <div class="clearfix" style="margin-top : 50px">
                    <div class="col-md-offset-3 col-md-9"  >
                        <input type="submit" value="Valider" class="btn btn-primary submit-button">


                        &nbsp; &nbsp; &nbsp;
                        <button type="reset" class="btn" ng-click="annulerModifEleve()">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Annuler
                        </button>
                    </div>
                </div>
                <input type="file" name="icone" fileavatar="upload.avatar"  id="icone" style="display : none">
            </form>
        </div>
        <modal title="Tuteur" visible="showTuteurExist">
            <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                <p class="alert alert-danger"   style="margin: 5px">Le num&eacute;ro du tuteur {{numTuteurFind}} est d&eacute;ja connu dans la base</p>

                <br/>
                Voulez-vous affecter le tuteur {{prenomTuteurFind}} {{nomTuteurFind}}  &agrave; ce nouvel &eacute;l&egrave;ve ?
                <br/>
            </div>

            <div class="modal-footer">
                <button type="reset" class="btn" ng-click="annulerTuteur()">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Annuler
                </button>

                &nbsp; &nbsp; &nbsp;

                <button type="button" class="btn btn-info" ng-click="confirmTuteur()">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Valider
                </button>
            </div>

        </modal>
        
          <modal title="Dej�  Inscrit" visible="showAnneeExist">
            <div class="modal-content" style="text-align : center ; padding-bottom : 10px">
                <p class="alert alert-danger"   style="margin: 5px">L&apos;élève {{eleve.prenom}} {{eleve.nom}} est dej�  inscrit pour l'année scolaire {{eleve.oldAnneeScolaire}}</p>

                 <br/>
                Veuillez changer svp l'année scolaire.
                <br/>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" ng-click="confirmAnneeScolaire()">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Confirmer
                </button>
            </div>

        </modal>
    </div>
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
        $("#show-option").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });

        // $('#spinner1').ace_spinner({value:0,min:0,max:100,step:5, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
    });
</script>
