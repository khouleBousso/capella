<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class NoteManager extends BDManager {

    public function getNoteMoyByEleve($numero_eleve, $matiere, $typeMoy, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT * FROM note WHERE numero_eleve='$numero_eleve'"
                . " and id_matiere='$matiere' and annee_scolaire='$annee_scolaire' and id_examen='$typeMoy' and semestre='$semestre'");

        return $reponse;
    }

    public function getNotesEleveByMatiere($numero_eleve, $matiere, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT * FROM note n ,matiere m,examen e,type_examen t where e.id_type_examen=t.id "
                . "and m.id_matiere = n.id_matiere and n.id_examen= e.id_examen and n.annee_scolaire='$annee_scolaire' and n.numero_eleve='$numero_eleve' and m.id_matiere ='$matiere'  and n.semestre='$semestre'");
        return $reponse;
    }

    public function getNoteByNote($numero_eleve, $matiere, $note, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT * FROM note n ,matiere m,examen e,type_examen t where e.id_type_examen=t.id "
                . "and m.id_matiere = n.id_matiere and n.id_examen= e.id_examen and n.annee_scolaire='$annee_scolaire' and n.numero_eleve='$numero_eleve' and m.id_matiere ='$matiere' and n.id_note='$note'  and n.semestre='$semestre'");
        return $reponse;
    }

    public function getExistComp($numero_eleve, $matiere, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT * FROM note n ,examen e where "
                . "  n.id_examen= e.id_examen and e.id_type_examen = 2 and n.annee_scolaire='$annee_scolaire' and n.numero_eleve='$numero_eleve' and n.id_matiere ='$matiere' and n.semestre='$semestre'");
        return $reponse;
    }

    public function addNote() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->id_matiere;
        $id_type_examen = $request->id_type_examen;
        $numero_eleve = $request->numero_eleve;
        $annee_scolaire = $request->annee_scolaire;
        $semestre = $request->semestre;
        $libelle = $request->libelle;
        $note = $request->note;
        $user = $request->user;

        $this->executeUpdate("Insert into examen (id_type_examen,libelle) values ('$id_type_examen','$libelle')");

        $lastExamen = $this->GetLastExamen()[0]['id_examen'];

        $this->executeUpdate("Insert into note (note, numero_eleve,id_matiere,id_examen,annee_scolaire,date_modification,user,semestre) values ( '$note', '$numero_eleve','$id_matiere','$lastExamen','$annee_scolaire',NOW(),'$user','$semestre')");
    }

    public function addNoteMoy() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->id_matiere;
        $id_type_examen = $request->typemoy;
        $numero_eleve = $request->numero_eleve;
        $annee_scolaire = $request->annee_scolaire;
        $semestre = $request->semestre;
        $note = $request->note;
        $this->executeUpdate("Insert into note (annee_scolaire, id_examen,id_matiere,numero_eleve,note,semestre) values ( '$annee_scolaire', '$id_type_examen',"
                . " '$id_matiere','$numero_eleve','$note','$semestre')");
    }

    public function modNoteMoy() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_notemoy = $request->id_note;
        $note = $request->note;
        $this->executeUpdate("Update  note set note='$note' where id_note='$id_notemoy'");
    }

    public function modNote() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_note = $request->id_note;
        $id_examen = $request->id_examen;
        $libelle = $request->libelle;
        $note = $request->note;
        $user = $request->user;


        $this->executeUpdate("Update  examen set libelle='$libelle' where id_examen='$id_examen'");
        $this->executeUpdate("Update note set note='$note',user='$user',date_modification=NOW() where id_note='$id_note'");
    }

    public function GetLastExamen() {
        $reponse = $this->executeList("SELECT max(id_examen) as id_examen FROM examen");
        return $reponse;
    }

    public function DeleteNote($idnote) {

        $reponse = $this->executeList("DELETE FROM note WHERE id_note = '$idnote'");
        return $reponse;
    }

    public function GetIdExamenByNote($id_note) {
        $reponse = $this->executeList("SELECT id_examen from note where  id_note = '$id_note'");
        return $reponse;
    }

    public function getPresencesEleveByMatiere($numero_eleve, $matiere, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT p.id_presence,p.type_presence,p.id_matiere,p.numero_eleve,DATE_FORMAT(date,'%d/%m/%Y') as date,p.annee_scolaire"
                . ",m.*,t.* FROM presence p ,matiere m,type_presence t where t.id_type_presence=p.type_presence "
                . "and m.id_matiere = p.id_matiere and p.annee_scolaire='$annee_scolaire' and p.numero_eleve='$numero_eleve' and m.id_matiere ='$matiere' and p.semestre='$semestre'");
        return $reponse;
    }

    public function getPresencesByPresence($numero_eleve, $matiere, $presence, $annee_scolaire, $semestre) {
        $reponse = $this->executeList("SELECT p.id_presence,p.type_presence,p.id_matiere,p.numero_eleve,DATE_FORMAT(date,'%d/%m/%Y') as date,p.annee_scolaire"
                . ",m.*,t.* FROM presence p ,matiere m,type_presence t where t.id_type_presence=p.type_presence "
                . "and m.id_matiere = p.id_matiere and p.annee_scolaire='$annee_scolaire' and p.numero_eleve='$numero_eleve' and m.id_matiere ='$matiere' and p.id_presence='$presence' and p.semestre='$semestre'");
        return $reponse;
    }

    public function addAllPresences() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->matiere->id_matiere;
        $type_presences = $request->type_presences;
        $motifs = $request->motifs;
        $numero_eleves = $request->numero_eleves;
        $annee_scolaire = $request->annee_scolaire;
        $semestre = $request->semestre;
        $index = 0;
        for ($index; $index < count($numero_eleves); $index++) {
            $type_presence = $type_presences[$index]->presence;
            $motif_renvoi = $motifs[$index]->motif_renvoi;
            $numero_eleve = $numero_eleves[$index]->numero_eleve;
            $this->executeUpdate("Insert into presence (type_presence, numero_eleve,id_matiere,date,annee_scolaire,semestre,motif_renvoi) values ( '$type_presence', '$numero_eleve', '$id_matiere',NOW(),'$annee_scolaire','$semestre','$motif_renvoi')");
        }
    }

    public function addAllNote() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->matiere->id_matiere;
        $type = $request->type;
        $numero_eleves = $request->numero_eleves;
        $annee_scolaire = $request->annee_scolaire;
        $libelle = $request->libelle;
        $semestre = $request->semestre;
        $user = $request->user;
        $notes = $request->notes;
        $index = 0;
        $this->executeUpdate("Insert into examen (id_type_examen,libelle) values ('$type','$libelle')");
        $lastExamen = $this->GetLastExamen()[0]['id_examen'];
        for ($index; $index < count($numero_eleves); $index++) {
            $note = $notes[$index]->note;
            $numero_eleve = $numero_eleves[$index]->numero_eleve;
            $id_note = 0;
            if ($type == 2) {
                $existComp = $this->getExistComp($numero_eleve, $id_matiere, $annee_scolaire, $semestre);
                if (count($existComp) != 0) {
                    $id_note = $existComp[0]['id_note'];
                    $this->executeUpdate("Update note set note ='$note' where id_note = '$id_note'");
                } else {
                    $this->executeUpdate("Insert into note (note, numero_eleve,id_matiere,id_examen,annee_scolaire,date_modification,user,semestre) values ( '$note', '$numero_eleve','$id_matiere','$lastExamen','$annee_scolaire',NOW(),'$user','$semestre')");
                }
            } else {    
                $this->executeUpdate("Insert into note (note, numero_eleve,id_matiere,id_examen,annee_scolaire,date_modification,user,semestre) values ( '$note', '$numero_eleve','$id_matiere','$lastExamen','$annee_scolaire',NOW(),'$user','$semestre')");
            }
        }
    }

    public function addPresence() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_matiere = $request->id_matiere;
        $type_presence = $request->type_presence;
        $numero_eleve = $request->numero_eleve;
        $annee_scolaire = $request->annee_scolaire;
        $semestre = $request->semestre;
        $date = $request->date;
        $dateExplode = explode("/", $date);
        $datePresence = $dateExplode[2] . '-' . $dateExplode[1] . '-' . $dateExplode[0];

        $this->executeUpdate("Insert into presence (type_presence, numero_eleve,id_matiere,date,annee_scolaire,semestre) values ( '$type_presence', '$numero_eleve', '$id_matiere','$datePresence','$annee_scolaire','$semestre')");
    }

    public function modPresence() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_presence = $request->id_presence;
        $type_presence = $request->type_presence;
        $date = $request->date;
        $dateExplode = explode("/", $date);
        $datePresence = $dateExplode[2] . '-' . $dateExplode[1] . '-' . $dateExplode[0];

        $this->executeUpdate("Update presence set date='$datePresence' ,type_presence='$type_presence' where id_presence='$id_presence'");
    }

    public function DeletePresence($id_presence) {
        $reponse = $this->executeList("DELETE FROM presence WHERE id_presence = '$id_presence'");
        return $reponse;
    }

    public function getAnneesScolaire($numero_eleve) {
        $reponse = $this->executeList("Select i.annee_scolaire,c.code_classe from inscrit i,classe c WHERE c.id_classe = i.id_classe and i.numero_eleve = '$numero_eleve' order by i.annee_scolaire desc");
        return $reponse;
    }

    
    public function getRangMoy($numero_eleve, $matiere, $typeMoy, $annee_scolaire, $semestre) {

        $reponse = $this->executeList("SELECT nom,coef, note as noteFinale , (select count(*) + 1 from note  s ,matiere ma
                  ,type_examen ta ,examen ea WHERE s.id_matiere=ma.id_matiere and s.annee_scolaire='$annee_scolaire'
                  and s.id_examen = ea.id_examen and ea.id_type_examen = ta.id and ta.id !=1 and ta.type='noteFinale' 
                  and ma.id_matiere = '$matiere' and s.semestre='$semestre' and n.note < s.note ) as rang FROM note n ,matiere m 
                  ,type_examen t ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire'
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and n.id_examen='$typeMoy'   and m.id_matiere ='$matiere' and  n.semestre='$semestre'");

        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new NoteManager)
        ->addGetRoute('getNotesEleveByMatiere', 'getNotesEleveByMatiere')
        ->addGetRoute('getPresencesEleveByMatiere', 'getPresencesEleveByMatiere')
        ->addPostRoute('addNote', 'addNote')
        ->addPostRoute('addNoteMoy', 'addNoteMoy')
        ->addPostRoute('addPresence', 'addPresence')
        ->addPostRoute('modNote', 'modNote')
        ->addPostRoute('addAllPresences', 'addAllPresences')
        ->addPostRoute('addAllNote', 'addAllNote')
        ->addPostRoute('modPresence', 'modPresence')
        ->addPostRoute('modNoteMoy', 'modNoteMoy')
        ->addGetRoute('GetLastExamen', 'GetLastExamen')
        ->addGetRoute('getNoteMoyByEleve', 'getNoteMoyByEleve')
        ->addGetRoute('getExistComp', 'getExistComp')
        ->addGetRoute('DeleteNote', 'DeleteNote')
        ->addGetRoute('GetIdExamenByNote/(.*)', 'GetIdExamenByNote')
        ->addGetRoute('DeletePresence/(.*)', 'DeletePresence')
        ->addGetRoute('getAnneesScolaire/(.*)', 'getAnneesScolaire')
        ->addGetRoute('getPresencesByPresence', 'getPresencesByPresence')
        ->addGetRoute('getNoteByNote', 'getNoteByNote')
        ->addGetRoute('getRangMoy', 'getRangMoy')
        ->run();
