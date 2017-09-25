<script type="text/javascript">
var AjaxTipoEvaluacion={
    AgregarEditar:function(evento){
        var data=$("#ModalTipoEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.TipoEvaluacionEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.TipoEvaluacionEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#TipoEvaluacionForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#TipoEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#TipoEvaluacionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TipoEvaluacionEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalTipoEvaluacionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalTipoEvaluacionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TipoEvaluacionEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};

</script>
