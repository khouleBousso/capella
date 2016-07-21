<?php

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

<table style="vertical-align:top;">
    <tr>
         
		          <td style="width: 75%; border:none;background:white;"><img style="width: 35%;" src="images/rl.jpg" alt="Logo"><br></td>
		  
   </tr>
</table><br/>
<table>
    <tr>
		<td style="width:50%;"> Mermoz &nbsp; Tel: 77&nbsp; 481-06-21</td>
		
    </tr>
</table>


<br/><br/>

<table>
    <tr>
		<td style="width:50%;"> Facture <strong>N° 20150903-2049</strong></td>
		
    </tr>
</table><br/><br/>
<table style="width:10%;">
    <tr>
		<td style="width:50%;"> Doit: <strong>CONNEXION</strong></td>
		
    </tr>
</table><br/><br/>

<table class="border">
    <thead>
	    <tr>
			<th style="width:35%;">Op&eacute;ration</th>
			<th style="width:35%;">Description</th>
			<th style="width:20%;">Montant</th>
			
		</tr>
    </thead>
	<tbody>
	    <tr>
			<td>1 mois </td>
			<td>Hebergement du 24/08/2015 au 24/09/2015</td>
			<td>600.000 Fr</td>
			
		</tr>
		  <tr>
			<td><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
			<td></td>
			<td></td>
			
		</tr>
		<tr>
			<td class="noborder" style="padding:1mm;"></td>
			<td  style="padding:1mm;"></td>
			<td style="padding:1mm;" class="black" > T:600.000 Fr</td>
			
		</tr>
    </tbody>
</table><br/><br/><br/><br/><br/>
   <table>
    <tr>
	<td style="width:60%;"> </td>
		<td style="width:40%;">Fait à Dakar le 03/09/2015</td>
		
    </tr>
</table>
	</page>
<?php
$content=ob_get_clean();
// die($content);
require ('html2pdf/html2pdf.class.php');
try{
    $pdf =new HTML2PDF('P', 'A4', 'fr');
    $pdf->writeHTML($content);
	$pdf->Output('facture.pdf');
	$pdf->pdf->SetDisplayMode('fullpage');
}catch(HTML2PDF_exception $e){ die ($e);}



?>