<script type="text/javascript">
var AjaxContenidoProgramacion={
    AgregarEditar:function(evento){
        var data=$("#ModalContenidoProgramacionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoProgramacionPR@New';
        if(AddEdit==0){
            url='AjaxDinamic/Proceso.ContenidoProgramacionPR@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        var contenido_id=$("#ContenidoProgramacionForm #txt_contenido_id").val();
        var data={contenido_id:contenido_id};
        url='AjaxDinamic/Proceso.ContenidoProgramacionPR@Load';
        $("#ContenidoProgramacionForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalContenidoProgramacionForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalContenidoProgramacionForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalContenidoProgramacionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalContenidoProgramacionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.ContenidoProgramacionPR@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
