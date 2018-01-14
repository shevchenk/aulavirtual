<script type="text/javascript">
var AjaxEvaluacion={
    Cargar:function(evento,pag){
        var programacion_unica_id = $("#EvaluacionForm #txt_programacion_unica_id").val();
        data={programacion_unica_id:programacion_unica_id};
        url='AjaxDinamic/Proceso.TipoEvaluacionPR@validarTipoEvaluacionMaster';
        masterG.postAjax(url,data,evento);
    },
    AgregarEditar:function(evento){
        var data=$("#ModalEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.EvaluacionPR@GenerateReprogramacion';
        masterG.postAjax(url,data,evento);
    },
};
</script>
