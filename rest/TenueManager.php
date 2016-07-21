<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class TenueManager extends BDManager{

    
        public function ListTenueSimple()
	{
			$reponse = $this->executeList("SELECT id_tenue , type_tenue FROM tenue where archive =0");	
		    return $reponse;
	}
        
	public function ListTenue($annee_scolaire)
	{
			$reponse = $this->executeList("SELECT t.id_tenue as id_tenue , t.type_tenue as type_tenue, t.mensualite as mensualite, count(e.numero_eleve)as nb from tenue t left outer join eleves e 
											on e.type_tenue=t.type_tenue and e.archive=0
                                              left outer join inscrit i
											 on e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire'
											where t.archive=0 
											group by t.type_tenue , t.mensualite order by t.id_tenue DESC");	
		    return $reponse;
	}
		public function GetEleveByTenue($numero, $annee_scolaire)
	{
			$reponse = $this->executeList("SELECT e.numero_eleve,e.nom, e.prenom , c.nom as classe from tenue t left outer join eleves e 
											on e.type_tenue=t.type_tenue 
											inner join inscrit i
											on i.numero_eleve=e.numero_eleve
											inner join classe c 
											on c.id_classe=i.id_classe
											
											where t.archive=0 and i.annee_scolaire='$annee_scolaire'
											and t.id_tenue='$numero'  "
											);	
		    return $reponse;
	}
	
	
	 public function DeleteTenue($numero)
	{
		$this->executeUpdate("Update tenue set archive=1 WHERE id_tenue = '$numero'");
	}
	 public function AddTenue()
    {	
	
	   $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
       $type_tenue = $request->type_tenue;
       $mensualite = $request->mensualite;  		
	 $this->executeUpdate("Insert into tenue(type_tenue, mensualite) values ('$type_tenue','$mensualite')");
    } 

	public function getMensualiteByType($type)
	{
			$reponse = $this->executeList("SELECT mensualite FROM tenue where type_tenue='$type'");	
		    return $reponse;
	}
	
	  public function UpdateTenue()
    {	

	  $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
		$id_tenue = $request->id_tenue;
      $type_tenue = $request->type_tenue;
       $mensualite = $request->mensualite; 
	 $this->executeUpdate("Update tenue set type_tenue='$type_tenue', mensualite='$mensualite' where id_tenue ='$id_tenue'" );
    
    }
	public function GetTenue($tenue_id)
	{
			$reponse = $this->executeList("SELECT * FROM tenue where id_tenue='$tenue_id'");	
		    return $reponse;
	}
} 	

use RestService\Server;

Server::create('/', new TenueManager)
        ->addGetRoute('ListTenueSimple', 'ListTenueSimple')
	->addGetRoute('ListTenue/(.*)', 'ListTenue')
	->addGetRoute('DeleteTenue/(.*)', 'DeleteTenue')
	->addGetRoute('GetEleveByTenue', 'GetEleveByTenue')
	->addGetRoute('getMensualiteByType/(.*)', 'getMensualiteByType')
	->addPostRoute('AddTenue', 'AddTenue')
	->addPostRoute('UpdateTenue', 'UpdateTenue')
	->addGetRoute('GetTenue/(.*)', 'GetTenue')
	
	
	
->run();