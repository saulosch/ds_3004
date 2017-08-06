<?php defined('SITE_URL') OR exit('Acesso não permitido');

/**
* Classe do Status 
*/
class Status
{
	private $id_status;
	private $nome_status;

	public function __construct($id_status, $nome_status = false)
	{
		$this->setIdStatus($id_status);
		if ($nome_status !== false) {
			$this->setNomeStatus($nome_status);
		}
	}

	/* Getters and Setters */
	
	public function getIdStatus()
	{
		return $this->id_status;
	}
	
	public function setIdStatus($id_status)
	{
		$this->id_status = $id_status;
	}


	public function getNomeStatus()
	{
		return $this->nome_status;
	}

	public function setNomeStatus($nome_status)
	{
		$this->nome_status = $nome_status;
	}
}
