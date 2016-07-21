<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
// require_once("entities/ClassEleve.php");
header("Access-Control-Allow-Origin: *");

class MessagerieManager extends BDManager {

    public function AddMessage() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $objet = $request->objet;
        $message = $request->message;
        $nom_sender = $request->nom_sender;
        $nom_receiver = $request->nom_receiver;
        $attachements = "";
        if (isset($request->attachements)) {
            $attachements = $request->attachements;
        }
        $id_sender = $request->id_sender;
        $id_receiver = $request->id_receiver;
        //ADD Messages for receiver and for sender
        $this->executeUpdate("Insert into messagerie (objet, message,date_message, attachement, id_receiver,id_sender,id_owner, nom_sender,nom_receiver,lu) values ( '$objet', '$message',NOW(),'$attachements','$id_receiver','$id_sender','$id_receiver','$nom_sender','$nom_receiver','message-unread')");
        $this->executeUpdate("Insert into messagerie (objet, message,date_message, attachement, id_receiver,id_sender, id_owner,nom_sender,nom_receiver,lu) values ( '$objet', '$message',NOW(),'$attachements','$id_receiver','$id_sender','$id_sender','$nom_sender','$nom_receiver','message-unread')");
    }

    public function AddMessageReplyMultiple() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $objet = $request->objet;
       
        $message = $request->message;
        $noms_receivers = $request->noms_receivers;
        $nom_sender = $request->nom_sender;
        $ids_receivers = $request->ids_receivers;
        $id_sender = $request->id_sender;
        $attachements = "";
        if (isset($request->attachements)) {
            $attachements = $request->attachements;
        }
 
        for ($index = 0; $index < count($noms_receivers); $index++) {
            $id_receiver = $ids_receivers[$index]->id_receiver;
            $nom_receiver = $noms_receivers[$index]->nom_receiver;
            $this->executeUpdate("Insert into messagerie (objet, message,attachement,date_message, id_receiver,id_sender,id_owner, nom_sender,nom_receiver,lu) values ( '$objet', '$message','$attachements',NOW(),'$id_receiver','$id_sender','$id_receiver','$nom_sender','$nom_receiver','message-unread')");
            $this->executeUpdate("Insert into messagerie (objet, message,attachement,date_message, id_receiver,id_sender,id_owner,nom_sender,nom_receiver,lu) values ( '$objet', '$message','$attachements',NOW(),'$id_receiver','$id_sender','$id_sender','$nom_sender','$nom_receiver','message-unread')");
        }
    }

    public function CountTotalMessages($id) {
        $reponse = $this->executeList("SELECT COUNT(*) as count FROM messagerie  where id_receiver = '$id' and id_owner='$id' and  archive=0  and lu='message-unread'");
        return $reponse;
    }

    public function ListMessages($id) {
        $reponse = $this->executeList("SELECT id_messagerie, objet, message, attachement,id_receiver, id_owner, lu, id_sender, nom_sender,nom_archive, nom_receiver, archive, DATE_FORMAT(date_message,'%d %b %Y %h:%i') as date_message FROM messagerie where id_receiver = '$id' and  id_owner='$id'  and  archive=0  order by date_message desc");
        return $reponse;
    }

    public function ListMessagesArchives($id) {
        $reponse = $this->executeList("SELECT id_messagerie, objet, message, attachement,id_receiver, id_owner, lu, id_sender, nom_sender,nom_archive, nom_receiver, archive, DATE_FORMAT(date_message,'%d %b %Y %h:%i') as date_message FROM messagerie where id_owner='$id' and archive=1 order by date_message desc");
        return $reponse;
    }

    public function ListMessagesSent($id) {
        $reponse = $this->executeList("SELECT id_messagerie, objet, message, attachement,id_receiver, id_owner, lu, id_sender, nom_sender,nom_archive, nom_receiver, archive, DATE_FORMAT(date_message,'%d %b %Y %h:%i') as date_message FROM messagerie where id_sender = '$id' and id_owner='$id'   and  archive=0  order by date_message desc");
        return $reponse;
    }

    public function ListMessagesNotif($id) {
        $reponse = $this->executeList("SELECT id_messagerie, objet, message, attachement,id_receiver, id_owner, lu, id_sender, nom_sender,nom_archive, nom_receiver, archive, DATE_FORMAT(date_message,'%d %b %Y %h:%i') as date_message FROM messagerie where  id_receiver = '$id' and  id_owner='$id'  and  archive=0  and lu='message-unread' order by date_message desc");
        return $reponse;
    }

    public function getMessage($id) {
        $reponse = $this->executeList("SELECT id_messagerie, objet, message, attachement,id_receiver, id_owner, lu, id_sender, nom_sender,nom_archive, nom_receiver, archive, DATE_FORMAT(date_message,'%d/%m/%Y %h:%i') as date_message FROM messagerie where id_messagerie='$id'");
        return $reponse;
    }

    public function DeleteMessage() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id_messagerie;
        $this->executeUpdate("Delete from messagerie WHERE id_messagerie = '$id'");
    }

    public function UpdateMessageRead() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id_messagerie;
        $reponse = $this->executeUpdate("UPDATE messagerie set lu='message-read' where id_messagerie='$id'");
        return $reponse;
    }

    public function UpdateMessageArchive() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id_messagerie;
        $nom_archive = $request->nom_archive;
        $reponse = $this->executeUpdate("UPDATE messagerie set archive =1 ,nom_archive='$nom_archive',lu='message-read' where id_messagerie='$id'");
        return $reponse;
    }

    public function CountMessageNonLu($id) {
        $reponse = $this->executeUpdate("SELECT COUNT(*) FROM messagerie where lu ='message-unread' and id_receiver='$id' and archive=0 and id_owner='$id'")->fetchColumn();
        return $reponse;
    }

    public function CountMessageEnvoye($id) {
        $reponse = $this->executeUpdate("SELECT COUNT(*) FROM messagerie where  id_sender='$id' and archive=0 and id_owner='$id'")->fetchColumn();
        return $reponse;
    }

    public function CountMessageArchive($id) {
        $reponse = $this->executeUpdate("SELECT COUNT(*) FROM messagerie where archive=1 and id_owner='$id'")->fetchColumn();
        return $reponse;
    }

    public function ListDestinataires() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and utilisateur.profile_id = 2");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new MessagerieManager)
        ->addPostRoute('AddMessage', 'AddMessage')
        ->addPostRoute('AddMessageReply', 'AddMessageReply')
        ->addPostRoute('AddMessageReplyMultiple', 'AddMessageReplyMultiple')
        ->addPostRoute('UpdateMessageArchive', 'UpdateMessageArchive')
        ->addGetRoute('CountTotalMessages/(.*)', 'CountTotalMessages')
        ->addGetRoute('ListMessages/(.*)', 'ListMessages')
        ->addGetRoute('ListDestinataires', 'ListDestinataires')
        ->addGetRoute('ListMessagesArchives/(.*)', 'ListMessagesArchives')
        ->addGetRoute('ListMessagesSent/(.*)', 'ListMessagesSent')
        ->addGetRoute('CountMessageNonLu/(.*)', 'CountMessageNonLu')
        ->addGetRoute('CountMessageEnvoye/(.*)', 'CountMessageEnvoye')
        ->addGetRoute('CountMessageArchive/(.*)', 'CountMessageArchive')
        ->addGetRoute('ListMessagesNotif/(.*)', 'ListMessagesNotif')
        ->addGetRoute('getMessage/(.*)', 'getMessage')
        ->addPostRoute('DeleteMessage', 'DeleteMessage')
        ->addPostRoute('UpdateMessageRead', 'UpdateMessageRead')
        ->run();
