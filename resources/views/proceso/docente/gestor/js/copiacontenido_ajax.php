<script type="text/javascript">
var AjaxCopiaContenido={
    AgregarEditar:function(evento){
        var data=$("#ModalCopiaContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoPR@NewCopiaContenido';
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        var curso_id=$("#ModalCopiaContenidoForm #txt_curso_id").val();
        var programacion_unica_id=$("#ModalCopiaContenidoForm #txt_programacion_unica_id").val();
        var data={curso_id:curso_id,tipo_respuesta:0,distinto_programacion_unica_id:programacion_unica_id};
        url='AjaxDinamic/Proceso.ContenidoPR@Load';
        $("#ModalCopiaContenidoForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
};
</script>
