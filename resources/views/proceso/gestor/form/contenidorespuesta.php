<div class="modal" id="ModalContenidoRespuesta" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Contenido Respuesta</h4>
            </div>
            <div class="modal-body">
                <form id="ModalContenidoRespuestaForm">
                    <input type="hidden" class="form-control mant" id="txt_contenido_id" name="txt_contenido_id" readonly="">
<!--                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Curso</label>
                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_curso_id" name="slct_curso_id">
                                <option value="0">.::Seleccione::.</option>
                            </select>
                        </div> 
                    </div>-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Respuesta</label>
                            <input type="text"  class="form-control" id="txt_respuesta" name="txt_respuesta">
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ruta Respuesta</label>
                            <input type="text"  class="form-control" id="txt_ruta_respuesta" name="txt_ruta_respuesta">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control selectpicker show-menu-arrow" name="slct_estado" id="slct_estado">
                                <option  value='0'>Inactivo</option>
                                <option  value='1'>Activo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"> 
                         <label></label>
                    </div>
                </form>
            </div> <!-- FIN DE MODAL BODY -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
