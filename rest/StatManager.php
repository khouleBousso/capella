<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class StatManager extends BDManager{

	 public function CountTotalEleves($annee_scolaire)
    {
     $reponse = $this->executeUpdate("SELECT COUNT(*) FROM eleves e,inscrit i,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }
	
	 public function CountTotalInscrits($annee_scolaire)
    {
     $reponse = $this->executeUpdate("SELECT COUNT(*) FROM inscrit i , eleves e ,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and  i.annee_scolaire='$annee_scolaire' and e.type_demande='Inscription' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }

   public function CountTotalFilles($annee_scolaire)
    {
     $reponse = $this->executeUpdate("SELECT COUNT(*) FROM eleves e,inscrit i ,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and civilite='F' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }
  
   public function CountTotalGarcons($annee_scolaire)
    {
     $reponse = $this->executeUpdate("SELECT COUNT(*) FROM eleves e,inscrit i ,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and civilite='M' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }
	
	public function CountTotalBoursier($annee_scolaire)
    {
    $reponse = $this->executeUpdate("SELECT COUNT(*) FROM eleves e,inscrit i ,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and e.boursier='OUI' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }
	
	public function CountTotalHandicape($annee_scolaire)
    {
    $reponse = $this->executeUpdate("SELECT COUNT(*) FROM eleves e,inscrit i ,classe c where c.id_classe=i.id_classe and e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and e.handicape='OUI' and e.archive=0 and c.archive=0")->fetchColumn();
	 return $reponse;
    }
	
	
	 public function getAnneesInscrits() {
        $reponse = $this->executeList("Select i.annee_scolaire from Inscrit i group by i.annee_scolaire");
        return $reponse;
    }
} 	

use RestService\Server;

Server::create('/', new StatManager)
	->addGetRoute('CountTotalEleves/(.*)', 'CountTotalEleves')
	->addGetRoute('CountTotalInscrits/(.*)', 'CountTotalInscrits')
	->addGetRoute('CountTotalFilles/(.*)', 'CountTotalFilles')
	->addGetRoute('CountTotalGarcons/(.*)', 'CountTotalGarcons')
	->addGetRoute('CountTotalBoursier/(.*)', 'CountTotalBoursier')
	->addGetRoute('CountTotalHandicape/(.*)', 'CountTotalHandicape')
	->addGetRoute('getAnneesInscrits', 'getAnneesInscrits')
	
	
	
->run();