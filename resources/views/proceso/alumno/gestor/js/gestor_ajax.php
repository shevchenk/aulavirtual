<script type="text/javascript">
var AjaxEvaluacion={
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#TipoEvaluacionForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#TipoEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#TipoEvaluacionForm input[type='hidden']").not('.mant').remove();

        url='AjaxDinamic/Proceso.EvaluacionPR@validarCurso';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalTipoEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalTipoEvaluacionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.EvaluacionPR@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};

</script>
