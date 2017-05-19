<?php
session_start();
session_regenerate_id();
require_once './../../../global/config.php';
$control = true;
$objet = array();
$req2 = "";
if (!isset($_POST['adresse']) && !isset($_POST['adresse_suite'])) {
    $control = false;
    $objet['message_debug'][] = 'le champ adresse et le champ adresse_suite sont vide tous les deux';
} else {
    if (isset($_POST['adresse']) && !empty($_POST['adresse'])) {
        $_POST['adresse'] = htmlspecialchars($_POST['adresse']);
        $req2 .= "adresse='" . $_POST['adresse'] . "',";
    }
    if (isset($_POST['adresse_suite']) && !empty($_POST['adresse_suite'])) {
        $_POST['adresse_suite'] = htmlspecialchars($_POST['adresse_suite']);
        $req2 .= "adresse_suite='" . $_POST['adresse_suite'] . "',";
    }
}
if (!isset($_POST['cp']) || empty($_POST['cp'])) {
    $control = false;
    $objet['message_debug'][] = 'le champ code-postale soit vide ou le champ n\'existe pas ';
} else {
    $_POST['cp'] = htmlspecialchars($_POST['cp']);
    if (!preg_match('/^([0-9]{5})$/', $_POST['cp'])) {
        $control = false;
        $objet['message_debug'][] = 'le format  code-postale n\'est pas valide ';
    } else {
        $req2 .= "CP='" . $_POST['cp'] . "',";
    }
}

if (!isset($_POST['ville']) || empty($_POST['ville'])) {
    $control = false;
    $objet['message_debug'][] = 'le champ ville soit vide ou le champ n\'existe pas ';
} else {
    $_POST['ville'] = htmlspecialchars($_POST['ville']);
    $req2 .= "ville='" . $_POST['ville'] . "',";
}
if (!isset($_POST['tel_port']) && !isset($_POST['tel_fixe']) && !isset($_POST['tel_travail'])) {
    $control = false;
    $objet['message_debug'][] = 'les champs tel_port et tel_fixe et tel_travail sont vides ';
} else {
    if (isset($_POST['tel_port']) && !empty($_POST['tel_port'])) {
        $_POST['tel_port'] = htmlspecialchars($_POST['tel_port']);
        if (!preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['tel_port'])) {
            $control = false;
            $objet['message_debug'][] = 'le format tel_port  n\'est pas valide ';
        } else {
            $req2 .= "tel_portable='" . $_POST['tel_port'] . "',";
        }
    }
    if (isset($_POST['tel_fixe']) && !empty($_POST['tel_fixe'])) {
        $_POST['tel_fixe'] = htmlspecialchars($_POST['tel_fixe']);
        if (!preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['tel_fixe'])) {
            $control = false;
            $objet['message_debug'][] = 'le format tel_fixe  n\'est pas valide ';
        } else {
            $req2 .= "tel_fixe='" . $_POST['tel_fixe'] . "',";
        }
    }
    if (isset($_POST['fax']) && !empty($_POST['fax'])) {
        $_POST['fax'] = htmlspecialchars($_POST['fax']);
        if (!preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['fax'])) {
            $control = false;
            $objet['message_debug'][] = 'le format Fax  n\'est pas valide ';
        } else {
            $req2 .= "fax='" . $_POST['fax'] . "',";
        }
    }
}
if (isset($_POST['url']) && !empty($_POST['url'])) {
    $_POST['url'] = htmlspecialchars($_POST['url']);
    if (!preg_match('#^http://[w-]+[w.-]+.[a-zA-Z]{2,6}#i', $_POST['url'])) {
        $control = false;
        $objet ['message_debug'][] = 'le format url  n\'est pas valide ';
    } else {
        $req2 .= "site_web='" . $_POST['url'] . "',";
    }
}
if (!isset($_POST['cle_rib']) || empty($_POST['cle_rib'])) {
    $control = false;
    $objet['message_debug'][] = 'le champ cle-rib soit vide ou le champ n\'existe pas ';
} else {
    $_POST['cle_rib'] = htmlspecialchars($_POST['cle_rib']);
    if ($_POST['cle_rib'] == '00') {
        $control = false;
        $objet['message_debug'][] = 'le format cle-rib n\'est pas valide ';
    } elseif (!preg_match('/^([0-9]{2})$/', $_POST['cle_rib'])) {
        $control = false;
        $objet['message_debug'][] = 'le format cle-rib n\'est pas valide ';
    } else {
        $req2 .= "cle_rib='" . $_POST['cle_rib'] . "',";
    }
}
if (isset($_POST['code_banque']) && !empty($_POST['code_banque'])) {
    $_POST['code_banque'] = htmlspecialchars($_POST['code_banque']);
    if ((!is_numeric($_POST['code_banque'])) OR (strlen($_POST['code_banque'])!=5)) {
        $control = false;
        $objet ['message_debug'][] = 'le format code banque  n\'est pas valide ';
    } else {
        $req2 .= "banque='" . $_POST['code_banque'] . "',";
    }
}
if (isset($_POST['code_guichet']) && !empty($_POST['code_guichet'])) {
    $_POST['code_guichet'] = htmlspecialchars($_POST['code_guichet']);
    if ((!is_numeric($_POST['code_guichet'])) OR (strlen($_POST['code_guichet'])!=5)) {
        $control = false;
        $objet ['message_debug'][] = 'le format code guichet  n\'est pas valide ';
    } else {
        $req2 .= "guichet='" . $_POST['code_guichet'] . "',";
    }
}
if (isset($_POST['n_compte']) && !empty($_POST['n_compte'])) {
    $_POST['n_compte'] = htmlspecialchars($_POST['n_compte']);
    if (strlen($_POST['n_compte'])!=11) {
        $control = false;
        $objet ['message_debug'][] = 'le format Numero compte  n\'est pas valide ';
    } else {
        $req2 .= "n_compte='" . $_POST['n_compte'] . "',";
    }
}

if ($control) {
    $req2 = substr($req2, 0, -1);
    $req1 = "UPDATE  intervenants  SET ";
    $sql = $req1 . $req2 . " WHERE code_intervenant=:param   ";
    try {
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param', $code_intervenant);
        $code_intervenant = $_SESSION['membre']['code_intervenant'];
        $stmt->execute();
        $reponse = 'oui';
    } catch (Exception $e) {
        $reponse = 'non';
        $objet ['message_debug'][] = 'Une erreur est survenue lors de la insertion des données ';
    }
    $objet['message_debug'][] = 'Control-ok ';
} else {
    $reponse = 'non';
}
/* echo $reponse;
  foreach ($_POST as $key => $value) {
  echo $key . "-" . $value . "<br/>";
  }
  foreach ($objet['message_debug'] as $key => $value) {
  echo $value . "<br/>";
  }
  echo $sql."<br/>";
  echo "<a href='../../index.php?module=membre&action=modif_profil'>retour </a>"; */
$objet['message'] = array('reponse' => $reponse);
header('Content-type: application/json');
echo json_encode($objet);
?>

