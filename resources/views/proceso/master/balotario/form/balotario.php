<div class="modal" id="ModalBalotario" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Balotario</h4>
            </div>
            <div class="modal-body">
                <form id="ModalBalotarioForm">
                    <input type="hidden" class="form-control mant" id="txt_programacion_unica_id" name="txt_programacion_unica_id" readonly="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Curso</label>
                            <input  type="hidden" class="form-control mant"  id="txt_curso_id" name="txt_curso_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_curso" name="txt_curso" disabled="">
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Tipo Evaluación</label>
                            <input  type="hidden" class="form-control mant"  id="txt_tipo_evaluacion_id" name="txt_tipo_evaluacion_id" readonly="">
                            <input type="text"  class="form-control mant" id="txt_tipo_evaluacion" name="txt_tipo_evaluacion" disabled="">
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cantidad de Preguntas de Balotario</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_cantidad_maxima" name="txt_cantidad_maxima">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cantidad de Preguntas de Evaluación</label>
                            <input type="text" onkeyup="masterG.DecimalMax(this, 2);" onkeypress="return masterG.validaDecimal(event, this);" class="form-control" id="txt_cantidad_pregunta" name="txt_cantidad_pregunta">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Unidad de Contenido</label>
                             <select  class="form-control selectpicker" data-live-search="true" multiple id="slct_unidad_contenido_id" name="slct_unidad_contenido_id[]">
                            </select>
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text"  class="form-control mant" id="txt_estado" name="txt_estado" value="Activo" disabled="">
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
