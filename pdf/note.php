<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$avatar = "";
$numero_eleve = "";
$semestre = "";
$annee_scolaire = "";
$nomClasse = "";
$lieu_naissance = "";
$date_naissance = "";
$prenom = "";
$nomEleve = "";
$totalCoef = 0;
$nbEleves = 0;
$totalTotal = 0;
$moy = 0;
$moy1 = 0;
$moy2 = 0;
$moygenerale = 0;
$idClasse = 0;
$formatMoy = 0;
$rang = 0;
$rangannuel = 0;
$reponseEleves = [];
$reponseRang = [];
$nbRetards = 0;
$nbAbinj = 0;
$reponse = [];
$donneesRangMatiere = [];
$formatMoyGen = 0;
if (isset($_GET['numero_eleve']))
    $numero_eleve = $_GET['numero_eleve'];

if (isset($_GET['semestre']))
    $semestre = $_GET['semestre'];


if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];



if (isset($_GET['numero_eleve']) && isset($_GET['annee_scolaire']) && isset($_GET['semestre'])) {



    $reponseNbEleves = $bdd->query("select count(numero_eleve) as nbEleves FROM inscrit where inscrit.id_classe IN (SELECT id_classe FROM inscrit where inscrit.numero_eleve='$numero_eleve' and annee_scolaire='$annee_scolaire') and annee_scolaire='$annee_scolaire'");

    $reponsePresences = $bdd->query("select * from (SELECT count(*) as nbAbinj FROM presence p ,matiere m,type_presence t ,dispense d  where t.id_type_presence=p.type_presence and m.id_matiere ="
            . " p.id_matiere and m.id_matiere=d.id_matiere  and p.annee_scolaire='$annee_scolaire' and p.numero_eleve='$numero_eleve' and d.semestre ='$semestre' and t.type='ABINJ')"
            . " as tabABINJ , (SELECT count(*) as nbRetards FROM presence p ,matiere m,type_presence t,dispense d "
            . " where t.id_type_presence=p.type_presence and m.id_matiere = p.id_matiere  and m.id_matiere=d.id_matiere and p.semestre = '$semestre' and p.annee_scolaire='$annee_scolaire'"
            . " and p.numero_eleve='$numero_eleve' and d.semestre ='$semestre' and t.type='RETARD') as tabRETARD");


    $reponseEleves = $bdd->query("SELECT  e.numero_eleve,e.nom as nomEleve,e.prenom ,e.avatar, "
            . " e.numero_eleve ,DATE_FORMAT(e.date_naissance,'%d/%m/%Y') as date_naissance, e.lieu_naissance,c.nom as nomClasse,c.id_classe"
            . " from eleves e , classe c,inscrit i where i.id_classe=c.id_classe and i.numero_eleve =e.numero_eleve and e.numero_eleve ='$numero_eleve' and i.annee_scolaire='$annee_scolaire'");


    $reponse = $bdd->query("SELECT m.* ,e.numero_eleve,e.nom as nomEleve,e.prenom , e.numero_eleve ,DATE_FORMAT(e.date_naissance,'%d/%m/%Y') as date_naissance, e.lieu_naissance,c.nom as nomClasse FROM inscrit i ,eleves e,dispense d,matiere m,classe c where m.id_matiere=d.id_matiere and i.id_classe = d.id_classe and c.id_classe=d.id_classe "
            . " and i.numero_eleve = e.numero_eleve and i.numero_eleve = '$numero_eleve' and i.annee_scolaire='$annee_scolaire' and d.semestre = '$semestre' and m.archive=0");


    if ($donnees = $reponseEleves->fetch()) {
        $numero_eleve = $donnees['numero_eleve'];
        $avatar = $donnees['avatar'];
        $nomEleve = $donnees['nomEleve'];
        $prenom = $donnees['prenom'];
        $date_naissance = $donnees['date_naissance'];
        $lieu_naissance = $donnees['lieu_naissance'];
        $nomClasse = $donnees['nomClasse'];
        $idClasse = $donnees['id_classe'];
    }

    if ($donnees = $reponsePresences->fetch()) {
        $nbRetards = $donnees['nbRetards'];
        $nbAbinj = $donnees['nbAbinj'];
    }

    if ($donnees = $reponseNbEleves->fetch()) {
        $nbEleves = $donnees['nbEleves'];
    }
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


<page  backleft="10mm" backright="10mm" backbottom="10mm"> 
    <page_footer> 


    </page_footer>
    <table style="vertical-align:top;">
        <tr>

            <td style="width: 39%; border:none;background:white;"><img style="width: 85%;" src="images/iconee.jpg" alt="Logo"><br></td>
            <td style="width:15%"></td>
            <td style="width:25%"><img style="width: 80%;" src="images/bulletinTitre.png" alt="Logo"></td>
            <td style="width:25%"></td>
        </tr>
    </table>
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
            <td style="width:30%;"></td></tr> </table><br/>

    <table style="width: 100%"><tr>
            <td style="width:41%"> </td>
            <td style="width: 35%;border:none;background:white;font-size:10px; "><strong> Ann&eacute;e scolaire: <?php print("$annee_scolaire") ?></strong></td>
            <td style="width:30%;"></td></tr> </table><br/><br/>



    <table  style="width: 100%; font-size:8px; border-collapse:collapse;">
        <tr>
            <td ROWSPAN=3 style="width:61%;border: solid 1px #000; padding:3mm 1mm;">Carte: <strong><?php print("$numero_eleve") ?> </strong>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
                El&egrave;ve: <strong><?php print("$prenom") ?> <?php print("$nomEleve") ?></strong> <br/>Date naissance: <strong><?php print("$date_naissance") ?> </strong>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &agrave;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <strong><?php print("$lieu_naissance") ?> </strong><br/>
                Nom classe: <strong><?php print("$nomClasse") ?></strong></td>
            <td style="border: solid 1px #000; padding:3mm 1mm;width: 43%">Options: <strong></strong></td>  
        </tr>
        <tr>
            <td style="border: solid 1px #000; padding:3mm 1mm;">Nombre d'absence: <strong><?php print("$nbAbinj") ?></strong></td>
        </tr>
        <tr>
            <td style="border: solid 1px #000; padding:3mm 1mm;">Nombre de retard: <strong><?php print("$nbRetards") ?></strong></td>
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
        if (isset($_GET['numero_eleve']) && isset($_GET['annee_scolaire']) && isset($_GET['semestre'])) {
            while ($donnees = $reponse->fetch()) {
                $id_matiere = $donnees['id_matiere'];
                
                $existMoyCC = $bdd->query("SELECT nom  as nomMoyCC,coef as coefMoyCC,note as noteMoyCC FROM note n ,matiere m ,type_examen t,
                                          examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' 
                                          and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteMoyCC' 
                                          and m.id_matiere  ='$id_matiere' and n.semestre='$semestre'");
               
                if($existMoyCC->fetch())
                {  
                  $allNotes = $bdd->query("select tabAll.nom,tabAll.coef,tabAll.composition,tabAll.noteMoyCC,tabAll.noteFinale from 
                  (select * from (SELECT nom as nomComp,coef as coefComp,note as composition FROM note n ,matiere m ,type_examen t ,examen e 
                  WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' and n.id_examen = e.id_examen 
                  and e.id_type_examen = t.id and t.id !=1 and t.type='Composition' and m.id_matiere  ='$id_matiere' and n.semestre='$semestre') as tabComp, 
                  (SELECT nom  as nomMoyCC,coef as coefMoyCC,note as noteMoyCC FROM note n ,matiere m ,type_examen t 
                  ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' 
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteMoyCC' 
                  and m.id_matiere  ='$id_matiere' and n.semestre='$semestre') as tabMoyCC,(SELECT nom,coef, note as noteFinale FROM note n ,matiere m 
                  ,type_examen t ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire'
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteFinale' 
                  and m.id_matiere ='$id_matiere' and n.semestre='$semestre') as tabFinale  ) as tabAll");
                }
                else{ 
                  $allNotes = $bdd->query("select tabAll.nom,tabAll.coef,tabAll.composition,tabAll.noteFinale from 
                  (SELECT * from (SELECT nom as nomComp,coef as coefComp,note as composition FROM note n ,matiere m ,type_examen t ,examen e 
                  WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire' and n.id_examen = e.id_examen 
                  and e.id_type_examen = t.id and t.id !=1 and t.type='Composition' and m.id_matiere  ='$id_matiere' and n.semestre='$semestre') as tabComp,
                  (SELECT nom,coef, note as noteFinale FROM note n ,matiere m 
                  ,type_examen t ,examen e WHERE n.id_matiere=m.id_matiere and n.numero_eleve='$numero_eleve' and n.annee_scolaire='$annee_scolaire'
                  and n.id_examen = e.id_examen and e.id_type_examen = t.id and t.id !=1 and t.type='noteFinale' 
                  and m.id_matiere ='$id_matiere' and n.semestre='$semestre') as tabFinale  ) as tabAll");

                }
                
                 
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
                 
                  $rangmatiere = $donnees['rang_matiere'];
                }
             
                $total = 0;
                $sur = 0;
                while ($donnees = $allNotes->fetch()) {
                     $moycc = $donnees ['noteMoyCC'];
                     
                    $total = $donnees['coef'] * $donnees['noteFinale'];
                    $sur = $donnees['coef'] * 20;

                    $totalCoef = $totalCoef + $donnees['coef'];

                    $totalTotal = $totalTotal + $total;
                    echo '<tr><td style="width: 22%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $donnees['nom'] .'</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $donnees['coef'] . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $moycc  . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $donnees['composition'] . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $donnees['noteFinale'] . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $total . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $sur . '</strong></td>
                    <td style="width: 8%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"><strong>' . $rangmatiere . '</strong></td>
                    <td style="width: 22%;border: solid 1px #000; padding:3mm 1mm; text-align:center;"></td>
                    </tr>';
                }
            }

            if ($totalCoef != 0) {
                $moy = $totalTotal / $totalCoef;
                $formatMoy = number_format($moy, 2, '.', ' ');



                //Verifie si la moyenne a ete auparavant deja calculee pour cet eleve
                $reponsegetRang = $bdd->query("select * from moyenne e where e.annee_scolaire='$annee_scolaire' and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'");
                if ($donnees = $reponsegetRang->fetch()) {

                    $bdd->query("Update  moyenne e set moyenne='$moy' where e.annee_scolaire='$annee_scolaire' and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'");
                } else {
                    $bdd->query("Insert into moyenne (semestre, annee_scolaire,numero_eleve,id_classe,moyenne) values ('$semestre','$annee_scolaire','$numero_eleve','$idClasse','$moy')");
                }


                if ($semestre == 1) {

                    $reponseRang = $bdd->query("select numero_eleve ,moyenne , "
                            . "(select count(*) + 1 from moyenne s where e.moyenne < s.moyenne and  s.annee_scolaire='$annee_scolaire' and s.semestre= '$semestre' and s.id_classe= '$idClasse') "
                            . "as rang  from moyenne e where e.annee_scolaire='$annee_scolaire' and e.semestre= '$semestre' and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve' order by rang asc");

                    if ($donnees = $reponseRang->fetch()) {
                        $rang = $donnees['rang'];
                    }
                } else if ($semestre == 2) {
                    $reponseRang = $bdd->query("select numero_eleve ,moyenne as moyenne2 , (select count(*) + 1 from moyenne s where e.moyenne < s.moyenne and "
                            . " s.annee_scolaire='$annee_scolaire' and s.semestre=2 and s.id_classe= '$idClasse') as rang ,(select moyenne from moyenne e where e.annee_scolaire='$annee_scolaire'"
                            . " and e.semestre= 1 and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve') as moyenne1"
                            . "  from moyenne e where e.annee_scolaire='$annee_scolaire' and e.semestre= 2 and e.id_classe= '$idClasse' and numero_eleve='$numero_eleve'  order by rang asc");


                    if ($donnees = $reponseRang->fetch()) {
                        $rang = $donnees['rang'];
                        $moy1 = $donnees['moyenne1'];
                        $moy2 = $donnees['moyenne2'];

                        $moygenerale = ($moy1 + $moy2) / 2;
                        $formatMoyGen = number_format($moygenerale, 2, '.', ' ');
                    }

                    $reponsegetMoyenneGen = $bdd->query("select * from moyenne  where annee_scolaire='$annee_scolaire'  and id_classe= '$idClasse' and numero_eleve='$numero_eleve' and (semestre is null  or semestre='')");

                    if ($donnees = $reponsegetMoyenneGen->fetch()) {

                        $bdd->query("Update  moyenne  set moyenne_generale='$formatMoyGen' where annee_scolaire='$annee_scolaire'  and id_classe= '$idClasse' and numero_eleve='$numero_eleve' and (semestre is null or semestre='')");
                    } else {
                        $bdd->query("Insert into moyenne (annee_scolaire,numero_eleve,id_classe,moyenne_generale) values ('$annee_scolaire','$numero_eleve','$idClasse','$formatMoyGen')");
                    }

                    $reponseRangAnnuel = $bdd->query("select numero_eleve ,moyenne_generale , "
                            . "(select count(*) + 1 from moyenne s where e.moyenne_generale < s.moyenne_generale and  s.annee_scolaire='$annee_scolaire' and (s.semestre is null or s.semestre='') and s.id_classe= '$idClasse'  ) as rang_annuel  "
                            . "from moyenne e where e.annee_scolaire='$annee_scolaire' "
                            . "and (e.semestre is null or e.semestre='') and e.numero_eleve = '$numero_eleve'  "
                            . "and e.id_classe= '$idClasse'  order by rang_annuel asc");

                    if ($donnees = $reponseRangAnnuel->fetch()) {
                        $rangannuel = $donnees['rang_annuel'];
                    }
                }
            }
        }
        ?>

        <tr>
            <td style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"><strong>Total: </strong></td>	
            <td style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"> <strong><?php print("$totalCoef") ?> </strong></td> 
            <td colSPAN=3  style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"></td> 
            <td style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"> <strong><?php print("$totalTotal") ?> </strong></td>
            <td colSPAN=3  style="width: 10% ;border: solid 1px #000;padding:3mm 1mm; text-align:center;"></td> 
        </tr>
    </table>

    <table  style="width: 100%; font-size:8px; border-collapse:collapse;">
        <tr>
            <td ROWSPAN=3 style="width:61%;border: solid 1px #000; padding:3mm 1mm;">  
                <img style="width: 2%;text-align:center;" src="images/images.png" alt="Logo">&nbsp; &nbsp;&nbsp; Félicitaion
                <img style="width: 2%;" src="images/images.png" alt="Logo"> &nbsp; &nbsp;&nbsp;Encouragement
				<img style="width: 2%;" src="images/images.png" alt="Logo">  &nbsp;&nbsp; &nbsp;Tableau d'honneur
                <br/>
				<img style="width: 2%;" src="images/images.png" alt="Logo"> &nbsp; &nbsp;&nbsp;Avertissement
				<img style="width: 2%;" src="images/images.png" alt="Logo">&nbsp;&nbsp; &nbsp;Blame </td>
            <td style="border: solid 1px #000; padding:3mm 1mm;width: 43%;font-size:11px;">M: <strong style="font-size:14px"><?php print($formatMoy) ?>/20 </strong><br/> R: <strong><?php print($rang) ?> / <?php print($nbEleves) ?></strong> <br> 
                <?php
                if ($semestre == 2) {
                    ?>  
                    
                    M 1er Sem :  <strong><?php print(number_format($moy1, 2, ',', ' ')) ?>/20 </strong><br> 
                    M G&eacute;n&eacute;rale :  <strong><?php print($formatMoyGen) ?>/20 </strong><br> 
                    Rang annuel :  <strong><?php print($rangannuel) ?> / <?php print($nbEleves) ?></strong> 
                    <?php
                }
                ?>  
            </td> 
        </tr>
    </table>


    <table  style="width: 100%; font-size:08px; border-collapse:collapse;">
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
$content = ob_get_clean();
// die($content);
require ('html2pdf/html2pdf.class.php');
try {
    $pdf = new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
    $pdf->Output('facture.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>				