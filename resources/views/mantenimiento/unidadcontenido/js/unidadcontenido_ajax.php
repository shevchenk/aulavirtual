<script type="text/javascript">
var AjaxUnidadContenido={
    AgregarEditar:function(evento){
        var data=$("#ModalUnidadContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#UnidadContenidoForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#UnidadContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#UnidadContenidoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalUnidadContenidoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalUnidadContenidoForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalUnidadContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalUnidadContenidoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};

</script>
