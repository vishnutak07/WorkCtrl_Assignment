<?php
    $user_Name = $_GET["name"];
    $user_MobileNumber = $_GET['mob'];
    $user_City = $_GET['city'];
        ob_end_clean();
        require('fpdf/fpdf.php');
        
        // Instantiate and use the FPDF class 
        $pdf = new FPDF();
        
        //Add a new page
        $pdf->AddPage();
        
        // Set the font for the text
        $pdf->SetFont('Arial', '', 18);
        
        // Prints a cell with given text 
        $pdf->Cell(0,10,"Registration Details",1,1,"C");
        $pdf->Cell(40,10,'Name',1,0);
        $pdf->Cell(80,10,'Mobile Number',1,0);
        $pdf->Cell(0,10,'City',1,1);

        $pdf->Cell(40,10,$user_Name,1,0);
        $pdf->Cell(80,10,$user_MobileNumber,1,0);
        $pdf->Cell(0,10,$user_City,1,0);
        
        // return the generated output
        $pdf->Output();
?>