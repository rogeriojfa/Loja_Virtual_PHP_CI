<?php

defined('BASEPATH') or exit('Ação não permitida');

class Login extends CI_Controller
{

	public function index()
	{
		$data = array(
			'titulo' => 'Login - Loja Virtual',
		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/login');
		$this->load->view('web/layout/footer');
	}

	public function auth()
	{

		$identity = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember' ? TRUE : FALSE));

		$login = $this->input->post('login');

		if ($this->ion_auth->login($identity, $password, $remember)) {

			if ($this->ion_auth->is_admin()) {
				redirect('restrita');
			} else {

				//Sucesso no login
				$cliente = $this->core_model->get_by_id('clientes', array('cliente_email' => $identity));

				$this->session->set_userdata('cliente_user_id', $cliente->cliente_id);

				if ($login == 'login'){
					redirect('/');
				}else{
					redirect('checkout');
				}
			
			}
		} else {
			$this->session->set_flashdata('erro', 'Erro ao logar: Usuário e/ou senha não encontrados');
			if ($this->input->post('login') == 'login'){
				redirect('login');
			}else{
				redirect('checkout');
			}
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('/');
	}
}
