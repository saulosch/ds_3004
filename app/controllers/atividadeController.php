<?php defined('SITE_URL') OR exit('Acesso não permitido');
require_once(__DIR__.'/../models/atividadeDAO.php');
require_once(__DIR__.'/../models/atividade.php');
require_once(__DIR__.'/../../lib/statusMAP.php');
require_once(__DIR__.'/../../lib/view.php');

/**
*  Classe Controller das atividades
*  
*  Nota: mantive o termo "Atividade" em portugues para 
*  simplificar sua identificação.
*/
class AtividadeController
{

	public function list()
	{
		$atividade_dao = new AtividadeDAO();
		$data['title'] = 'Lista de Atividades';
		$data ['atividades'] = $atividade_dao->showAtividades();
		$data['statuses'] = statusMAP::showStatus();
		View::show('listarAtividades', $data);
	}

	public function add()
	{
		$data['id_atividade'] = '';
		
		$data['nome_atividade'] = (isset($_POST['nome_atividade']))?
			$_POST['nome_atividade']:'';
		
		$data['descricao_atividade'] = (isset($_POST['descricao_atividade']))?
			$_POST['descricao_atividade']:'';
		
		//converte o formato da data_inicio e data_fim
		$data['data_inicio'] = (isset($_POST['data_inicio']))?DateTime::
			createFromFormat('d/m/Y', $_POST['data_inicio'])->
			format('Y-m-d'):'';
		
		$data['data_fim'] = (isset($_POST['data_fim']) && $_POST['data_fim'] != 
			'')?DateTime::createFromFormat('d/m/Y', $_POST['data_fim'])->
			format('Y-m-d'):'';
		
		$data['fk_status_id_status'] = (isset($_POST['fk_status_id_status']))?
			$_POST['fk_status_id_status']:'';
		
		$data['situacao'] = (isset($_POST['situacao']))?$_POST['situacao']:'';

		if (isset($_POST["salvar_atividade"])) {
			$atividade = new Atividade(
				0,
				$data['nome_atividade'], 
				$data['descricao_atividade'], 
				$data['data_inicio'], 
				$data['data_fim'], 
				statusMAP::getStatus($data['fk_status_id_status']),
				$data['situacao']);
			$atividade_dao = new AtividadeDAO();
			$data['mensagem'] = $atividade_dao->addAtividade($atividade);
			if (true === $data['mensagem']) {
				//Limpa dados dos campos
				foreach ($data as $key => $value) {
					$data[$key] = '';
				}
				$data['mensagem'] = 'Atividade salva com sucesso';
				$data['mensagem_tipo'] = 'success';
			}
		} 

		$data['title'] = 'Criar nova atividade';
		$data['statuses'] = statusMAP::showStatus();
		View::show('manterAtividade', $data);
	}

	public function edit()
	{
		$id_atividade = (isset($_GET['id']))?$_GET['id']:false;
		
		$atividade_dao = new AtividadeDAO();
		$atividade = $atividade_dao->getAtividade($id_atividade);

		if ($atividade === false){
			$data['id_atividade'] = false;
			$data['mensagem'] = 'Atividade não encontrada.';
		} else {
			//se houver $_POST carrega com dados do $_POST, senão carrega com os
			//dados do objeto atividade.
			$data['id_atividade'] = (isset($_POST['id_atividade']))?
				$_POST['id_atividade']:$atividade->getIdAtividade();
			
			$data['nome_atividade'] = (isset($_POST['nome_atividade']))?
				$_POST['nome_atividade']:$atividade->getNomeAtividade();
			
			$data['descricao_atividade'] = 
				(isset($_POST['descricao_atividade']))?
				$_POST['descricao_atividade']:
				$atividade->getDescricaoAtividade();
			
			//converte o formato da data_inicio e data_fim
			$data['data_inicio'] = (isset($_POST['data_inicio']))?DateTime::
				createFromFormat('d/m/Y', $_POST['data_inicio'])->
				format('Y-m-d'):$atividade->getDataInicio();

			if (isset($_POST['data_fim']) && $_POST['data_fim'] != '') {
				$data['data_fim'] = DateTime::createFromFormat('d/m/Y', 
					$_POST['data_fim'])->format('Y-m-d');
			} elseif ($atividade->getDataFim() != '' && $atividade->getDataFim()
				!= "0000-00-00") {
				$data['data_fim'] = $atividade->getDataFim();
			} else {
				$data['data_fim'] = '';
			}
			
			$data['fk_status_id_status'] = 
				(isset($_POST['fk_status_id_status']))?
				$_POST['fk_status_id_status']:
				$atividade->getStatus()->getIdStatus();
			
			$data['situacao'] = (isset($_POST['situacao']))?$_POST['situacao']:
			$atividade->getSituacao();
		}

		if (isset($_POST["salvar_atividade"])) {
			$atividade = new Atividade(
				$data['id_atividade'], 
				$data['nome_atividade'], 
				$data['descricao_atividade'], 
				$data['data_inicio'], 
				$data['data_fim'], 
				statusMAP::getStatus($data['fk_status_id_status']),
				$data['situacao']);
			$data['mensagem'] = $atividade_dao->editAtividade($atividade);
			if (true === $data['mensagem']) {
				$data['mensagem'] = 'Atividade salva com sucesso';
				$data['mensagem_tipo'] = 'success';
			}
		} 

		$data['title'] = 'Editar atividade';
		$data['statuses'] = statusMAP::showStatus();
		View::show('manterAtividade', $data);
	}
}
