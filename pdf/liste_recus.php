<?php
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=capel646515', 'capel646515', 'Su4wcTgW', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$numEleve ="";
$annee_scolaire="";
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

    $reponse = $bdd->query("SELECT  r.id_recu as numero, r.libelle as libelle,r.versement as versement,
                      DATE_FORMAT(r.date_recu,'%d/%m/%Y') as date, r.operation as description FROM recu r
					  where  r.archive<>1 and r.annee_scolaire='$annee_scolaire' and r.numero_eleve = '$numEleve'");


            
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
        $versement[$index] = $donnees['versement'];
        $datee[$index] = $donnees['date'];
        $total = $total + $donnees['versement'];
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
table.border td{ border: none;}
table.border th, td.black{ background:#000; color:#FFF; font-weight:normal; border: solid 1px #FFF; padding:1mm 1mm; text-align:left;}
td.border { border: none;}
td.bordure{ border: none;}
.center { text-align:center;}
</style>


<page backtop="15mm" backleft="10mm" backright="10mm" backbottom="30mm"> 
<page_footer> 
   <hr/>
   <p style="font-size:19px; color:#000"><strong>Bon de re&ccedil;u</strong></p>
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
		<td style="width:50%;"><strong></strong></td>
		<td style="width:45%;" class="right">Emis le <?php  echo date('d/m/Y');  ?></td>
    </tr>
</table><br/><br/>

<table class="border">
    <thead>
	    <tr>
			<th class="center" style="width:40%;">Op&eacute;ration</th>
			<th  class="center" style="width:20%;">Description</th>
			<th class="center" style="width:20%;">Versement</th>
			<th class="center" style="width:19%;">Date</th>
		</tr>
    </thead>
	<tbody>
		 <?php
            for ($indexRecu = 0; $indexRecu < $index; $indexRecu++) {
                ?> 
                <tr><td class="center" style="width: 20%"><?php print("$libelle[$indexRecu]") ?></td><td class="center" style="width: 20%"><?php print("$description[$indexRecu]") ?></td>
                    <td class="center"  style="width: 20%"><?php print("$versement[$indexRecu]") ?></td><td class="center" style="width: 20%"><?php print("$datee[$indexRecu]") ?></td></tr>
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
			<td style="padding:1mm;"><?php  echo  number_format($total, 0, ',', ' ') ;?> Fr</td>
			
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
	$pdf->Output('Liste_des_recus.pdf');
	$pdf->pdf->SetDisplayMode('fullpage');
}catch(HTML2PDF_exception $e){ die ($e);}



?>