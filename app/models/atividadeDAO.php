<?php defined('SITE_URL') OR exit('Acesso não permitido');

require_once('atividade.php');
require_once(__DIR__.'/../../lib/conexao.php');
require_once(__DIR__.'/../../lib/statusMAP.php');

/**
* Classe AtividadeDAO 
*/
class AtividadeDAO
{
	/**
	 * Exibe a lista de todas as atividades
	 * @return array            Retorna um array do objeto Atividade, tendo como
	 *                          indice do array o ID da atividade.
	 */
	public function showAtividades()
	{
		$atividades = [];
		$stmt = Conexao::getInstance()->query("SELECT * FROM atividade;");
		while ($linha = $stmt->fetch()) {
			$atividades[$linha['id_atividade']] = new Atividade(
				$linha['id_atividade'],
                $linha['nome_atividade'],
                $linha['descricao_atividade'],
                $linha['data_inicio'],
                $linha['data_fim'],
                StatusMAP::getStatus($linha['fk_status_id_status']),
                $linha['situacao']);
		}
		return $atividades;
	}

	public function getAtividade($id_atividade)
	{
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM atividade where 
			id_atividade = :id_atividade;");
		$stmt->bindParam(':id_atividade', $id_atividade, PDO::PARAM_INT);
		$stmt->execute();

		if ($linha = $stmt->fetch()) {
			return new Atividade(
				$linha['id_atividade'],
                $linha['nome_atividade'],
                $linha['descricao_atividade'],
                $linha['data_inicio'],
                $linha['data_fim'],
                StatusMAP::getStatus($linha['fk_status_id_status']),
                $linha['situacao']);
		}
		return false;
	}

	/**
	 * Insere uma atividade no banco
	 * @param Atividade $atividade Atividade a ser inserida no banco
	 * @return mixed               Retorna true se inserido com sucesso ou uma
	 *                             string com a mensagem de erro.
	 */
	public function addAtividade(Atividade $atividade)
	{
		$valida_atividade = $this->validaAtividade($atividade);
		if ($valida_atividade !== true){
			return $valida_atividade;
		}

		$nome_atividade = $atividade->getNomeAtividade();
		$descricao_atividade = $atividade->getDescricaoAtividade();
		$data_inicio = $atividade->getDataInicio();
		$data_fim = $atividade->getDataFim();
		$status = $atividade->getStatus()->getIdStatus();
		$situacao = $atividade->getSituacao();

		$stmt = Conexao::getInstance()->prepare("call prc_insere_atividade (
			:nome_atividade, :descricao_atividade, :data_inicio, :data_fim, 
			:status, :situacao);");	
		
		$stmt->bindParam(':nome_atividade', $nome_atividade,PDO::PARAM_STR);
		$stmt->bindParam(':descricao_atividade', $descricao_atividade,
			PDO::PARAM_STR);
		$stmt->bindParam(':data_inicio', $data_inicio,PDO::PARAM_STR);
		$stmt->bindParam(':data_fim', $data_fim,PDO::PARAM_STR);
		$stmt->bindParam(':status', $status,PDO::PARAM_INT);
		$stmt->bindParam(':situacao', $situacao, PDO::PARAM_BOOL);
		$retorno = $stmt->execute();
		
		$arr = $stmt->errorInfo();
		if ($arr[2] == null)
		{
			return true;
		}
		return 'Erro ao inserir. - '.$arr[2];
	}

	/**
	 * Edita uma atividade existente
	 * @param Atividade $atividade Atividade a ser editada
	 * @return mixed               Retorna true se alterada com sucesso ou uma
	 *                             string com a mensagem de erro.
	 */
	public function editAtividade(Atividade $atividade)
	{
		$valida_atividade = $this->validaAtividade($atividade);
		if ($valida_atividade !== true){
			return $valida_atividade;
		}

		$id_atividade = $atividade->getIdAtividade();
		$nome_atividade = $atividade->getNomeAtividade();
		$descricao_atividade = $atividade->getDescricaoAtividade();
		$data_inicio = $atividade->getDataInicio();
		$data_fim = $atividade->getDataFim();
		$status = $atividade->getStatus()->getIdStatus();
		$situacao = $atividade->getSituacao();

		$stmt = Conexao::getInstance()->prepare("call prc_atualiza_atividade (
			:id_atividade, :nome_atividade, :descricao_atividade, :data_inicio,
			:data_fim, :status, :situacao);");	
		
		$stmt->bindParam(':id_atividade', $id_atividade,PDO::PARAM_INT);
		$stmt->bindParam(':nome_atividade', $nome_atividade,PDO::PARAM_STR);
		$stmt->bindParam(':descricao_atividade', $descricao_atividade,
			PDO::PARAM_STR);
		$stmt->bindParam(':data_inicio', $data_inicio,PDO::PARAM_STR);
		$stmt->bindParam(':data_fim', $data_fim,PDO::PARAM_STR);
		$stmt->bindParam(':status', $status,PDO::PARAM_INT);
		$stmt->bindParam(':situacao', $situacao, PDO::PARAM_BOOL);
		$retorno = $stmt->execute();
		
		$arr = $stmt->errorInfo();
		if ($arr[2] == null)
		{
			return true;
		}
		return 'Erro ao atualizar. - '.$arr[2];
	}

	/**
	 * Verifica se uma atividade é válida
	 * @param Atividade $atividade Atividade a ser validada
	 * @return mixed               Retorna true se validada com sucesso ou uma
	 *                             string com a mensagem de erro.
	 */
	private function validaAtividade(Atividade $atividade)
	{
		$sucesso = true;
		$mensagem = '';
		// O campo nome é de preenchimento obrigatório e deve possuir o total de 
		// 255 caracteres;
		if (strlen($atividade->getNomeAtividade()) == 0 ) {
			$sucesso = false;
			$mensagem .= 'Campo nome é obrigatório. ';
		} 
		if (strlen($atividade->getNomeAtividade()) > 255 ) {
			$sucesso = false;
			$mensagem .= 'Campo nome deve possuir 255 caracteres no máximo. ';
		} 

		// O campo descrição é de preenchimento obrigatório e deve possuir o 
		// total de 600 caracteres;
		if (strlen($atividade->getDescricaoAtividade()) == 0 ) {
			$sucesso = false;
			$mensagem .= 'Campo descrição é obrigatório. ';
		} 
		if (strlen($atividade->getDescricaoAtividade()) > 600 ) {
			$sucesso = false;
			$mensagem .= 'Campo descrição deve possuir 600 caracteres no 
				máximo. ';
		}
		
		// O campo data de início é de preenchimento obrigatório e deve ser no 
		// formato “DATE”;
		if (strlen($atividade->getDataInicio()) == 0 ) {
			$sucesso = false;
			$mensagem .= 'Campo data início é obrigatório. ';
		} else {
			$dia = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataInicio())->format('d');
			$mes = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataInicio())->format('m');
			$ano = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataInicio())->format('Y');
			if (! checkdate($mes, $dia, $ano)) {
				$sucesso = false;
				$mensagem .= 'Campo data início deve ser uma data válida. ';
			}
		}
		
		// O campo data de fim não é de preenchimento obrigatório desde que o 
		// status da atividade seja diferente de “Concluído” (deve ser no 
		// formato “DATE”);
		if (strlen($atividade->getDataFim()) == 0 ) {
			if ($atividade->getStatus()->getIdStatus() == 4){
				$sucesso = false;
				$mensagem .= 'Campo data fim é obrigatório quando o status for'.
				' "Concluído". ';
			}
		} else {
			$dia = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataFim())->format('d');
			$mes = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataFim())->format('m');
			$ano = DateTime::createFromFormat('Y-m-d', $atividade->
				getDataFim())->format('Y');
			if (! checkdate($mes, $dia, $ano)) {
				$sucesso = false;
				$mensagem .= 'Campo data fim deve ser uma data válida. ';
			}
		}
		
		// Uma vez uma atividade marcada com o status “Concluído” ela jamais 
		// poderá ter alguma informação alterada (inclusive o status);
		if ($atividade->getIdAtividade() > 0 ) { // trata-se de uma edicao
			$atividade_atual = $this->getAtividade($atividade->
				getIdAtividade());
			if ($atividade_atual->getStatus()->getIdStatus() == 4){
				$sucesso = false;
				$mensagem .= 'Atividade concluída não pode ser alterada. ';
			}
		}

		if ($sucesso){
			return true;
		}
		return $mensagem;
	}
}
