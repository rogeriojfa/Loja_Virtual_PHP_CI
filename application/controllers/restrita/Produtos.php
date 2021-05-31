<?php

defined('BASEPATH') or exit('Ação não permitida');

class Produtos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}
	}

	public function index()
	{
		$data = array(
			'titulo' => 'Listagem de Produtos',
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
			'produtos' => $this->Produtos_model->get_all('produtos'),
			'categorias' => $this->core_model->get_all('categorias'),
			'marcas' => $this->core_model->get_all('marcas'),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/produtos/index');
		$this->load->view('restrita/layout/footer');
	}


	public function core($produto_id = NULL)
	{

		$produto_id = (int) $produto_id;

		if (!$produto_id) {

			//Cadastrandp ....

			$this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[3]|max_length[40]|callback_valida_nome_produto');
			$this->form_validation->set_rules('produto_categoria_id', 'Categoria do produto', 'trim|required');
			$this->form_validation->set_rules('produto_marca_id', 'Marca do produto', 'trim|required');
			$this->form_validation->set_rules('produto_valor', 'Valor do produto', 'trim|required');
			$this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
			$this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
			$this->form_validation->set_rules('produto_largura', 'Largura do produto', 'trim|required|integer');
			$this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
			$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade em Estoque', 'trim|required|integer');
			$this->form_validation->set_rules('produto_descricao', 'Descrição do produto', 'trim|required|min_length[10]|max_length[5000]');

			$fotos_produtos = $this->input->post('fotos_produtos');
			if (!$fotos_produtos) {
				$this->form_validation->set_rules('fotos_produtos', 'Imagens do Produto', 'required');
			}

			if ($this->form_validation->run()) {

				$data = elements(
					array(
						'produto_nome',
						'produto_categoria_id',
						'produto_marca_id',
						'produto_valor',
						'produto_peso',
						'produto_altura',
						'produto_largura',
						'produto_comprimento',
						'produto_quantidade_estoque',
						'produto_ativo',
						'produto_destaque',
						'produto_controlar_estoque',
						'produto_descricao',
					),
					$this->input->post()
				);


				//Remove a vírgula do valor
				$data['produto_valor'] = str_replace(',', '', $data['produto_valor']);
				$data['produto_meta_link'] = url_amigavel($data['produto_nome']);
				$data['produto_codigo'] = $this->input->post('produto_codigo');

				$data = html_escape($data);

				//  echo '<pre>';
				//  print_r($data);
				//  exit();

				$this->core_model->insert('produtos', $data, TRUE);

				//Recupera o último id inserido
				$produto_id = $this->session->userdata('last_id');

				//verifica se veio foto no post
				$fotos_produtos = $this->input->post('fotos_produtos');

				if ($fotos_produtos) {
					$total_fotos = count($fotos_produtos);

					for ($i = 0; $i < $total_fotos; $i++) {
						$data = array(
							'foto_produto_id' => $produto_id,
							'foto_caminho' => $fotos_produtos[$i],
						);
						$this->core_model->insert('produtos_fotos', $data);
					}
				}

				redirect('restrita/produtos');
			} else {
				$data = array(
					'titulo' => 'Inclusão de produto',

					'styles' => array(
						'jquery-upload-file/css/uploadfile.css',
					),
					'scripts' => array(
						'sweetalert2/sweetalert2.all.min.js',
						'jquery-upload-file/js/jquery.uploadfile.min.js',
						'jquery-upload-file/js/produtos.js',
						'mask/jquery.mask.min.js',
						'mask/custom.js',
					),
					'codigo_gerado' => $this->core_model->create_unique_code('produtos', 'numeric', 8, 'produto_codigo'),
					'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
					'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
				);
				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/produtos/core');
				$this->load->view('restrita/layout/footer');
			}
		} else {

			if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
				$this->session->set_flashdata('erro', 'O produto não foi encontrado');
				redirect('restrita/produtos');
			} else {

				//Editando...
				$this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[3]|max_length[40]|callback_valida_nome_produto');
				$this->form_validation->set_rules('produto_categoria_id', 'Categoria do produto', 'trim|required');
				$this->form_validation->set_rules('produto_marca_id', 'Marca do produto', 'trim|required');
				$this->form_validation->set_rules('produto_valor', 'Valor do produto', 'trim|required');
				$this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_largura', 'Largura do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade em Estoque', 'trim|required|integer');
				$this->form_validation->set_rules('produto_descricao', 'Descrição do produto', 'trim|required|min_length[10]|max_length[5000]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'produto_nome',
							'produto_categoria_id',
							'produto_marca_id',
							'produto_valor',
							'produto_peso',
							'produto_altura',
							'produto_largura',
							'produto_comprimento',
							'produto_quantidade_estoque',
							'produto_ativo',
							'produto_destaque',
							'produto_controlar_estoque',
							'produto_descricao',
						),
						$this->input->post()
					);


					//Remove a vírgula do valor
					$data['produto_valor'] = str_replace(',', '', $data['produto_valor']);
					$data['produto_meta_link'] = url_amigavel($data['produto_nome']);

					$data = html_escape($data);

					//  echo '<pre>';
					//  print_r($data);
					//  exit();

					$this->core_model->update('produtos', $data, array('produto_id' => $produto_id));

					//Exclui as imagens antigas
					$this->core_model->delete('produtos_fotos', array('foto_produto_id' => $produto_id));

					//verifica se veio foto no post
					$fotos_produtos = $this->input->post('fotos_produtos');

					if ($fotos_produtos) {
						$total_fotos = count($fotos_produtos);

						for ($i = 0; $i < $total_fotos; $i++) {
							$data = array(
								'foto_produto_id' => $produto_id,
								'foto_caminho' => $fotos_produtos[$i],
							);
							$this->core_model->insert('produtos_fotos', $data);
						}
					}

					redirect('restrita/produtos');
				} else {
					$data = array(
						'titulo' => 'Edição de produto',

						'styles' => array(
							'jquery-upload-file/css/uploadfile.css',
						),
						'scripts' => array(
							'sweetalert2/sweetalert2.all.min.js',
							'jquery-upload-file/js/jquery.uploadfile.min.js',
							'jquery-upload-file/js/produtos.js',
							'mask/jquery.mask.min.js',
							'mask/custom.js',
						),

						'produto' => $produto,
						'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
						'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
						'fotos_produto' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),
					);



					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/produtos/core');
					$this->load->view('restrita/layout/footer');
				}
			}
		}
	}

	public function upload()
	{
		$config['upload_path']          = './uploads/produtos/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 2048;
		$config['max_width']            = 1000;
		$config['max_height']           = 1000;
		$config['max_filename']         = 200;
		$config['encrypt_name']         = TRUE;
		$config['file_ext_tolower']     = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto_produto')) {

			$data = array(
				'uploaded_data' => $this->upload->data(),
				'mensagem' => 'Imagem enviada cm sucesso',
				'foto_caminho' => $this->upload->data('file_name'),
				'erro' => 0
			);

			//Resize imagem 


			$config['image_library'] = 'gd2';
			$config['source_image'] = './uploads/produtos/' . $this->upload->data('file_name');
			$config['new_image'] = './uploads/produtos/small/' . $this->upload->data('file_name');
			$config['width'] = 300;
			$config['height'] = 300;

			$this->load->library('image_lib', $config);

			if (!$this->image_lib->resize()) {
				$data['erro'] = $this->image_lib->display_errors();
			}
		} else {
			$data = array(
				'mensagem' => $this->upload->display_errors(),
				'erro' => 5,
			);
		}
		echo json_encode($data);
	}

	public function delete($produto_id = NULL)
	{

		$produto_id = (int) $produto_id;

		if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {

			$this->session->set_flashdata('erro', 'produto não encontrado');
			redirect('restrita/produtos');
		}

		if ($this->core_model->get_by_id('produtos', array('produto_id' => $produto_id, 'produto_ativo' => 1))) {
			$this->session->set_flashdata('erro', 'Não é possível excluir um produto ATIVO');
			redirect('restrita/produtos');
		}

		//REcupera as fotos do produto e elimina
		$fotos_produto = $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id));

		if ($fotos_produto) {
			foreach ($fotos_produto as $foto) {
				$foto_grande = FCPATH.'uploads/produtos/'.$foto->foto_caminho;
				$foto_pequena = FCPATH.'uploads/produtos/small/'.$foto->foto_caminho;
			}
			if (file_exists($foto_grande) && file_exists($foto_grande)){
				unlink($foto_grande);
				unlink($foto_pequena);
			}
		}

		$this->core_model->delete('produtos', array('produto_id' => $produto_id));
		redirect('restrita/produtos');
	}

	public function valida_nome_produto($produto_nome)
	{
		$produto_id = $this->input->post('produto_id');

		if (!$produto_id) {
			//Cadastrando
			if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome))) {
				$this->form_validation->set_message('valida_nome_produto', 'Este produto já existe.');
				return false;
			} else {
				return true;
			}
		} else {
			//Editando
			if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome, 'produto_id != ' => $produto_id))) {
				$this->form_validation->set_message('valida_nome_produto', 'Este produto já existe.');
				return false;
			} else {
				return true;
			}
		}
	}
}
