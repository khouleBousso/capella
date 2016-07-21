<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class MatiereManager extends BDManager {

    public function ListMatiere() {
        $reponse = $this->executeList("SELECT * FROM matiere m where m.archive=0  group by  m.id_matiere");
        return $reponse;
    }

    public function DeleteMatiere($id_matiere) {
        $this->executeUpdate("Update matiere set archive=1 WHERE id_matiere = '$id_matiere'");
    }

   public function AddMatiere()
     {	
	
	   $postdata = file_get_contents("php://input");
       $request = json_decode($postdata);
       $code_matiere = $request->code_matiere;
       $professeur = $request->professeur;
       $nom = $request->nom;  
       $coef = $request->coef;	 
	   $id_classe = $request->classe; 	
	    $this->executeUpdate("Insert into matiere(nom, coef , code_matiere) values ('$nom', '$coef', '$code_matiere')");

	   $lastMatiere = $this->GetLastMatiere()[0]['id_matiere'];
	   
	    $this->executeUpdate("Insert into dispense(id_classe, id_matiere,id_professeur,semestre) values ('$id_classe', '$lastMatiere','$professeur',1)");
             $this->executeUpdate("Insert into dispense(id_classe, id_matiere,id_professeur,semestre) values ('$id_classe', '$lastMatiere','$professeur',2)");
	 }


    public function UpdateMatiere() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $code_matiere = $request->code_matiere;
        $nom = $request->nom;
        $coef = $request->coef;
        $professeur = $request->professeur;
        $id_matiere = $request->id_matiere;
        $id_classe = $request->classe;
        $this->executeUpdate("Update matiere set nom='$nom', coef='$coef' ,  code_matiere='$code_matiere' where id_matiere ='$id_matiere'");
        $this->executeUpdate("Update  dispense set id_professeur='$professeur'  where id_matiere ='$id_matiere' and id_classe='$id_classe'");
    }

    public function GetMatiere($matiere_id) {
        $reponse = $this->executeList("SELECT matiere.* ,dispense.id_classe,dispense.id_professeur as professeur"
                . " FROM matiere,dispense where dispense.id_matiere = matiere.id_matiere and matiere.id_matiere='$matiere_id' group by matiere.id_matiere");
        return $reponse;
    }

    public function GetLastMatiere() {
        $reponse = $this->executeList("SELECT max(id_matiere) as id_matiere FROM matiere");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new MatiereManager)
        ->addGetRoute('ListMatiere', 'ListMatiere')
        ->addGetRoute('DeleteMatiere/(.*)', 'DeleteMatiere')
        ->addPostRoute('AddMatiere', 'AddMatiere')
        ->addGetRoute('GetMatiere/(.*)', 'GetMatiere')
        ->addGetRoute('GetLastMatiere', 'GetLastMatiere')
        ->addPostRoute('UpdateMatiere', 'UpdateMatiere')
        ->run();
