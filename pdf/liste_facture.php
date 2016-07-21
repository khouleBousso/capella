<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$numEleve = 0;
$annee_scolaire="";
 $reponseEleve=[];
 
 if (isset($_GET['numEleve']))
    $numEleve = $_GET['numEleve'];

 if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];

    $index = 0;
    $total = 0;
    $adresse="";$nomprenom="";$telephone="";$classe="";

 if (isset($_GET['numEleve']) && isset($_GET['annee_scolaire'])) {

    $reponseEleve = $bdd->query("SELECT e.nom as nom, e.prenom as prenom, u.adresse as adresse, u.telephone as telephone, 
                      c.nom as classe FROM eleves e, inscrit i, utilisateur u , classe c
					  where e.id_parent= u.id and  c.id_classe= i.id_classe and e.numero_eleve= i.numero_eleve  and e.numero_eleve = '$numEleve' and i.annee_scolaire='$annee_scolaire'");

    $reponse = $bdd->query("SELECT  f.code,f.numero_facture as numero, f.libelle as libelle,f.montant as montant,
                      DATE_FORMAT(f.date_payement,'%d/%m/%Y') as date, f.description as description FROM facture f
					  where  f.archive<>1 and f.annee_scolaire='$annee_scolaire' and f.numero_eleve = '$numEleve'");


            
    if ($donnees = $reponseEleve->fetch()) {
        $nom = $donnees['nom'];
        $prenom = $donnees['prenom'];
        $nomprenom = $donnees['prenom'] . ' ' . $nom;
        $adresse = $donnees['adresse'];
        $telephone = $donnees['telephone'];
        $classe = $donnees['classe'];
    }
            
            
    while ($donnees = $reponse->fetch()) {

        $libelle[$index] = $donnees['libelle'];
        $description[$index] = $donnees['description'];
        $numero[$index] = $donnees['numero'];
        $code[$index] = $donnees['code'];
        $montant[$index] = $donnees['montant'];
        $datee[$index] = $donnees['date'];
        $total = $total + $donnees['montant'];
        $index++;
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
        
        td.border { border: none;}
        td.bordure{ border: none;}
		table.border td{ border: solid 1px #000; padding:3mm 1mm;}
table.border th, td.black{ background:#000; color:#FFF; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm; text-align:left;}

        .center { text-align:center;}
    </style>


<page backtop="15mm" backleft="10mm" backright="10mm" backbottom="30mm"> 
    
    <table style="vertical-align:top;">
        <tr>

            <td style="width: 75%; border:none;background:white;"><img style="width: 45%;" src="images/icone.png" alt="Logo"><br></td>
            <td style="width:25%; font-size:12px;">
                <strong><?php print("$nomprenom") ?></strong><br/>
                <img style="width: 12%;" src="images/adresse.png" alt="Logo"> <?php print("$adresse") ?><br/>
                <img style="width: 12%;" src="images/tel.png" alt="Logo"> Tel:<?php print("$telephone") ?><br/>
                <img style="width: 12%;" src="images/classe.png" alt="Logo"> <?php print("$classe") ?>
            </td>
        </tr>
    </table><br/><br/><br/>

    <table>
        <tr>
            <td style="width:50%;"><strong></strong></td>
            <td style="width:45%;" class="right">Emis le <?php echo date('d/m/Y'); ?></td>
        </tr>
    </table><br/><br/>

    <table class="border">
        <thead>
            <tr>
                <th class="center" style="width:40%;">Op&eacute;ration</th>
                <th  class="center" style="width:20%;">Description</th>
                <th class="center" style="width:20%;">Montant</th>
                <th class="center" style="width:19%;">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($indexFac = 0; $indexFac < $index; $indexFac++) {
                ?> 
                <tr><td class="center" style="width: 20%"><?php print("$libelle[$indexFac]") ?></td><td class="center" style="width: 20%"><?php print("$description[$indexFac]") ?></td>
                    <td class="center"  style="width: 20%"><?php print("$montant[$indexFac]") ?></td><td class="center" style="width: 20%"><?php print("$datee[$indexFac]") ?></td></tr>
                <?php
            }
            ?>		
            <tr>
                <td><br/><br/><br/><br/></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" class="noborder" style="padding:1mm;"></td>
                <td class="black" style="padding:1mm;">Total : </td>
                <td style="padding:1mm;"><?php echo number_format($total, 0, ',', ' '); ?> Fcfa</td>

            </tr>
        </tbody>
    </table>

</page>
<?php
$content = ob_get_clean();
// die($content);
require ('html2pdf/html2pdf.class.php');
try {
    $pdf = new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
    $pdf->Output('Liste_des_facture.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>