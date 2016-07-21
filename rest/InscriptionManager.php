<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class InscriptionManager extends BDManager {

    public function stockAvatar() {

        $dossier = $_POST['dossier'] . "/";
        $fichier = basename($_FILES['icone']['name']);
        $nom = $_POST['nom'];

        var_dump($fichier);

        $fichier = strtr($fichier, 'À�?ÂÃÄÅÇÈÉÊËÌ�?Î�?ÒÓÔÕÖÙÚÛÜ�?àáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if (move_uploaded_file($_FILES['icone']['tmp_name'], $dossier . $nom)) {
            echo '';
        } else {

            echo 'Echec de l\'upload !';
        }
    }

    public function AddEleve() {

        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);

        $nomAvatar = "";
        $boursier = "";
        $handicape = "";
        $type_handicape = "";
        $tarif = "";
        $montant_bourse = 0;
        $date_arr_anc = "";
        $ancEtab = "";
        $date_fin_anc = "";
        $adresse_dernier_ecole = "";
        $region_dernier_ecole = "";
        $email_dernier_ecole = "";
        $telephone_dernier_ecole = "";
        $type_demande = "";
        $numero_eleve = "";
        $existParent = "";
        if (isset($request->name)) {
            $nomAvatar = $request->name;
        }

        if (isset($request->numero_eleve)) {
            $numero_eleve = $request->numero_eleve;
        }

        $date_naissance = $request->date_naissance;
        $lieu_naissance = $request->lieu_naissance;
        $nom = $request->nom;
        $prenom = $request->prenom;
        if (isset($request->existParent)) {
            $existParent = $request->existParent;
        }
        $nationalite = $request->nationalite;

        if (isset($request->montant_bourse)) {
            $montant_bourse = $request->montant_bourse;
        }

        if (isset($request->tarif)) {
            $tarif = $request->tarif;
        }

        if (isset($request->boursier)) {
            $boursier = $request->boursier;
        }
        if (isset($request->handicape)) {
            $handicape = $request->handicape;
        }
        if (isset($request->type_handicape)) {
            $type_handicape = $request->type_handicape;
        }
        if (isset($request->civilite)) {
            $civilite = $request->civilite;
        }

      


        if (isset($request->ancEtab)) {
            $ancEtab = $request->ancEtab;
        }

        if (isset($request->date_arr_anc)) {
            $date_arr_anc = $request->date_arr_anc;
        }

        if (isset($request->date_fin_anc)) {
            $date_fin_anc = $request->date_fin_anc;
        }

        if (isset($request->adresse_dernier_ecole)) {

            $adresse_dernier_ecole = $request->adresse_dernier_ecole;
        }


        if (isset($request->region_dernier_ecole)) {
            $region_dernier_ecole = $request->region_dernier_ecole;
        }

        if (isset($request->email_dernier_ecole)) {
            $email_dernier_ecole = $request->email_dernier_ecole;
        }


        if (isset($request->telephone_dernier_ecole)) {
            $telephone_dernier_ecole = $request->telephone_dernier_ecole;
        }

        if (isset($request->type_demande)) {
            $type_demande = $request->type_demande;
        }

        $classe_demande = $request->classe_demande;
        $transport = "";
        $id_transport = "";
        $montant_transport = 0;
        $sport = "";
        $type_sport = "";
        $frais_sport = 0;
        $montant_du = 0;
        $taux_reduction = 0;
        $tenue = "";
        $type_tenue = "";
        $frais_tenue = 0;
        if (isset($request->transport)) {
            $transport = $request->transport;
        }

        if (isset($request->id_transport)) {
            $id_transport = $request->id_transport;
        }

        if (isset($request->montant_transport)) {
            $montant_transport = $request->montant_transport;
        }

        if (isset($request->sport)) {

            $sport = $request->sport;
        }

        if (isset($request->type_sport)) {
            $type_sport = $request->type_sport;
        }

        if (isset($request->frais_sport)) {
            $frais_sport = $request->frais_sport;
        }

        if (isset($request->taux_reduction)) {
            $taux_reduction = $request->taux_reduction;
        }

        if (isset($request->montant_du)) {
            $montant_du = $request->montant_du;
        }

        if (isset($request->tenue)) {
            $tenue = $request->tenue;
        }
        if (isset($request->type_tenue)) {
            $type_tenue = $request->type_tenue;
        }

        if (isset($request->frais_tenue)) {
            $frais_tenue = $request->frais_tenue;
        }


        $annee_scolaire = $request->annee_scolaire;
        $datearrive = "";
        $datenaiss = "";
        $datesorti = "";

        if ($date_naissance != "") {
            $date = explode("/", $date_naissance);
            $datenaiss = $date[2] . '-' . $date[1] . '-' . $date[0];
        }

        if ($date_arr_anc != "") {

            $date = explode("/", $date_arr_anc);
            $datearrive = $date[2] . '-' . $date[1] . '-' . $date[0];
        } else


        if ($date_fin_anc != "") {

            $date = explode("/", $date_fin_anc);
            $datesorti = $date[2] . '-' . $date[1] . '-' . $date[0];
        }
        $nomtuteur = "";
        $prenomtuteur = "";
        $professiontuteur = "";
        $societetuteur = "";
        $adressetuteur = "";
        $regiontuteur = "";
        $emailtuteur = "";
        $telephonetuteur = "";
        $autorite_parental = "";
        $id_parent = "";
        //Informations Tuteur
       
        if (!isset($request->numero_eleve)) {
            if ($existParent == false) {

                $nomtuteur = $request->user->nom;
                $prenomtuteur = $request->user->prenom;
                $professiontuteur = $request->user->profession_tuteur;
                $societetuteur = $request->user->societe_tuteur;
                $adressetuteur = $request->user->adresse;
                $regiontuteur = $request->user->region_tuteur;
                $emailtuteur = $request->user->email;
                $telephonetuteur = $request->user->telephone;
                $autorite_parental = $request->user->autorite_parentale;

                $this->executeUpdate("Insert into utilisateur (nom, prenom, email, login,password, telephone, adresse, profession_tuteur, region_tuteur, societe_tuteur,autorite_parentale,profile_id) "
                        . "values ('$nomtuteur', '$prenomtuteur', '$emailtuteur','$telephonetuteur', 'passer1', '$telephonetuteur','$adressetuteur','$professiontuteur','$regiontuteur','$societetuteur','$autorite_parental',2)");
                // $this->executeUpdate("Insert into eleves (adresse, date_naissance, lieu_naissance, nom, prenom, civilite, boursier, montant_bourse, nationalite, ancEtab, date_arr_anc, date_fin_anc, adresse_dernier_ecole,region_dernier_ecole, email_dernier_ecole, telephone_dernier_ecole, nomtuteur, prenomtuteur, professiontuteur, societetuteur, adressetuteur, regiontuteur, emailtuteur, telephonetuteur, autorite_parental, type_demande, classe_demande, transport, itineraire_transport, sport, taux_reduction) values ('$adresse', '$date_naissance', '$lieu_naissance', '$nom', '$prenom', '$civilite', '$boursier', '$montant_bourse', '$nationalite', '$ancEtab','$date_arr_anc','$date_fin_anc','$adresse_dernier_ecole','$region_dernier_ecole','$email_dernier_ecole','$telephone_dernier_ecole','$nomtuteur','$prenomtuteur', '$professiontuteur', '$societetuteur', '$adressetuteur', '$regiontuteur', '$emailtuteur', '$telephonetuteur', '$autorite_parental', '$type_demande', '$classe_demande', '$transport', '$itineraire_transport', '$sport', '$taux_reduction')");

                $id_parent = $this->GetLastUser()[0]['id_parent'];
            } else {
                $id_parent = $request->id_parent;
            }



            $this->executeUpdate("Insert into eleves (date_naissance, handicape, type_handicape, lieu_naissance, nom, prenom, civilite, boursier, montant_bourse, nationalite, ancEtab, "
                    . "date_arr_anc, date_fin_anc, adresse_dernier_ecole,region_dernier_ecole, email_dernier_ecole, "
                    . "telephone_dernier_ecole, type_demande, transport, id_transport, montant_transport, sport,"
                    . " type_sport, frais_sport, taux_reduction, montant_du, tenue, type_tenue, frais_tenue, "
                    . "avatar,id_parent,tarif) values ('$datenaiss','$handicape','$type_handicape', '$lieu_naissance', '$nom', '$prenom', '$civilite', '$boursier', '$montant_bourse', '$nationalite',"
                    . " '$ancEtab','$datearrive','$datesorti','$adresse_dernier_ecole','$region_dernier_ecole','$email_dernier_ecole',"
                    . "'$telephone_dernier_ecole', '$type_demande', '$transport', '$id_transport', '$montant_transport',"
                    . " '$sport', '$type_sport', '$frais_sport', '$taux_reduction', '$montant_du', '$tenue', '$type_tenue', "
                    . "'$frais_tenue','$nomAvatar','$id_parent','$tarif')");


            $lastNumEleve = $this->GetLastEleve()[0]['numero_eleve'];

            $this->executeUpdate("Insert into inscrit (date_inscription,id_classe, numero_eleve, annee_scolaire) values (NOW(), '$classe_demande', '$lastNumEleve', '$annee_scolaire')");

            
$strLogin = strtolower($prenom) . strtolower($nom) . $lastNumEleve;
            $this->executeUpdate("Insert into utilisateur (nom, prenom, login, password, adresse,avatar,profile_id,id_etudiant) "
                    . "values ('$nom', '$prenom', '$strLogin', 'passer1','$adressetuteur','$nomAvatar',5,$lastNumEleve)");
            // $this->executeUpdate("Insert into eleves (adresse, date_naissance, lieu_naissance, nom, prenom, civilite, boursier, montant_bourse, nationalite, ancEtab, date_arr_anc, date_fin_anc, adresse_dernier_ecole,region_dernier_ecole, email_dernier_ecole, telephone_dernier_ecole, nomtuteur, prenomtuteur, professiontuteur, societetuteur, adressetuteur, regiontuteur, emailtuteur, telephonetuteur, autorite_parental, type_demande, classe_demande, transport, itineraire_transport, sport, taux_reduction) values ('$adresse', '$date_naissance', '$lieu_naissance', '$nom', '$prenom', '$civilite', '$boursier', '$montant_bourse', '$nationalite', '$ancEtab','$date_arr_anc','$date_fin_anc','$adresse_dernier_ecole','$region_dernier_ecole','$email_dernier_ecole','$telephone_dernier_ecole','$nomtuteur','$prenomtuteur', '$professiontuteur', '$societetuteur', '$adressetuteur', '$regiontuteur', '$emailtuteur', '$telephonetuteur', '$autorite_parental', '$type_demande', '$classe_demande', '$transport', '$itineraire_transport', '$sport', '$taux_reduction')");
        } else {
             $this->executeUpdate("Update eleves set nom='$nom', prenom='$prenom', civilite='$civilite', boursier='$boursier',handicape='$handicape',type_handicape='$type_handicape',date_naissance='$datenaiss',lieu_naissance='$lieu_naissance', montant_bourse='$montant_bourse',
            	 nationalite='$nationalite', ancEtab='$ancEtab', date_arr_anc='$datearrive', date_fin_anc='$datesorti', avatar='$nomAvatar',
		adresse_dernier_ecole='$adresse_dernier_ecole',region_dernier_ecole='$region_dernier_ecole', email_dernier_ecole='$email_dernier_ecole',
		 telephone_dernier_ecole='$telephone_dernier_ecole', type_demande='$type_demande', 
		 transport='$transport', id_transport='$id_transport', montant_transport='$montant_transport', sport='$sport', 
		 type_sport='$type_sport', frais_sport='$frais_sport', taux_reduction='$taux_reduction', montant_du='$montant_du',
		 tenue='$tenue', type_tenue='$type_tenue', frais_tenue='$frais_tenue' , tarif ='$tarif' where numero_eleve='$numero_eleve'");
            $this->executeUpdate("Insert into inscrit (date_inscription,id_classe, numero_eleve, annee_scolaire) values (NOW(), '$classe_demande', '$numero_eleve', '$annee_scolaire')");
        }
    }
    public function UpdateEleve() {

        
        
        $nomtuteur = "";
        $prenomtuteur = "";
        $professiontuteur = "";
        $societetuteur = "";
        $adressetuteur = "";
        $regiontuteur = "";
        $emailtuteur = "";
        $autorite_parental = "";
        
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $numero_eleve = $request->numero_eleve;
        $date_naissance = $request->date_naissance;
        $lieu_naissance = $request->lieu_naissance;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $nationalite = $request->nationalite;
        $montant_bourse = $request->montant_bourse;
        $boursier = $request->boursier;
        $handicape = $request->handicape;
        $type_handicape = $request->type_handicape;
        $civilite = $request->civilite;
        $ancEtab = $request->ancEtab;
        $date_arr_anc = $request->date_arr_anc;
        $date_fin_anc = $request->date_fin_anc;
        $adresse_dernier_ecole = $request->adresse_dernier_ecole;
        $region_dernier_ecole = $request->region_dernier_ecole;
        $email_dernier_ecole = $request->email_dernier_ecole;
        $telephone_dernier_ecole = $request->telephone_dernier_ecole;
        $type_demande = $request->type_demande;
        $tarif = $request->tarif;
        $transport = $request->transport;
        $id_transport = $request->id_transport;
        $montant_transport = $request->montant_transport;
        $sport = $request->sport;
        $type_sport = $request->type_sport;
        $frais_sport = $request->frais_sport;
        $taux_reduction = $request->taux_reduction;
        $montant_du = $request->montant_du;
        $tenue = $request->tenue;
        $type_tenue = $request->type_tenue;
        $frais_tenue = $request->frais_tenue;
        $id_parent = $request->id_parent;
        $classe_demande = $request->classe_demande;
        $annee_scolaire = $request->annee_scolaire;
        $anc_classe_demande = $request->anc_classe_demande;
        $date = explode("/", $date_naissance);
        $datenaiss = $date[2] . '-' . $date[1] . '-' . $date[0];

        $date = explode("/", $date_arr_anc);
        $datearrive = $date[2] . '-' . $date[1] . '-' . $date[0];

        $date = explode("/", $date_fin_anc);
        $datesorti = $date[2] . '-' . $date[1] . '-' . $date[0];

        $avatar = $request->name;
        
          if (isset($request->user->nom)) {
            $nomtuteur = $request->user->nom;
         
        }

        
         if (isset($request->user->prenom)) {
            $prenomtuteur = $request->user->prenom;
         
        }
        
        if (isset($request->user->profession_tuteur)) {
           $professiontuteur = $request->user->profession_tuteur;
        }

         if (isset($request->user->societe_tuteur)) {
                $societetuteur = $request->user->societe_tuteur;
        }

        if (isset($request->user->adresse)) {
                $adressetuteur = $request->user->adresse;
        }
         if (isset($request->user->region_tuteur)) {
                $regiontuteur = $request->user->region_tuteur;
        }
        
         if (isset($request->user->email)) {
          
                $emailtuteur = $request->user->email;
        }
        
        if (isset($request->user->email)) {
          
                $autorite_parental = $request->user->autorite_parentale;
        }
        
        

        $this->executeUpdate("Update eleves set nom='$nom', prenom='$prenom', civilite='$civilite', boursier='$boursier',handicape='$handicape',type_handicape='$type_handicape',date_naissance='$datenaiss',lieu_naissance='$lieu_naissance', montant_bourse='$montant_bourse',
            	 nationalite='$nationalite', ancEtab='$ancEtab', date_arr_anc='$datearrive', date_fin_anc='$datesorti', avatar='$avatar',
		adresse_dernier_ecole='$adresse_dernier_ecole',region_dernier_ecole='$region_dernier_ecole', email_dernier_ecole='$email_dernier_ecole',
		 telephone_dernier_ecole='$telephone_dernier_ecole', type_demande='$type_demande', 
		 transport='$transport', id_transport='$id_transport', montant_transport='$montant_transport', sport='$sport', 
		 type_sport='$type_sport', frais_sport='$frais_sport', taux_reduction='$taux_reduction', montant_du='$montant_du',
		 tenue='$tenue', type_tenue='$type_tenue', frais_tenue='$frais_tenue' , tarif ='$tarif' where numero_eleve='$numero_eleve'");
        
      
      $id= $this->GetInscrit($annee_scolaire,$anc_classe_demande,$numero_eleve)[0]['id'];
      
      $this->executeUpdate("Update  inscrit set annee_scolaire='$annee_scolaire' , id_classe='$classe_demande' where id='$id'");
      
      $this->executeUpdate("Update  utilisateur set nom='$nomtuteur', prenom='$prenomtuteur', email='$emailtuteur', adresse='$adressetuteur', profession_tuteur='$professiontuteur', region_tuteur='$regiontuteur', societe_tuteur='$societetuteur',autorite_parentale='$autorite_parental' where id='$id_parent'");
               
    }

     public function GetInscrit($annee,$idClasse,$numero_eleve) {
        $reponse = $this->executeList("SELECT id  FROM inscrit where id_classe='$idClasse' and annee_scolaire='$annee' and numero_eleve='$numero_eleve'");
        return $reponse;
    }

    public function GetLastEleve() {
        $reponse = $this->executeList("SELECT max(numero_eleve) as numero_eleve FROM eleves");
        return $reponse;
    }

	public function GetAncEtab() {
        $reponse = $this->executeList("SELECT distinct ancEtab FROM eleves");
        return $reponse;
    }
	
	public function GetInfoAncEtab($etab) {
        $reponse = $this->executeList("SELECT adresse_dernier_ecole, email_dernier_ecole, telephone_dernier_ecole, region_dernier_ecole FROM eleves where ancEtab='$etab' limit 1");
        return $reponse;
    }
	
    public function GetEleve($eleve_id) {
        $reponse = $this->executeList("SELECT * FROM eleves where numero_eleve='$eleve_id'");
        return $reponse;
    }

    public function GetLastUser() {
        $reponse = $this->executeList("SELECT max(id) as id_parent FROM utilisateur");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new InscriptionManager)
        ->addPostRoute('AddEleve', 'AddEleve')
        ->addPostRoute('UpdateEleve', 'UpdateEleve')
        ->addPostRoute('stockAvatar', 'stockAvatar')
        ->addGetRoute('GetLastEleve', 'GetLastEleve')
        ->addGetRoute('GetEleve/(.*)', 'GetEleve')
        ->addGetRoute('GetLastUser', 'GetLastUser')
        ->addGetRoute('GetAncEtab', 'GetAncEtab')
	->addGetRoute('GetInfoAncEtab/(.*)', 'GetInfoAncEtab')
	 ->addGetRoute('GetInscrit', 'GetInscrit')

		
        ->run();
