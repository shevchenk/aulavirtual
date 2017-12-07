<script type="text/javascript">
var AjaxTipoEvaluacion={
    Cargar:function(evento,pag){
        data={};        
        url='AjaxDinamic/Proceso.TipoEvaluacionPR@validarTipoEvaluacion';
        masterG.postAjax(url,data,evento);
    },
};

</script>
