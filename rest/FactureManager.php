<?php

include 'vendor/autoload.php';
// include 'entities/Facture.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class FactureManager extends BDManager {

    public function ListFacturesEleves($numero, $annee_scolaire) {
        $reponse = $this->executeList("SELECT code , numero_facture, description, libelle, montant, DATE_FORMAT(date_payement,'%d/%m/%Y') as datee , solde FROM facture where numero_eleve = '$numero' and archive=0 and annee_scolaire='$annee_scolaire' order by numero_facture DESC");
        return $reponse;
    }

    public function ListImpayes() {
        $reponse = $this->executeList("SELECT f.code, f.numero_facture, e.nom, f.solde from eleves e, facture f where e.numero_eleve= f.numero_eleve and f.solde<0 ");
        return $reponse;
    }

    public function getFactureByCodeClasse($id_classe, $annee_scolaire) {
        $reponse = $this->executeList("SELECT f.code, f.numero_facture, DATE_FORMAT(f.date_payement,'%d/%m/%Y') as date_payement, e.nom, e.prenom, f.libelle, f.solde from eleves e, inscrit i, classe c , "
                . "facture f where e.numero_eleve=i.numero_eleve and c.id_classe=i.id_classe and f.numero_eleve=e.numero_eleve and f.solde<0 and c.id_classe='$id_classe' and f.archive=0 and f.annee_scolaire=i.annee_scolaire and f.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }
	
	public function getAllFacture($annee_scolaire) {
        $reponse = $this->executeList("SELECT f.code, f.numero_facture, DATE_FORMAT(f.date_payement,'%d/%m/%Y') as date_payement, e.nom, e.prenom, f.libelle, f.solde from eleves e, inscrit i,"
                . "facture f where e.numero_eleve=i.numero_eleve and f.numero_eleve=e.numero_eleve and f.solde<0 and f.archive=0 and f.annee_scolaire=i.annee_scolaire and f.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }

    public function getRecuByCodeClasseValuePeriode($id_classe, $annee_scolaire, $valueperiode) {
        $date = explode("-", $valueperiode);
        $start = $date[0];
        $start = str_replace(' ', '', $start);
        $split_date_start = explode("/", $start);
        $date_start = $split_date_start[2] . '-' . $split_date_start[1] . '-' . $split_date_start[0];

        $end = $date[1];
        $end = str_replace(' ', '', $end);
        $split_date_end = explode("/", $end);
        $date_end = $split_date_end[2] . '-' . $split_date_end[1] . '-' . $split_date_end[0];

        $reponse = $this->executeList("SELECT f.code, f.numero_facture, DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date_payement, e.nom, e.prenom, f.libelle, r.versement from eleves e, inscrit i, classe c , facture f , recu r where e.numero_eleve=i.numero_eleve "
                . "and r.numero_facture= f.numero_facture and c.id_classe=i.id_classe and f.numero_eleve=e.numero_eleve and c.id_classe='$id_classe' and f.archive=0 and r.annee_scolaire=i.annee_scolaire and r.date_recu BETWEEN '$date_start' AND '$date_end' and r.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }

    public function getRecuByCodeClasse($id_classe, $annee_scolaire) {
        $reponse = $this->executeList("SELECT f.code, f.numero_facture, DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date_payement, e.nom, e.prenom, f.libelle, r.versement from eleves e, inscrit i, classe c , facture f , recu r where e.numero_eleve=i.numero_eleve "
                . "and r.numero_facture= f.numero_facture and c.id_classe=i.id_classe and f.numero_eleve=e.numero_eleve and c.id_classe='$id_classe' and f.archive=0 and r.annee_scolaire=i.annee_scolaire and r.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }
	  public function getAllRecu($annee_scolaire) {
        $reponse = $this->executeList("SELECT f.code, f.numero_facture, DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date_payement, e.nom, e.prenom, f.libelle, r.versement from eleves e, inscrit i, facture f , recu r where e.numero_eleve=i.numero_eleve "
                . "and r.numero_facture= f.numero_facture and f.numero_eleve=e.numero_eleve and f.archive=0 and r.annee_scolaire=i.annee_scolaire and r.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }

    public function GetFacture($facture_id) {
        $reponse = $this->executeList("SELECT code , numero_eleve, numero_facture, DATE_FORMAT(date_payement,'%d/%m/%Y') as date_payement, libelle, description, montant  FROM facture where numero_facture='$facture_id'");
        return $reponse;
    }

    public function GetFactureByNumEleve($num_eleve) {
        $reponse = $this->executeList("SELECT  code ,  numero_facture, montant ,solde FROM facture where numero_eleve='$num_eleve' and archive=0");
        return $reponse;
    }

    public function GetSolde($numero_facture) {
        $reponse = $this->executeList("SELECT  solde  FROM facture where numero_facture='$numero_facture'");
        return $reponse;
    }

    public function GetFactureByOperation($num_eleve, $operation, $annee_scolaire) {
        $reponse = $this->executeList("SELECT  code , numero_facture, montant ,solde FROM facture where numero_eleve='$num_eleve' and annee_scolaire='$annee_scolaire' and archive=0 and description='$operation'");
        return $reponse;
    }

    public function AddFacture() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $libelle = $request->libelle;
        $annee_scolaire = $request->anneeScolaire;
        $description = $request->description;
        $montant = $request->montant;
        $date_payement = $request->date_payement;
        $date = explode("/", $date_payement);
        $datepaye = $date[2] . '-' . $date[1] . '-' . $date[0];
        $numero_eleve = $request->numero_eleve;
        date_default_timezone_set('Africa/Dakar');
        $datetime= new DateTime();
        $code= $datetime->format("Ymd-Hi");
        $this->executeUpdate("Insert into facture(date_payement,code, libelle, montant, description,numero_eleve, solde,annee_scolaire) values ('$datepaye','$code','$libelle', '$montant','$description','$numero_eleve','-$montant','$annee_scolaire')");
    }

    public function AddAllFacture() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $libelle = $request->libelle;
        $payer= $request->payer;
        $annee_scolaire = $request->anneeScolaire;
        $description = $request->description;
        $montant = $request->montant;
        $date_payement = $request->date_payement;
        $date = explode("/", $date_payement);
        $datepaye = $date[2] . '-' . $date[1] . '-' . $date[0];
        $numero_eleves = $request->numero_eleves;
        $index = 0;
        
        date_default_timezone_set('Africa/Dakar');
        $datetime= new DateTime();
        $code= $datetime->format("Ymd-Hi");
        for ($index; $index < count($numero_eleves); $index++) {
            $numero_eleve = $numero_eleves[$index]->numero_eleve;

            $this->executeUpdate("Insert into facture(date_payement,code, libelle, montant, description,numero_eleve, solde,annee_scolaire) values ('$datepaye','$code','$libelle', '$montant','$description','$numero_eleve','-$montant','$annee_scolaire') where payer=0");
            $this->executeUpdate("Update facture set payer=0");
        }
    }

    public function UpdateFacture() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $libelle = $request->libelle;
        $description = $request->description;
        $montant = $request->montant;
        $date_payement = $request->date_payement;
        $numero_facture = $request->numero_facture;
        $date = explode("/", $date_payement);
        $datepaye = $date[2] . '-' . $date[1] . '-' . $date[0];
		
		 $totalversement = $this->GetSommeVersement($numero_facture)[0]['totalversement'];
		 $solde = $montant-$totalversement;
        $this->executeUpdate("Update facture set libelle='$libelle', description='$description', montant='$montant',solde='-$solde', date_payement='$datepaye' where numero_facture ='$numero_facture'");
    }

    public function DeleteFacture($numero) {
        $this->executeUpdate("Update facture set archive=1 WHERE numero_facture = '$numero'");
    }

      public function Updatepayement($numero) {
        $this->executeUpdate("Update facture set payer=1 WHERE numero_eleve = '$numero'");
    }

	  public function GetSommeVersement($numero) {
        $reponse = $this->executeList("SELECT sum(versement ) as totalversement from recu WHERE numero_facture = '$numero' and archive=0");
		return $reponse;
    }
	
	 public function GetTotalSolde($numero, $annee_scolaire) {
        $reponse = $this->executeList("SELECT sum(solde) as totalsolde from facture f  WHERE f.numero_eleve = '$numero' and f.archive=0 and f.annee_scolaire='$annee_scolaire'");
		return $reponse;
    }
}

use RestService\Server;

Server::create('/', new FactureManager)
        ->addGetRoute('ListFacturesEleves', 'ListFacturesEleves')
        ->addGetRoute('ListImpayes', 'ListImpayes')
        ->addPostRoute('AddFacture', 'AddFacture')
        ->addGetRoute('getFactureByCodeClasse', 'getFactureByCodeClasse')
        ->addGetRoute('getRecuByCodeClasse', 'getRecuByCodeClasse')
        ->addGetRoute('getRecuByCodeClasseValuePeriode', 'getRecuByCodeClasseValuePeriode')
        ->addPostRoute('UpdateFacture', 'UpdateFacture')
        ->addGetRoute('DeleteFacture/(.*)', 'DeleteFacture')
       ->addGetRoute('Updatepayement/(.*)', 'Updatepayement')
		->addGetRoute('GetSommeVersement/(.*)', 'GetSommeVersement')
        ->addGetRoute('GetFacture/(.*)', 'GetFacture')
        ->addGetRoute('GetSolde/(.*)', 'GetSolde')
		->addGetRoute('getAllRecu/(.*)', 'getAllRecu')
		->addGetRoute('getAllFacture/(.*)', 'getAllFacture')
        ->addGetRoute('GetFactureByNumEleve/(.*)', 'GetFactureByNumEleve')
        ->addGetRoute('GetFactureByOperation', 'GetFactureByOperation')
		->addGetRoute('GetTotalSolde', 'GetTotalSolde')
        ->addPostRoute('AddAllFacture', 'AddAllFacture')
        ->run();
