<script type="text/javascript">
var AjaxBalotario={
    Cargar:function(evento,pag){
        var programacion_id = $("#EvaluacionForm #txt_programacion_id").val();
        data={programacion_id:programacion_id};
        url='AjaxDinamic/Proceso.TipoEvaluacionPR@validarTipoEvaluacionMaster';
        masterG.postAjax(url,data,evento);
    },
};
</script>
