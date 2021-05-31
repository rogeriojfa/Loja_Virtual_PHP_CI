<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Master extends CI_Controller {

	public function __construct() {
        parent::__construct();

        
    }

	public function index($categoria_pai_meta_link = NULL){
		if(!$categoria_pai_meta_link || !$master = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_meta_link' => $categoria_pai_meta_link))){
			redirect('/');
		}
		else{

			$data = array(
				'titulo' => 'Produtos da Categoria '.$master->categoria_pai_nome,
				'categoria' => $master->categoria_pai_nome,
				'produtos' => $this->Produtos_model->get_all_by(array('categoria_pai_meta_link' => $categoria_pai_meta_link)),

			);

		}

		// echo '<pre>';
		// print_r($data);
		// exit();

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/master');
		$this->load->view('web/layout/footer');
	}
}
