<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idClasse = "";
$annee_scolaire = "";
$donnesNomprenom = [];
$donnesNum  = [];
$reponse = [];
if (isset($_GET['idClasse']))
    $idClasse = $_GET['idClasse'];
	
	if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];
	
	$index = 0;
	
if (isset($_GET['idClasse'])) {


        $reponse = $bdd->query("select e.numero_eleve as numE, e.nom as nomE, e.prenom as prenomE, c.nom as classe  from eleves e , inscrit i, classe c  where 
					   e.numero_eleve=i.numero_eleve and i.annee_scolaire='$annee_scolaire' and i.id_classe=c.id_classe  and c.id_classe ='$idClasse' ");
    

    while ($donnees = $reponse->fetch()) {
        $donnesNum[$index] = $donnees['numE'];
        $donnesNomprenom[$index] = $donnees['prenomE'] . ' ' . $donnees['nomE'];
		$classe = $donnees['classe'];
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
		<p>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Fait par:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Cours:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Signature: &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</p>
        
    </page_footer>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">  
        <tr>            
            <td style="width: 39%; border:none;background:white;"> <img style="width: 75%;" src="images/iconee.jpg" alt="Logo"><br></td>
            <td style="width: 30%; border:none;background:white"> </td>
            <td style="width: 35%; border:none;background:white"> Mbour, le <?php $date = date("d-m-Y");
print("$date")
?></td>

        </tr>


    </table><br>
    <br>    <br>    <br>   <table><tr><td class="title" style="width: 95%; border:none;background:white" >FICHE DE PR&Eacute;SENCE <strong><?php print("$classe") ?> </strong></td></tr></table><br>    <br>    
   
        
        <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt; margin-left:40px;">  
        <tr>           

            <th style="width: 25%">N° &eacute;l&egrave;ve</th>    
            <th style="width: 25%">El&egrave;ve</th>            
            <th style="width: 10%">Pr&Eacute;sent</th>
			<th style="width: 10%">Absent</th>
			<th style="width: 10%">Retard</th>
			<th style="width: 10%">Renvoi</th>
			

        </tr> 

    </table>  

    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt; margin-left:40px;">    
	<?php
        for ($indexEnc = 0; $indexEnc < $index; $indexEnc++) {
            ?> 
            <tr><td style="width: 25%"><?php print(number_format($donnesNum[$indexEnc], 0, ',', ' ')) ?></td>

                <td style="width: 25%"><?php print($donnesNomprenom[$indexEnc]) ?></td>
                <td style="width: 10%"><img style="width: 30%;text-align:center;" src="images/images.png" alt="Logo"></td>
				<td style="width: 10%"><img style="width: 30%;text-align:center;" src="images/images.png" alt="Logo"></td>
				<td style="width: 10%"><img style="width: 30%;text-align:center;" src="images/images.png" alt="Logo"></td>
				<td style="width: 10%"><img style="width: 30%;text-align:center;" src="images/images.png" alt="Logo"></td></tr>
            <?php
        }
        ?>	
        
     

    </table> 
</page>
<?php
$content = ob_get_clean();
require ('html2pdf/html2pdf.class.php');
try {
    $pdf = new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
    $pdf->Output('fiche-presence.pdf');
    $pdf->pdf->SetDisplayMode('fullpage');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>