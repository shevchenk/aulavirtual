<script type="text/javascript">
var AjaxContenidoRespuesta={
    Cargar:function(evento){
        var contenido_id=$("#ContenidoRespuestaForm #txt_contenido_id").val();
        var data={contenido_id:contenido_id};
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Load';
        $("#ContenidoRespuestaForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    GuardarNotaRpta:function(evento){
        var id = $("#ContenidoRespuestaForm #txt_contenido_respuesta_id").val();
        var nota = $("#ContenidoRespuestaForm #txt_nota_cr").val();
        $("#ContenidoRespuestaForm input[type='hidden']").not('.mant').remove();        
        var data={id:id, nota:nota};
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@guardarNotaRpta';
        masterG.postAjax(url,data,evento);
    }
};
</script>
