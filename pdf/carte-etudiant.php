<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$numEleve = "";
$numEleve = $_GET['numEleve'];

$annee_scolaire = "";
if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];

if (isset($_GET['numEleve']) && isset($_GET['annee_scolaire'])) {
    $reponse = $bdd->query("SELECT e.numero_eleve as numero,e.nom as nom, e.prenom as prenom,e.avatar, u.adresse as adresse, u.telephone as telephone,  DATE_FORMAT(e.date_naissance,'%d/%m/%Y') as date,  e.lieu_naissance as lieu,
                      c.nom as classe, i.annee_scolaire as annee
                       FROM  eleves e, inscrit i, utilisateur u , classe c
					  where e.id_parent= u.id and  c.id_classe= i.id_classe and e.numero_eleve= i.numero_eleve  and e.numero_eleve = '$numEleve' and i.annee_scolaire='$annee_scolaire'");

    if ($donnees = $reponse->fetch()) {

        $numero = $donnees['numero'];
        $classe = $donnees['classe'];
        $nom = $donnees['nom'];
        $prenom = $donnees['prenom'];
        $date = $donnees['date'];
        $lieu = $donnees['lieu'];
        $adresse = $donnees['adresse'];
        $annee = $donnees['annee'];
        $avatar = $donnees['avatar'];
    }
}
ob_start();
?>
<style type="text/css">
    * {color: #717375 ;}
    p {margin:0 ;padding: 4mm 0 0 0;}
    hr {background:#717375;height:1px; border:none;}
    table{ border-collapse:collapse;width:  100%; color:#717375; font-size:12pt; font-family:helvetica; line-height:6mm;}
    table strong { color:#000;}
    td.right { text-align: right;}
    table.border td{ border: solid 1px #000; padding:3mm 1mm;}
    table.border th, td.black{ background:green; color:#FFF; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm; text-align:left;}
    td.border { border: none;}
</style>


<page backtop="0mm" backbottom="0mm" backleft="15mm" backright="10mm"> 

    <table class="border">

        <thead>
            <tr>
                <th style="text-align:center;" colspan="4" >Carte d'&eacute;l&egrave;ve</th>


            </tr>
        </thead>
        <tbody>
            <tr style="width:100%;background-color:white;">;
                <td style="width: 65%"><img style="width: 80%;" src="images/iconee.jpg" alt="Logo"><br></td>
                <td style="width: 5%;border:none;"></td> 
                <td style="width: 19%">
                <?php
                   if ($avatar != null && $avatar != '') {  
                          echo '<img  width="80" height="80" src="../rest/avatarEleves/'.$avatar.'" class="imghover"/><br></td>'; 
                
                    }
                    else if($avatar == null || $avatar == '') 
                    {
                       echo '<br></td>'; 
                    }
                    ?>
                </tr>

                <tr  style="font-size:10px;">

                    <td>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Année Scolaire: <strong><?php print("$annee") ?></strong> <br/>
                        Numero Etudiant: <strong><?php print("$numero") ?></strong> <br/>
                        Nom: <strong><?php print("$nom") ?></strong><br/>
                        Prenom: <strong><?php print("$prenom") ?></strong><br/>
                        Né(e) le: <strong><?php print("$date") ?></strong> &nbsp;&nbsp; &nbsp;&nbsp; &agrave; &nbsp;&nbsp; &nbsp;&nbsp; <strong><?php print("$lieu") ?></strong><br/>
                        Adresse: <strong><?php print("$adresse") ?></strong><br/>
                        Inscrit(e) en <strong><?php print("$classe") ?></strong><br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;Fait le:  <strong><?php echo date('d/m/Y'); ?></strong><br/></td>
                    <td style=" border:border;" colspan="2">&nbsp;&nbsp; &nbsp;&nbsp;Le Directeur du CSI<br>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Keur Madior <br></td>
                </tr>

                <tr>
                    <td colspan="3" class="black" style="padding:1mm;"></td>
                </tr>
            </tbody>
        </table><br/><br/><br/>



    </page>
    <?php
    $content = ob_get_clean();
// die($content);
    require ('html2pdf/html2pdf.class.php');
    try {
        $pdf = new HTML2PDF('P', 'A5', 'fr');
        $pdf->writeHTML($content);
        $pdf->Output('carte-etudiant.pdf');
        $pdf->pdf->SetDisplayMode('fullpage');
    } catch (HTML2PDF_exception $e) {
        die($e);
    }
    ?>