<header>
	<!-- Begin Header Top Area -->
	<div class="header-top">
		<div class="container">

			<?php $sistema = info_header_footer(); ?>

			<div class="row">
				<!-- Begin Header Top Left Area -->
				<div class="col-lg-3 col-md-4">
					<div class="header-top-left">
						<ul class="phone-wrap">
							<li><span>Fone:</span><a href="#"><?php echo $sistema->sistema_telefone_fixo ?></a></li>
						</ul>
					</div>
				</div>
				<!-- Header Top Left Area End Here -->
				<!-- Begin Header Top Right Area -->
				<div class="col-lg-9 col-md-8">
					<div class="header-top-right">
						<ul class="ht-menu">
							<!-- Begin Setting Area -->
							<li>
								<div class="ht-setting-trigger"><span>Grandes marcas</span></div>
								<div class="setting ht-setting">
									<ul class="ht-setting-list">
										<?php $grandes_marcas = grandes_marcas_navbar(); ?>

										<?php foreach ($grandes_marcas as $marca) : ?>

											<li><a href="<?php echo base_url('marca/' . $marca->marca_meta_link); ?>"><?php echo $marca->marca_nome ?></a></li>

										<?php endforeach; ?>
									</ul>
								</div>
							</li>
							<!-- Setting Area End Here -->
							<!-- Begin Currency Area -->
							<li>

								<div class="ht-currency-trigger"><span>Área do Cliente</span></div>
								<div class="currency ht-currency">
									<ul class="ht-setting-list">
										<?php if (!$this->ion_auth->logged_in()) : ?>
											<li><a href="<?php echo base_url('login'); ?>">Entrar</a></li>
										<?php else: ?>
											<li><a href="#">Perfil</a></li>
											<li class="active"><a href="#">Compras</a></li>
										<?php endif; ?>
									</ul>
								</div>
							</li>
							<!-- Currency Area End Here -->
							<!-- Begin Language Area -->
							<li>
								<span class="language-selector-wrapper">Language :</span>
								<div class="ht-language-trigger"><span>English</span></div>
								<div class="language ht-language">
									<ul class="ht-setting-list">
										<li class="active"><a href="#"><img src="images/menu/flag-icon/1.jpg" alt="">English</a></li>
										<li><a href="#"><img src="images/menu/flag-icon/2.jpg" alt="">Français</a></li>
									</ul>
								</div>
							</li>
							<!-- Language Area End Here -->
						</ul>
					</div>
				</div>
				<!-- Header Top Right Area End Here -->
			</div>
		</div>
	</div>
	<!-- Header Top Area End Here -->
	<!-- Begin Header Middle Area -->
	<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
		<div class="container">
			<div class="row">
				<!-- Begin Header Logo Area -->
				<div class="col-lg-3">
					<div class="logo pb-sm-30 pb-xs-30">
						<a href="index.html">
							<img src="<?php echo base_url('public/web/images/menu/logo/1.jpg'); ?>" alt="">
						</a>
					</div>
				</div>
				<!-- Header Logo Area End Here -->
				<!-- Begin Header Middle Right Area -->
				<div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
					<!-- Begin Header Middle Searchbox Area -->

					<?php
					$atributos = array(
						'class' => 'hm-searchbox',
					)
					?>

					<?php echo form_open('busca', $atributos) ?>
					<input type="text" name="busca" placeholder="Localizar um produto...">
					<button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
					<?php echo form_close(); ?>

					<!-- Header Middle Searchbox Area End Here -->
					<!-- Begin Header Middle Right Area -->
					<div class="header-middle-right">
						<ul class="hm-menu">

							<!-- Begin Header Mini Cart Area -->
							<li class="hm-minicart">
								<div id="top-cart" class="hm-minicart-trigger">
									<span class="item-icon"></span>
									<span class="item-text">
										<?php echo ($this->carrinho_compras->get_total() > '0.00' ? 'R$&nbsp;' . number_format($this->carrinho_compras->get_total(), 2) : 'R$&nbsp;0.00') ?>
										<?php if ($this->carrinho_compras->get_total_itens() > 0) : ?>
											<span class="cart-item-count"><?php echo $this->carrinho_compras->get_total_itens(); ?></span>
										<?php endif; ?>
									</span>
								</div>
								<span></span>
								<div id="list-itens" class="minicart">
									<ul class="minicart-product-list">
										<?php if ($this->carrinho_compras->get_total_itens() > 0) : ?>
											<?php
											$carrinho = $this->carrinho_compras->get_all();
											?>

											<?php foreach ($carrinho as $produto) : ?>

												<li>
													<a href="<?php echo base_url('produto/' . $produto['produto_meta_link']); ?>" class="minicart-product-image">
														<img src="<?php echo base_url('uploads/produtos/small/' . $produto['produto_foto']); ?>" alt="<?php echo $produto['produto_nome'] ?>">
													</a>
													<div class="minicart-product-details">
														<h6><a href="<?php echo base_url('produto/' . $produto['produto_meta_link']); ?>"><?php echo word_limiter($produto['produto_nome'], 3) ?></a></h6>
														<span><?php echo 'R$&nbsp;' . number_format($produto['produto_valor'], 2) . ' x ' . $produto['produto_quantidade'] ?></span>
													</div>
												</li>
											<?php endforeach; ?>
										<?php endif; ?>
									</ul>

									<p class="minicart-total">SUBTOTAL: <span><?php echo 'R$&nbsp;' . number_format($this->carrinho_compras->get_total(), 2) ?></span></p>
									<div class="minicart-button">
										<?php if ($this->carrinho_compras->get_total_itens() > 0) : ?>
											<a href="<?php echo base_url('carrinho') ?>" class="li-button li-button-fullwidth li-button-dark">
												<span>Ver carrinho</span>
											</a>
											<a href="<?php echo base_url('checkout') ?>" class="li-button li-button-fullwidth">
												<span>Finalizar Compra</span>
											</a>
										<?php else : ?>
											<a href="#" class="li-button li-button-fullwidth">
												<span>Carrinho Vazio</span>
											</a>
										<?php endif; ?>

									</div>
								</div>
							</li>
							<!-- Header Mini Cart Area End Here -->
						</ul>
					</div>
					<!-- Header Middle Right Area End Here -->
				</div>
				<!-- Header Middle Right Area End Here -->
			</div>
		</div>
	</div>
	<!-- Header Middle Area End Here -->
	<!-- Begin Header Bottom Area -->
	<div class="header-bottom header-sticky d-none d-lg-block d-xl-block mb-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Begin Header Bottom Menu Area -->
					<div class="hb-menu">
						<nav>
							<ul>
								<li class="dropdown-holder"><a href="<?php echo base_url('/'); ?>">Home</a>
								</li>

								<?php $categorias_pai = get_categorias_pai_navbar(); ?>
								<?php foreach ($categorias_pai as $pai) : ?>
									<?php $categorias_filhas = get_categorias_filhas_navbar($pai->categoria_pai_id); ?>


									<li class="dropdown-holder"><a href="<?php echo base_url('master/' . $pai->categoria_pai_meta_link); ?>"><?php echo $pai->categoria_pai_nome; ?></a>
										<ul class="hb-dropdown">
											<?php foreach ($categorias_filhas as $filha) : ?>
												<li class="active"><a href="<?php echo base_url('categoria/' . $filha->categoria_meta_link); ?>"><?php echo $filha->categoria_nome ?></a></li>
											<?php endforeach; ?>
										</ul>
									</li>

								<?php endforeach; ?>
							</ul>
						</nav>
					</div>
					<!-- Header Bottom Menu Area End Here -->
				</div>
			</div>
		</div>
	</div>
	<!-- Header Bottom Area End Here -->
	<!-- Begin Mobile Menu Area -->
	<div class="mobile-menu-area d-lg-none d-xl-none col-12">
		<div class="container">
			<div class="row">
				<div class="mobile-menu">
				</div>
			</div>
		</div>
	</div>
	<!-- Mobile Menu Area End Here -->
</header>
<!-- Header Area End Here -->
