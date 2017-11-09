<script type="text/javascript">
var AjaxContenidoRespuesta={
    Cargar:function(evento){
        var contenido_id=$("#ContenidoRespuestaForm #txt_contenido_id").val();
        var data={contenido_id:contenido_id};
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Load';
        $("#ContenidoRespuestaForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
};
</script>
