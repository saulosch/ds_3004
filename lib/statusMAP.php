<?php defined('SITE_URL') OR exit('Acesso não permitido');
require_once(__DIR__.'/../app/models/statusDAO.php');
require_once(__DIR__.'/../app/models/status.php');

/**
* Classe StatusMAP
* 
* ******************************************************************************
* NOTA DO DESENVOLVEDOR:
* ----------------------
* 
* Para uma tabela com 4 registros em uma aplicação com pouco uso, pode-se 
* implementar a obenção do status de uma forma mais simples: carregando todos
* os registros de uma só vez, ou ainda um a um, não faria muita diferença.
* Criei essa arquitetura para demonstrar uma forma de obter melhor desempenho
* da aplicação considerando um possível cenário com mais registros. Com essa
* implementação, apenas os status que tiverem uma atividade relacionada são
* carregados uma única vez e ficam em memória para serem reutilizados.
* 
* ******************************************************************************
*/
class StatusMAP
{
	private static $statuses;
	private static $statusDao;
	
	private function __construct() 
	{
		//
	}

	/**
	 * Obtem um Status com base no ID informado.
	 * @param  int  $id   ID do status que se deseja obter.
	 * @return mixed Retorna um objeto do tipo Status ou o booleano false caso 
	 *               não encontre um status com o id informado.
	 */
	public static function getStatus($id)
	{
		if (! isset(self::$statuses[$id])){
			self::$statuses[$id] = self::getStatusDao()->getStatus($id);
		}
		return self::$statuses[$id];
	}

	/**
	 * Obtem a lista completa de Status. 
	 * @return array Retorna um array tendo o id_status como chave o nome_status
	 *               como valor.
	 */
	public static function showStatus()
	{
		$statuses = self::getStatusDao()->showStatus();
		foreach ($statuses as $status) {
			self::$statuses[$status->getIdStatus()] = $status->getNomeStatus();
		}
		return self::$statuses;
	}

	/**
	 * Gererencia um objeto de StatusDao
	 * @return StatusDAO retorna um objeto de StatusDAO
	 */
	private static function getStatusDao()
	{
		if (! self::$statusDao instanceOf StatusDAO) {
			self::$statusDao = new StatusDAO;
		}
		return self::$statusDao;
	}
}
