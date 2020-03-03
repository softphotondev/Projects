<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("vendor/dompdf/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

  public function generate($user_id,$html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {	 
    $dompdf = new DOMPDF();
	$dompdf->setPaper(array(0,0,0,1200));
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);

	$options = new Options();
	$options->setIsRemoteEnabled(true);
	$options->set('isHtml5ParserEnabled', true);
	$options->set('debugKeepTemp', TRUE);
	$options->set('dpi', 120);
	$options->set('Paper', 1000);
    $options->set('isPhpEnabled', TRUE);
	$customPaper = array(0,0,700,970);
	$dompdf->set_paper($customPaper);
	$dompdf->setOptions($options);
    $dompdf->render();
	//$font = $dompdf->getFontMetrics()->get_font("helvetica", "");
	$dompdf->getCanvas()->page_text(622, 940, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
	//$dompdf->set_base_path(ASSETS_PATH.'css/bootstrap.min.css');
	//$dompdf->set_base_path(ASSETS_PATH.'css/dashboard.css');
    if ($stream) {
        if (!file_exists('uploads/pdffiles/'.$user_id))
			mkdir('uploads/pdffiles/'.$user_id, 0777, true);
         file_put_contents('uploads/pdffiles/'.$user_id.'/'.$filename.".pdf", $dompdf->output());
         return true;
    } else {

        return $dompdf->output();
    }
  }
  
  public function generateReport($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new DOMPDF();
	//$dompdf->setPaper(array(0,0,0,1200));
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);

	$options = new Options();
	$options->setIsRemoteEnabled(true);
	$options->set('isHtml5ParserEnabled', true);
	$options->set('debugKeepTemp', TRUE);
	$options->set('dpi', 140);
	//$options->set('Paper', 1000);
    $options->set('isPhpEnabled', TRUE);
	//$customPaper = array(0,0,0,0);
	$dompdf->set_paper($customPaper);
	$dompdf->setOptions($options);
    $dompdf->render();
	$font = $dompdf->getFontMetrics()->get_font("helvetica", "");
	//$dompdf->getCanvas()->page_text(622, 940, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
	//$dompdf->set_base_path(ASSETS_PATH.'css/bootstrap.min.css');
	//$dompdf->set_base_path(ASSETS_PATH.'css/dashboard.css');
	 $dompdf->stream($filename.".pdf", array("Attachment" => 0));
	 $output = $dompdf->output();
	 return $output;
    }
}
