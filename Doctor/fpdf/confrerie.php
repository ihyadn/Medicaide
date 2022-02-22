<?php
 try {

    $pdo = new PDO("mysql:host=localhost;dbname=cabinet","root", "");
    echo "connexion etablie";
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());

    //die('Erreur : impossible de se connecter à la base de donnée');
}
require('fpdf.php');
ob_end_clean(); //    the buffer and never prints or returns anything.
ob_start(); // it starts buffering

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = 0;

$info_patient = $pdo->query("select * from patient WHERE id=$id");
$patient = $info_patient->fetch();

//$compterendu = $pdo->query("select * from consultation WHERE patient_ID=$id");
//$compterendu = $info_patient->fetch();

$nom_prenom = strtoupper($patient['Nom'] . "  " . $patient['Prenom']);
$birth=$patient['birth'];
// $ordanance=$patient['ordonance'];
$raison=$_GET["raison"];

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A5');

//Ajouter une nouvelle page
$pdf->AddPage();

$pdf->SetFont('Arial', '', 10);
$h = 0;
$retrait = "";
//$pdf->Ln(18);

// Saut de ligne
$pdf->SetFont('', 'BIU');
$pdf->Cell(0);
//$pdf->Write(0,  $code_secret ."\n");
$pdf->Image("conf2.PNG",0, 5, 135, 45);
$pdf->Ln(18);
$pdf->SetFont('', 'BI');
$pdf->Cell(60);
$pdf->Ln(26);
$pdf->Cell(0, 3, 'Fait A Casablanca Le :' . date('d/m/Y'), 0, 1, 'C');
$pdf->Ln(18);
$pdf->Cell(25);
$pdf->Ln(1);
$pdf->Ln(1);
$pdf->Write($h,$retrait .utf8_decode("Cher confrère,je vous adresse le(la) patient(e) : "));
$pdf->Ln(10);
$pdf->Cell(50);
$pdf->Write($h, $nom_prenom );
$pdf->Ln(10);
$pdf->Write($h, $retrait .utf8_decode("né(e) le :                ") );
$pdf->Ln(10);
$pdf->Cell(50);
$pdf->Write($h, $birth);
$pdf->Ln(15);
$pdf->Write($h, $retrait .utf8_decode("qui se présente au cabinet pour : ") );
$pdf->Ln(10);
$pdf->Write($h, $raison); 

//$pdf->Ln(15);
//$pdf->Write($h, $retrait . utf8_decode("sauf complication"));
///$pdf->Write($h, $filiere);

$pdf->Cell(8);
$pdf->Ln(15);
$pdf->Write($h, utf8_decode("veuillez s'il vous plait  nous expliquez la nature de sa maladie ,"));
$pdf->Ln(10);
$pdf->Write($h, utf8_decode("des éventuelles traitements en cours et des éventuelles précautions"));
$pdf->Ln(10);
$pdf->Write($h, utf8_decode("à prendre en considération"));
$pdf->Ln(10);
$pdf->Cell(100);

$pdf->Write($h, utf8_decode("Cordialment"));

//$pdf->Ln(18);
// Décalage de 50 mm à droite
//$pdf->Cell(50);
//$pdf->write( $h, $retrait ."SONASID ");
// x et y et width (latgeur)
$pdf->Ln(2);

$pdf->Ln(10);
//$pdf->SetFont('', 'BIU');
//$pdf->Write($h, "objet :");
//Ecriture normal
//$pdf->SetFont('', 'BI');
//$pdf->Write($h,"    Attestation de stage");


$pdf->SetFont('', '');

// Saut de ligne
//$pdf->Ln(15);

// Début en police Arial normale taille 10


//dealage de 8 mm a droite
$pdf->Cell(8);


//$pdf->Write($h, $certif);

// Décalage de 50 mm à droite
//$pdf->Cell(50);
//$pdf->write( $h, $retrait ."SONASID ");
// x et y et width (latgeur)
//$pdf->Image('attestation.PNG', 0,195,150);
//Afficher le pdf
$pdf->Output('C:/xampp/htdocs/Doctor/fpdf/Saved/confrerie'.$id.'.pdf','F');
ob_end_flush();
?>