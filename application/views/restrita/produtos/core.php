<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4><?php echo $titulo ?></h4>
						</div>

						<?php
						$atributos = array(
							'name' => 'form-core',
						);

						if (isset($produto)) {
							$produto_id = $produto->produto_id;
						} else {
							$produto_id = '';
						}
						?>

						<?php echo form_open('restrita/produtos/core/' . $produto_id, $atributos); ?>

						<div class="card-body">
							<?php if (isset($produto)) : ?>
								<div class="form-row">
									<div class="col-md-12">
										<label>Meta Link do produto</label>
										<p class="text-info"> <?php echo $produto->produto_meta_link; ?> </p>
									</div>
								</div>
							<?php endif; ?>

							<div class="form-row">

								<div class="form-group col-md-1">
									<label>Código Produto</label>
									<input type="text" name="produto_codigo" class="form-control border-0" value="<?php echo (isset($produto) ? $produto->produto_codigo : $codigo_gerado) ?>" readonly="">
									<?php echo form_error('produto_codigo', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-4">
									<label>Nome</label>
									<input type="text" name="produto_nome" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_nome : set_value('produto_nome')) ?>">
									<?php echo form_error('produto_nome', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-2">
									<label for="">Categoria</label>
									<select id="" class="form-control" name="produto_categoria_id">

										<option value="">Selecione...</option>

										<?php foreach ($categorias as $cat) : ?>
											<?php if (isset($produto)) : ?>
												<option value="<?php echo $cat->categoria_id; ?>" <?php echo ($cat->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?>> <?php echo $cat->categoria_nome; ?></option>
											<?php else : ?>
												<option value="<?php echo $cat->categoria_id; ?>"> <?php echo $cat->categoria_nome; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('produto_categoria_id', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-2">
									<label for="">Marca</label>
									<select id="" class="form-control" name="produto_marca_id">

										<option value="">Selecione...</option>

										<?php foreach ($marcas as $marca) : ?>
											<?php if (isset($produto)) : ?>
												<option value="<?php echo $marca->marca_id; ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected' : '') ?>> <?php echo $marca->marca_nome; ?></option>
											<?php else : ?>
												<option value="<?php echo $marca->marca_id; ?>"> <?php echo $marca->marca_nome; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('produto_marca_id', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-2">
									<label>Valor Venda</label>
									<input type="text" name="produto_valor" class="form-control money2" value="<?php echo (isset($produto) ? $produto->produto_valor : set_value('produto_valor')) ?>">
									<?php echo form_error('produto_valor', '<div class="text-danger">', '</div>') ?>
								</div>

							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="">Controla Estoque?</label>
									<select id="" class="form-control" name="produto_controlar_estoque">

										<?php if (isset($produto)) : ?>
											<option value="1" <?php echo ($produto->produto_controlar_estoque == 1 ? 'selected' : '') ?>>Sim</option>
											<option value="0" <?php echo ($produto->produto_controlar_estoque == 0 ? 'selected' : '') ?>>Não</option>

										<?php else : ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="">Produto Em Destaque?</label>
									<select id="" class="form-control" name="produto_destaque">

										<?php if (isset($produto)) : ?>
											<option value="1" <?php echo ($produto->produto_destaque == 1 ? 'selected' : '') ?>>Sim</option>
											<option value="0" <?php echo ($produto->produto_destaque == 0 ? 'selected' : '') ?>>Não</option>

										<?php else : ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>
								<div class="form-group col-md-1">
									<label>Peso</label>
									<input type="number" name="produto_peso" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_peso : set_value('produto_peso')) ?>">
									<?php echo form_error('produto_peso', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-1">
									<label>Altura</label>
									<input type="number" name="produto_altura" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_altura : set_value('produto_altura')) ?>">
									<?php echo form_error('produto_altura', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-1">
									<label>Largura</label>
									<input type="number" name="produto_largura" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_largura : set_value('produto_largura')) ?>">
									<?php echo form_error('produto_largura', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-1">
									<label>Comprimento</label>
									<input type="number" name="produto_comprimento" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_comprimento : set_value('produto_comprimento')) ?>">
									<?php echo form_error('produto_comprimento', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-1">
									<label>Qtde Estoque</label>
									<input type="number" name="produto_quantidade_estoque" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_quantidade_estoque : set_value('produto_quantidade_estoque')) ?>">
									<?php echo form_error('produto_quantidade_estoque', '<div class="text-danger">', '</div>') ?>
								</div>

								<div class="form-group col-md-2">
									<label for="">Ativo</label>
									<select id="" class="form-control" name="produto_ativo">

										<?php if (isset($produto)) : ?>
											<option value="1" <?php echo ($produto->produto_ativo == 1 ? 'selected' : '') ?>>Sim</option>
											<option value="0" <?php echo ($produto->produto_ativo == 0 ? 'selected' : '') ?>>Não</option>

										<?php else : ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>

							</div>
							<div class="form-row">
								<div class="form-group col-md-11">
									<label>Descrição do produto</label>
									<textarea name="produto_descricao" class="form-control" style="min-height: 100px;" rows="3"><?php echo (isset($produto) ? $produto->produto_descricao : set_value('produto_descricao')) ?></textarea>
									<?php echo form_error('produto_descricao', '<div class="text-danger">', '</div>') ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-11">
									<label>Imagens do produto</label>

									<div id="fileuploader">

									</div>

									<div id="erro_uploaded" class="text-danger">

									</div>

									<?php echo form_error('fotos_produtos', '<div class="text-danger">', '</div>') ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-12">
									<?php if (isset($produto)) : ?>

										<div id="uploaded_image" class="text-danger">

											<?php foreach ($fotos_produto as $foto) : ?>
												<ul style="list-style: none; display: inline-block;">
													<li>
														<img src="<?php echo base_url('uploads/produtos/' . $foto->foto_caminho); ?>" width="80" class="img-thumbnail" mr-1 mb-2 alt="foto do produto" />
														<input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_caminho; ?>">
														<a href="javascript:(void)" class="btn btn-danger d-block btn-icon mx-auto mb-30 btn-remove"><i class="fas fa-times"></i></a>
													</li>
												</ul>
											<?php endforeach; ?>
										</div>
									<?php else : ?>
										<div id="uploaded_image" class="text-danger">

										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-row">
								<?php if (isset($produto)) : ?>
									<input type="hidden" name="produto_id" value="<?php echo $produto->produto_id; ?>">
								<?php endif; ?>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary mr-2">Salvar</button>
							<a class="btn btn-dark" href="<?php echo base_url('restrita/produtos'); ?>">Cancelar</a>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>


			<!-- add content here -->
		</div>
	</section>

	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>
