<div class="modal" id="ModalPregunta" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pregunta</h4>
            </div>
            <div class="modal-body">
                <form id="ModalPreguntaForm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Curso</label>
                            <input  type="hidden" class="form-control mant"  id="txt_curso_id" name="txt_curso_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_curso" name="txt_curso" disabled="">
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Unidad de Contenido</label>
                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_unidad_contenido_id" name="slct_unidad_contenido_id">
                                <option value="0">.::Seleccione::.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pregunta</label>
                            <input type="text"  class="form-control" id="txt_pregunta" name="txt_pregunta">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="text"  readOnly class="form-control input-sm" id="txt_imagen_nombre"  name="txt_imagen_nombre" value="">
                            <input type="text" style="display: none;" id="txt_imagen_archivo" name="txt_imagen_archivo">
                            <label class="btn btn-default btn-flat margin btn-xs">
                                <i class="fa fa-file-image-o fa-lg"></i>
                                <input type="file" style="display: none;" onchange="onImagenPregunta(event);" >
                            </label>

                        </div>  
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <img class="img-circle" style="height: 142px;width: 100%;border-radius: 8px;border: 1px solid grey;margin-top: 5px;padding: 8px"> 
                        </div>  
                    </div>
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label>Puntaje</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_puntaje" name="txt_puntaje">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
