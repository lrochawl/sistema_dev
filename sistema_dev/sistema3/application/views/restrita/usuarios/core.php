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
            <div class="card-body">


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
               
                
              </div>
              <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>

</div>