<div class="navbar navbar-default" id="navbar" ng-controller="HeaderCtrl">
    <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
    </script>

    <div id="navbar-container" class="navbar-container">
        <button data-target="#sidebar" id="menu-toggler" class="navbar-toggle menu-toggler pull-left" type="button">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a class="navbar-brand" ng-href="#/accueil" onclick="ouvrirmenu('idaccueil', 'idhome', 'idfacture','idrecu','idnote','iddevoir', 'idpayement','idimpaye','idfichepre','idfichenote','idrecherche','iddesistemnt','idtarif','idtransport','idsport','idtenue','idmatiere','idinscription','idlisteuser','idclasse','idemploi','idcontact')">
                <small>
                    <i class="fa fa-leaf"></i>
                    Gestion Eleves
                </small>
            </a>
        </div>

        <div role="navigation" class="navbar-buttons navbar-header pull-right" >
            <ul class="nav ace-nav">
            <li class="purple" ng-if="user.id_profil ==1 || user.id_profil ==4">
                                    <a target="_blank" ng-href="chat?inf={{user.nom}};{{user.prenom}};{{user.code_profil}}">
                                        <span><i class="fa fa-weixin bigger-180"></i></span>
                 </a>
               </li>
                <li class="green" ng-if=" user.id_profil == 1 || user.id_profil == 2">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">{{totalmessage}}</span>
                    </a>

                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close" >
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-envelope-o"></i>
                            {{totalmessage}} Messages
                        </li>

                        <li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 200px;">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="message in messages">
                                        <a class="clearfix" ng-click="goToInbox(message)">
                                            <img alt="Alex's Avatar" class="msg-photo" src="assets/avatars/avatar.png">
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    <span class="blue">{{message.nom_sender}}:</span>
                                                    {{message.objet}}  ...
                                                </span>

                                                <span class="msg-time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span>{{message.date_message}}</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </div></li>

                        <li class="dropdown-footer">
                            <a href="#/reception/default">
                                Boite de r&eacute;ception
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="light-blue"  ng-controller="NavCtrl">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="cursor: pointer">
                        <img src="public/images/profils/unlogo.jpg"  ng-show="user.avatar == null || user.avatar == ''"  class="nav-user-photo"/>

                        <img  width="50" height="40" ng-src="rest/avatarUsers/{{user.avatar}}" ng-show="user.avatar != null && user.avatar != ''" class="nav-user-photo"/>

                        <span 
                            class="user-info "> <small>Bienvenue 
                                <span ng-if=" user.nom != null && user.nom != ''">,</span></small><span ng-if=" user.nom != null && user.nom != ''">{{user.nom}}</span>
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#/motdepasse/{{user.id}}">
                                <i class="ace-icon fa fa-cog"></i>
                                Param&egrave;tres
                            </a>
                        </li>

                        <li ng-if=" user.id_profil !=5">
                            <a href="#/profil/{{user.id}}" >
                                <i class="ace-icon fa fa-user"></i>
                                Profil
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="" data-ng-click="logout()">
                                <i class="ace-icon fa fa-power-off"></i>
                                D&eacute;connexion
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>