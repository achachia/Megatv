<?php


    if ((empty($module) && !empty($action))) {

        $route = FALSE;
    } elseif ((!empty($module) && empty($action))) {

        $route = FALSE;
    } elseif ((!empty($module) && !empty($action)) || (empty($module) && empty($action))) {

        if (!empty($module) && !empty($action)) {

            $file = $root_dir . chemin_controleur . $module . '.php';

            if (!is_file($file)) {

                $route = FALSE;
            }
        }
    }

?>