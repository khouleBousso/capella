<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class TarifManager extends BDManager {

    public function ListTarif($type) {
        $reponse = $this->executeList("SELECT * FROM tarif where type='$type' and archive=0  order by id_tarif DESC ");
        return $reponse;
    }

    public function DeleteTarif() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_tarif = $request->id_tarif;
        $this->executeUpdate("Update tarif set archive=1 where id_tarif = '$id_tarif'");
    }

    public function AddTarif() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
		
		$frais_general=0;
		$cotisation_ape=0;
		$mens_octobre=0;
		$uniforme=0;
		$libelle="";
		$type="";
		$tenue_sport=0;
		$frais_examen=0;
		
		$frais_general_re=0;
		$cotisation_ape_re=0;
		$mens_octobre_re=0;
		$libelle_re="";
		$frais_examen_re=0;
		
		if (isset($request->frais_general)) {
       $frais_general = $request->frais_general;
	   }
	   if (isset($request->cotisation_ape)) {
        $cotisation_ape = $request->cotisation_ape;
		}
		if (isset($request->mens_octobre)) {
		$mens_octobre = $request->mens_octobre;
		}
		if (isset($request->uniforme)) {
        $uniforme = $request->uniforme;
		}
		if (isset($request->libelle)) {
        $libelle = $request->libelle;
		}
		if (isset($request->tenue_sport)) {
        $tenue_sport = $request->tenue_sport;
		}
		if (isset($request->frais_examen)) {
		$frais_examen= $request->frais_examen;
		}
		if (isset($request->type)) {
		$type= $request->type;
		}
		
        $total = $mens_octobre + $frais_general + $uniforme + $tenue_sport+ $frais_examen+$cotisation_ape;
		
		if (isset($request->libelle_re)) {
		$libelle_re = $request->libelle_re;
		}
		if (isset($request->frais_general_re)) {
		$frais_general_re = $request->frais_general_re;
		}
		if (isset($request->cotisation_ape_re)) {
		$cotisation_ape_re = $request->cotisation_ape_re;
		}
		if (isset($request->mens_octobre_re)) {
		$mens_octobre_re = $request->mens_octobre_re;
		}
		if (isset($request->frais_examen_re)) {
		$frais_examen_re= $request->frais_examen_re;
		}
		
		$total_re = $frais_general_re + $cotisation_ape_re + $mens_octobre_re+ $frais_examen_re;
		
		
        $label_css = '';
        $label_button = '';

        if ($total <= 32000 or $total_re <= 32000) {
            $label_css = 'red3';
            $label_button = 'btn-danger';
        }

        if ($total > 32000 or $total_re > 32000 and $total <= 36000 or $total_re <= 36000) {
            $label_css = 'orange';
            $label_button = 'btn-warning';
        }

        if ($total > 36000 or $total_re > 36000 and $total <= 38000 or $total_re <= 38000) {
            $label_css = 'blue';
            $label_button = 'btn-primary';
        }

        if ($total > 38000 or $total_re > 38000 and $total <= 43000 or $total_re <= 43000) {
            $label_css = 'green';
            $label_button = 'btn-success';
        }

        if ($total > 43000 or $total_re > 43000) {
            $label_css = 'grey';
            $label_button = 'btn-grey';
        }

        $this->executeUpdate("Insert into tarif(frais_general,cotisation_ape, mens_octobre, uniforme, libelle,tenue_sport,frais_examen,total,  frais_general_re,cotisation_ape_re, mens_octobre_re, libelle_re,frais_examen_re,total_re,label_css,label_button,archive,type) values ('$frais_general','$cotisation_ape', '$mens_octobre', '$uniforme', '$libelle','$tenue_sport','$frais_examen','$total',  '$frais_general_re','$cotisation_ape_re', '$mens_octobre_re', '$libelle_re','$frais_examen_re','$total_re','$label_css','$label_button',0,'$type')");
    }

    public function UpdateTarif() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_tarif = $request->id_tarif;
		
	    if (isset($request->frais_general)) {
       $frais_general = $request->frais_general;
	   }
	   if (isset($request->cotisation_ape)) {
        $cotisation_ape = $request->cotisation_ape;
		}
		if (isset($request->mens_octobre)) {
		$mens_octobre = $request->mens_octobre;
		}
		if (isset($request->uniforme)) {
        $uniforme = $request->uniforme;
		}
		if (isset($request->libelle)) {
        $libelle = $request->libelle;
		}
		if (isset($request->tenue_sport)) {
        $tenue_sport = $request->tenue_sport;
		}
		if (isset($request->frais_examen)) {
		$frais_examen= $request->frais_examen;
		}
		if (isset($request->total)) {
         $total = $mens_octobre + $frais_general + $uniforme + $tenue_sport+ $frais_examen+$cotisation_ape;
		}
		if (isset($request->type)) {
		$type= $request->type;
		}
		if (isset($request->libelle_re)) {
		$libelle_re = $request->libelle_re;
		}
		if (isset($request->frais_general_re)) {
		$frais_general_re = $request->frais_general_re;
		}
		if (isset($request->cotisation_ape_re)) {
		$cotisation_ape_re = $request->cotisation_ape_re;
		}
		if (isset($request->mens_octobre_re)) {
		$mens_octobre_re = $request->mens_octobre_re;
		}
		if (isset($request->frais_examen_re)) {
		$frais_examen_re= $request->frais_examen_re;
		}
		if (isset($request->total_re)) {
		$total_re = $frais_general_re + $cotisation_ape_re + $mens_octobre_re+ $frais_examen_re;
		}
		
        $label_css = '';
        $label_button = '';

        if ($total <= 32000 or $total_re <= 32000) {
            $label_css = 'red3';
            $label_button = 'btn-danger';
        }

        if ($total > 32000 or $total_re > 32000 and $total <= 36000 or $total_re <= 36000) {
            $label_css = 'orange';
            $label_button = 'btn-warning';
        }

        if ($total > 36000 or $total_re > 36000 and $total <= 38000 or $total_re <= 38000) {
            $label_css = 'blue';
            $label_button = 'btn-primary';
        }

        if ($total > 38000 or $total_re > 38000 and $total <= 43000 or $total_re <= 43000) {
            $label_css = 'green';
            $label_button = 'btn-success';
        }

        if ($total > 43000 or $total_re > 43000) {
            $label_css = 'grey';
            $label_button = 'btn-grey';
        }

        $this->executeUpdate("Update tarif set  frais_general='$frais_general', cotisation_ape='$cotisation_ape', mens_octobre='$mens_octobre', uniforme='$uniforme', libelle='$libelle', tenue_sport='$tenue_sport', frais_examen='$frais_examen',total='$total',frais_general_re='$frais_general_re', cotisation_ape_re='$cotisation_ape_re', mens_octobre_re='$mens_octobre_re',libelle_re='$libelle_re', frais_examen_re='$frais_examen_re',total_re='$total_re',label_css='$label_css', label_button='$label_button', type='$type' where id_tarif ='$id_tarif'");
    }

    public function GetTarif($numero) {
        $reponse = $this->executeList("SELECT * FROM tarif where id_tarif = '$numero'");
        return $reponse;
    }

    public function GetTarifInscription($classe) {
        $reponse = $this->executeList("select t.total from tarif t, classe c where c.id_tarif= t.id_tarif and c.id_classe = '$classe'");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new TarifManager)
        ->addGetRoute('ListTarif/(.*)', 'ListTarif')
        ->addPostRoute('DeleteTarif', 'DeleteTarif')
        ->addPostRoute('AddTarif', 'AddTarif')
        ->addGetRoute('GetTarif/(.*)', 'GetTarif')
        ->addPostRoute('UpdateTarif', 'UpdateTarif')
        ->addGetRoute('GetTarifInscription/(.*)', 'GetTarifInscription')
        ->run();
