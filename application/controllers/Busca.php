<?php
defined('BASEPATH') or exit('Ação não permitida');


class Busca extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$busca = html_escape($this->input->post('busca'));
		$data = array(
			'titulo' => 'Busca pelo produto:  ' . (!empty($busca) ? $busca : 'Nenhuma palavra digitada'),
			'palavra_digitada' => (!empty($busca) ? $busca : 'Nenhuma palavra digitada'),
		);

		if ($busca) {
			if ($produtos = $this->Produtos_model->buscar_produtos($busca)) {
				$data['produtos'] = $produtos;
			}
		}

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/busca');
		$this->load->view('web/layout/footer');
	}
}
