<?php $this->load->view('web/layout/navbar');  ?>

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
				<li><a href="<?php echo base_url('master/' . $produto->categoria_pai_meta_link); ?>"><?php echo $produto->categoria_pai_nome ?></a></li>
				<li class="active"><a href="<?php echo base_url('categoria/' . $produto->categoria_meta_link); ?>"><?php echo $produto->categoria_nome ?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
	<div class="container">
		<div class="row single-product-area">
			<div class="col-lg-5 col-md-6">
				<!-- Product Details Left -->
				<div class="product-details-left">
					<div class="product-details-images slider-navigation-1">
						<?php foreach ($fotos_produtos as $foto) : ?>
							<div class="lg-image">
								<a class="popup-img venobox vbox-item" href="<?php echo base_url('uploads/produtos/small/' . $foto->foto_caminho) ?>" data-gall="myGallery">
									<img src="<?php echo base_url('uploads/produtos/' . $foto->foto_caminho) ?>" alt="<?php echo $produto->produto_nome; ?>">
								</a>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="product-details-thumbs slider-thumbs-1">
						<?php foreach ($fotos_produtos as $foto) : ?>
							<div class="sm-image"><img src="<?php echo base_url('uploads/produtos/small/' . $foto->foto_caminho) ?>" alt="<?php echo $produto->produto_nome; ?>"></div>
						<?php endforeach; ?>
					</div>
				</div>
				<!--// Product Details Left -->
			</div>

			<div class="col-lg-7 col-md-6">
				<div class="product-details-view-content pt-60">
					<div class="product-info">
						<h2><?php echo $produto->produto_nome; ?></h2>
						<span class="product-details-ref">Código: <?php echo $produto->produto_codigo; ?></span>
						<p class="mt-10"><span class="product-details-ref">Marca:&nbsp;<a href="<?php echo base_url('marca/' . $produto->marca_meta_link); ?>"> <?php echo $produto->marca_nome; ?> </a> </span></p>
						<p class="mt-10"><span class="product-details-ref">Estoque:&nbsp;<?php echo ($produto->produto_quantidade_estoque > 0) ?  '<span class="badge badge-success" style="font-size:14px;">' . $produto->produto_quantidade_estoque . '</span>'  :  '<span class="badge badge-danger" style="font-size:12px;">Indisponível</span>'; ?></span></p>
						<div class="price-box pt-20">
							<span class="new-price new-price-2"><?php echo 'R$&nbsp;' . number_format($produto->produto_valor, 2); ?></span>
						</div>

						<div class="single-add-to-cart">

							<?php
							$atributos = array(
								'class' => 'cart-quantity'
							);
							?>

							<?php echo form_open('ajax', $atributos); ?>
							<div class="quantity">
								<label>Caluclar Frete e Prazo de entrega</label>
								<div class="" style="min-width: 140px; float:left; margin-right: 10px; position: relative; text-align:left;">
									<input type="text" id="cep" name="cep" class="cart-plus-minus-box cep" placeholder="Informe o cep" type="text">
								</div>
							</div>
							<button id="btn-calcula-frete" data-id="<?php echo $produto->produto_id; ?>" name="produto_id" class="add-to-cart bg-info" type="button" style="padding: 12px 20px">Calcular</button>

							<?php echo form_close(); ?>

						</div>

						<div id="frete" class="pt-10 text-info"></div>

						<div class="single-add-to-cart">

							<?php if ($produto->produto_quantidade_estoque > 0) : ?>



								<?php
								$atributos = array(
									'class' => 'cart-quantity'
								);
								?>
								<?php echo form_open('carrinho', $atributos); ?>

								<div class="quantity">
									<label>Quantidade</label>
									<div class="cart-plus-minus">
										<input class="cart-plus-minus-box mask-produto-qty" name="produto-quantidade" id="produto-quantidade" value="1" type="text">
										<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
										<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
									</div>
								</div>
								<button class="add-to-cart btn-add-produto" data-id="<?php echo $produto->produto_id; ?>" type="button">Comprar</button>
								<div id="mensagem" style="max-width: 295px;">

								</div>

								<?php echo form_close(); ?>

							<?php else : ?>
								<div class="cart-quantity">
								<button class="add-to-cart bg-danger" type="button">Indisponível</button>
								</div>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="li-product-tab">
					<ul class="nav li-product-menu">
						<li><a class="active" data-toggle="tab" href="#description"><span>Descrição</span></a></li>
					</ul>
				</div>
				<!-- Begin Li's Tab Menu Content Area -->
			</div>
		</div>
		<div class="tab-content">
			<div id="description" class="tab-pane active show" role="tabpanel">
				<div class="product-description">
					<span>T<?php echo $produto->produto_descricao; ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Product Area End Here -->
