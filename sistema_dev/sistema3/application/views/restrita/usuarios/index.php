s<?php $this->load->view('restrita/layout/navbar');?>
<?php $this->load->view('restrita/layout/sidebar');?>

            
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-block">
                    <h4><?= isset($titulo)?$titulo:'LISTANDO'?></h4>
                    <a class="btn btn-primary float-right" href="<?= base_url('restrita/usuarios/core')?>">Cadastrar</a>
                  </div>
                  <div class="card-body">

                  <?php if($message = $this->session->flashdata('sucesso')):?>
                    <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                        <div class="alert-icon"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Perfeito!</div>
                            <button class="close" data-demiss="alert">
                                <span>&times;</span>
                            </button>
                            <?= $message ?>
                        </div>
                    </div>
                    <?php endif?>
                  <?php if($message = $this->session->flashdata('erro')):?>
                    <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                        <div class="alert-icon"><i class="fas fa-exclamation-circle fa-lg"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Atenção!</div>
                            <button class="close" data-demiss="alert">
                                <span>&times;</span>
                            </button>
                            <?= $message ?>
                        </div>
                    </div>
                    <?php endif?>
                    <div class="table-responsive">
                      <table class="table table-striped data-table" >
                        <thead>
                          <tr>
                            <th class="text-center pt-3">
                              <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                  class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                              </div>
                            </th>
                            <th>#</th>
                            <th>Nome Completo</th>
                            <th>E-mail</th>
                            <th>Perfil de acesso</th>
                            <th>Status</th>
                            <th class="nosort">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php foreach($usuarios as $usuario):?>
                            <td class="text-center pt-2">
                              <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                  id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                              </div>
                            </td>
                            <td><?= $usuario->id ?></td>
                            <td><?= $usuario->first_name.' '.$usuario->last_name ?></td>              
                            <td><?= $usuario->email; ?></td>
                            <td><?= $this->ion_auth->is_admin($usuario->id)?"Administrador":"Cliente" ?></td>
                            <td><?= $usuario->active == 1?'<span class="badge badge-success">Ativo</span>':'<span class="badge badge-danger">Inativo</span>'; ?></td>
                           
                            </td>
                            <td>
                                <a href="<?= base_url("restrita/usuarios/core/".$usuario->id)?>" class="btn btn-icon btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url("restrita/usuarios/core/".$usuario->id)?>" class="btn btn-icon btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                          </tr>
                         <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                    </div>
                </section>
                
            </div>
           