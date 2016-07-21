<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class ClasseManager extends BDManager{

	public function ListClasse($annee_scolaire)
	{
			$reponse = $this->executeList("SELECT c.id_classe, c.code_classe, c.nom, count(i.id) as inscrit
						 from classe c
						 left outer join inscrit i
						 on i.id_classe=c.id_classe and i.annee_scolaire='$annee_scolaire'
						 where c.archive=0
				group by  c.id_classe order by c.id_classe DESC ");	
		    return $reponse;
	}
	 
public function ListClasseBasic()
	{
			$reponse = $this->executeList("SELECT *
												from classe c
												 where c.archive=0 
												group by  c.id_classe ");	
		    return $reponse;
	}
	 
        public function DeleteClasse()
	{
             $postdata = file_get_contents("php://input");
              $request = json_decode($postdata);
	      $stm = $this->getPdo()->prepare("Update classe set archive=1 WHERE id_classe = :id_classe");
             $stm->bindParam(":id_classe",$request->id_classe);
	       $stm->execute();

                $stmPrim = $this->getPdo()->prepare("Update inscrit, eleves ev , classe set ev.archive = 1 where ev.numero_eleve= inscrit.numero_eleve and 
              classe.id_classe=inscrit.id_classe and classe.id_classe:id_classe and annee_scolaire=:annee_scolaire");
               $stmPrim ->bindParam(":annee_scolaire",$request->annee_scolaire);
	      $stmPrim ->execute();
	}
	
        public function ListNomClasse()
	{
			$reponse = $this->executeList("SELECT id_classe, nom, code_classe FROM classe where archive=0");	
		    return $reponse;
	}
	
	    public function ListAnneeScolaire()
	{
			$reponse = $this->executeList("SELECT distinct annee_scolaire FROM inscrit");	
		    return $reponse;
	}
    public function AddClasse()
    {	
	   $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);	   
	 $stm = $this->getPdo()->prepare("Insert into classe(code_classe, nom, id_cycle) values (:code, :nom, :cycle)");
	 $stm->bindParam(":code",$request->code_classe);
	 $stm->bindParam(":nom",$request->nom);
	 $stm->bindParam(":cycle",$request->id_cycle);
	 $stm->execute();
	 

    } 
	
	 public function UpdateClasse()
    {	

	  $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
	 $stm = $this->getPdo()->prepare("Update classe set code_classe=:code, nom=:nom , id_cycle=:cycle where id_classe =:classe" );
         $stm->bindParam(":code",$request->code_classe);
	 $stm->bindParam(":nom",$request->nom);
	 $stm->bindParam(":cycle",$request->id_cycle);
	 $stm->bindParam(":classe",$request->id_classe);
	 $stm->execute();
    }
	
	public function GetClasse($classe_id)
	{
			$reponse = $this->executeList("SELECT * FROM classe where id_classe='$classe_id'");	
		    return $reponse;
	}
	
	
	public function GetCycle($annee_scolaire)
	{
			$reponse = $this->executeList("select cy.libelle_cycle as label, count(*) as data,cy.color as color  from cycle cy, classe ca,inscrit i,eleves e where e.numero_eleve= i.numero_eleve and ca.id_classe=i.id_classe and ca.id_cycle=cy.id_cycle  and i.annee_scolaire='$annee_scolaire' and e.archive=0 group by cy.libelle_cycle");	
		    return $reponse;
	}
	
        
        
    public function getClassesByProfesseur($num_professeur) {
        $reponse = $this->executeList("SELECT c.* FROM classe c,dispense d where d.id_classe = c.id_classe and d.id_professeur = '$num_professeur' group by c.id_classe ");
        return $reponse;
    }

} 	

use RestService\Server;

Server::create('/', new ClasseManager)
	->addGetRoute('ListClasse/(.*)', 'ListClasse')
->addGetRoute('ListClasseBasic', 'ListClasseBasic')
	->addGetRoute('ListNomClasse', 'ListNomClasse')
	->addGetRoute('ListAnneeScolaire', 'ListAnneeScolaire')
	->addPostRoute('DeleteClasse', 'DeleteClasse')
	->addPostRoute('AddClasse', 'AddClasse')
	->addPostRoute('UpdateClasse', 'UpdateClasse')
	->addGetRoute('GetClasse/(.*)', 'GetClasse')
	->addGetRoute('GetCycle/(.*)', 'GetCycle')
        ->addGetRoute('getClassesByProfesseur/(.*)', 'getClassesByProfesseur')
	
	
->run();
