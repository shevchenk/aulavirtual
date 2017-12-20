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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label id="label_curso">Curso</label>
                            <input  type="hidden" class="form-control mant"  id="txt_curso_id" name="txt_curso_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_curso" name="txt_curso" disabled="">
                        </div> 
                    </div>
                    <div class="col-sm-6">  
                        <div class="form-group">
                            <label>Unidad de Contenido</label>
                            <select class="form-control selectpicker show-menu-arrow" data-live-search="true" name="slct_unidad_contenido_id" id="slct_unidad_contenido_id">
                                <option value>.::Seleccione::.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen de Contenido</label>
                            <input type="text" readonly="" class="form-control input-sm" id="txt_imagen_nombre" name="txt_imagen_nombre" value="">
                            <input type="text" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                            <label class="btn btn-default btn-flat margin btn-xs">
                                <i class="fa fa-file-image-o fa-lg"></i>
                                <input type="file" style="display: none;" onchange="onImagen(event, 'imagen');">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Titulo de Contenido</label>
                            <textarea type="text"  class="form-control" id="txt_titulo_contenido" name="txt_titulo_contenido"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contenido</label>
                            <textarea type="text"  class="form-control" id="txt_contenido" name="txt_contenido"></textarea>
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Archivo</label>
                            <input type="text" readonly="" class="form-control input-sm" id="txt_file_nombre" name="txt_file_nombre" value="">
                            <input type="text" style="display: none;" id="txt_file_archivo" name="txt_file_archivo">
                            <label class="btn btn-default btn-flat margin btn-xs">
                                <i class="fa fa-file-pdf-o fa-lg"></i>
                                <i class="fa fa-file-word-o fa-lg"></i>
                                <i class="fa fa-file-image-o fa-lg"></i>
                                <input type="file" style="display: none;" onchange="onImagen(event, 'file');">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Referencia<a class='btn btn-success btn-xs' onclick="AgregarReferencia()"><i class="fa fa-plus fa-xs"></i></a></label>
                            <div id="referencia">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo de Contenido</label>
                            <select class="form-control selectpicker"  data-actions-box='true' name="slct_tipo_respuesta" id="slct_tipo_respuesta">
                                <option value>.::Seleccione::.</option>
                                <option value="0">Documento de Apoyo</option>
                                <option value="1">Tarea</option>
                                <option value="2">Videoconferencia</option>
                            </select>
                        </div>
                    </div>
                    <div id="respuesta">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title anotacion">Different Width</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha de Inicio</label>
                                                <input type="text" class="form-control fecha" id="txt_fecha_inicio" name="txt_fecha_inicio" readonly="" >
                                            </div>
                                        </div>
                                        <div id="video" style="display:none">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Hora Inicio</label>
                                                    <input type="text" class="form-control hora" id="txt_hora_inicio" name="txt_hora_inicio" readonly="" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Hora Final</label>
                                                    <input type="text" class="form-control hora" id="txt_hora_final" name="txt_hora_final" readonly="" >
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tarea" style="display:none">
                                            <div class="col-md-6">
                                                <div class="form-group respuesta">
                                                    <label>Fecha Final</label>
                                                    <input type="text" class="form-control fecha" id="txt_fecha_final" name="txt_fecha_final" readonly="" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
