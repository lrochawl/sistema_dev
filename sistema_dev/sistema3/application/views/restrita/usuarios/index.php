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
                  <div class="card-header">
                    <h4><?= isset($titulo)?$titulo:'LISTANDO'?></h4>
                  </div>
                  <div class="card-body">
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
                            <th>Usuário</th>
                            <th>Status</th>
                            <th>Action</th>
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
                            <td><?= $usuario->username; ?></td>
                            <td><?= $usuario->active == 1?'<span class="badge badge-success">Ativo</span>':'<span class="badge badge-danger">Inativo</span>'; ?></td>
                           
                            </td>
                            <td><a href="#" class="btn btn-primary">Detail</a></td>
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
           