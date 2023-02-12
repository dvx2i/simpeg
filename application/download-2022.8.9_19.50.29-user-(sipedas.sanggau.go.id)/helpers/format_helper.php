<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function cut_string($string, $wordsreturned)
{
  $retval = $string;
  $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
  $string = str_replace("\n", " ", $string);
  $array  = explode(" ", $string);

  if (count($array) <= $wordsreturned) {
    $retval = $string;
  } else {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array) . " ...";
  }
  return $retval;
}

function tgl_ind($date)
{
  // array hari dan bulan
  $Hari   = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
  $Bulan  = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
  // pemisahan tahun, bulan, hari, dan waktu
  $tahun  = substr($date, 0, 4);
  $bulan  = substr($date, 5, 2);
  $tgl    = substr($date, 8, 2);
  $waktu  = substr($date, 11, 5);
  $hari   = date("w", strtotime($date));

  $result = $Hari[$hari] . " " . $tgl . "/" . $bulan . "/" . $tahun . " " . $waktu . " " . "WIB";
  return $result;
}

function d_m_y($date)
{
    if ($date == '0000-00-00') {
        return '';
    }else if ($date == '1000-01-01') {
        return '';
    }else{
    return $date;
    }
}

function y_m_d($date)
{
  if (!empty($date)) {
    return $date;
  } else {
    return '1000-01-01';
  }
}
