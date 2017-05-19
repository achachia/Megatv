<?php

function debug_sql() {
    $sql_debug = NULL;
    foreach ($modele as $key => $value) {
        $var = "'" . $value . "'";
        if ($sql_debug == NULL) {
            $sql_debug = str_replace($key, $var, $sql);
        } else {
            $sql_debug = str_replace($key, $var, $sql_debug);
        }
    }
    return $sql_debug;
}
?>

