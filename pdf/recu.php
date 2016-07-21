<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$numRecu ="";
if(isset($_GET['numRecu']))
$numRecu = $_GET['numRecu'];

$annee_scolaire="";
 if (isset($_GET['annee_scolaire']))
    $annee_scolaire = $_GET['annee_scolaire'];
 
$adresse="";$nomprenom="";$telephone="";$classe="";$libelle="";$description="";$numero=0;$versement=0;$datee="";

if(isset($_GET['numRecu']) && isset($_GET['annee_scolaire']))
{
    $reponse = $bdd->query("SELECT e.nom as nom, e.prenom as prenom, u.adresse as adresse, u.telephone as telephone, 
                      c.nom as classe, r.id_recu as numero, r.libelle as libelle,r.versement as versement, 
                      DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date, r.operation as description FROM recu r, eleves e, inscrit i, utilisateur u , classe c 
					  where e.id_parent= u.id and  c.id_classe= i.id_classe and e.numero_eleve= i.numero_eleve and r.numero_eleve= e.numero_eleve and r.id_recu = '$numRecu' and i.annee_scolaire='$annee_scolaire'");


    if ($donnees = $reponse->fetch()){
         $nom=$donnees['nom'];
		 $prenom=$donnees['prenom'];
		 $nomprenom= $donnees['prenom'] .' '. $nom;
		 $adresse=$donnees['adresse'];
		 $telephone=$donnees['telephone'];
		 $classe=$donnees['classe'];
		 $libelle=$donnees['libelle'];
		 $description=$donnees['description'];
		 $numero=$donnees['numero'];
		 $versement=$donnees['versement'];
		 $datee=$donnees['date'];
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
table.border th, td.black{ background:#000; color:#FFF; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm; text-align:left;}
td.border { border: none;}
</style>


<page backtop="15mm" backleft="10mm" backright="10mm" backbottom="30mm"> 
<page_footer> 
   <hr/>
   <p style="font-size:19px; color:#000"><strong>Bon de Re&ccedil;u</strong></p>
   <p>Date:</p>
     <p>Signature et cachet de l'établissement :</p>
	 <p> &nbsp;</p>
	 <p> &nbsp;</p>
	 
    </page_footer>
<table style="vertical-align:top;">
    <tr>
         
		          <td style="width: 75%; border:none;background:white;"><img style="width: 45%;" src="images/iconee.jpg" alt="Logo"><br></td>

		  <td style="width:25%; font-size:12px;">
		   <strong><?php print("$nomprenom")?></strong><br/>
		   <img style="width: 12%;" src="images/adresse.png" alt="Logo"> <?php print("$adresse")?><br/>
		   <img style="width: 12%;" src="images/tel.png" alt="Logo"> Tel:<?php print("$telephone")?><br/>
		   <img style="width: 12%;" src="images/classe.png" alt="Logo"> <?php print("$classe")?>
		 </td>
   </tr>
</table><br/><br/><br/>

<table>
    <tr>
		<td style="width:50%;"><strong> Re&ccedil;u N° <?php print("$numero")?></strong></td>
		<td style="width:45%;" class="right">Emis le <?php  echo date('d/m/Y');  ?></td>
    </tr>
</table><br/><br/>

<table class="border">
    <thead>
	    <tr>
			<th style="width:50%;">Op&eacute;ration</th>
			<th style="width:17%;">Description</th>
			<th style="width:18%;">Versement</th>
			<th style="width:15%;">Date</th>
		</tr>
    </thead>
	<tbody>
	    <tr>
			<td><?php print("$description")?></td>
			<td><?php print("$libelle")?></td>
			<td><?php  echo  number_format($versement, 0, ',', ' ') ;?></td>
			<td><?php echo ("$datee")?></td>
		</tr>
		  <tr>
			<td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2" class="noborder" style="padding:1mm;"></td>
			<td class="black" style="padding:1mm;">Total : </td>
			<td style="padding:1mm;"><?php  echo  number_format($versement, 0, ',', ' ') ;?> Fr</td>
			
		</tr>
    </tbody>
</table>
   
	</page>
<?php
$content=ob_get_clean();
// die($content);
require ('html2pdf/html2pdf.class.php');
try{
    $pdf =new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
	$pdf->Output('recu.pdf');
	$pdf->pdf->SetDisplayMode('fullpage');
}catch(HTML2PDF_exception $e){ die ($e);}



?>