<div class="modal" id="ModalEvaluacion" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprogramación de Evaluación</h4>
            </div>
            <div class="modal-body">
                <form id="ModalEvaluacionForm">
                    <input type="hidden" class="form-control mant" id="txt_programacion_unica_id" name="txt_programacion_unica_id" readonly="">
                    <input type="hidden" class="form-control mant" id="txt_tipo_evaluacion_id" name="txt_tipo_evaluacion_id" readonly="">
                    <div id="individual">
                    <div class="col-md-12">
                        <label>Alumno</label>
                    </div>
                    <div class="input-group margin">              
                        <input type="hidden" class="form-control mant" id="txt_programacion_id" name="txt_programacion_id" readonly="">
                        <input type="text" class="form-control" id="txt_persona" name="txt_persona" disabled="">
                        <span class="input-group-btn">
                            <button type="button" id="btn_listarpersona" class="btn btn-info btn-flat" data-toggle="modal" data-target="#ModalListapersona" data-personaid="ModalEvaluacionForm #txt_programacion_id" data-persona="ModalEvaluacionForm #txt_persona">Buscar</button>
                        </span>
                    </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha de Reprogramación Inicial</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_reprogramada_inicial" name="txt_fecha_reprogramada_inicial" readonly="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha de Reprogramación Final</label>
                            <input type="text" class="form-control fecha" id="txt_fecha_reprogramada_final" name="txt_fecha_reprogramada_final" readonly="" >
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
