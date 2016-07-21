<?php

include 'vendor/autoload.php';
// include 'entities/Facture.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class RecuManager extends BDManager {

    public function ListRecuEleves($numero,$annee_scolaire) {
        $reponse = $this->executeList("SELECT r.id_recu, r.genre, r.numero_facture, r.operation, r.libelle, r.versement, DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date_recu, f.code, f.solde FROM recu r ,facture f  where r.numero_facture = f.numero_facture and r.numero_eleve = '$numero' and r.annee_scolaire='$annee_scolaire' and r.archive=0 order by r.id_recu DESC");
        return $reponse;
    }

    public function GetRecu($recu_id) {
        $reponse = $this->executeList("SELECT r.id_recu, r.genre, r.numero_facture, r.operation, r.libelle, r.versement, DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date_recu,facture.solde FROM recu r,facture where r.numero_facture =facture.numero_facture and r.id_recu='$recu_id'");
        return $reponse;
    }

    public function AddRecu() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $libelle = $request->libelle;
        $operation = $request->operation;
        $annee_scolaire = $request->anneeScolaire;
        $versement = $request->versement;
		$genre = $request->genre;
        $numero_eleve = $request->numero_eleve;
        $date_recu = $request->date_recu;
        $date = explode("/", $date_recu);
        $daterecu = $date[2] . '-' . $date[1] . '-' . $date[0];
        $numero_facture = $request->facture->numero_facture;
        $solde = ($request->solde * -1) + $versement;
        $this->executeUpdate("Insert into recu(numero_facture, numero_eleve, operation, libelle,  versement, genre, date_recu,annee_scolaire) values ('$numero_facture','$numero_eleve', '$operation', '$libelle', '$versement','$genre', '$daterecu','$annee_scolaire')");

        $this->executeUpdate("Update facture set solde='$solde' where numero_facture ='$numero_facture'");
    }

    public function UpdateRecu() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $libelle = $request->libelle;
        $operation = $request->operation;
        $numero_facture = $request->numero_facture;
        $versement = $request->versement;
		$genre = $request->genre;
        $date_recu = $request->date_recu;
        $date = explode("/", $date_recu);
        $daterecu = $date[2] . '-' . $date[1] . '-' . $date[0];
        $id_recu = $request->id_recu;
        
		
        $this->executeUpdate("Update recu set libelle='$libelle', operation='$operation', versement='$versement', genre='$genre',date_recu='$daterecu' where id_recu ='$id_recu'");
		$soldefacture = $this->GetSommesoldeFacture($numero_facture)[0]['sommeversement'];
		$montant = $this->GetSommesoldeFacture($numero_facture)[0]['montant'];
		 $solde = $montant-$soldefacture;
		$this->executeUpdate("Update facture set solde='-$solde' where numero_facture ='$numero_facture'");
		

    }

    public function DeleteRecu($numero) {
        $this->executeUpdate("Update recu set archive=1 WHERE id_recu = '$numero'");
    }
	
	 public function GetSommesoldeFacture($numero) {
        $reponse = $this->executeList("SELECT sum(r.versement) as sommeversement, f.montant from recu r, facture f WHERE r.numero_facture=f.numero_facture and r.numero_facture = '$numero' and r.archive=0");
		return $reponse;
    }

}

use RestService\Server;

Server::create('/', new RecuManager)
        ->addGetRoute('ListRecuEleves', 'ListRecuEleves')
        ->addPostRoute('AddRecu', 'AddRecu')
        ->addPostRoute('UpdateRecu', 'UpdateRecu')
        ->addGetRoute('DeleteRecu/(.*)', 'DeleteRecu')
        ->addGetRoute('GetRecu/(.*)', 'GetRecu')
		->addGetRoute('GetSommesoldeFacture/(.*)', 'GetSommesoldeFacture')
        ->run();
