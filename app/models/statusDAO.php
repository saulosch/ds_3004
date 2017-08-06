<?php defined('SITE_URL') OR exit('Acesso não permitido');

require_once('status.php');
require_once(__DIR__.'/../../lib/conexao.php');

/**
* Classe StatusDAO 
*/
class StatusDAO
{
	/**
	 * Consulta a tabela Status referente ao ID fornecido.
	 * @param  int  $id  ID do status que se deseja obter.
	 * @return mixed     Retorna um objeto do tipo Status ou o booleano false 
	 *                   caso não encontre um status com o id informado.
	 */
	public function getStatus($id)
	{
		$stmt = Conexao::getInstance()->prepare('SELECT * FROM status where 
			id_status = :id;');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
			
		if ($linha = $stmt->fetch()) {
			return new Status($linha['id_status'],$linha['nome_status']);
		} else {
			return false;
		}
	}

	/**
	 * Consulta todos os dados da tabela Status.
	 * @return array     Retorna um array de objetos do tipo Status ou um array 
	 *                   vazio.
	 */
	public function showStatus()
	{
 		$stmt = Conexao::getInstance()->query('SELECT * FROM status;');
 		$status = [];
	
		while ($linha = $stmt->fetch()) {
			$status[$linha['id_status']] = new Status($linha['id_status'],
				$linha['nome_status']);
		}
		return $status;
	}
}
