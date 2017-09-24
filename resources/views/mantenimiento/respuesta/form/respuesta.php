<div class="modal" id="ModalRespuesta" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Respuesta</h4>
            </div>
            <div class="modal-body">
                <form id="ModalRespuestaForm">
<!--                    <div class="col-md-12">
                        <label>Docente</label>
                    </div>
                        <div class="input-group margin">
                            <input type="hidden" class="form-control mant" id="txt_docente_id" name="txt_docente_id" readOnly="">
                            <input type="hidden" name="txt_persona_id" id="txt_persona_id" class="form-control mant" readonly="">
                            <input type="text" class="form-control" id="txt_docente" name="txt_docente"  disabled="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#ModalListadocente" data-filtros="estado:1" data-personaid="ModalRespuestaForm #txt_persona_id" data-docenteid="ModalRespuestaForm #txt_docente_id" data-docente="ModalRespuestaForm #txt_docente">Buscar</button>
                            </span>
                        </div>           -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pregunta</label>
                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_pregunta_id" name="slct_pregunta_id">
                                <option value="0">.::Seleccione::.</option>
                            </select>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_curso">Tipo de Respuesta</label>
                            <select  class="form-control selectpicker show-menu-arrow" data-live-search="true" id="slct_tipo_respuesta_id" name="slct_tipo_respuesta_id">
                                <option value="0">.::Seleccione::.</option>
                            </select>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Respuesta</label>
                            <input type="text" onkeypress="return masterG.validaAlfanumerico(event, this);" class="form-control" id="txt_respuesta" name="txt_respuesta">
                        </div>
                    </div>                 
                    <div class="col-md-12">
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
