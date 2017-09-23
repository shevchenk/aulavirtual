<div class="modal" id="ModalPrivilegio" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header btn-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Privilegio</h4>
        </div>
        <div class="modal-body">
          <form id="ModalPrivilegioForm">
          <fieldset>
            <div class="form-group">
              <div class="col-md-12">
              
                <label>Privilegio</label>
                <input type="text" class="form-control" id="txt_privilegio" name="txt_privilegio" placeholder="Privilegio">
              </div>
            
              <div class="col-sm-12">  
                <div class="col-sm-6">     
                    <br>         
                        <label>Opcion</label>
                        <br>
                          <select class="selectpicker show-menu-arrow" multiple data-actions-box="true" data-live-search="true" name="slct_opcion_id[]" id="slct_opcion_id">
                          </select>     
                    </div>
                <div class="col-sm-6">    
                  <br>                    
                        <label>Estado</label>
                          <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                            <option value='0'>Inactivo</option>
                            <option value='1' selected>Activo</option>
                          </select>               
                </div>
              </div>
            </div>
            <br>
          <fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
