<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "third_party/tcpdf/tcpdf.php";

class Pdf extends TCPDF
{
    function __construct($params = array())
    {
        // Call parent constructor
        $orientation = isset($params['orientation']) ? $params['orientation'] : 'L';
        $unit = isset($params['unit']) ? $params['unit'] : 'mm';
        $format = isset($params['format']) ? $params['format'] : 'A4';
        $unicode = isset($params['unicode']) ? $params['unicode'] : true;
        $encoding = isset($params['encoding']) ? $params['encoding'] : 'UTF-8';
        $diskcache = isset($params['diskcache']) ? $params['diskcache'] : false;
        $pdfa = isset($params['pdfa']) ? $params['pdfa'] : false;
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }
}
