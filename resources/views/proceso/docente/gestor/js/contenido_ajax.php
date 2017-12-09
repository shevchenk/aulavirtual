<script type="text/javascript">
var AjaxContenido={
    AgregarEditar:function(evento){
        var data=$("#ModalContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoPR@New';
        if(AddEdit==0){
            url='AjaxDinamic/Proceso.ContenidoPR@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        var programacion_unica_id=$("#ContenidoForm #txt_programacion_unica_id").val();
        var data={programacion_unica_id:programacion_unica_id};
        url='AjaxDinamic/Proceso.ContenidoPR@Load';
        $("#ContenidoForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalContenidoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalContenidoForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.ContenidoPR@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarUnidadContenido:function(evento){
        url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@ListUnidadContenido';
        data={};
        masterG.postAjax(url,data,evento);
    },        
};
</script>
