<script type="text/javascript">
var AjaxRespuesta={
    AgregarEditar:function(evento){
        var data=$("#ModalRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.RespuestaEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.RespuestaEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#RespuestaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#RespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#RespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.RespuestaEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalRespuestaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalRespuestaForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalRespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.RespuestaEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarTipoRespuesta:function(evento){
        url='AjaxDinamic/Mantenimiento.RespuestaEM@ListTipoRespuesta';
        data={tipo_curso:1};
        masterG.postAjax(url,data,evento);
    }
};
</script>
