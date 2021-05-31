<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Master extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Listagem de Categorias-Pai',
            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js'
            ),
            'master' => $this->core_model->get_all('categorias_pai'),
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/master/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_pai_id = NULL) {

        $categoria_pai_id = (int) $categoria_pai_id;

        if (!$categoria_pai_id) {

            $this->form_validation->set_rules('categoria_pai_nome', 'Nome da Categoria Pai', 'trim|required|min_length[3]|max_length[40]|callback_valida_nome_categoria_pai');

            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'categoria_pai_nome',
                            'categoria_pai_ativa',
                        ), $this->input->post()
                );

                $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                $data = html_escape($data);
                $this->core_model->insert('categorias_pai', $data);
                redirect('restrita/master');
            } else {
                $data = array(
                    'titulo' => 'Cadastro de Categorias Pai',
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/master/core');
                $this->load->view('restrita/layout/footer');
            }
        } else {

            if (!$categoria_pai = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {
                $this->session->set_flashdata('erro', 'A categoria pai não foi encontrada');
                redirect('restrita/categoria_pai');
            } else {

                $this->form_validation->set_rules('categoria_pai_nome', 'Nome da Categoria Pai', 'trim|required|min_length[3]|max_length[40]|callback_valida_nome_categoria_pai');

                if ($this->form_validation->run()) {
                    
                    if ($this->input->post('categoria_pai_ativa') == 0){
                        
						if ($this->core_model->get_by_id('categorias', array('categoria_pai_id' => $categoria_pai_id))){
							$this->session->set_flashdata('erro', 'Não é possível desativar uma categoria pai vinculada a uma categoria filha');
							redirect('restrita/master');
						}
                    }
                    
                    $data = elements(
                            array(
                                'categoria_pai_nome',
                                'categoria_pai_ativa',
                            ), $this->input->post()
                    );

                    $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                    $data = html_escape($data);
                    $this->core_model->update('categorias_pai', $data, array('categoria_pai_id' => $categoria_pai_id));
                    redirect('restrita/master');
                } else {
                    $data = array(
                        'titulo' => 'Edição de categoria pai',
                        'categoria_pai' => $categoria_pai,
                    );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/master/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_nome_categoria_pai($categoria_pai_nome) {
        $categoria_pai_id = $this->input->post('categoria_pai_id');

        if (!$categoria_pai_id) {
            //Cadastrando
            if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome))) {
                $this->form_validation->set_message('valida_nome_categoria_pai', 'Esta categoria pai já existe.');
                return false;
            } else {
                return true;
            }
        } else {
            //Editando
            if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id != ' => $categoria_pai_id))) {
                $this->form_validation->set_message('valida_nome_categoria_pai', 'Essa categoria pai já existe.');
                return false;
            } else {
                return true;
            }
        }
    }
    
    public function delete($categoria_pai_id = NULL) {

        $categoria_pai_id = (int) $categoria_pai_id;

        if (!$categoria_pai_id || !$this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {

            $this->session->set_flashdata('erro', 'Marca não encontrada');
            redirect('restrita/master');
        }

        if ($this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id, 'categoria_pai_ativa' => 1))) {
            $this->session->set_flashdata('erro', 'Não é possível excluir uma categoria pai ATIVA');
            redirect('restrita/master');
        }

        $this->core_model->delete('categorias_pai', array('categoria_pai_id' => $categoria_pai_id));
        redirect('restrita/master');
    }
}
