<div class="modal" id="ModalContenido" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Contenido</h4>
            </div>
            <div class="modal-body">
                <form id="ModalContenidoForm">
                    <input type="hidden" class="form-control mant" id="txt_programacion_unica_id" name="txt_programacion_unica_id" readonly="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Curso</label>
                            <input  type="hidden" class="form-control mant"  id="txt_curso_id" name="txt_curso_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_curso" name="txt_curso" disabled="">
<!--                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_curso_id" name="slct_curso_id">
                                <option value="0">.::Seleccione::.</option>
                            </select>-->
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contenido</label>
                            <input type="text"  class="form-control" id="txt_contenido" name="txt_contenido">
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ruta Contenido</label>
                            <input type="text" readonly="" class="form-control input-sm" id="txt_file_nombre" name="txt_file_nombre" value="">
                            <input type="text" style="display: none;" id="txt_file_archivo" name="txt_file_archivo">
                            <label class="btn btn-default btn-flat margin btn-xs">
                                <i class="fa fa-file-image-o fa-lg"></i>
                                <input type="file" style="display: none;" onchange="onImagen(event);">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo Respuesta</label>
                            <select class="form-control selectpicker"  data-actions-box='true' name="slct_tipo_respuesta" id="slct_tipo_respuesta">
                                <option value>.::Seleccione::.</option>
                                <option value="0">Solo vista</option>
                                <option value="1">Requiere Respuesta</option>
                            </select>
                        </div>
                    </div>
                    <div id="respuesta" style="display:none">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha de Inicio</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_inicio" name="txt_fecha_inicio" readonly="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_final" name="txt_fecha_final" readonly="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Ampliada</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_ampliada" name="txt_fecha_ampliada" readonly="" >
                        </div>
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
