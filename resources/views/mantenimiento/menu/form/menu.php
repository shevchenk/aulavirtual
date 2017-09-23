<div class="modal" id="ModalMenu" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header btn-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Menu</h4>
        </div>
        <div class="modal-body">
          <form id="ModalMenuForm">
            <div class="form-group">
              <div class="col-md-12">
              
                <label>Menu</label>
                <input type="text" class="form-control" id="txt_menu" name="txt_menu" placeholder="Menu">
              </div>
            

            <div class="col-md-12">
              <div class="form-group">
                <label>Class Icono</label>
                <input type="text" class="form-control" id="txt_class_icono" name="txt_class_icono" placeholder="Class Icono">
              </div>
            </div>

            <div class="col-md-12">
                <label>Estado</label>
                  <select class="form-control" name="slct_estado" id="slct_estado">
                    <option value='0'>Inactivo</option>
                    <option value='1' selected>Activo</option>
                  </select>
                <br>
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
