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

if (isset($_GET['limit']))
    $limit = $_GET['limit'];

if (isset($_GET['semestre']))
    $semestre = $_GET['semestre'];


if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];



if (isset($_GET['idclasse']) && isset($_GET['semestre']) && isset($_GET['annee_scolaire'])) {

$countElevesReq= $bdd->query("SELECT  count(*) as nombre_eleves  from classe , inscrit,eleves where eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$idClasse' and annee_scolaire='$annee_scolaire'");

if($donneesCountEleves = $countElevesReq->fetch())
    $countEleves= $donneesCountEleves['nombre_eleves'];

   if (!isset($_GET['limit']))
    {

    $reponseEleves = $bdd->query("SELECT eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance ,classe.nom as nomClasse FROM inscrit, eleves , classe
			where eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$idClasse' and annee_scolaire='$annee_scolaire'");

    }else{

$reponseEleves = $bdd->query("SELECT eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance ,classe.nom as nomClasse FROM inscrit, eleves , classe
			where eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$idClasse' and annee_scolaire='$annee_scolaire' limit $limit, 20");
    }

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
    * {color: black ;}
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

<?php
for ($index = 0; $index < $nbEleves; $index++) {
    ?>
    <page backtop="5mm" backleft="10mm" backright="10mm" backbottom="10mm"> 


        <page_footer> 


        </page_footer>
        <table style="vertical-align:top;">
            <tr>

                <td style="width: 39%; border:none;background:white;"><img style="width: 65%;" src="images/iconee.jpg" alt="Logo"><br></td>
                <td style="width:15%"></td>
                <td style="width:25%"><img style="width: 60%;" src="images/bulletinTitre.png" alt="Logo"></td>
                <td style="width:25%"></td>
            </tr>
        </table><br/>
        <table style="width: 100%; font-size: 8px"><tr>
                <td style="width:40%"> </td>
                <?php
                if ($semestre == 1) {
                    echo '<td style="width: 35%;border:none;background:white "><strong style="font-size:16px">1ere Composition</strong></td>';
                }
                ?> 

                <?php
                if ($semestre == 2) {
                    echo '<td style="width: 35%;border:none;background:white "><strong style="font-size:16px">2eme Composition</strong></td>';
                }
                ?> 
                <td style="width:30%;"></td></tr> </table>

        <table style="width: 100%"><tr>
                <td style="width:41%"> </td>
                <td style="width: 35%;border:none;background:white;font-size:8px; ">Ann&eacute;e scolaire: <strong><?php print("$annee_scolaire") ?></strong></td>
                <td style="width:30%;"></td></tr> </table><br/><br/>



        <table  style="width: 100%; font-size:8px; border-collapse:collapse;">
            <tr>
                <td ROWSPAN=3 style="width:61%;border: solid 1px #000; padding:3mm 1mm;">Carte: <strong><?php echo $donneesAllEleves[$index]["numero_eleve"] ?> </strong>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
                    El&egrave;ve: <strong><?php echo $donneesAllEleves[$index]["prenom"] ?> <?php echo $donneesAllEleves[$index]["nom"] ?></strong> <br/>Date naissance: <strong><?php echo $donneesAllEleves[$index]["date_naissance"] ?> </strong>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &agrave;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <strong><?php echo $donneesAllEleves[$index]["lieu_naissance"] ?> </strong><br/>
                    Nom classe: <strong><?php echo $donneesAllEleves[$index]["nomClasse"] ?></strong></td>
                <td style="border: solid 1px #000; padding:3mm 1mm;width: 43%">Options: <strong></strong></td>  
            </tr>
            <tr>
                <td style="border: solid 1px #000; padding:3mm 1mm;">Nombre d'absence: <strong><?php echo $donneesNbAbinj[$index] ?></strong></td>
            </tr>
            <tr>
                <td style="border: solid 1px #000; padding:3mm 1mm;">Nombre de retard: <strong><?php echo $donneesNbRetards[$index] ?></strong></td>
            </tr>						 
        </table>



        <table style="width: 100%;font-size:8px;border-collapse:collapse;" >
            <tr>

                <th style="width: 22%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Mati&egrave;res</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Coef</strong></th>
                <th style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>N.Con</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Comp</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Moy</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Total</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Sur</strong></th>
                <th style="width: 8% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Rang</strong></th>
                <th style="width: 22% ;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>Appr&eacute;ciations</strong></th>
            </tr>
            <?php
            for ($indexNotes = 0; $indexNotes < $donnnesCountNotes[$index]; $indexNotes++) {
                ?>    

                <tr><td style="width: 22%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong><?php echo $donneesAllNotes[$index][$indexNotes]['nom'] ?></strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong><?php echo $donneesAllNotes[$index][$indexNotes]['coef'] ?></strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong><?php echo $donneesAllNotes[$index][$indexNotes]['noteMoyCC'] ?></strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong><?php echo $donneesAllNotes[$index][$indexNotes]['composition'] ?></strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center"><?php echo $donneesAllNotes[$index][$indexNotes]['noteFinale'] ?></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center"><?php echo $donneesTotal[$index][$indexNotes] ?></td>
                    <td style="width: 8%;border: solid 1px #000;padding:3mm 1mm; text-align:center"><?php echo $donneesSur[$index][$indexNotes] ?></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center"><?php echo $donneesRangmatiere[$index][$indexNotes] ?></td>
                    <td style="width: 22%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td  style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"><strong>Total: </strong></td>	
                <td style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"> <strong><?php print("$donneesTotalCoef[$index]") ?> </strong></td> 
                <td colSPAN=3  style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"></td> 
                <td style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"> <strong><?php print("$donneesTotalTotal[$index]") ?> </strong></td>
                <td colSPAN=3  style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"></td> 
            </tr>
        </table>

        <table  style="width: 100%; font-size:8px; border-collapse:collapse;">
            <tr>
                <td ROWSPAN=3 style="width:61%;border: solid 1px #000; padding:3mm 1mm;">  
                <img style="width: 2%;text-align:center;" src="images/images.png" alt="Logo">&nbsp; &nbsp;&nbsp; Félicitation&nbsp; &nbsp;&nbsp; 
                <img style="width: 2%;" src="images/images.png" alt="Logo"> &nbsp; &nbsp;&nbsp;Encouragement&nbsp; &nbsp;&nbsp; 
				<img style="width: 2%;" src="images/images.png" alt="Logo">  &nbsp;&nbsp; &nbsp;Tableau d'honneur
                <br/>
				<img style="width: 2%;" src="images/images.png" alt="Logo"> &nbsp; &nbsp;&nbsp;Avertissement&nbsp;&nbsp; &nbsp;
				<img style="width: 2%;" src="images/images.png" alt="Logo">&nbsp;&nbsp; &nbsp;Blame </td>  
<td style="border: solid 1px #000; padding:3mm 1mm;width: 43%;font-size:12px">M: <strong ><?php print($donneesFormatMoy[$index]) ?>/20 </strong><br/> R: <strong><?php print($donneesRang[$index]) ?> / <?php print($countEleves) ?></strong><br>          
                 <?php
                if ($semestre == 2) {
                 ?>   
                    <br>
                    M 1er Sem :  <strong><?php print(number_format($donneesMoy1[$index], 2, '.', ' ')) ?>/20 </strong><br> 
                    M G&eacute;n&eacute;rale :  <strong><?php print($donneesFormatMoyGen[$index]) ?>/20 </strong><br> 
                    Rang annuel :  <strong><?php print($donneesRangAnnuel[$index]) ?> / <?php print($nbEleves) ?></strong>
             <?php
                }
                ?>  
                </td>  
            </tr>
        </table>


       <table  style="width: 100%; font-size:8px; border-collapse:collapse;">
        <tr>
            <th style="width: 34%; padding:3mm 1mm;text-align:center; border-collapse:collapse;;border: solid 1px #000;">Appr&eacute;ciation du Directeur</th>
        </tr>
        <tr>
            <td style="border: solid 1px #000; padding:3mm 1mm;width: 104%">
               <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo"> &nbsp;&nbsp; Excellent élève &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">&nbsp; &nbsp; Très bon élève 
                <br/>
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">  &nbsp;&nbsp;  Bon élève &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;Assez bon élève  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Signature du Directeur <br/> 
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;Passable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">&nbsp; &nbsp;Doit redoubler d'effort <br/> 
                <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo"> &nbsp; Risque de redoubler sa classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
               <img style="width: 1%;text-align:center;" src="images/images.png" alt="Logo">&nbsp;&nbsp; Risque de ne pas etre conservé en classe  </td>  
        </tr>
    </table>

    </page>

    <?php
}
?>
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