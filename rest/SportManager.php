<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class SportManager extends BDManager{

    
       public function ListSportSimple(){
            $reponse = $this->executeList("SELECT id_sport, type FROM sport where archive =0");	
		    return $reponse;
        }
        
	public function ListSport($annee_scolaire)
	{
			$reponse = $this->executeList("SELECT s.id_sport as id_sport, s.type as type, s.mensualite as mensualite, count(e.numero_eleve)as nb from sport s left outer join eleves e 
											on e.type_sport=s.type and e.archive=0
											left outer join inscrit i
											 on e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire'
											where s.archive=0 
											group by s.type , s.mensualite order by s.id_sport DESC");	
		    return $reponse;
	}
	
		public function GetEleveBySport($numero, $annee_scolaire)
	{
			$reponse = $this->executeList("SELECT e.numero_eleve,e.nom, e.prenom , c.nom as classe from sport s left outer join eleves e 
											on e.type_sport=s.type 
											inner join inscrit i
											on i.numero_eleve=e.numero_eleve
											inner join classe c 
											on c.id_classe=i.id_classe
											
											where s.archive=0  and  i.annee_scolaire='$annee_scolaire'
											and s.id_sport='$numero'  "
											);	
		    return $reponse;
	}
	 public function DeleteSport($numero)
	{
		$this->executeUpdate("Update sport set archive=1 WHERE id_sport = '$numero'");
	}
	 public function AddSport()
    {	
	
	   $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
       $type = $request->type;
       $mensualite = $request->mensualite;  		
	 $this->executeUpdate("Insert into sport(type, mensualite) values ('$type','$mensualite')");
    } 

	public function getMensualiteByType($type)
	{
			$reponse = $this->executeList("SELECT mensualite FROM sport where type='$type'");	
		    return $reponse;
	}
	 public function UpdateSport()
    {	

	  $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
		$id_sport = $request->id_sport;
      $type = $request->type;
       $mensualite = $request->mensualite; 
	 $this->executeUpdate("Update sport set type='$type', mensualite='$mensualite' where id_sport ='$id_sport'" );
    
    }
	public function GetSport($sport_id)
	{
			$reponse = $this->executeList("SELECT * FROM sport where id_sport='$sport_id'");	
		    return $reponse;
	}
} 	

use RestService\Server;

Server::create('/', new SportManager)
        ->addGetRoute('ListSportSimple', 'ListSportSimple')
	->addGetRoute('ListSport/(.*)', 'ListSport')
	->addGetRoute('DeleteSport/(.*)', 'DeleteSport')
	->addGetRoute('GetEleveBySport', 'GetEleveBySport')
	->addGetRoute('getMensualiteByType/(.*)', 'getMensualiteByType')
	->addPostRoute('AddSport', 'AddSport')
	->addPostRoute('UpdateSport', 'UpdateSport')
	->addGetRoute('GetSport/(.*)', 'GetSport')
	
	
	
->run();