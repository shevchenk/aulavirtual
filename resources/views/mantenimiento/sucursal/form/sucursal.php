<div class="modal" id="ModalSucursal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header btn-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ODE</h4>
        </div>
        <div class="modal-body">
            <form id="ModalSucursalForm">
            <div class="form-group">
              <div class="col-md-12">
              
                <label>ODE</label>
                <input type="text" class="form-control" id="txt_sucursal" name="txt_sucursal" placeholder="ODE">
              </div>
            

            <div class="col-md-12">
              <div class="form-group">
                <label>Direccion</label>
                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Direccion">
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-sm-6">
                
                  <label>Telefono</label>
                  <input type="text" onkeypress="return masterG.validaNumerosMax(event,this,7);" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Telefono">
                
              </div>

              <div class="col-sm-6">
                <label>Celular</label>
                <input type="text" onkeypress="return masterG.validaNumerosMax(event,this,9);" class="form-control" id="txt_celular" name="txt_celular" placeholder="Celular">
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-sm-6">
                <label>Email</label>
                <input type="text" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
              </div>

              <div class="col-sm-6">
                <label>Estado</label>
                  <select class="form-control" name="slct_estado" id="slct_estado">
                    <option value='0'>Inactivo</option>
                    <option value='1' selected>Activo</option>
                  </select>
              </div>
            </div>
            <br>
            
            <div class="col-md-8">
                <div class="form-group">
                            <label>Imagen</label>
                            <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                            <input type="text" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                            <label class="btn btn-default btn-flat margin btn-xs">
                                <i class="fa fa-file-image-o fa-lg"></i>
                                <input type="file" style="display: none;" onchange="onImagen(event);" >
                            </label>

                </div>  
            </div> 

            <div class="col-md-4">
                        <div class="form-group">
                            <img class="img-circle" style="height: 142px;width: 100%;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px"> 
                        </div>  
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
