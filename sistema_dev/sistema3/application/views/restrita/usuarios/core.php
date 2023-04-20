s<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4><?= isset($titulo) ? $titulo : 'EDITAR ---' ?></h4>
            </div>
            <form method="post" name="form_core" action="">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="first_name">
                </div>
                <div class="form-group col-md-4">
                  <label>Sobrenome</label>
                  <input type="text" class="form-control" name="last_name">
                </div>
                <div class="form-group col-md-4">
                  <label>E-mail</label>
                  <input type="email" class="form-control" name="email">
                </div>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Usuario</label>
                    <input type="text" class="form-control" name="username">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Senha</label>
                    <input type="text" class="form-control" name="password">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Confirmar senha</label>
                    <input type="password" class="form-control" name="confirma">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Situação</label>
                    <select class="form-control" name="active">
                      <option>Ativo</option>
                      <option>Inativo</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Perfil de acesso</label>
                    <select class="form-control" name="group">
                      <option selected>Cliente</option>
                      <option>Administrador</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
              </div>
</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>