<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idClasse = "";
$valueperiode = "";
$start = "";
$end = "";
$date_start = "";
$date_end = "";
$annee_scolaire = "";
$reponse = [];
$donnesNomprenom = [];
$solde = [];
$debit = [];
$credit = [];
$donnesNum = [];
if (isset($_GET['idClasse']))
    $idClasse = $_GET['idClasse'];

if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];


if (isset($_GET['valueperiode']))
    $valueperiode = $_GET['valueperiode'];

$idNomClasse = explode(":", $idClasse);

$id = $idNomClasse[0];
$nom = $idNomClasse[1];
$total = 0;
$totalCredit = 0;
$totalDedit = 0;
$index = 0;

if (isset($_GET['idClasse']) && isset($_GET['annee_scolaire'])) {
    if ($valueperiode != "") {
        $valueperiode = $_GET['valueperiode'];
        $date = explode("-", $valueperiode);
        $start = $date[0];
        $start = str_replace(' ', '', $start);
        $split_date_start = explode("/", $start);
        $date_start = $split_date_start[2] . '-' . $split_date_start[1] . '-' . $split_date_start[0];

        $end = $date[1];
        $end = str_replace(' ', '', $end);
        $split_date_end = explode("/", $end);
        $date_end = $split_date_end[2] . '-' . $split_date_end[1] . '-' . $split_date_end[0];
        $reponse = $bdd->query("select tab.num, tab.nom, tab.prenom  ,tab.classe ,sum(montant) as debit,sum(solde) as solde,sum(versement) as credit from
						(select e.numero_eleve as num , e.nom as nom, e.prenom as prenom, c.nom as classe,  f.montant as montant,f.solde as solde, SUM(r.versement) as versement
						from eleves e
						JOIN inscrit i
						on e.numero_eleve=i.numero_eleve
						JOIN classe c
						on i.id_classe=c.id_classe
						JOIN facture f
						on e.numero_eleve= f.numero_eleve
						LEFT JOIN recu r
						on r.numero_facture=f.numero_facture
						where c.id_classe='$id' and  f.solde<0 and f.date_payement BETWEEN '$date_start' AND '$date_end' and f.annee_scolaire='$annee_scolaire'
						group by f.numero_facture)as tab
                   group by num");
    } else {

        $reponse = $bdd->query("select tab.num, tab.nom, tab.prenom  ,tab.classe ,sum(montant) as debit,sum(solde) as solde,sum(versement) as credit from
						(select e.numero_eleve as num , e.nom as nom, e.prenom as prenom, c.nom as classe,  f.montant as montant,f.solde as solde, SUM(r.versement) as versement
						from eleves e
						JOIN inscrit i
						on e.numero_eleve=i.numero_eleve
						JOIN classe c
						on i.id_classe=c.id_classe
						JOIN facture f
						on e.numero_eleve= f.numero_eleve
						LEFT JOIN recu r
						on r.numero_facture=f.numero_facture
						where c.id_classe='$id' and  f.solde<0  and f.annee_scolaire='$annee_scolaire'
						group by f.numero_facture)as tab
                   group by num");
    }


    while ($donnees = $reponse->fetch()) {
        $donnesNum[$index] = $donnees['num'];
        $donnesNomprenom[$index] = $donnees['prenom'] . ' ' . $donnees['nom'];
        $solde[$index] = $donnees['solde'] * -1;
        $debit[$index] = $donnees['debit'];
        $credit[$index] = $donnees['credit'];
        $total+=$solde[$index];
        $totalCredit+=$credit[$index];
        $totalDedit+=$debit[$index];
        $index++;
    }
}


ob_start();
?>
<style type="text/css">
    table{    width:  100%;    border:none;    border-collapse: collapse;}th, td  {    text-align: center;    border: solid 1px #000;    background: #f8f8f8;}td{    text-align: center;         }.dataTable td{padding:10px 5px;background-color:#efefef;}.dataTable th{padding:10px 5px;}
    .title{ background: #f8f8f8;}

</style>


<page backtop="15mm" backleft="10mm"  backbottom="10mm">
    <page_footer>

        <hr/>
        <p>Signature:</p>
        <p>Date:</p>
    </page_footer>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 39%; border:none;background:white;"> <img style="width: 75%;" src="images/iconee.jpg" alt="Logo"><br></td>
            <td style="width: 30%; border:none;background:white"> </td>
            <td style="width: 35%; border:none;background:white"> Mbour, le <?php $date = date("d-m-Y");
print("$date") ?></td>

        </tr>


    </table><br>
    <br>    <br>    <br>   <table><tr><td class="title" style="width: 95%; border:none;background:white" > SITUATION DES IMPAYES <strong><?php print("$nom") ?> </strong></td></tr></table><br>    <br>

    <?php
        if ($valueperiode!="") {
            ?>  <table>
        <tr><td class="title" style="width: 95%; border:none;background:white" > P&eacute;riode du <strong><?php print("$start") ?></strong> au <strong><?php print("$end") ?></strong> </td></tr></table><br>
     <?php
        }
        ?> <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 20%">N° &eacute;l&egrave;ve</th>
            <th style="width: 20%">El&egrave;ve</th>
            <th style="width: 20%">Montant d&ucirc;</th>
            <th style="width: 20%">Versement</th>
            <th style="width: 20%">Solde</th>
        </tr>
        <tr>
            <th colspan="5"></th>
        </tr>
    </table>

    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
<?php
for ($indexImp = 0; $indexImp < $index; $indexImp++) {
    ?>
            <tr><td style="width: 20%"><?php print(number_format($donnesNum[$indexImp], 0, ',', ' ')) ?></td><td style="width: 20%">
                <?php print($donnesNomprenom[$indexImp]) ?></td><td style="width: 20%"><?php print(number_format($debit[$indexImp], 0, ',', ' ')) ?></td><td style="width: 20%"><?php print(number_format($credit[$indexImp], 0, ',', ' ')) ?></td><td style="width: 20%"><?php print(number_format($solde[$indexImp], 0, ',', ' ')) ?></td> </tr>
            <?php
        }
        ?>
        <tr>
            <td style="width: 20%"><br/><br/><br/><br/></td>
            <td style="width: 20%"></td>
            <td style="width: 20%"></td>
            <td style="width: 20%"></td>
            <td style="width: 20%"></td>
        </tr>
        <tr>
            <td  colspan="2" style="width: 0%; text-align:center;" >Total des impay&eacute;s de la classe</td>
<?php echo '<td style="width: 10%; text-align:center;"><strong> ' . number_format($totalDedit, 0, ',', ' ') . '</strong></td> '; ?>
<?php echo '<td style="width: 10%; text-align:center;"><strong> ' . number_format($totalCredit, 0, ',', ' ') . '</strong></td> '; ?>
<?php echo '<td style="width: 10%; text-align:center;"><strong> ' . number_format($total, 0, ',', ' ') . '</strong></td> '; ?>
        </tr>
    </table>
</page>
            <?php
            $content = ob_get_clean();
            require ('html2pdf/html2pdf.class.php');
            try {
                $pdf = new HTML2PDF('P', 'A4', 'fr');
                $pdf->writeHTML($content);
                $pdf->Output('test.pdf');
                $pdf->pdf->SetDisplayMode('fullpage');
            } catch (HTML2PDF_exception $e) {
                die($e);
            }
            ?>