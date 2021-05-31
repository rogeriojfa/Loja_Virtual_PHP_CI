
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
                            <a class="btn btn-primary float-right" href="<?php echo base_url('restrita/master/core') ?>">+ Nova Cat. Pai</a>
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
                                            <th class="text-center">#</th>
                                            <th>Nome</th>
                                            <th>Meta Link</th>
                                            <th>Data Criação</th>                                           
                                            <th>Status</th>
                                            <th class="nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($master as $pai): ?>
                                            <tr>
                                                <td><?php echo $pai->categoria_pai_id; ?></td>
                                                <td><?php echo $pai->categoria_pai_nome?></td>
                                                <td><i data-feather="link-2" class="text-info"></i>&nbsp;<?php echo $pai->categoria_pai_meta_link ?></td>
                                                <td><?php echo formata_data_banco_com_hora($pai->categoria_pai_data_criacao); ?></td>
                                                <td><?php echo ($pai->categoria_pai_ativa == 1 ? '<span class="badge badge-success">Ativa</span>' : '<span class="badge badge-danger">Inativa</span>' ) ?></td>

                                                <td>
                                                    <a href="<?php echo base_url('restrita/master/core/' . $pai->categoria_pai_id) ?>" class="btn btn-primary btn-icon"><i class="far fa-edit"></i></a>
                                                    <a href="<?php echo base_url('restrita/master/delete/' . $pai->categoria_pai_id); ?>" class="btn btn-danger btn-icon delete" data-confirm="Deseja Realmente excluir a Categoria Pai?"><i class="fas fa-times"></i></a>
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
