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
            <form name="form_core">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" value="<?= isset($usuario) ? $usuario->first_name : '' ?>" name="first_name">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" value="<?= isset($usuario) ? $usuario->last_name : '' ?>" name="last_name">
                  </div>
                  <div class="form-group col-md-4">
                    <label>E-mail</label>
                    <input type="email" class="form-control" value="<?= isset($usuario) ? $usuario->email : '' ?>" name="email">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Usuario</label>
                    <input type="text" class="form-control" value="<?= isset($usuario) ? $usuario->username : '' ?>" name="username">
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
                      <?php if (isset($usuario)) : ?>
                        <option value="1" <?= ($usuario->active == 1) ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= ($usuario->active == 0) ? 'selected' : '' ?>>Inativo</option>
                      <?php else : ?>
                        <option value="1" >Ativo</option>
                        <option value="0" >Inativo</option> 
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Perfil de acesso</label>
                    <select class="form-control" name="perfil">
                      <?php foreach($groups as $group):?>
                        <?php if(isset($usuario)): ?>
                        <option value="<?= $group->id?>" <?= ($group->id == $perfil)?'selected':''?>><?= $group->description ?></option>
                        <?php else:?>
                          <option value="<?= $group->id?>" ><?= $group->description ?></option>
                        <? endif?>
                      <?php endforeach; ?>
                      
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button class="btn btn-primary">Salvar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
</section>

</div>