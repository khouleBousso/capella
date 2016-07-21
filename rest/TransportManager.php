<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class TransportManager extends BDManager{
        
    
        public function ListTransportSimple(){
            $reponse = $this->executeList("SELECT id_transport, code_transport FROM transport where archive =0");	
		    return $reponse;
        }
            
	public function ListTransport($annee_scolaire)
	{
			$reponse = $this->executeList("SELECT t.id_transport as id_transport, t.code_transport as code_transport, t.mensualite as mensualite, count(e.numero_eleve)as nb from transport t left outer join eleves e 
											on e.id_transport=t.code_transport and e.archive=0
                                            left outer join inscrit i
											 on e.numero_eleve=i.numero_eleve  and i.annee_scolaire='$annee_scolaire'
											where t.archive=0 
											group by t.code_transport , t.mensualite order by t.id_transport DESC"
											);	
		    return $reponse;
	}
	
		public function GetEleveByTransport($numero, $annee_scolaire)
	{
			$reponse = $this->executeList("SELECT e.numero_eleve,e.nom, e.prenom , c.nom as classe from transport t left outer join eleves e 
											on e.id_transport=t.code_transport 
											inner join inscrit i
											on i.numero_eleve=e.numero_eleve
											inner join classe c 
											on c.id_classe=i.id_classe
											
											where t.archive=0 and i.annee_scolaire='$annee_scolaire'
											and t.id_transport='$numero'  "
											);	
		    return $reponse;
	}
	 public function DeleteTransport($numero)
	{
		$this->executeUpdate("Update transport set archive=1 WHERE id_transport = '$numero'");
	}
	 public function AddTransport()
    {	
	
	   $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
       $code_transport = $request->code_transport;
       $mensualite = $request->mensualite;  		
	 $this->executeUpdate("Insert into transport(code_transport, mensualite) values ('$code_transport','$mensualite')");
    } 

	public function getMensualiteByItineraire($itineraire)
	{
			$reponse = $this->executeList("SELECT mensualite FROM transport where code_transport='$itineraire'");	
		    return $reponse;
	}
	
	
	public function GetTransport($transport_id)
	{
			$reponse = $this->executeList("SELECT * FROM transport where id_transport='$transport_id'");	
		    return $reponse;
	}
	
	 public function UpdateTransport()
    {	

	  $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
		$id_transport = $request->id_transport;
      $code_transport = $request->code_transport;
       $mensualite = $request->mensualite; 
	 $this->executeUpdate("Update transport set code_transport='$code_transport', mensualite='$mensualite' where id_transport ='$id_transport'" );
    
    }
	
} 	

use RestService\Server;

Server::create('/', new TransportManager)
	->addGetRoute('ListTransport/(.*)', 'ListTransport')
        ->addGetRoute('ListTransportSimple', 'ListTransportSimple')
	->addGetRoute('DeleteTransport/(.*)', 'DeleteTransport')
	->addGetRoute('GetEleveByTransport', 'GetEleveByTransport')
	->addGetRoute('getMensualiteByItineraire/(.*)', 'getMensualiteByItineraire')
	->addPostRoute('AddTransport', 'AddTransport')
    ->addPostRoute('UpdateTransport', 'UpdateTransport')
	->addGetRoute('GetTransport/(.*)', 'GetTransport')
	
->run();