<?php
  include_once('../config/init.php');

		$request_id = $_GET['request_id'];
		$provider_id = $smarty->getTemplateVars('user_id');
		$result = deleteServiceProviderAndRequestFromTableProviderRequest($provider_id, $request_id);
		die (header("Location: ../pages/propostas_disponiveis.tpl"));

?>


