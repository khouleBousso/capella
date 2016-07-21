<?php
if(isset($_POST['valid'])){
$msg_erreur = "Erreur. Les champs suivants doivent �tre obligatoirement remplis :<br/><br/>";
$msg_ok = "Votre demande a bien �t� prise en compte.";
$message = $msg_erreur;
define('MAIL_DESTINATAIRE','lamine.fall@live.fr'); // remplacer par votre email
define('MAIL_SUJET','Message du formulaire: Nouvelle demande de mise � jour ');
 
// v�rification des champs
if (empty($_POST['sexe'])) 
$message .= "Votre civilit�<br/>";
if (empty($_POST['nom'])) 
$message .= "Votre nom<br/>";
if (empty($_POST['prenom'])) 
$message .= "Votre Prenom<br/>";
if (empty($_POST['comments'])) 
$message .= "Votre message<br/>";
 
// si un champ est vide, on affiche le message d'erreur et on stoppe le script
if (strlen($message) > strlen($msg_erreur)) {
   echo $message; die();
}
 
// sinon c'est ok => on continue
foreach($_POST as $index => $valeur) {
  $$index = stripslashes(trim($valeur));
}
 
 
//Pr�paration de l'ent�te du mail:
$mail_entete  = "MIME-Version: 1.0\r\n";
$mail_entete .= "From: {$_POST['nom']} "
             ."<{$_POST['email']}>\r\n";
$mail_entete .= 'Reply-To: '.$_POST['email']."\r\n";
$mail_entete .= 'Content-Type: text/plain; charset="iso-8859-1"';
$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit\r\n";
$mail_entete .= 'X-Mailer:PHP/' . phpversion()."\r\n";
 
// pr�paration du corps du mail
$mail_corps  = "Message de : $sexe$nom\n";
$mail_corps .= $comments;
 
// envoi du mail
if (mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete)) {
  //Le mail est bien exp�di�
  echo $msg_ok;
  header('Location: "#/accueil"');
        
} else {
  //Le mail n'a pas �t� exp�di�
  echo "Une erreur est survenue lors de l'envoi du formulaire par email";
   header('Location: "#/contact"');
        
}
 }
?>