<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class DevManager extends BDManager {

    public function getDevsEleveByMatiere($numero_eleve, $matiere, $annee_scolaire) {
        $reponse = $this->executeList("SELECT d.id_devoir,de.id as id_devoir_eleve , d.id_matiere,d.annee_scolaire,de.numero_eleve,"
                . " DATE_FORMAT(d.date,'%d/%m') as date,DATE_FORMAT(d.date_rendu,'%d/%m/%Y') as date_rendu,d.details,d.title,de.appreciation FROM devoir d , devoir_eleves de where  "
                . " d.id_devoir = de.id_devoir and d.annee_scolaire='$annee_scolaire' and de.numero_eleve='$numero_eleve' and d.id_matiere ='$matiere'");
        return $reponse;
    }

    public function getDevsClasseByMatiere($id_classe, $matiere, $annee_scolaire) {
        $reponse = $this->executeList("SELECT d.id_devoir,d.id_matiere,d.annee_scolaire,d.id_classe,"
                . " DATE_FORMAT(d.date,'%d/%m') as date,DATE_FORMAT(d.date_rendu,'%d/%m/%Y') as date_rendu,d.details,d.title FROM devoir d  where  "
                . "  d.annee_scolaire='$annee_scolaire' and d.id_classe='$id_classe' and d.id_matiere ='$matiere'");
        return $reponse;
    }

    public function addAllDev() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $stm = $this->getPdo()->prepare("Insert into devoir (id_matiere, details,id_classe,title,date,date_rendu,annee_scolaire) "
                . "values (:id_matiere,:details,:id_classe,:title,:dateatt,:daterenduatt,:annee_scolaire)");
        $stm->bindParam(":id_matiere", $request->id_matiere);
        $stm->bindParam(":details", $request->details);
        $stm->bindParam(":id_classe", $request->id_classe);
        $stm->bindParam(":title", $request->title);
        $date = $request->date;
        $date_explode = explode("/", $date);
        $dateatt = $date_explode[2] . '-' . $date_explode[1] . '-' . $date_explode[0];
        $stm->bindParam(":dateatt", $dateatt);
        $date_rendu = $request->date_rendu;
        $date_rendu_explode = explode("/", $date_rendu);
        $daterenduatt = $date_rendu_explode[2] . '-' . $date_rendu_explode[1] . '-' . $date_rendu_explode[0];
        $stm->bindParam(":daterenduatt", $daterenduatt);
        $stm->bindParam(":annee_scolaire", $request->annee_scolaire);
        $stm->execute();


        $numero_eleves = $request->numero_eleves;

        $index = 0;
        for ($index; $index < count($numero_eleves); $index++) {
            $numero_eleve = $numero_eleves[$index]->numero_eleve;
            $id_devoir = $this->GetLastDev()[0]['id_devoir'];
            $stmPrim = $this->getPdo()->prepare("Insert into devoir_eleves (id_devoir,numero_eleve)  "
                    . "values (:id_devoir,:numero_eleve)");
            $stmPrim->bindParam(":id_devoir", $id_devoir);
            $stmPrim->bindParam(":numero_eleve", $numero_eleve);
            $stmPrim->execute();
        }
    }

    public function modDev() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $stm = $this->getPdo()->prepare("Update devoir set details=:details , title =:title ,  date=:dateatt , date_rendu=:daterenduatt "
                . " where id_devoir=:id_devoir");
        $stm->bindParam(":details", $request->details);
        $stm->bindParam(":id_devoir", $request->id_devoir);
        $stm->bindParam(":title", $request->title);
        $date = $request->date;
        $date_explode = explode("/", $date);
        $dateatt = $date_explode[2] . '-' . $date_explode[1] . '-' . $date_explode[0];
        $stm->bindParam(":dateatt", $dateatt);
        $date_rendu = $request->date_rendu;
        $date_rendu_explode = explode("/", $date_rendu);
        $daterenduatt = $date_rendu_explode[2] . '-' . $date_rendu_explode[1] . '-' . $date_rendu_explode[0];
        $stm->bindParam(":daterenduatt", $daterenduatt);
        $stm->execute();
    }

    public function modDevDev() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $appreciation = $request->appreciation;
        $id = $request->id_devoir_eleve;

        $this->executeUpdate("Update devoir_eleves set appreciation='$appreciation' where id='$id'");
    }

    public function getDevByDev($numero_eleve, $matiere, $dev, $annee_scolaire) {
        $reponse = $this->executeList("SELECT d.id_devoir,de.id as id_devoir_eleve,d.id_matiere,d.annee_scolaire,de.numero_eleve,"
                . " DATE_FORMAT(d.date,'%d/%m/%Y') as date,DATE_FORMAT(d.date_rendu,'%d/%m/%Y') as date_rendu,d.details,d.title,de.appreciation FROM devoir d ,devoir_eleves de where  "
                . " de.id_devoir = d.id_devoir and d.annee_scolaire='$annee_scolaire' and de.numero_eleve='$numero_eleve' and d.id_matiere ='$matiere' and de.id='$dev'");

        return $reponse;
    }

    public function getDevByDevClasse($id_classe, $matiere, $dev, $annee_scolaire) {
        $reponse = $this->executeList("SELECT d.id_devoir,d.id_matiere,d.annee_scolaire,d.id_classe,"
                . " DATE_FORMAT(d.date,'%d/%m/%Y') as date,DATE_FORMAT(d.date_rendu,'%d/%m/%Y') as date_rendu,d.details,d.title FROM devoir d  where  "
                . " d.annee_scolaire='$annee_scolaire' and d.id_classe='$id_classe' and d.id_matiere ='$matiere' and d.id_devoir='$dev'");

        return $reponse;
    }

    public function DeleteDev($iddev) {

        $reponse = $this->executeList("DELETE FROM devoir WHERE id_devoir = '$iddev'");
        return $reponse;
    }

    public function GetLastDev() {
        $reponse = $this->executeList("SELECT max(id_devoir) as id_devoir FROM devoir");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new DevManager)
        ->addGetRoute('getDevsEleveByMatiere', 'getDevsEleveByMatiere')
        ->addGetRoute('getDevsClasseByMatiere', 'getDevsClasseByMatiere')
        ->addGetRoute('getDevByDev', 'getDevByDev')
        ->addGetRoute('GetLastDev', 'GetLastDev')
        ->addGetRoute('DeleteDev/(.*)', 'DeleteDev')
        ->addPostRoute('modDev', 'modDev')
        ->addPostRoute('modDevDev', 'modDevDev')
        ->addGetRoute('getDevByDevClasse', 'getDevByDevClasse')
        ->addPostRoute('addAllDev', 'addAllDev')
        ->run();
