<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<div class="breadcrumbs" id="breadcrumbs">

    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a
                ui-sref="accueil">Accueil</a>&nbsp;&nbsp;<i class="ace-icon fa fa-angle-double-right"></i>&nbsp;&nbsp;<a
                ui-sref="reception">Messagerie</a></li>
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
<div class="page-content" ng-controller="ReceptionCtrl">
    <!-- /section:settings.box -->
    <div class="page-header">
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- #section:pages/inbox -->
                    <div class="tabbable">
                        <ul class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1" id="inbox-tabs">
                            <!-- #section:pages/inbox.compose-btn -->
                            <li class="li-new-mail pull-right">
                                <a class="btn-new-mail" data-target="write"  data-toggle="tab">
                                    <span class="btn btn-purple no-border">
                                        <i class="ace-icon fa fa-envelope bigger-130"></i>
                                        <span class="bigger-110">Nouveau</span>
                                    </span>
                                </a>
                            </li><!-- /.li-new-mail -->

                            <!-- /section:pages/inbox.compose-btn -->
                            <li  class="reception active">
                                <a data-target="inbox" href="#" data-toggle="tab" >
                                    <i class="blue ace-icon fa fa-inbox bigger-130"></i>
                                    <span class="bigger-110">Boite de r&eacute;ception</span>
                                </a>
                            </li>

                            <li class="sent">
                                <a data-target="sent" href="#" data-toggle="tab">
                                    <i class="orange ace-icon fa fa-location-arrow bigger-130"></i>
                                    <span class="bigger-110">Envoy&eacute;s</span>
                                </a>
                            </li>

                            <li class="draft">
                                <a data-target="draft" href="#" data-toggle="tab">
                                    <i class="pink ace-icon fa fa-tags bigger-130"></i>

                                    <span class="bigger-110">Archiv&eacute;s</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content no-border no-padding">
                            <div class="tab-pane in active" id="inbox">
                                <div class="message-container">
                                    <!-- #section:pages/inbox.navbar -->
                                    <div class="message-navbar clearfix" id="id-message-list-navbar">
                                        <div class="message-bar">
                                            <div id="id-message-infobar" class="message-infobar">
                                                <span class="blue bigger-150">R&eacute;ception</span>
                                                <span class="grey bigger-110">({{nbrnonlue}} messages non-lus)</span>
                                            </div>

                                        </div>

                                        
                                    </div>
                                    <div class="hide message-navbar clearfix" id="id-message-list-navbarArchive">
                                        <div class="message-bar">
                                            <div id="id-message-infobar" class="message-infobar">
                                                <span class="blue bigger-150">Archivage</span>
                                                <span class="grey bigger-110">({{nbrarchive}})</span>
                                            </div>
                                        </div>

                                        <div>
                                        
                                           

                                            <!-- /section:pages/inbox.navbar-search -->
                                        </div>
                                    </div>

                                    <div class="hide message-navbar clearfix" id="id-message-list-navbarSent">
                                        <div class="message-bar">
                                            <div id="id-message-infobar" class="message-infobar">
                                                <span class="blue bigger-150">Messages envoy&eacute;s</span>
                                                <span class="grey bigger-110">({{nbrenvoye}} )</span>
                                            </div>

                                        </div>

                                      
                                    </div>

                                    <div class="hide message-navbar clearfix" id="id-message-item-navbar">
                                        <div class="message-bar">
                                            <div class="message-toolbar">



                                            </div>
                                        </div>

                                        <div>
                                            <div class="messagebar-item-left">
                                                <a class="btn-back-message-list" href="#">
                                                    <i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
                                                    <b class="bigger-110 middle">Retour</b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hide message-navbar clearfix" id="id-message-new-navbar">
                                        <div class="message-bar">
                                            <div class="message-toolbar">
                                                <button class="btn-back-message-list btn btn-xs btn-white btn-primary" type="button">
                                                    <i class="ace-icon fa fa-times bigger-125 orange2"></i>
                                                    <span class="bigger-110">Annuler</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="messagebar-item-left">
                                                <a class="btn-back-message-list" href="#" >
                                                    <i class="ace-icon fa fa-arrow-left bigger-110 middle blue"></i>
                                                    <b class="middle bigger-110">Retour</b>
                                                </a>
                                            </div>

                                            <div class="messagebar-item-right">
                                                <span class="inline btn-send-message">
                                                    <button class="btn btn-sm btn-primary no-border btn-white btn-round" type="button" ng-click="sendMessage()">
                                                        <span class="bigger-110">Envoyer</span>

                                                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /section:pages/inbox.navbar -->
                                    <div class="message-list-container">
                                        <!-- #section:pages/inbox.message-list -->
                                        <div id="message-list" class="message-list">
                                            <!-- #section:pages/inbox.message-list.item -->
                                            <div class="message-item" ng-class="'message-item ' + message.lu" ng-repeat="message in messages">
                                                <div class="row"> 
                                                    <div class="action-buttons col-sm-2">
                                                    <a href="#" ng-click="archiverMessage($index,message,'rec')"  title="Archiver">
                                                        <i class="ace-icon fa fa-folder-open orange icon-only bigger-130"></i>
                                                    </a>

                                                    <a href="#" ng-click="replyMessage(message)" title="R&eacute;pondre">
                                                        <i class="ace-icon fa fa-mail-forward blue icon-only bigger-130"></i>
                                                    </a>
                                                         <a href="#" ng-click="SupprMessage($index,message,'rec')" title="Supprimer">
                                                        <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
                                                    </a>
                                                </div>  
                                                <div class="col-sm-9">
												<div class="row">
												<div class="col-md-1">
                                                <span class="sender" style="cursor:auto;">{{message.nom_sender}}</span>
                                                 </div>
												 <div class="col-md-3"></div>
												 <div class="col-md-3">
                                                <span class="summary">
                                                    <span class="text" ng-click="load(message,'default','rec')">
                                                        {{message.objet}}&nbsp;&nbsp;<i class="ace-icon fa fa-paperclip bigger-110 orange middle" ng-if="message.attachement != '' || message.attachement != NULL"></i>
                                                    </span>
													
                                                </span>
                                                 </div>
												 <div class="col-md-3"></div>
                                                 <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                                <span class="timee">{{message.date_message}}</span>
												
                                                </div></div></div> 

                                              </div>        

                                            <!-- /section:pages/inbox.message-list.item -->
                                        </div>

                                        <!-- /section:pages/inbox.message-list -->
                                    </div>

                                    <div class="message-list-container">

                                        <div id="message-list-archive" class="hide message-list">
                                            <!-- #section:pages/inbox.message-list.item -->
                                            <div class="message-item" class="message-item message-read" ng-repeat="message in messagesArchives">
                                                <div class="row"> 
                                                    <div class="action-buttons col-sm-2">
                                                    <a href="#" ng-click="SupprMessage($index,message,'arch')" >
                                                        <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
                                                    </a>
                                                </div>  
                                                <div class="col-sm-7">
                                                <span class="sender" style="cursor:auto">{{message.nom_receiver}}</span>

                                                <span class="summary">
                                                    <span class="text" ng-click="load(message,'default','arch')">
                                                        {{message.objet}}
                                                    </span>
                                                </span>
                                                
                                                 <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                                <span class="timee">{{message.date_message}}</span>
                                                </div></div> 
                                            <!-- /section:pages/inbox.message-list.item -->
                                        </div>
                                    </div>

                                </div>
                                    <div class="message-list-container">

                                        <div id="message-list-sent" class="hide message-list">
                                            <!-- #section:pages/inbox.message-list.item -->
                                            <div class="message-item" class="message-item message-read" ng-repeat="message in messagesSent">
                                                <div class="row"> 
                                                    <div class="action-buttons col-sm-2">
                                                    <a href="#" ng-click="archiverMessage($index,message,'sent')" >
                                                        <i class="ace-icon fa fa-folder-open orange icon-only bigger-130"></i>
                                                    </a>

                                                    <a href="#" ng-click="replyMessage(message)">
                                                        <i class="ace-icon fa fa-mail-forward blue icon-only bigger-130"></i>
                                                    </a>
                                                    
                                                     <a href="#" ng-click="SupprMessage($index,message,'sent')" >
                                                        <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
                                                    </a>
                                                </div>  
                                                <div class="col-sm-9">
												<div class="row">
												<div class="col-md-1">
                                                <span class="sender" style="cursor:auto;">{{message.nom_receiver}}</span>
                                                 </div> 
												 <div class="col-sm-3"></div>
												 <div class="col-md-3">
                                                <span class="summary">
                                                    <span class="text" ng-click="load(message,'default','sent')">
                                                        {{message.objet}}&nbsp;&nbsp;<i class="ace-icon fa fa-paperclip bigger-110 orange middle" ng-if="message.attachement != '' || message.attachement != NULL"></i>
                                                    </span>
                                                </span>
                                                </div>
												<div class="col-md-3"></div>
                                                 <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                                <span class="timee">{{message.date_message}}</span>
                                                </div></div> 

                                              </div>     
                                            <!-- /section:pages/inbox.message-list.item -->
                                        </div>
                                    </div>

                                    <!-- #section:pages/inbox.message-footer -->
                                    <div class="message-footer clearfix">

<!--                                        <div class="pull-right">
                                            <div class="inline middle"> page 1 à 16 </div>

                                            &nbsp; &nbsp;
                                            <ul class="pagination middle">
                                                <li class="disabled">
                                                    <span>
                                                        <i class="ace-icon fa fa-step-backward middle"></i>
                                                    </span>
                                                </li>

                                                <li class="disabled">
                                                    <span>
                                                        <i class="ace-icon fa fa-caret-left bigger-140 middle"></i>
                                                    </span>
                                                </li>

                                                <li>
                                                    <span>
                                                        <input type="text" maxlength="3" value="1">
                                                    </span>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-caret-right bigger-140 middle"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-step-forward middle"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>-->
                                    </div>

                                    <div class="hide message-footer message-footer-style2 clearfix">


                                      
                                    </div>

                                    <!-- /section:pages/inbox.message-footer -->
                                </div>
                            </div>
                           </div>      
                        </div><!-- /.tabbable -->

                        <!-- /section:pages/inbox -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form class="hide form-horizontal message-form col-xs-12"  role="form" enctype="multipart/form-data" id="id-message-form">
                    <!-- #section:pages/inbox.compose -->
                    <div>
                        <div class="form-group" ng-show="user.id_profil !=1">
                                <label for="form-field-recipient" class="col-sm-3 control-label no-padding-right">&Agrave;:</label>

                                <div class="col-sm-9">
                                    <span class="input-icon">
                                        <input type="email" placeholder="CSI Keur Madior" value="CSI Keur Madior" data-value="CSI Keur Madior" id="form-field-recipient" name="recipient"  ng-disabled="true" ng-model="messageSent.destinataire">
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                        <div class="form-group" ng-show="user.id_profil ==1">
                            <label for="form-field-recipient" class="col-sm-3 control-label no-padding-right">Destinataire(s):</label>

                            <div class="col-sm-9">

                                <select multiple="" class="chosen-select tag-input-style form-control" id="form-field-select-4" data-placeholder="Choisir une adresse e-mail..."

                                        ng-model="messageSent.destinataires" >
                                            <?php
                                            $reponse = $bdd->query("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and utilisateur.profile_id = 2");
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="' . $donnees['nom'] . ':' . $donnees['prenom'] . ':' . $donnees['id'] . '" >' . $donnees['prenom'] . ' ' . $donnees['nom'] . '(' . $donnees['email'] . ')' . '</option>';
                                            }
                                            ?>
                                </select>
                            </div>
                        </div>

                        <div class="hr hr-18 dotted"></div>

                        <div class="form-group">
                            <label for="form-field-subject" class="col-sm-3 control-label no-padding-right">Objet:</label>

                            <div class="col-sm-6 col-xs-12">
                                <div class="input-icon block col-xs-12 no-padding">
                                    <input type="text" placeholder="Objet" id="form-field-subject" name="subject" class="col-xs-12" maxlength="100"  ng-model="messageSent.objet">
                                    <i class="ace-icon fa fa-comment-o"></i>
                                </div>
                            </div>
                        </div>

                        <div class="hr hr-18 dotted"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">
                                <span class="inline space-24 hidden-480"></span>
                                Message:
                            </label>

                            <!-- #section:plugins/editor.wysiwyg -->
                            <div class="col-sm-9">
                                <textarea  class="form-textarea" contenteditable="true" placeholder="Tapez votre message" style="width:90%" class="wysiwyg-editor" ng-model="messageSent.message" ></textarea>
                            </div>

                            <!-- /section:plugins/editor.wysiwyg -->
                        </div>

                        <div class="hr hr-18 dotted"></div>

                        <div class="form-group no-margin-bottom">
                            <label class="col-sm-3 control-label no-padding-right">Fichier :</label>

                            <div class="col-sm-9">
                                <div id="form-attachments">
                                </div>
                            </div>
                        </div>

                        <div class="align-right">
                            <button class="btn btn-sm btn-danger" type="button" id="id-add-attachment">
                                <i class="ace-icon fa fa-paperclip bigger-140"></i>
                                Ajout Fichier
                            </button>
                        </div>

                        <div class="space"></div>
                    </div>

                    <!-- /section:pages/inbox.compose -->
                </form>

                <div id="id-message-content" class="hide message-content">
                    <!-- #section:pages/inbox.message-header -->
                    <div class="message-header clearfix">
                        <div class="pull-left">
                            <span class="blue bigger-125 objet"></span>

                            <div class="space-4"></div>

                            <i class="ace-icon fa fa-star orange2"></i>

                            &nbsp;
                            <img width="32" src="assets/avatars/avatar.png" alt="John's Avatar" class="middle">
                            &nbsp;
                            <a class="sender" href="#/profil/{{idsender}}"></a>

                            &nbsp;
                            <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                            <span class="time grey"></span>
                        </div>

                    </div>

                    <!-- /section:pages/inbox.message-header -->
                    <div class="hr hr-double"></div>

                    <!-- #section:pages/inbox.message-body -->
                    <div class="message-body">
                    </div>

                    <!-- /section:pages/inbox.message-body -->
                    <div class="hr hr-double"></div>

                    <!-- #section:pages/inbox.message-attachment -->
                    <div class="message-attachment clearfix">
                        <div class="attachment-title">
                            <span class="blue bolder bigger-110">Fichiers</span>
                            &nbsp;


                            <div class="inline position-relative">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    &nbsp;
                                    <i class="ace-icon fa fa-caret-down bigger-125 middle"></i>
                                </a>

                            </div>
                        </div>

                        &nbsp;
                        <ul class="attachment-list pull-left list-unstyled"> </ul>


                    </div>

                    <!-- /section:pages/inbox.message-attachment -->
                </div><!-- /.message-content -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
