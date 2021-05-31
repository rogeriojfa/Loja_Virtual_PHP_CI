<?php $this->load->view('web/layout/navbar');  ?>

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
				<li class="active"><?php echo $titulo; ?></li>
			</ul>
		</div>
	</div>
</div>

<!-- Begin Login Content Area -->
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
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
				<!-- Login Form s-->
				<?php echo form_open('login/auth'); ?>
				<div class="login-form">
					<h4 class="login-title">Login</h4>
					<div class="row">
						<div class="col-md-12 col-12 mb-20">
							<label>E-mail*</label>
							<input class="mb-0" name="email" type="email" placeholder="E-mail" required="">
						</div>
						<div class="col-12 mb-20">
							<label>Senha*</label>
							<input class="mb-0" name="password" type="password" placeholder="Senha" required="">
						</div>
						<div class="col-md-8">
							<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
								<input type="checkbox" name="remember" id="remember_me">
								<label for="remember_me">Manter Conectado</label>
							</div>
						</div>
						<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
							<a href="#">Criar Conta?</a>
						</div>
						<input type="hidden" name="login" value="login">
						<div class="col-md-12">
							<button type="submit" class="register-button mt-0">Entrar</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<!-- Login Content Area End Here -->
