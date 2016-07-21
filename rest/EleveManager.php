<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
// require_once("entities/ClassEleve.php");
header("Access-Control-Allow-Origin: *");

class EleveManager extends BDManager {

    public function ListEleves($annee_scolaire) {
        $reponse = $this->executeList("SELECT eleves.numero_eleve,eleves.nom, eleves.prenom, eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance, utilisateur.adresse as adresseParent, classe.nom as classe FROM eleves,utilisateur, classe, inscrit where utilisateur.id=eleves.id_parent and eleves.numero_eleve=inscrit.numero_eleve and eleves.archive=0  and  inscrit.annee_scolaire='$annee_scolaire' and inscrit.id_classe=classe.id_classe  ");
        return $reponse;
    }

    public function Desistement($numero) {
        $this->executeUpdate("Update eleves set archive=1 WHERE numero_eleve = '$numero'");
    }

    public function ReIntegrerEleve($numero) {
        $this->executeUpdate("Update eleves set archive=0 WHERE numero_eleve = '$numero'");
    }

    public function MotifReIntegrerEleve($motif, $numero) {
        $this->executeUpdate("Update eleves set motif='$motif' WHERE numero_eleve = '$numero'");
    }

    public function ListElevesDesiste($annee_scolaire) {
        $reponse = $this->executeList("SELECT  eleves.numero_eleve,eleves.nom, eleves.prenom, eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance, classe.nom as classe, desistement.motif, DATE_FORMAT(desistement.date_desistement,'%d/%m/%Y')as date_desistement FROM eleves,desistement, classe, inscrit where eleves.numero_eleve=desistement.numero_eleve and eleves.numero_eleve=inscrit.numero_eleve and eleves.archive=1  and  inscrit.annee_scolaire='$annee_scolaire' and  inscrit.id_classe=classe.id_classe group by eleves.numero_eleve ");
        return $reponse;
    }

    public function CountEleves() {
        $reponse = $this->executeUpdate('SELECT COUNT(*) FROM eleves')->fetchColumn();
        return $reponse;
    }

    public function getElevesByCodeClasse($id_classe, $annee_scolaire) {
        $reponse = $this->executeList("SELECT eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance, utilisateur.adresse as adresseParent FROM inscrit,utilisateur, eleves , classe
			where utilisateur.id=eleves.id_parent and eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$id_classe' and annee_scolaire='$annee_scolaire' and eleves.archive=0 order by eleves.numero_eleve DESC");
        return $reponse;
    }

public function getElevesMoyenneByCodeClasse($id_classe, $annee_scolaire) {
        $reponse = $this->executeList("SELECT eleves.numero_eleve,eleves.nom,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance, m.moyenne FROM moyenne m, eleves ,  classe, inscrit
			where  m.numero_eleve=eleves.numero_eleve and m.semestre=1 and inscrit.numero_eleve=eleves.numero_eleve and inscrit.annee_scolaire='$annee_scolaire' and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$id_classe'  and eleves.archive=0 order by m.moyenne DESC");
        return $reponse;
    }

	public function getElevesByAnnee($id_classe, $annee_scolaire) {
        $reponse = $this->executeList("SELECT eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance, utilisateur.adresse as adresseParent FROM inscrit,utilisateur, eleves , classe
			where utilisateur.id=eleves.id_parent and eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$id_classe' and annee_scolaire='$annee_scolaire' and eleves.archive=0");
        return $reponse;
    }

	
	
    public function getElevesByNumEleve($numero_eleve, $annee_scolaire) {
        $reponse = $this->executeList(" select eleves.*,utilisateur.nom as nomTuteur,utilisateur.adresse as adresseParent, inscrit.id_classe FROM inscrit, eleves,utilisateur  where utilisateur.id = eleves.id_parent and  eleves.numero_eleve= inscrit.numero_eleve
 			and inscrit.id_classe IN (SELECT id_classe FROM inscrit
			 where inscrit.numero_eleve='$numero_eleve' and annee_scolaire='$annee_scolaire') ");

        return $reponse;
    }

    public function getEleves($numero, $annee_scolaire) {
        $reponse = $this->executeList("SELECT eleves.avatar,eleves.tarif, eleves.numero_eleve, utilisateur.adresse as adresseParent, DATE_FORMAT(date_naissance,'%d/%m/%Y') as date_naissance,"
                . " lieu_naissance, eleves.nom, eleves.prenom, civilite, boursier,handicape,type_handicape, montant_bourse, nationalite, ancEtab, DATE_FORMAT(date_arr_anc,'%d/%m/%Y') "
                . " as date_arr_anc, DATE_FORMAT(date_fin_anc,'%d/%m/%Y') as date_fin_anc, adresse_dernier_ecole,region_dernier_ecole,"
                . " email_dernier_ecole, telephone_dernier_ecole, classe.id_classe as classe_demande,classe.nom as classeNom,inscrit.annee_scolaire,"
                . " type_demande, transport, id_transport, montant_transport, sport, type_sport, frais_sport, taux_reduction, montant_du, tenue, type_tenue, frais_tenue, "
                . " id_parent,utilisateur.nom as nomtuteur,utilisateur.prenom as prenomtuteur,utilisateur.adresse as adressetuteur,utilisateur.telephone as telephonetuteur,"
                . " utilisateur.profession_tuteur as professiontuteur,utilisateur.autorite_parentale as autoriteparentale,utilisateur.email as emailtuteur,utilisateur.societe_tuteur as societetuteur,utilisateur.region_tuteur as regiontuteur "
                . " FROM eleves,utilisateur,inscrit,classe where inscrit.numero_eleve =eleves.numero_eleve and inscrit.id_classe = classe.id_classe and eleves.id_parent = utilisateur.id and eleves.numero_eleve = '$numero' and inscrit.annee_scolaire='$annee_scolaire'");
        return $reponse;
    }

    public function ListEnfants($numero) {
        $reponse = $this->executeList("SELECT e.numero_eleve,e.nom , e.prenom, c.nom as nomClasse "
                . "FROM eleves e,inscrit i, classe c where i.numero_eleve = e.numero_eleve and i.id_classe = c.id_classe and e.id_parent = '$numero'");
        return $reponse;
    }

    public function getMatieresByEleve($numero_eleve, $semestre, $annee_scolaire) {
        $reponse = $this->executeList("SELECT m.* ,d.id_professeur,d.semestre, u.avatar as avatarprof FROM inscrit i ,dispense d,matiere m,utilisateur u where m.id_matiere=d.id_matiere and i.id_classe = d.id_classe "
                . " and u.id =d.id_professeur and i.numero_eleve = '$numero_eleve' and i.annee_scolaire='$annee_scolaire' and d.semestre = '$semestre' and m.archive=0");
        return $reponse;
    }

    public function AddMotif() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $motif ='';
        if(isset($request->motif))
        {
            $motif = $request->motif;
        }
        $numero_eleve = $request->numero_eleve;
        $this->executeUpdate("Insert into desistement(motif,numero_eleve, date_desistement) values ('$motif','$numero_eleve', NOW())");
    }

}

use RestService\Server;

Server::create('/', new EleveManager)
        ->addGetRoute('ListEleves/(.*)','ListEleves')
        ->addGetRoute('ListElevesDesiste/(.*)', 'ListElevesDesiste')
        ->addPostRoute('AddMotif', 'AddMotif')
        ->addGetRoute('DeleteEleves/(.*)', 'DeleteEleves')
        ->addGetRoute('CountEleves', 'CountEleves')
        ->addGetRoute('getEleves', 'getEleves')
        ->addGetRoute('getElevesByCodeClasse', 'getElevesByCodeClasse')
       ->addGetRoute('getElevesMoyenneByCodeClasse', 'getElevesMoyenneByCodeClasse')
		->addGetRoute('getElevesByAnnee', 'getElevesByAnnee')
        ->addGetRoute('getElevesByNumEleve', 'getElevesByNumEleve')
        ->addGetRoute('ListEnfants/(.*)', 'ListEnfants')
        ->addGetRoute('getMatieresByEleve', 'getMatieresByEleve')
        ->addGetRoute('Desistement/(.*)', 'Desistement')
        ->addGetRoute('ReIntegrerEleve/(.*)', 'ReIntegrerEleve')
        ->addGetRoute('MotifReIntegrerEleve', 'MotifReIntegrerEleve')
        ->run();
