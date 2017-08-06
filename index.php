<?php
define('SITE_URL','http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
define('BASE_URL',substr(SITE_URL, 0, strpos(SITE_URL.'/index.php',
	'/index.php')));

require_once __DIR__.'/app/controllers/atividadeController.php';

/**
 * ROUTES
 *
 * Pela simplicidade da aplicação será utilizado um único controller e as rotas 
 * serão definidas neste arquivo. As rotas desta seção determinam qual método 
 * deste controller deve ser chamado em cada caso.
 */

//Controller padrão
$activity_controller = new AtividadeController;

$path = (isset($_SERVER['PATH_INFO']))?$_SERVER['PATH_INFO']:null;
if ($path !== null ) {
	$path = explode('/', trim($path,'/'));
		
	switch ($path[0]) {
		case 'lista':
			$activity_controller->list();
			break;
		
		case 'adiciona':
			$activity_controller->add();
			break;
		
		case 'edita':
			$activity_controller->edit();
			break;
		
		default:
			/*
			 * Alternativamente, pode-se chamar um html com a mensagem de erro 
			 * 404 personalizada.
			 */
			http_response_code(404);
			echo '<h3>Erro 404 - Página não encontrada.</h3>';
			die(0);
			break;
	}

} else {
	// Método padrão
	$activity_controller->list();
}
