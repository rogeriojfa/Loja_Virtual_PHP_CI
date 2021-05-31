<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{

		$sistema = info_header_footer();

		$data = array(
			'titulo' => 'Seja muito bem-vindo(a) à Loja Virtual '.$sistema->sistema_nome_fantasia,
			'produtos_destaque' => $this->Loja_model->get_produtos_destque($sistema->sistema_produtos_destaques),
		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/loja');
		$this->load->view('web/layout/footer');
	}

	
}
