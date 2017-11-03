<div class="modal" id="ModalContenidoProgramacion" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Contenido Programación</h4>
            </div>
            <div class="modal-body">
                <form id="ModalContenidoProgramacionForm">
                    <input type="hidden" class="form-control mant" id="txt_contenido_id" name="txt_contenido_id" readonly="">
                    <div class="col-md-12">
                        <label>Alumno</label>
                    </div>
                    <div class="input-group margin">              
                        <input type="hidden" class="form-control mant" id="txt_programacion_id" name="txt_programacion_id" readonly="">
                        <input type="text" class="form-control" id="txt_persona" name="txt_persona" disabled="">

                        <span class="input-group-btn">
                            <button type="button" id="btn_listarpersona" class="btn btn-info btn-flat" data-toggle="modal" data-target="#ModalListapersona" data-personaid="ModalContenidoProgramacionForm #txt_programacion_id" data-persona="ModalContenidoProgramacionForm #txt_persona">Buscar</button>
                        </span>

                    </div>    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Fecha de Ampliación</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_ampliacion" name="txt_fecha_ampliacion" readonly="" >
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
