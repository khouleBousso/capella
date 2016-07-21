<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *"); 
 
 
class EdtManager extends BDManager{

    public function ListEdt($classe)
    {
       $reponse = $this->executeList("SELECT id,title,start,end,className from edt where id_classe = '$classe'");	
       return $reponse;
    }
 
    
     public function addEdt() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $title = $request->title;
        $start = $request->start;
        $end = $request->end;
        $className = $request->className;
        $id_classe = $request->id_classe;
        
        
        $this->executeUpdate("Insert into edt (title, start,end,className,id_classe) values ('$title', '$start','$end','$className','$id_classe')");
    }

    public function modEdt() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        $title = $request->title;
        $start = $request->start;
        
        $end = $request->end;
        $className = $request->className;

        $this->executeUpdate("Update edt set title='$title',start='$start',end='$end',className='$className' where id='$id'");
    }
    
    
     public function deleteEdt($id) {
        

        $this->executeUpdate("delete from  edt where id='$id'");
    }
    
    
} 	

use RestService\Server;

Server::create('/', new EdtManager)
	->addGetRoute('ListEdt/(.*)', 'ListEdt')
        ->addGetRoute('deleteEdt/(.*)', 'deleteEdt')
	->addPostRoute('addEdt', 'addEdt')
        ->addPostRoute('modEdt', 'modEdt')
->run();