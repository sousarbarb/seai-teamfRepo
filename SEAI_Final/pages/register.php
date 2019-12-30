<?php

include_once('../config/init.php');

if(!empty($smarty->getTemplateVars('login'))) {
  $smarty->assign('menu', '1');
  $smarty->display('menu_account/menu_my_account.tpl');
} else {
  $smarty->display('initial/register.tpl');
}

if(!empty($smarty->getTemplateVars('form_values'))) {
  $qzq = $smarty->getTemplateVars('form_values');
  $qzq = $qzq['selectform'];
  if(($qzq)=='provider') {
    echo '<script type="text/javascript">',
     'auto_click_provider();',
     '</script>';
  } else {
    echo '<script type="text/javascript">',
     'auto_click_client();',
     '</script>';
  }
}

/*
if ((($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))) {
    if($_POST['selectedfaucet'] == "servp") {
        die(header("location:register_provider.php"));
    }
    else if($_POST['selectedfaucet'] == "servc") {
        die(header("location:register_client.php"));
    }
}*/
?>
