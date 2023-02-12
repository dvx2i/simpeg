<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once("./application/third_party/dompdf_0-8-3/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

class Pdfgenerator
{

  public function generate($html, $filename = '', $stream = TRUE, $paper, $orientation = "lanscape")
  {
    // die(APPPATH);
    $webRoot = APPPATH;

    $dompdf = new DOMPDF();
    $dompdf->setBasePath($webRoot);
    $dompdf->loadHtml($html);
    if ($paper == "F4") //gunkan google mm to point di goggle untuk custom
      $dompdf->setPaper(array(0, 0, 595.276, 935.433), $orientation);
    if ($paper == "A2")
      $dompdf->setPaper(array(0, 0, 467.7165, 609.4488), $orientation);
    if ($paper == "SPPT")
      $dompdf->setPaper(array(0, 0, 610.276, 530.276), $orientation);
    else
      $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
      $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    } else {
      return $dompdf->output();
    }
  }


  public function generate_to_server($html, $filename = '', $stream = FALSE, $paper = 'A4', $orientation = "portrait")
  {
    // die($paper);
    // $dompdf = new DOMPDF();
    $webRoot = APPPATH;

    $dompdf = new DOMPDF();
    $dompdf->setBasePath($webRoot);

    $dompdf->loadHtml($html);

    if ($paper == "F4") //gunkan google mm to point di goggle untuk custom
      $dompdf->setPaper(array(0, 0, 595.276, 935.433), $orientation);
    if ($paper == "A2")
      $dompdf->setPaper(array(0, 0, 467.7165, 609.4488), $orientation);
    else
      $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    // if ($stream) {
    // $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    // } else {
    // die;
    $pdf = $dompdf->output();
    $file_location = $_SERVER['DOCUMENT_ROOT'] . "/assets/docs/" . $filename . ".pdf";
    file_put_contents($file_location, $pdf);
    // }
  }
}


/*
class PdfGenerator
{
  public function generate($html,$filename, $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    // define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("./application/third_party/dompdf_0-8-3/dompdf/autoload.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}
*/