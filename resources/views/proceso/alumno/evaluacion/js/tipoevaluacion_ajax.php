<script type="text/javascript">
var AjaxTipoEvaluacion={
    Cargar:function(evento,pag){
        data={};
        url='AjaxDinamic/Proceso.TipoEvaluacionPR@validarTipoEvaluacion';
        masterG.postAjax(url,data,evento);
    },
    CargarPreguntas:function(evento){
        var programacion_unica_id = $("#ResultEvaluacion #txt_programacion_unica_id").val();
        var tipo_evaluacion_id = $("#ResultEvaluacion #txt_tipo_evaluacion_id").val();
        $("#ContenidoForm input[type='hidden']").not('.mant').remove();

        var data={programacion_unica_id:programacion_unica_id,
                  tipo_evaluacion_id : tipo_evaluacion_id};
        url='AjaxDinamic/Proceso.EvaluacionPR@cargarPreguntas';
        console.log(data);
        masterG.postAjax(url,data,evento);
    },

};

</script>
