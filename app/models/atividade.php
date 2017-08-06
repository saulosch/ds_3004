<?php defined('SITE_URL') OR exit('Acesso não permitido');

require_once('status.php');

/**
* Classe Atividade 
*/
class Atividade
{
	private $id_atividade;
	private $nome_atividade;
	private $descricao_atividade;
	private $data_inicio;
	private $data_fim;
	private $status;
	private $situacao;

	public function __construct($id_atividade, $nome_atividade, 
		$descricao_atividade, $data_inicio, $data_fim, Status $status, 
		$situacao) 
	{
		$this->setIdAtividade($id_atividade);
		$this->setNomeAtividade($nome_atividade);
		$this->setDescricaoAtividade($descricao_atividade);
		$this->setDataInicio($data_inicio);
		$this->setDataFim($data_fim);
		$this->setStatus($status);
		$this->setSituacao($situacao);
	}

	/* Getters and Setters */
	
	public function getIdAtividade() 
	{
		return $this->id_atividade;
	}

	public function setIdAtividade($id_atividade) 
	{
		$this->id_atividade = $id_atividade;
	}


	public function getNomeAtividade() 
	{
		return $this->nome_atividade;
	}

	public function setNomeAtividade($nome_atividade) 
	{
		$this->nome_atividade = $nome_atividade;
	}


	public function getDescricaoAtividade() 
	{
		return $this->descricao_atividade;
	}

	public function setDescricaoAtividade($descricao_atividade) 
	{
		$this->descricao_atividade = $descricao_atividade;
	}


	public function getDataInicio() 
	{
		return $this->data_inicio;
	}

	public function setDataInicio($data_inicio) 
	{
		$this->data_inicio = $data_inicio;
	}


	public function getDataFim() 
	{
		return $this->data_fim;
	}

	public function setDataFim($data_fim) 
	{
		$this->data_fim = $data_fim;
	}


	public function getStatus() 
	{
		return $this->status;
	}

	public function setStatus(Status $status) 
	{
		$this->status = $status;
	}

	public function getSituacao() 
	{
		return $this->situacao;
	}

	public function setSituacao($situacao) 
	{
		$this->situacao = $situacao;
	}
}
