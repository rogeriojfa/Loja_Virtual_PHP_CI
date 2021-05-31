
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

                        if (isset($categoria_pai)) {
                            $categoria_pai_id = $categoria_pai->categoria_pai_id;
                        } else {
                            $categoria_pai_id = '';
                        }
                        ?>

                        <?php echo form_open('restrita/master/core/' . $categoria_pai_id, $atributos); ?>


                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Nome</label>
                                    <input type="text" name="categoria_pai_nome" class="form-control"
                                           value="<?php echo (isset($categoria_pai) ? $categoria_pai->categoria_pai_nome : set_value('categoria_pai_nome')) ?>">
                                           <?php echo form_error('categoria_pai_nome', '<div class="text-danger">', '</div>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Ativa</label>
                                    <select id="inputState" class="form-control" name="categoria_pai_ativa">

                                        <?php if (isset($categoria_pai)): ?>
                                            <option value="1" <?php echo ($categoria_pai->categoria_pai_ativa == 1 ? 'selected' : '') ?> >Sim</option>
                                            <option value="0" <?php echo ($categoria_pai->categoria_pai_ativa == 0 ? 'selected' : '') ?> >Não</option>

                                        <?php else: ?>

                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>

                                        <?php endif; ?>

                                    </select>
                                </div>

                                <?php if (isset($categoria_pai)): ?>
                                    <div class="form-group col-md-4">
                                        <label>Meta Link</label>
                                        <input type="text" name="categoria_pai_meta_link" class="form-control border-0"
                                               value="<?php echo $categoria_pai->categoria_pai_meta_link; ?>" readonly="">
                                <?php endif; ?>




                            </div>
                            <div class="form-row">    
                                <?php if (isset($categoria_pai)): ?>
                                    <input type="hidden" name="categoria_pai_id" value="<?php echo $categoria_pai->categoria_pai_id; ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mr-2">Salvar</button>
                            <a class="btn btn-dark" href="<?php echo base_url('restrita/master'); ?>">Cancelar</a>
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
