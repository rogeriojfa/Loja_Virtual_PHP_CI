<?php $this->load->view('web/layout/navbar');  ?>

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container-fluid">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
				<li class="active"><?php echo $titulo; ?></li>
			</ul>
		</div>
	</div>
</div>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-5 pb-60">
	<div class="container-fluid">
		<div class="row">
			<?php if (isset($carrinho) && !empty($carrinho)) : ?>
				<div class="col-12">
					<div id="mensagem"></div>
					<form action="#">
						<div class="table-content table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="li-product-thumbnail">imagens</th>
										<th class="cart-product-name">Produto</th>
										<th class="li-product-price">Pço Unitário</th>
										<th class="li-product-quantity">Qtd.</th>
										<th class="li-product-subtotal">Total</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach ($carrinho as $produto) : ?>
										<tr>
											<td class="li-product-thumbnail"><a href="<?php echo base_url('produto/' . $produto['produto_meta_link']); ?>"><img width="50" src="<?php echo base_url('uploads/produtos/small/' . $produto['produto_foto']); ?>" alt="<?php echo word_limiter($produto['produto_nome'], 4) ?>"></a></td>
											<td class="li-product-name"><a href="<?php echo base_url('produto/' . $produto['produto_meta_link']); ?>"><?php echo $produto['produto_nome'] ?></a></td>
											<td class="li-product-price"><span class="amount">R$&nbsp; <?php echo number_format($produto['produto_valor'], 2); ?></span></td>
											<td class="quantity" style="width: 50px;">
												<div style="text-align: center;">
													<input id="produto_<?php echo $produto['produto_id'] ?>" name="produto_quantidade" class="mask-produto-qty" value="<?php echo $produto['produto_quantidade'] ?>" type="text" readonly="">
												</div>
											</td>
											<td class="product-subtotal"><span class="amount">R$&nbsp; <?php echo number_format($produto['subtotal'], 2); ?></span></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

						<div class="row">
							<div class="col-md-5 ml-auto">
								<div class="cart-page-total">
									<ul>
										<li>Total Produtos: <span>R$&nbsp;<?php echo number_format($this->carrinho_compras->get_total(), 2); ?></span></li>
										<li>Valor Frete: <span id="opcao_frete_escolhido">R$&nbsp;0.00</span></li>
										<li>Total Pedido: <span id="total_final_carrinho">R$&nbsp;<?php echo number_format($this->carrinho_compras->get_total(), 2); ?></span></span></li>
									</ul>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="container-fluid mt-10">

					<?php $logged = $this->ion_auth->logged_in(); ?>

					<?php if (!$logged) : ?>
						<div class="row">
							<div class="col-12">
								<div class="col-6">
									<?php if ($message = $this->session->flashdata('erro')) : ?>

										<div class="alert alert-danger bg-danger text-white alert-dismissible alert-has-icon show fade">
											<div class="alert-body">
												<button class="close" data-dismiss="alert">
													<span>&times;</span>
												</button>
												<?php echo $message; ?>
											</div>
										</div>

									<?php endif; ?>
								</div>
								<div class="coupon-accordion">
									<!--Accordion Start-->
									<h3>Já é cliente? <span id="showlogin">Clique aqui para entrar</span></h3>
									<div id="checkout-login" class="coupon-content">
										<div class="coupon-info">
											<?php echo form_open('login/auth'); ?>
											<p class="form-row-first">
												<label>E-mail<span class="required">*</span></label>
												<input name="email" type="text" required="">
											</p>
											<p class="form-row-last">
												<label>Senha <span class="required">*</span></label>
												<input name="password" type="password" required="">
											</p>
											<input type="hidden" name="login" value="checkout">
											<p class="form-row">
												<input value="Entrar" type="submit">
												<label>
													<input type="checkbox" name="remember">
													Manter Conectado
												</label>
											</p>
											<p class="lost-password"><a href="#">Cirar Conta?</a></p>
											<?php echo form_close(); ?>
										</div>
									</div>
									<!--Accordion End-->
								</div>
							</div>
						</div>
					<?php endif; ?>

					<div class="row mt-20 ">
						<div class="container-fluid">
							
							<?php 
								$atributos = array('class' => 'do-payment');
							?>

							<?php echo form_open('pagar', $atributos); ?>

								<input type="text" name="hash_pagamento" value="12123131313131">

								<?php if (!$logged) : ?>
									<div class="col-lg-4 col-12 float-left">
										<div class="checkbox-form">
											<h3>Dados Pessoais</h3>
											<div class="row">

												<div class="col-md-4">
													<div class="checkout-form-list">
														<label>Nome<span class="required">*</span></label>
														<input type="text" name="cliente_nome" required="" value="<?php set_value('cliente_nome') ?>">
														<div id="cliente_nome" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="checkout-form-list">
														<label>Sobrenome<span class="required">*</span></label>
														<input type="text" name="cliente_sobrenome" required="" value="<?php set_value('cliente_sobrenome') ?>">
														<div id="cliente_sobrenome" class="text-danger"></div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>CPF<span class="required">*</span></label>
														<input type="text" name="cliente_cpf" class="cpf" required="" value="<?php set_value('cliente_cpf') ?>">
														<div id="cliente_cpf" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Data Nascimento<span class="required">*</span></label>
														<input type="date" name="cliente_data_nascimento" required="" value="<?php set_value('cliente_data_nascimento') ?>">
														<div id="cliente_data_nascimento" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Celular<span class="required">*</span></label>
														<input type="tel" name="cliente_telefone_movel" class="sp_celphones" required="" value="<?php set_value('cliente_telefone_movel') ?>">
														<div id="cliente_telefone_movel" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>E-mail<span class="required">*</span></label>
														<input type="email" name="cliente_email" required="" value="<?php set_value('cliente_email') ?>">
														<div id="cliente_email" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Senha<span class="required">*</span></label>
														<input type="password" name="cliente_senha" required="" value="<?php set_value('cliente_senha') ?>">
														<div id="cliente_senha" class="text-danger"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>Confirmar Senha<span class="required">*</span></label>
														<input type="text" name="confirmacao" required="">
														<div id="confirmacao" class="text-danger"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<div class="<?php echo ($logged ? 'col-lg-6' : 'col-lg-4') ?> col-12 float-left">
									<div class="checkbox-form">
										<h3>Calcular Frete</h3>
										<div class="row">
											<div class="col-md-8">
												<div class="checkout-form-list" style="margin-bottom: 10px !important;">
													<label>CEP<span class="required">*</span></label>
													<input id="cliente_cep" class="cep" type="text" name="cliente_cep" required="" value="<?php set_value('clientecep') ?>">
													<!-- <div id="cliente_cep" class="text-danger"></div> -->
												</div>
												<div id="erro_frete">
												</div>
											</div>

											<div class="col-md-4">
												<div class="checkout-form-list">
													<div class="order-button-payment">
														<button class="btn btn-info" id="btn-busca-cep" value="Calcular" style="height: 40px; margin: 28px 0 0; font-size: 14px; border-radius: 1px; border-color:#434343; background-color: #434343;">Calcular Frete</button>
													</div>

												</div>
											</div>

											<div class="col-md-12 endereco d-none">
												<div id="retorno-frete">
												</div>
												<div id="opcao_frete_carrinho" class="text-danger mt-2">
												</div>
											</div>

											<?php if (!$logged): ?>
												<div class="col-md-9 endereco d-none mt-20">
												<div class="checkout-form-list">
													<label>Endereço<span class="required">*</span></label>
													<input type="text" name="cliente_endereco" required="" value="<?php set_value('cliente_endereco') ?>">
													<div id="cliente_endereco" class="text-danger"></div>
												</div>
											</div>

											<div class="col-md-3 endereco d-none mt-20">
												<div class="checkout-form-list">
													<label>Núm<span class="required">*</span></label>
													<input type="text" name="cliente_numero_endereco" required="" value="<?php set_value('cliente_numero_endereco') ?>">
													<div id="cliente_numero_endereco" class="text-danger"></div>
												</div>
											</div>
											<div class="col-md-12 endereco d-none">
												<div class="checkout-form-list">
													<label>Bairro<span class="required">*</span></label>
													<input type="text" name="cliente_bairro" required="" value="<?php set_value('cliente_bairro') ?>">
													<div id="cliente_bairro" class="text-danger"></div>
												</div>
											</div>
											<div class="col-md-12 endereco d-none">
												<div class="checkout-form-list">
													<label>Cidade<span class="required">*</span></label>
													<input type="text" name="cliente_cidade" required="" value="<?php set_value('cliente_cidade') ?>">
													<div id="cliente_cidade" class="text-danger"></div>
												</div>
											</div>


											<div class="col-md-12 endereco d-none">
												<div class="country-select clearfix">
													<label>Estado <span class="required">*</span></label>
													<select class="custom-select" name="cliente_estado">
														<option value="">Selecione...</option>
														<option value="AC">Acre</option>
														<option value="AL">Alagoas</option>
														<option value="AP">Amapá</option>
														<option value="AM">Amazonas</option>
														<option value="BA">Bahia</option>
														<option value="CE">Ceará</option>
														<option value="DF">Distrito Federal</option>
														<option value="ES">Espírito Santo</option>
														<option value="GO">Goiás</option>
														<option value="MA">Maranhão</option>
														<option value="MT">Mato Grosso</option>
														<option value="MS">Mato Grosso do Sul</option>
														<option value="MG">Minas Gerais</option>
														<option value="PA">Pará</option>
														<option value="PB">Paraíba</option>
														<option value="PR">Paraná</option>
														<option value="PE">Pernambuco</option>
														<option value="PI">Piauí</option>
														<option value="RJ">Rio de Janeiro</option>
														<option value="RN">Rio Grande do Norte</option>
														<option value="RS">Rio Grande do Sul</option>
														<option value="RO">Rondônia</option>
														<option value="RR">Roraima</option>
														<option value="SC">Santa Catarina</option>
														<option value="SP">São Paulo</option>
														<option value="SE">Sergipe</option>
														<option value="TO">Tocantins</option>
													</select>
													<div id="cliente_estado" class="text-danger"></div>
												</div>
											</div>
											<?php endif; ?>

										</div>
									</div>
								</div>

								<div class="<?php echo ($logged ? 'col-lg-6' : 'col-lg-4') ?> col-12 float-left">
									<div class="checkbox-form">
										<h3>Dados do Pagamento</h3>
										<div class="row">

											<div class="col-md-12">
												<div class="country-select clearfix">
													<label>Tipo de pagamento<span class="required">*</span></label>
													<select class="nice-select wide forma_pagamento" name="forma_pagamento">
														<option value="1" data-display="Cartão de crédito" value="">Cartão de crédito</option>
														<option value="2" value="">Boleto bancário</option>
														<option value="3" value="">Débito em conta</option>
													</select>
													<div id="forma_pagamento" class="text-danger"></div>
												</div>
											</div>

											<div class="col-md-6 cartao">
												<div class="checkout-form-list">
													<label>Número do cartão<span class="required">*</span></label>
													<input type="text" name="numero_cartao" class="card_number" placeholder="0000 0000 0000 0000" required="" value="<?php set_value('numero_cartao') ?>">
													<div id="numero_cartao" class="text-danger"></div>
												</div>
											</div>
											<div class="col-md-6 cartao">
												<div class="checkout-form-list">
													<label>Nome do Titular do Cartão<span class="required">*</span></label>
													<input type="text" name="cliente_nome_titular" placeholder="Nome impresso no cartão" required="" value="<?php set_value('cliente_nome_titular') ?>">
													<div id="cliente_nome_titular" class="text-danger"></div>
												</div>
											</div>


											<div class="col-md-8 cartao">
												<div class="checkout-form-list">
													<label>Validade do Cartão<span class="required">*</span></label>
													<input type="text" name="validade_cartao" class="card_expire" placeholder="MM/AAAA" required="" value="<?php set_value('validade_cartao') ?>">
													<div id="validade_cartao" class="text-danger"></div>
												</div>
											</div>

											<div class="col-md-4 cartao">
												<div class="checkout-form-list">
													<label>CCV<span class="required">*</span></label>
													<input type="text" name="codigo_seguranca" class="card_cvv" placeholder="000" required="" value="<?php set_value('codigo_seguranca') ?>">
													<div id="codigo_seguranca" class="text-danger"></div>
												</div>
											</div>
											<div class="col-md-12 opcao-boleto d-none">
												<div class="checkout-form-list">
													<div class="alert alert-info" role="alert">
														<i class="fa fa-barcode fa-lg"></i>&nbsp;Você poderá emitir o boleto ao final da compra.
													</div>
												</div>
												<div class="order-button-payment">
													<input id="btn-pagar-boleto" value="Pagar com boleto" style="height: 40px; margin: 28px 0 0; font-size: 14px;" type="button">
												</div>
												<div id="opcao-boleto" class="mt-2"></div>
											</div>


											<div class="col-md-12 opcao-debito-conta d-none">
												<div class="checkout-form-list">
													<select class="nice-select wide" name="banco_escolhido">
														<option value="">Selecione o banco...</option>
														<option value="bradesco">Bradesco</option>
														<option value="itau">Itaú</option>
														<option value="bancodobrasil">Banco do Brasil</option>
														<option value="banrisul">Banrisul</option>

													</select>
													<div id="opcao_banco"></div>
												</div>


												<div class="alert alert-info mt-50" role="alert">
													<i class="fa fa-university fa-lg"></i>&nbsp;Você poderá acessar o ambiente seguro do seu banco ao final da compra.
												</div>

												<div class="order-button-payment">
													<input id="btn-debito-conta" value="Pagar com Débito" style="height: 40px; margin: 28px 0 0; font-size: 14px;" type="button">
												</div>
												<div id="opcao_btn_debito_conta"></div>
											</div>
											<div class="col-md-12 cartao">
												<div class="order-button-payment">
													<input id="btn-pagar-cartao" value="Pagar com Cartão" style="height: 40px; margin: 28px 0 0; font-size: 14px;" type="button">
												</div>

												<input id="token_pagamento" type="hidden" class="form-control" name="token_pagamento">
												<div id="opcao_pagar_cartao" class="mt-2"></div>

											</div>

										</div>
									</div>
								</div>

							<?php echo form_close(); ?>
						</div>




					</div>
				</div>
			<?php else : ?>
				<div class="col-12 pt-20">
					<h6 class="mb-30">Seu carrinho está vazio</h6>

					<div class="coupon-all">
						<div class="coupon">
							<a href="<?php echo base_url('/'); ?>" class="button"><input style="width: 240px;" class="button" value="Continuar comprando..."></a>
						</div>
					</div>
					<div class="container text-center">
						<img width="35%" src="<?php echo base_url('public/web/images/empty_cart.svg');  ?>" alt="">
					</div>
				</div>



			<?php endif; ?>
		</div>
	</div>
</div>
<!--Shopping Cart Area End-->
