<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
// require_once("entities/ClassEleve.php");
header("Access-Control-Allow-Origin: *");

class LoginManager extends BDManager {


     public function getAnneeEncours() {
        $reponse = $this->executeList("SELECT CASE    
		WHEN month(now()) >=1 and month(now()) <10	THEN  CONCAT(Year(now())-1, '-',  Year(now()))
        WHEN month(now()) >=10 and month(now()) <=12 THEN  CONCAT(Year(now()), '-',  Year(now())+1)  
        END as annee_en_cours
        FROM DUAL");
        return $reponse;
    }


    public function getUsersAll() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id");
        return $reponse;
    }

    public function getUsers() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and utilisateur.profile_id != 2 and utilisateur.profile_id != 5 limit 8");
        return $reponse;
    }
	
	public function getAllUsers() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and utilisateur.profile_id != 2 and utilisateur.profile_id != 5");
        return $reponse;
    }

    public function getUserById($userId) {
        $reponse = $this->executeList("SELECT utilisateur.*, profil.code_profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and "
                . "utilisateur.id= '$userId'");


        return $reponse;
    }

    public function postLogin($login, $password) {
        $reponse = $this->executeList("SELECT u.*,p.id as id_profil, p.code_profil FROM utilisateur u  ,  profil p where p.id =  u.profile_id and 
                                         u.login='$login' and u.password='$password'");
        return $reponse;
    }

    public function updateUser($id) {
        $this->executeUpdate("Update utilisateur set status='ON' where id='$id'");
    }

    public function updateUserDeconnect($id) {
        $this->executeUpdate("Update utilisateur set status='OFF' where id='$id'");
    }

    public function getProfesseurs() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and utilisateur.profile_id = 4");
        return $reponse;
    }

    public function getProfils() {
        $reponse = $this->executeList("SELECT * FROM profil where  id != 2");
        return $reponse;
    }

    public function addUser() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nomAvatar = $request->name;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
        $telephone = $request->telephone;
        $profil = $request->id_profil;


        $this->executeUpdate("Insert into utilisateur (nom, prenom,email,adresse,telephone,profile_id,password,avatar,login) values ( '$nom', '$prenom', '$email', '$adresse', '$telephone', '$profil','passer1','$nomAvatar','$telephone')");
    }

    public function modUser() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        $nomAvatar = $request->name;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
        $telephone = $request->telephone;
        $profil = $request->id_profil;

        $this->executeUpdate("Update utilisateur set nom='$nom', prenom='$prenom', email='$email',adresse='$adresse',telephone='$telephone',profile_id='$profil',avatar ='$nomAvatar' where id='$id'");
    }
	
	public function changePasswordUser($password,$id) {
        $this->executeUpdate("Update utilisateur set password='$password' where id='$id'");
    }

	

}

use RestService\Server;

Server::create('/', new LoginManager)
        ->addPostRoute('addUser', 'addUser')
        ->addPostRoute('modUser', 'modUser')
        ->addGetRoute('updateUser/(.*)', 'updateUser')
	->addGetRoute('changePasswordUser', 'changePasswordUser')
        ->addGetRoute('updateUserDeconnect/(.*)', 'updateUserDeconnect')
        ->addGetRoute('getUsers', 'getUsers')
	->addGetRoute('getAllUsers', 'getAllUsers')
        ->addGetRoute('getUsersAll', 'getUsersAll')
        ->addGetRoute('getUserById/(.*)', 'getUserById')
        ->addGetRoute('login', 'postLogin')
        ->addGetRoute('getProfesseurs', 'getProfesseurs')
        ->addGetRoute('getProfils', 'getProfils')
		 ->addGetRoute('getAnneeEncours', 'getAnneeEncours')
        ->run();
