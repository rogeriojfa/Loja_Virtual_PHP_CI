<?php
defined('BASEPATH') or exit('Ação não permitida');


class Carrinho extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$data = array(
			'titulo' => 'Carrinho de Compras',
			'scripts' => array(
				'mask/jquery.mask.min.js',
				'mask/custom.js',
				'js/carrinho.js',
			),
		);

		$carrinho = array(
			'carrinho' => $this->carrinho_compras->get_all(),
		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/carrinho', $carrinho);
		$this->load->view('web/layout/footer');
	}

	public function insert()
	{
		$produto_id = (int) $this->input->post('produto_id');
		$produto_quantidade = (int) $this->input->post('produto_quantidade');
		$retorno = array();

		if (!$produto_id || $produto_quantidade < 1) {
			$retorno['erro'] = 3;
			$retorno['mensagem'] = 'Quantide = 0 mão é permitida';
		} else {

			if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
				$retorno['erro'] = 3;
				$retorno['mensagem'] = 'Produto não encontrado.';
			} else {
				if ($produto_quantidade > $produto->produto_quantidade_estoque) {
					$retorno['erro'] = 3;
					$retorno['mensagem'] = 'Infelizmente só temos mais ' . $produto->produto_quantidade_estoque . ' peças desse produto em estoque';
				} else {
					$this->carrinho_compras->insert($produto_id, $produto_quantidade);
					$retorno['erro'] = 0;
					$retorno['mensagem'] = '<i class="fa fa-check-square" aria-hidden="true"></i>&nbsp; Adicionado ao carrinho.';
				}
			}
		}
		echo json_encode($retorno);
	}

	public function delete()
	{
		$retorno = array();

		if ($produto_id = (int) $this->input->post('produto_id')) {

			$this->carrinho_compras->delete($produto_id);

			$retorno['erro'] = 0;
			$retorno['mensagem'] = 'Produto removido com sucesso!';
		}
		echo json_encode($retorno);
	}

	public function update()
	{
		$produto_id = (int) $this->input->post('produto_id');
		$produto_quantidade = (int) $this->input->post('produto_quantidade');

		$retorno = array();
		if ($produto_quantidade == "" || $produto_quantidade < 1) {
			$retorno['erro'] = 3;
			$retorno['mensagem'] = 'Informe uma quantidade maior que zero';
		} else {
			if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
				$retorno['erro'] = 3;
				$retorno['mensagem'] = 'Produto não encontrado.';
			} else {
				if ($produto_quantidade > $produto->produto_quantidade_estoque) {
					$retorno['erro'] = 3;
					$retorno['mensagem'] = 'Infelizmente só temis mais ' . $produto->produto_quantidade_estoque . 'unidades deste produto em estoque';
				} else {
					$this->carrinho_compras->update($produto_id, $produto_quantidade);
					$retorno['erro'] = 0;
					$retorno['mensagem'] = 'Carrinho atualizado com sucesso.';
				}
			}
		}
		echo json_encode($retorno);
	}

	public function limpar()
	{
		$retorno = array();

		if ($this->input->post('limpar') && $this->input->post('limpar') == true) {
			$this->carrinho_compras->limpar();
			$retorno['erro'] = 0;
			$retorno['mensagem'] = 'Carrinho está vazio.';
		}
		echo json_encode($retorno);
	}

	public function calcula_frete()
	{
		$this->form_validation->set_rules('cep', 'CEP Destino', 'trim|required|exact_length[9]');

		$retorno = array();
		if ($this->form_validation->run()) {



			$cep_destino = str_replace('-', '', $this->input->post('cep'));
			$url_endereco = 'https://viacep.com.br/ws/';
			$url_endereco .= $cep_destino;
			$url_endereco .= '/json';

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, $url_endereco);

			$resultado = curl_exec($curl);
			$resultado = json_decode($resultado);

			if (isset($resultado->erro)) {
				$retorno['erro'] = 3;
				$retorno['mensagem'] = 'Não encontramos o CEP em nossa base de dados.';
				$retorno['retorno_endereco'] = 'Não encontramos o CEP em nossa base de dados.';
			} else {
				$retorno['erro'] = 0;
				$retorno['mensagem'] = 'Sucesso';
				$retorno['url_endereco'] = $url_endereco;
				$retorno_endereco =  $retorno['retorno_endereco'] = $resultado->logradouro . ', ' . $resultado->bairro .
					', ' . $resultado->localidade . ' - ' . $resultado->uf . ', ' . $resultado->cep;
			}
			/*
					http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=08082650&sDsSenha=564321
					&sCepOrigem=70002900&sCepDestino=04547000&nVlPeso=1
					&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n
					&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3

					*/

			$config_correios = $this->core_model->get_by_id('config_correios', array('config_id' => 1));

			$produto = $this->carrinho_compras->get_produto_maior_dimensao();
			$total_peso = $this->carrinho_compras->get_peso_total_produtos();

			$url_correios = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?';
			$url_correios .= 'nCdEmpresa=08082650';
			$url_correios .= '&sDsSenha=564321';
			$url_correios .= '&sCepOrigem=' . str_replace('-', '',  $config_correios->config_cep_origem);
			$url_correios .= '&sCepDestino=' . $cep_destino;
			$url_correios .= '&nVlPeso=' . $total_peso;
			$url_correios .= '&nCdFormato=1';
			$url_correios .= '&nVlComprimento=' . $produto['produto_comprimento'];
			$url_correios .= '&nVlAltura=' . $produto['produto_altura'];
			$url_correios .= '&nVlLargura=' . $produto['produto_largura'];
			$url_correios .= '&sCdMaoPropria=n';
			$url_correios .= '&nVlValorDeclarado=' . $config_correios->config_valor_declarado;
			$url_correios .= '&sCdAvisoRecebimento=n';
			$url_correios .= '&nCdServico=' . $config_correios->config_codigo_pac;
			$url_correios .= '&nCdServico=' . $config_correios->config_codigo_sedex;
			$url_correios .= '&nVlDiametro=0';
			$url_correios .= '&StrRetorno=xml';
			$url_correios .= '&nIndicaCalculo=3';

			// echo json_encode($url_correios);
			// exit();

			$xml = simplexml_load_file($url_correios);
			$xml = json_encode($xml);

			$consulta = json_decode($xml);

			if ($consulta->cServico[0]->Valor == '0,00') {
				$retorno['erro'] = 3;
				$retorno['mensagem'] = 'Não foi possível calcular o frete. Por favor, ente em contato com o nosso suporte';
				exit();
			} else {

				$valor_total_produtos = str_replace(',', '', $this->carrinho_compras->get_total());
				$retorno_frete = '';

				foreach ($consulta->cServico as $dados) {

					$valor_formatado = str_replace(',', '.', $dados->Valor);

					number_format($valor_calculado = ($valor_formatado + $config_correios->config_somar_frete), 2, '.', ',');

					$valor_final_carrinho = $valor_total_produtos + $valor_calculado;


					$retorno_frete .= '<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="' . $dados->Codigo . '" name="opcao_frete_carrinho" value="' . $valor_calculado . '" data-valor_frete="'.$valor_calculado.'" data-valor_final_carrinho="'.number_format($valor_final_carrinho, 2).'">
											<label class="custom-control-label" for="' . $dados->Codigo . '"> '. ($dados->Codigo == '04510' ? 'PAC' : 'SEDEX') .' - R$&nbsp; ' . $valor_calculado . '&nbsp; - &nbsp;Chega em: <span class="badge badge-primary">' . $dados->PrazoEntrega . ' </span> dias Uteis.</label>
									   </div>';


					//$retorno_frete .= '<p>' . ($dados->Codigo == '04510' ? 'PAC' : 'SEDEX') . '&nbsp; R$&nbsp; ' . $valor_calculado . ' , Chega em: <span class="badge badge-primary">' . $dados->PrazoEntrega . ' </span> dias Uteis. </pre>';



					$retorno['erro'] = 0;
					$retorno['retorno_endereco'] = $retorno_endereco . ' <br><br>' . $retorno_frete;
				}
			}
		} else {
			$retorno['erro'] = 3;
			$retorno['retorno_endereco'] = validation_errors();
		}

		echo json_encode($retorno);
	}
}
