<script type="text/javascript">
var AjaxTipoRespuesta={
    AgregarEditar:function(evento){
        var data=$("#ModalTipoRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.TipoRespuestaEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.TipoRespuestaEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#TipoRespuestaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#TipoRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#TipoRespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TipoRespuestaEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalTipoRespuestaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalTipoRespuestaForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalTipoRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalTipoRespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.TipoRespuestaEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};

</script>
