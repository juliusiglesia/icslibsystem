<?php
/*============================================================+
* File name   : print_inventory_view.php
* Last Update : 2013-01-30
*
* Description : Generate PDF for Inventory Report
*
* Author: CMSC 128 AB-6L A.Y.2013-14
*
============================================================+
*/

/**
 * Creates a PDF of Inventory Report using TCPDF
 * @package com.tecnick.tcpdf
 */

// Include the main TCPDF library (search for installation path).
require_once('/application/third_party/tcpdf_min/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
    
    // Colored table
    public function ColoredTable($header,$data) {
        
        // Colors, line width and bold font
        $this->SetFillColor(0, 0, 255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
       
        // Header
        $w = count($header) == 4?array(30, 180, 20, 20):array(180, 20, 20);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Data
        $fill = 0;
        $count = 0;
        $actual = 0;
        if(count($w) == 3){
            foreach($data as $row) {
                $this->Cell($w[0], 6, $row['name'], 'LR', 0, 'L', $fill, null, 3);
                $this->Cell($w[1], 6, number_format($row['quantity']), 'LR', 0, 'C', $fill, null, 3);
                $this->Cell($w[2], 6, number_format($row['total']), 'LR', 0, 'C', $fill, null, 3);
                $count+=number_format($row['quantity']);
                $actual+=number_format($row['total']);
                $this->Ln();
                $fill=!$fill;
            }
            $this->Cell($w[0], 6, "Total", 'LR', 0, 'C', $fill, null, 3);
            $this->Cell($w[1], 6, number_format($count), 'LR', 0, 'C', $fill, null, 3);
            $this->Cell($w[2], 6, number_format($actual), 'LR', 0, 'C', $fill, null, 3);
            $this->Ln();
            $fill=!$fill;
        }

        else{
            foreach($data as $row) {
                $this->Cell($w[0], 6, $row['isbn'], 'LR', 0, 'L', $fill, null, 3);
                $this->Cell($w[1], 6, $row['name'], 'LR', 0, 'L', $fill, null, 3);
                $this->Cell($w[2], 6, number_format($row['quantity']), 'LR', 0, 'C', $fill, null, 3);
                $this->Cell($w[3], 6, number_format($row['total']), 'LR', 0, 'C', $fill, null, 3);
                $count+=number_format($row['quantity']);
                $actual+=number_format($row['total']);
                $this->Ln();
                $fill=!$fill;
            }
            $this->Cell($w[0]+$w[1], 6, "Total", 'LR', 0, 'C', $fill, null, 3);
            $this->Cell($w[2], 6, number_format($count), 'LR', 0, 'C', $fill, null, 3);
            $this->Cell($w[3], 6, number_format($actual), 'LR', 0, 'C', $fill, null, 3);
            $this->Ln();
            $fill=!$fill;
        }

        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function Footer(){

        //System Time
        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/Y h:i:s a', time());

        //Set Y and Font
        $this->SetY(-15);
        $this->SetFont('courier', 'I', 8);
       
        // Title
        $this->Cell(50, 15, 'Report Generated From:', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(50, 15, 'ICS Library System (iLS)', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(50, 15, $date, 0, false, 'R', 0, '', 0, false, 'M', 'M');
    }
}
// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('ICS Library Inventory Report');

// set default header data
$pdf->SetHeaderData("ICSlogo.jpg", PDF_HEADER_LOGO_WIDTH, 'Inventory Report For: ', $libinventory['sem']);
$pdf->SetFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);


$pdf->AddPage();

$html = '<div style ="line-height:700%;"><br></div>';
$pdf->writeHTML($html, true, false, true, false, "C");
$html = '<font size="36"><center>ICS Library Inventory Report</center></font><br>
        <h4>Institute of Computer Science, UPLB</h4>
        </div>';
$pdf->writeHTML($html, true, false, true, false, "C");


// add a page
$pdf->AddPage();

$html = '<h3>Books</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');
// column titles
$header = array('ISBN','Course', 'Copies', 'Actual');

// data loading
// print colored table
$pdf->ColoredTable($header, $libinventory['books']);


//add a page
$pdf->AddPage();

$html = '<h3>Journals</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');
// column titles
$header = array('ISBN','Title', 'Copies', 'Actual');

$pdf->ColoredTable($header, $libinventory['journals']);

// add a page
$pdf->AddPage();

$html = '<h3>Magazines</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');
// column titles
$header = array('Name of Magazine', 'Copies', 'Actual');

// data loading
// print colored table
$pdf->ColoredTable($header, $libinventory['mags']);

// add a page
$pdf->AddPage();

$html = '<h3>Special Problem Manuscripts</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');
// column titles
$header = array('Title', 'Copies', 'Actual');

// data loading
// print colored table
$pdf->ColoredTable($header, $libinventory['sps']);

// add a page
$pdf->AddPage();

$html = '<h3>Theses and Dissertation Papers</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->ColoredTable($header, $libinventory['theses']);

// add a page
$pdf->AddPage();

$html = '<h3>References</h3></br>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->ColoredTable($header, $libinventory['refs']);

$html = '<br/><br/><br/><br/>Certified true and accurate by: <b><u>MRS. MAYETH GIRONELLA</u></b><br/>Signature:';
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('inventory.pdf', 'I');

    /*  End of file print_inventory_view.php
    *   Location: ./application/views/print_inventory_view.php 
    */