<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class DispenseManager extends BDManager {

    public function ListDispense() {
        $reponse = $this->executeList("SELECT * FROM dispense");
        return $reponse;
    }

    public function getMatieresByCodeClasse($id_classe) {
        $reponse = $this->executeList("SELECT matiere.*, dispense.id_professeur, u.avatar as avatarprof  FROM dispense,matiere,classe,utilisateur u 
			where u.id = dispense.id_professeur and  dispense.id_matiere= matiere.id_matiere
			and classe.id_classe=dispense.id_classe and classe.id_classe='$id_classe' and matiere.archive=0 group by matiere.id_matiere 
                     order by matiere.id_matiere DESC");
        return $reponse;
    }

    public function AddDispense() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->id_matiere;
        $id_classe = $request->id_classe;

        $this->executeUpdate("Insert into dispense(id_classe, id_matiere) values ('$id_classe', '$id_matiere')");
    }

    public function UpdateDispense() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $code_matiere = $request->code_matiere;
        $code_classe = $request->classe;

        $this->executeUpdate("Update dispense set code_matiere='$code_matiere',code_classe='$code_classe' where code_matiere ='$code_matiere'");
    }

}

use RestService\Server;

Server::create('/', new DispenseManager)
        ->addGetRoute('ListDispense', 'ListDispense')
        ->addGetRoute('getMatieresByCodeClasse/(.*)', 'getMatieresByCodeClasse')
        ->addPostRoute('AddDispense', 'AddDispense')
        ->addPostRoute('UpdateDispense', 'UpdateDispense')
        ->run();
