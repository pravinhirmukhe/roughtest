<?php

require 'tcpdf.php';

class MYPDF extends TCPDF {

    //Page header
//    public function Header() {
//        // Logo
//        $image_file = PDF_HEADER_LOGO;
//        $this->Image($image_file, 10, 10, PDF_HEADER_LOGO_WIDTH, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//        // Set font
//        $this->SetFont('helvetica', 'B', 20);
//        // Title
//        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        // Page number
        $this->Cell(0, 10, "Roughsheet", 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'R', 8);
        $this->SetY(-15);
        $this->Cell(0, 20, "Website: www.roughsheet.com | Email: support@roughsheet.com ", 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}
