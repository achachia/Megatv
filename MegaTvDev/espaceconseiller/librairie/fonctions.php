<?php

/* * ************* Verification une date ************** */

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

/* Test
  $date = '2015-04-01';
  if (!validateDate($date, 'Y-m-d')) {
  echo 'non valide';
  }else{
  echo 'valide';
  } */
/* * *************  chaine de caractere ************** */

// function unhtmlentities($string) {
//     $string = trim($string);
//     $string = (!get_magic_quotes_gpc()) ? addslashes($string) : $string;
//     $string = htmlentities($string, ENT_QUOTES);
//     return $string;
// }
/* * *************  ************** */

?>
