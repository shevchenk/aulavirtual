<script type="text/javascript">
var AjaxContenidoRespuesta={
    AgregarEditar:function(evento){
        var data=$("#ModalContenidoRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@New';
        if(AddEdit==0){
            url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        var contenido_id=$("#ContenidoRespuestaForm #txt_contenido_id").val();
        var data={contenido_id:contenido_id};
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Load';
        $("#ContenidoRespuestaForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalContenidoRespuestaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalContenidoRespuestaForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalContenidoRespuestaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalContenidoRespuestaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
