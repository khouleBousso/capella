<?php

include 'vendor/autoload.php';
// include 'entities/Facture.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class DocumentManager extends BDManager {

    
    public function ListDocumentsEtudiant($id_etudiant)
    {
       $reponse = $this->executeList("select doc.*, ma.nom from document doc ,inscrit i ,dispense d ,matiere ma where i.id_classe=doc.id_classe and doc.id_classe = d.id_classe and "
               . " d.id_matiere = doc.id_matiere and doc.id_matiere = ma.id_matiere and i.numero_eleve = '$id_etudiant' and semestre  = 1");
 
        return $reponse;
    }
    
    
     public function ListDocuments($id_professeur)
    {
       $reponse = $this->executeList("Select * from document where id_professeur = '$id_professeur'");
 
        return $reponse;
    }
    
    public function AddDocument() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $intitule = $request->intitule;
        $classe = $request->classe->id_classe;
        $matiere = $request->matiere->id_matiere;
        $professeur= $request->id_professeur;
        $cours= $request->cours;
        $examen= "";
        $corrige= "";
         if (isset($request->corrige)) {
            $corrige = $request->corrige;
        }

        if (isset($request->examen)) {
            $corrige = $request->examen;
        }
        $this->executeUpdate("Insert into document(intitule, id_classe, id_matiere,  id_professeur, date,cours,examen,corrige) values ('$intitule','$classe', '$matiere',  '$professeur',NOW(),'$cours','$examen','$corrige')");
  }

}

use RestService\Server;

Server::create('/', new DocumentManager)
        ->addGetRoute('ListDocuments/(.*)', 'ListDocuments')
         ->addGetRoute('ListDocumentsEtudiant/(.*)', 'ListDocumentsEtudiant')
        ->addPostRoute('AddDocument', 'AddDocument')
        ->run();