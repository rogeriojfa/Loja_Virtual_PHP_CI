<?php $this->load->view('restrita/layout/navbar'); ?>             
<?php $this->load->view('restrita/layout/sidebar'); ?>             

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4><?php echo $titulo ?></h4>
                            <a class="btn btn-primary float-right" href="<?php echo base_url('restrita/produtos/core') ?>">+ Novo produto</a>
                        </div>
                        <div class="card-body">

                            <?php if ($message = $this->session->flashdata('sucesso')): ?>

                                <div class="alert alert-success alert-dismissible alert-has-icon show fade">
                                    <div class="alert-icon"><i class="fa fa-check-circle fa-lg"></i></div>
                                    <div class="alert-body">
                                        <div class="alert-title">Sucesso</div>
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?php echo $message; ?>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <?php if ($message = $this->session->flashdata('erro')): ?>

                                <div class="alert alert-danger alert-dismissible alert-has-icon show fade">
                                    <div class="alert-icon"><i class="fa fa-exclamation-circle fa-lg"></i></div>
                                    <div class="alert-body">
                                        <div class="alert-title">Atenção</div>
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?php echo $message; ?>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Marca</th>
                                            <th>Categoria</th> 
											<th>Valor</th>                                           
                                            <th>Status</th>
                                            <th class="nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($produtos as $produto): ?>
                                            <tr>
                                                <td><?php echo $produto->produto_codigo; ?></td>
                                                <td><?php echo $produto->produto_nome; ?></td>
												<td><?php echo $produto->marca_nome; ?></td>
												<td><?php echo $produto->categoria_nome; ?></td>
												<td><?php echo 'R$&nbsp;'.number_format($produto->produto_valor, 2); ?></td>
	                                            <td><?php echo ($produto->produto_ativo == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>' ) ?></td>
												
                                                <td>
                                                    <a href="<?php echo base_url('restrita/produtos/core/' . $produto->produto_id) ?>" class="btn btn-primary btn-icon"><i class="far fa-edit"></i></a>
                                                    <a href="<?php echo base_url('restrita/produtos/delete/' . $produto->produto_id); ?>" class="btn btn-danger btn-icon delete" data-confirm="Deseja Realmente excluir o produto?"><i class="fas fa-times"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- add content here -->
        </div>
    </section>

    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>
