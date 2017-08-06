<?php defined('SITE_URL') OR exit('Acesso não permitido');
/*
* Constantes de configuração da conexão
*/
define('USER', 'root');
define('PASSWORD', 'root');
define('HOST', 'localhost');
define('DBNAME', 'ds_3004');
define('CHARSET', 'utf8');

/**
* Classe no modelo Singleton que gerencia a conexão ao banco de dados
*/
class Conexao
{
	private static $pdo;

	private function __construct() {}

	public static function getInstance() {

		if (!isset(self::$pdo)) {
			try {
				$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
				self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, $opcoes);
			} catch (PDOException $e) {
				print "Erro: " . $e->getMessage();
			}
		}
		
		return self::$pdo;
	}
}