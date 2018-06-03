<?phpfunction liste_radio() {    $liste = array();    global $cxn;    /*     * ************************************************ */    try {        $sql = "     SELECT  ListeLangages.nom_langage,ListeRadioWeb.langage AS id_langage,ListeRadioWeb.url,ListeRadioWeb.id_radio,ListeRadioWeb.nom_radio,ListeRadioWeb.affiche,ListePays.nom_pays,ListeThemeRadio.nom_theme,ListeRadioWeb.activation,ListeRadioWeb.date_created                      FROM  ListeRadioWeb,ListePays,ListeThemeRadio,ListeLangages  WHERE ListeRadioWeb.pays=ListePays.id_pays  AND ListeRadioWeb.theme=ListeThemeRadio.id_theme AND ListeRadioWeb.langage=ListeLangages.id_langage ORDER BY id_radio DESC ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_radio'] = $enregistrement['id_radio'];            $liste[$i]['logo'] = $enregistrement['affiche'];            $liste[$i]['nom_radio'] = $enregistrement['nom_radio'];            $liste[$i]['pays'] = $enregistrement['nom_pays'];            $liste[$i]['date_creation'] = $enregistrement['date_created'];            $liste[$i]['theme'] = $enregistrement['nom_theme'];            $liste[$i]['activation'] = $enregistrement['activation'];                        $liste[$i]['url_chaine'] = $enregistrement['url'];                        $liste[$i]['id_langage'] = $enregistrement['id_langage'];                        $liste[$i]['nom_langage'] = $enregistrement['nom_langage'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;}function liste_pays_chaine() {    $liste = array();    global $cxn;    /*     * ************************************************ */    try {        $sql = "SELECT id_pays,nom_pays  FROM  ListePays  ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_pays'] = $enregistrement['id_pays'];            $liste[$i]['nom_pays'] = $enregistrement['nom_pays'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;}function liste_theme_chaine() {         $liste = array();    global $cxn;    /*     * ************************************************ */    try {        $sql = "SELECT id_theme,nom_theme  FROM  ListeThemeRadio  ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_theme'] = $enregistrement['id_theme'];            $liste[$i]['nom_theme'] = $enregistrement['nom_theme'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;    }function liste_langage_chaine() {         $liste = array();    global $cxn;    /*     * ************************************************ */    try {        $sql = "SELECT id_langage,nom_langage  FROM  ListeLangages  ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_langage'] = $enregistrement['id_langage'];            $liste[$i]['nom_langage'] = $enregistrement['nom_langage'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;    }?>