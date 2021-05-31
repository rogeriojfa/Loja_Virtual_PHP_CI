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

<div class="Shopping-cart-area pt-5 pb-60">
	<div class="container-fluid">
		<div class="row">

			<div class="container text-center pt-60 text-success">

				<?php foreach ($pedido_realizado as $pedido) : ?>
					<h5 class="mb-20"><?php echo $pedido->cliente_nome_completo; ?></h5>
					<h6 class="mb-20"><?php echo $pedido->mensagem; ?></h6>
					<div class="bg-primary badge text-white" style="padding: 1rem; font-size: 16px; ">
						<?php echo 'Número do Pedido: ' . $pedido->pedido_gerado; ?>
					</div>

					<?php if ($pedido->forma_pagamento != 1) : ?>
						<div class="mt-20">
							<a href="<?php echo $pedido->transacao_link_pagamento; ?>" target="_blank">

							<em class="<?php echo ($pedido->forma_pagamento != 3 ? 'fa fa-barcode fa-5x' : 'fa fa-university fa-5x') ?>"> </em> 								
								<p class="text-primary"><?php echo ($pedido->forma_pagamento != 3 ? 'Imprimir Boleto para pagamento': 'Concluir pagamento no ambiente seguro do seu banco'); ?></p>
							</a>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>

			</div>

		</div>
	</div>
</div>
