<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$nbEleves = 0;
$idClasse = 0;
$reponseEleves = [];
$donneesAllEleves = [];
$nbRetards = 0;
$nbAbinj = 0;
$donnnesCountNotes = [];
$donneesMoy1=[];
$donneesMoy2=[];
$donneesMoyGenerale=[];
$donneesFormatMoyGen =[];
$donneesRangAnnuel= [];
if (isset($_GET['idclasse']))
    $idClasse = $_GET['idclasse'];

if (isset($_GET['semestre']))
    $semestre = $_GET['semestre'];


if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];



if (isset($_GET['idclasse']) && isset($_GET['semestre']) && isset($_GET['annee_scolaire'])) {


    $reponseEleves = $bdd->query("SELECT eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance ,classe.nom as nomClasse FROM inscrit, eleves , classe
			where eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$idClasse' and annee_scolaire='$annee_scolaire'");



    $indexEleves = 0;

    $indexNotes = 0;

    while ($donneesEleves = $reponseEleves->fetch()) {

        $indexNotesMatieres = 0;

        $numero_eleve = $donneesEleves["numero_eleve"];

        $reponsePresences = $bdd->query("select * from (SELECT count(*) as nbAbinj FROM presence p ,matiere m,type_presence t ,dispense d  where t.id_type_presence=p.type_presence and m.id_matiere ="
                . " p.id_matiere and m.id_matiere=d.id_matiere  and p.annee_scolaire='$annee_scolaire' and p.numero_eleve='$numero_eleve' and d.semestre ='$semestre' and t.type='ABINJ')"
                . " as tabABINJ , (SELECT count(*) as nbRetards FROM presence p ,matiere m,type_presence t,dispense d "
                . " where t.id_type_presence=p.type_presence and m.id_matiere = p.id_matiere  and m.id_matiere=d.id_matiere  and p.annee_scolaire='$annee_scolaire'"
                . " and p.numero_eleve='$numero_eleve' and d.semestre ='$semestre' and p.semestre = '$semestre' and t.type='RETARD') as tabRETARD");

        $reponse = $bdd->query("SELECT m.* ,e.numero_eleve,e.nom as nomEleve,e.prenom , e.numero_eleve ,DATE_FORMAT(e.date_naissance,'%d/%m/%Y') as date_naissance, e.lieu_naissance,c.nom as nomClasse FROM inscrit i ,eleves e,dispense d,matiere m,classe c where m.id_matiere=d.id_matiere and i.id_classe = d.id_classe and c.id_classe=d.id_classe "
                . " and i.numero_eleve = e.numero_eleve and i.numero_eleve = '$numero_eleve' and i.annee_scolaire='$annee_scolaire' and d.semestre = '$semestre' and m.archive=0");

        $donneesAllEleves[$indexEleves] = $donneesEleves;


        if ($donnees = $reponsePresences->fetch()) {
            $donneesNbRetards[$indexNotes] = $donnees['nbRetards'];
            $donneesNbAbinj[$indexNotes] = $donnees['nbAbinj'];
        }


        $donneesFormatMoy[$indexNotes] = 0;
        $donneesRang[$indexNotes] = 0;
        $donneesMoy[$indexNotes] = 0;
        $donneesTotalCoef[$indexNotes] = 0;
        $donneesTotalTotal[$indexNotes] = 0;
        $donneesMoy1[$indexNotes] =0;
        $donneesFormatMoyGen[$indexNotes] = 0;
        $donneesMoy2[$indexNotes] = 0;
        $donneesMoyGenerale[$indexNotes]=0;
        $donneesRangAnnuel[$indexNotes]=0;
        while ($donneesMatiere = $reponse->fetch()) {

            $id_matiere = $donneesMatiere['id_matiere'];

            $allNotes = $bdd->query("select tabAll.nom,tabAll.coef,tabAll.composition,tabAll.noteMoyCC,tabAll.noteFinale from 
                  (select * from (SELECT nom as nomComp,coef as coefComp,note as composition FROM note n ,matiere m ,type_examen t ,examen e 
                  WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' and n.id_examen = e.id_examen 
                  and e.id_type_examen = t.id and t.id !=1 and t.type='Composition' and m.id_matiere  ='$id_matiere' and n.semestre ='$semestre') as tabComp, 
                  (SELECT nom  as nomMoyCC,coef as coefMoyCC,note as noteMoyCC FROM note n ,matiere m ,type_examen t 
                  ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' 
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteMoyCC' 
                  and m.id_matiere  ='$id_matiere' and n.semestre ='$semestre') as tabMoyCC,(SELECT nom,coef, note as noteFinale FROM note n ,matiere m 
                  ,type_examen t ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire'
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteFinale' 
                  and m.id_matiere ='$id_matiere' and n.semestre ='$semestre') as tabFinale) as tabAll");


            $reponsegetRangMatiere = $bdd->query("SELECT (select count(*) + 1 FROM note ne  ,matiere me
                  ,type_examen te ,examen ee
                                       WHERE  n.note < ne.note and ne.id_matiere=me.id_matiere and ne.annee_scolaire='$annee_scolaire'
                  and ne.id_examen = ee.id_examen and ee.id_type_examen = t.id and te.id !=1 and te.type='noteFinale' 
                  and me.id_matiere ='$id_matiere' and ne.semestre ='$semestre' 
                                      ) as rang_matiere FROM note n ,matiere m 
                  ,type_examen t ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire'
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteFinale' 
                  and m.id_matiere ='$id_matiere' and n.semestre ='$semestre' order by rang_matiere asc");
             
                if ($donnees = $reponsegetRangMatiere->fetch()) {
                 
                  $donneesRangmatiere[$indexNotes][$indexNotesMatieres] = $donnees['rang_matiere'];
                }
            
            
            $donneesTotal[$indexNotes][$indexNotesMatieres] = 0;
            $donneesSur[$indexNotes][$indexNotesMatieres] = 0;

            if ($donneesNotes = $allNotes->fetch()) {

                $donneesTotal[$indexNotes][$indexNotesMatieres] = $donneesNotes['coef'] * $donneesNotes['noteFinale'];
                $donneesSur[$indexNotes][$indexNotesMatieres] = $donneesNotes['coef'] * 20;

                $donneesTotalCoef[$indexNotes] = $donneesTotalCoef[$indexNotes] + $donneesNotes['coef'];

                $donneesTotalTotal[$indexNotes] = $donneesTotalTotal[$indexNotes] + $donneesTotal[$indexNotes][$indexNotesMatieres];

                $donneesAllNotes[$indexNotes][$indexNotesMatieres] = $donneesNotes;
                $indexNotesMatieres++;
            }
        }


        $donnnesCountNotes[$indexNotes] = $indexNotesMatieres;

        if ($donneesTotalCoef[$indexNotes] != 0) {

            $donneesMoy[$indexNotes] = $donneesTotalTotal[$indexNotes] / $donneesTotalCoef[$indexNotes];
            $donneesFormatMoy[$indexNotes] = number_format($donneesMoy[$indexNotes], 2, '.', ' ');
            //Verifie si la moyenne a ete auparavant deja calculee pour cet eleve
            $reponsegetMoyenne = $bdd->query("select * from moyenne e where e.annee_scolaire='$annee_scolaire' and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'");
            if ($donnees = $reponsegetMoyenne->fetch()) {

                $bdd->query("Update  moyenne e set moyenne='$donneesMoy[$indexNotes]' where e.annee_scolaire='$annee_scolaire' and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'");
            } else {
                $bdd->query("Insert into moyenne (semestre, annee_scolaire,numero_eleve,id_classe,moyenne) values ('$semestre','$annee_scolaire','$numero_eleve','$idClasse','$donneesMoy[$indexNotes]')");
            }
            
            if ($semestre == 1) {
                $reponseRang = $bdd->query("select numero_eleve ,moyenne , "
                        . "(select count(*) + 1 from moyenne s where e.moyenne < s.moyenne and  s.annee_scolaire='$annee_scolaire'"
                        . " and s.semestre= '$semestre' and s.id_classe= '$idClasse'  ) as rang  from moyenne e where e.annee_scolaire='$annee_scolaire' "
                        . "and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve' order by rang asc");
                
                if ($donnees = $reponseRang->fetch()) {
                    $donneesRang[$indexNotes] = $donnees['rang'];
                }
            } else if ($semestre == 2) {
                
                $reponseRang = $bdd->query("select numero_eleve ,moyenne as moyenne2 , (select count(*) + 1 from moyenne s where e.moyenne < s.moyenne and "
                        . " s.annee_scolaire='$annee_scolaire' and s.semestre=2 and s.id_classe= '$idClasse') as rang ,(select moyenne from moyenne e where e.annee_scolaire='$annee_scolaire'"
                        . " and e.semestre= 1 and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve') as moyenne1"
                        . "  from moyenne e where e.annee_scolaire='$annee_scolaire' and e.semestre= 2 and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'  order by rang asc");

                 
                if ($donnees = $reponseRang->fetch()) {
                    $donneesRang[$indexNotes] = $donnees['rang'];
                    $donneesMoy1[$indexNotes] = $donnees['moyenne1'];
                    $donneesMoy2[$indexNotes]  = $donnees['moyenne2'];

                    $donneesMoyGenerale[$indexNotes] = ( $donnees['moyenne1'] + $donnees['moyenne2']) / 2;
                    $donneesFormatMoyGen[$indexNotes] = number_format($donneesMoyGenerale[$indexNotes], 2, '.', ' ');
                }
                
                $reponsegetMoyenneGen = $bdd->query("select * from moyenne  where annee_scolaire='$annee_scolaire'  and id_classe= '$idClasse' and numero_eleve='$numero_eleve' and (semestre is null  or semestre='')");
                
                 if ($donnees = $reponsegetMoyenneGen->fetch()) {

                 $bdd->query("Update  moyenne  set moyenne_generale='$donneesFormatMoyGen[$indexNotes]' where annee_scolaire='$annee_scolaire'  and id_classe= '$idClasse' and numero_eleve='$numero_eleve' and (semestre is null or semestre='')");
   
                }
                else {
                    $bdd->query("Insert into moyenne (annee_scolaire,numero_eleve,id_classe,moyenne_generale) values ('$annee_scolaire','$numero_eleve','$idClasse','$donneesFormatMoyGen[$indexNotes]')");
                }
         
                $reponseRangAnnuel = $bdd->query("select numero_eleve ,moyenne_generale , "
                        . "(select count(*) + 1 from moyenne s where e.moyenne_generale < s.moyenne_generale and  s.annee_scolaire='$annee_scolaire' and (s.semestre is null or s.semestre='') and s.id_classe= '$idClasse'  ) as rang_annuel  "
                        . "from moyenne e where e.annee_scolaire='$annee_scolaire' "
                        . "and (e.semestre is null or e.semestre='') and e.numero_eleve = '$numero_eleve'  "
                        . "and e.id_classe= '$idClasse'  order by rang_annuel asc");
                   
                 if ($donnees = $reponseRangAnnuel->fetch()) {
                    $donneesRangAnnuel[$indexNotes] = $donnees['rang_annuel'];
                }
            }
        }


        $indexNotes++;
        $indexEleves++;
    }

    $nbEleves = $indexEleves;
}
ob_start();
?>
<style type="text/css">
    * {color: #717375 ;}
    p {margin:0 ;padding: 4mm 0 0 0;}
    hr {background:#717375;height:1px; border:none;}
    table{ border-collapse:collapse;width:  100%; color:#717375; font-size:10pt; font-family:helvetica; line-height:6mm;}
    table strong { color:#000;}
    td.right { text-align: right;}
    table.border td{ border: solid 1px #000; padding:3mm 1mm;}
    table.border th, td.black{ background:#000; color:#FFF; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm; text-align:left;}
    td.border { border: none;}
    .info{ border-collapse:collapse;width:  100%; color:#717375; font-size:10pt; font-family:helvetica; line-height:6mm;}
</style>
<page backtop="15mm" backleft="0mm"  backbottom="10mm"> 
    
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">  
        <tr>            
            <td style="width: 39%; border:none;background:white;"> <img style="width: 75%;" src="images/iconee.jpg" alt="Logo"><br></td>
            <td style="width: 30%; border:none;background:white"> </td>
            <td style="width: 35%; border:none;background:white"> Mbour, le <?php $date = date("d-m-Y");
print("$date")
?></td>

        </tr>


    </table><br>
    <br>    <br>    <br>   <table><tr>
          <td style="width: 40%; border:none;background:white"> </td>
          <td class="title" style="width: 60%; border:none;background:white" >EDITION LISTE DES BULLETINS <strong><?php print("$classe") ?> </strong></td>
    </tr></table><br>    <br>    
   
        
        <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt; margin-left:40px;">  
        <tr>           

            <th style="width: 5%">Carte</th>    
            <th style="width: 15%">El&egrave;ve</th>            
            <th style="width: 15%">Date et lieu naissance</th>
	    <th style="width: 12%">Moyen S1</th>
            <th style="width: 12%">Moyen S2</th>	
            <th style="width: 10%">Rang S2</th>
            <th style="width: 15%">Moy. An.</th>
            <th style="width: 10%">Rang An.</th>	

        </tr> 

    </table>  

    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt; margin-left:40px;">    
	<?php
        for ($indexEnc = 0; $indexEnc < $index; $indexEnc++) {
            ?> 
            <tr>
                <td style="width: 5%"><?php print(number_format($donnesNum[$indexEnc], 0, ',', ' ')) ?></td>
                <td style="width: 15%"><?php print($donnesNomprenom[$indexEnc]) ?></td>
                <td style="width: 15%"><?php print($donnesNaissance[$indexEnc]) ?></td>
                <td style="width: 15%"><?php print($donneesMoy1[$indexEnc]) ?></td>
                <td style="width: 15%"><?php print($donnesmoyens2[$indexEnc]) ?></td>
                <td style="width: 5%"><?php print($donnesrangs2[$indexEnc]) ?></td>
                <td style="width: 15%"><?php print($donnesmoyenan[$indexEnc]) ?></td>
               <td style="width: 5%"><?php print($donnesrangan[$indexEnc]) ?></td>
	  </tr>
            <?php
        }
        ?>	
        
     

    </table> 
</page>


<?php
$content = ob_get_clean();
// die($content);
require ('html2pdf/html2pdf.class.php');
try {
    $pdf = new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
    $pdf->Output('notes.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>