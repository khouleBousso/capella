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
$donneesNomPrenom = [];
$donneesAdresse = [];
$donneesTel = [];
$donneesClasse = [];
$total = [];
$month = 0;
$monthLibelle="";
$donnnesCountFac = [];
if (isset($_GET['idclasse']))
    $idClasse = $_GET['idclasse'];


if (isset($_GET['monthLibelle']))
    $monthLibelle = $_GET['monthLibelle'];


if (isset($_GET['month']))
    $month = $_GET['month'];


if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];



if (isset($_GET['idclasse']) && isset($_GET['month']) && isset($_GET['annee_scolaire'])) {


    $reponseEleves = $bdd->query("SELECT u.adresse as adresse, u.telephone as telephone, eleves.numero_eleve,eleves.nom,eleves.avatar,eleves.prenom,eleves.lieu_naissance,DATE_FORMAT(eleves.date_naissance,'%d/%m/%Y')as date_naissance ,classe.nom as nomClasse FROM inscrit, eleves , classe ,utilisateur u
			where u.id=eleves.id_parent and eleves.numero_eleve= inscrit.numero_eleve and classe.id_classe=inscrit.id_classe
			and classe.id_classe='$idClasse' and annee_scolaire='$annee_scolaire'");



    $indexEleves = 0;

    while ($donneesEleves = $reponseEleves->fetch()) {
        $numero_eleve = $donneesEleves["numero_eleve"];
        $donneesNomPrenom[$indexEleves] = $donneesEleves["prenom"] . ' ' . $donneesEleves["nom"];
        $donneesAdresse[$indexEleves] = $donneesEleves["adresse"];
        $donneesTel[$indexEleves] = $donneesEleves["telephone"];
        $donneesClasse[$indexEleves] = $donneesEleves["nomClasse"];


        $donneesAllEleves[$indexEleves] = $donneesEleves;

        $reponse = $bdd->query("SELECT f.code, f.numero_facture as numero, f.libelle as libelle,f.montant as montant,
                      DATE_FORMAT(f.date_payement,'%d/%m/%Y') as date, f.description as description FROM facture f
					  where  f.archive<>1 and f.annee_scolaire='$annee_scolaire' and f.numero_eleve = '$numero_eleve' and MONTH(f.date_payement) = '$month'");


        $indexFac = 0;
        $total[$indexEleves] = 0;
        while ($donneesFactures = $reponse->fetch()) {
            $libelle[$indexEleves][$indexFac] = $donneesFactures['libelle'];
            $description[$indexEleves][$indexFac] = $donneesFactures['description'];
            $numero[$indexEleves][$indexFac] = $donneesFactures['numero'];
            $code[$indexEleves][$indexFac] = $donneesFactures['code'];
            $montant[$indexEleves][$indexFac] = $donneesFactures['montant'];
            $datee[$indexEleves][$indexFac] = $donneesFactures['date'];
            $total[$indexEleves] = $total[$indexEleves] + $donneesFactures['montant'];
            $indexFac ++;
        }
        $donnnesCountFac[$indexEleves] = $indexFac;

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
    table{ border-collapse:collapse;width:  100%; font-size:12pt; font-family:helvetica; line-height:6mm;}
    table strong { color:#000;}
    td.right { text-align: right;}
    table.border td{ border: solid 1px #000; padding:3mm 1mm;}
    table.border th, td.black{ background:#000; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm}
    td.border { border: none;}
    .info{ border-collapse:collapse;width:  100%; color:#717375; font-size:12pt; font-family:helvetica; line-height:6mm;}
</style>

<?php
for ($index = 0; $index < $nbEleves; $index++) {
    ?>
    <page backtop="15mm" backleft="10mm" backright="10mm" backbottom="30mm">
        <page_footer>
            <hr/>
            <p style="font-size:19px; color:#000"><strong>Bon de facture</strong></p>
            <p>Date:</p>
            <p>Signature et cachet de l'établissement :</p>
            <p> &nbsp;</p>
            <p> &nbsp;</p>

        </page_footer>
        <table style="vertical-align:top;">
            <tr>

                <td style="width: 75%; border:none;background:white;"><img style="width: 45%;" src="images/iconee.jpg" alt="Logo"><br></td>
                <td style="width:25%; font-size:12px;">
                    <strong><?php print("$donneesNomPrenom[$index]") ?></strong><br/>
                    <img style="width: 12%;" src="images/adresse.png" alt="Logo"> <?php print("$donneesAdresse[$index]") ?><br/>
                    <img style="width: 12%;" src="images/tel.png" alt="Logo"> Tel:<?php print("$donneesTel[$index]") ?><br/>
                    <img style="width: 12%;" src="images/classe.png" alt="Logo"> <?php print("$donneesClasse[$index]") ?>
                </td>
            </tr>
        </table><br>
        <br>    <br>    <br>   <table > <tr>
<td class="title" style="text-align: center;width: 95%; border:none;background:white" > Factures : <strong><?php print($donneesClasse[$index]) ?> </strong></td></tr></table><br>    

        <table><tr><td class="title" style="text-align: center;width: 95%; border:none;background:white" > Mois : <strong><?php print("$monthLibelle") ?></strong></td></tr></table><br>
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
                for ($indexFac = 0; $indexFac < $donnnesCountFac[$index]; $indexFac++) {
                    ?>
                    <tr><td class="center" style="width: 20%"><?php print($libelle[$index][$indexFac]) ?></td><td class="center" style="width: 20%"><?php print($description[$index][$indexFac]) ?></td>
                        <td class="center"  style="width: 20%"><?php print($montant[$index][$indexFac]) ?></td><td class="center" style="width: 20%"><?php print($datee[$index][$indexFac]) ?></td></tr>
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
                    <td style="padding:1mm;"><?php echo number_format($total[$index], 0, ',', ' '); ?> Fcfa</td>

                </tr>
            </tbody>
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
    $pdf->Output('Liste_des_facture.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>