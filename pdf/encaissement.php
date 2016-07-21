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
$donnesVersementT = [];
$donnesNum  = [];
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
$index = 0;

if (isset($_GET['idClasse']) && isset($_GET['annee_scolaire'])) {
      if ($valueperiode!="") {  
        $date = explode("-", $valueperiode);
        $start = $date[0];
        $start = str_replace(' ', '', $start);
        $split_date_start = explode("/", $start);
        $date_start = $split_date_start[2] . '-' . $split_date_start[1] . '-' . $split_date_start[0];

        $end = $date[1];
        $end = str_replace(' ', '', $end);
        $split_date_end = explode("/", $end);
        $date_end = $split_date_end[2] . '-' . $split_date_end[1] . '-' . $split_date_end[0];


        $reponse = $bdd->query("select tab.num, tab.nom, tab.prenom  ,sum(versement) as versementT  from
						(select e.numero_eleve as num , e.nom as nom, r.date_recu ,e.prenom as prenom,  SUM(r.versement) as versement
						from eleves e 
						JOIN inscrit i 
						on e.numero_eleve=i.numero_eleve
						JOIN classe c 
						on i.id_classe=c.id_classe
						JOIN facture f 
						on e.numero_eleve= f.numero_eleve
						LEFT JOIN recu r 
						on r.numero_facture=f.numero_facture
						where c.id_classe='$id' and r.date_recu BETWEEN '$date_start' AND '$date_end'   and f.annee_scolaire='$annee_scolaire'
						group by f.numero_facture)as tab
                                                group by num");
    } else {
        $reponse = $bdd->query("select tab.num, tab.nom, tab.prenom  ,sum(versement) as versementT  from
						(select e.numero_eleve as num , e.nom as nom, r.date_recu ,e.prenom as prenom,  SUM(r.versement) as versement
						from eleves e 
						JOIN inscrit i 
						on e.numero_eleve=i.numero_eleve
						JOIN classe c 
						on i.id_classe=c.id_classe
						JOIN facture f 
						on e.numero_eleve= f.numero_eleve
						LEFT JOIN recu r 
						on r.numero_facture=f.numero_facture
					        where f.annee_scolaire='$annee_scolaire'
						group by f.numero_facture)as tab
                                                group by num");
    }
    while ($donnees = $reponse->fetch()) {
        $donnesNum[$index] = $donnees['num'];
        $donnesNomprenom[$index] = $donnees['prenom'] . ' ' . $donnees['nom'];
        $donnesVersementT[$index] = $donnees['versementT'];
        $total+=$donnesVersementT[$index];
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
            <td style="width: 38%; border:none;background:white;"> <img style="width: 75%;" src="images/iconee.jpg" alt="Logo"><br></td>
            <td style="width: 30%; border:none;background:white"> </td>
            <td style="width: 35%; border:none;background:white"> Mbour, le <?php $date = date("d-m-Y");
print("$date")
?></td>

        </tr>


    </table><br>
    <br>    <br>    <br>   <table><tr><td class="title" style="width: 95%; border:none;background:white" > SITUATION DES PAYEMENTS <strong><?php print("$nom") ?> </strong></td></tr></table><br>    <br>    
   
        
        <?php
        if ($valueperiode!="") {
            ?>  <table>
        <tr><td class="title" style="width: 95%; border:none;background:white" > P&eacute;riode du <strong><?php print("$start") ?></strong> au <strong><?php print("$end") ?></strong> </td></tr></table><br>
     <?php
        }
        ?>
        <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">  
        <tr>           

            <th style="width: 30%">N° &eacute;l&egrave;ve</th>    
            <th style="width: 30%">El&egrave;ve</th>            
            <th style="width: 30%">Versement</th>           

        </tr> 

    </table>  

    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">    

        <?php
        for ($indexEnc = 0; $indexEnc < $index; $indexEnc++) {
            ?> 
            <tr><td style="width: 30%"><?php print(number_format($donnesNum[$indexEnc], 0, ',', ' ')) ?></td>

                <td style="width: 30%"><?php print($donnesNomprenom[$indexEnc]) ?></td>
                <td style="width: 30%"><?php print(number_format($donnesVersementT[$indexEnc], 0, ',', ' ')) ?></td></tr>
            <?php
        }
        ?>	
        <tr>
            <td style="width: 30%"><br/><br/><br/><br/></td>
            <td style="width: 30%"></td>
            <td style="width: 30%"></td>
        </tr>
        <tr>          
            <td  colspan="2" style="width: 0%; text-align:center;" >Total des encaissements de la  classe</td>     
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
    $pdf->Output('encaissements.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>