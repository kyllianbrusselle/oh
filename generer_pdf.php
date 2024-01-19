<?php
// Vérifier si l'ID client est passé en paramètre
if (isset($_GET['id_client'])) {
    $idClient = $_GET['id_client'];

    // Connexion à la base de données
    $connexion = new PDO('mysql:host=localhost;dbname=ohinfo', 'root', '');

    // Récupérer les informations de la prise en charge liée au client
    $requetePEC = $connexion->prepare('SELECT * FROM prise_en_charge WHERE id_client = :id_client');
    $requetePEC->execute(array('id_client' => $idClient));
    $pec = $requetePEC->fetch();

    // Vérifier si la prise en charge existe
    if ($pec) {
        // Générer le PDF avec les informations de prise en charge
        require_once('fpdf.php');

        class PDF extends FPDF
        {
            function Header()
            {
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 10, 'Prise en charge', 0, 1, 'C');
                $this->Ln(10);
            }

            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Type : ' . $pec['type'], 0, 1);
        $pdf->Cell(0, 10, 'Marque et modèle : ' . $pec['marque_modele'], 0, 1);
        $pdf->Cell(0, 10, 'État du matériel : ' . $pec['etat'], 0, 1);
        $pdf->Cell(0, 10, 'Détails de la panne : ' . $pec['details'], 0, 1);
        $pdf->Cell(0, 10, 'Accessoires : ' . $pec['accessoires'], 0, 1);
        $pdf->Cell(0, 10, 'Mot de passe : ' . $pec['mot_de_passe'], 0, 1);
        $pdf->Output('prise_en_charge.pdf', 'F');

        // Rediriger vers la page de confirmation avec le lien vers le PDF
        $pdfLink = 'prise_en_charge.pdf';
        header('Location: confirmation.php?id_client=' . $idClient . '&pdf=' . $pdfLink);
        exit;
    } else {
        echo 'Aucune prise en charge trouvée pour ce client.';
    }
} else {
    echo 'Paramètre ID client manquant.';
}
?>
