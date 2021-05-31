
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
                            <a class="btn btn-primary float-right" href="<?php echo base_url('restrita/clientes/core') ?>">+ Novo Cliente</a>
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
                                            <th>
                                                #
                                            </th>
                                            <th>Nome Completo</th>
                                            <th>Data Nascimento</th>
                                            <th>CPF</th>
                                            <th>Telefone</th>
                                            <th class="nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <tr>
                                                <td><?php echo $cliente->cliente_id; ?></td>
                                                <td><?php echo $cliente->cliente_nome . ' ' . $cliente->cliente_sobrenome ?></td>
                                                <td><?php echo formata_data_banco_sem_hora($cliente->cliente_data_nascimento) ?></td>
                                                <td><?php echo $cliente->cliente_cpf ?></td>
                                                <td><?php echo $cliente->cliente_telefone_movel ?></td>

                                                <td>
                                                    <a href="<?php echo base_url('restrita/clientes/core/' . $cliente->cliente_id) ?>" class="btn btn-primary btn-icon"><i class="far fa-edit"></i></a>
                                                    <a href="<?php echo base_url('restrita/clientes/delete/' . $cliente->cliente_id); ?>" class="btn btn-danger btn-icon delete" data-confirm="Deseja Realmente excluir o registro?"><i class="fas fa-times"></i></a>
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
