<script type="text/javascript">
var AjaxPregunta={
    AgregarEditar:function(evento){
        var data=$("#ModalPreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.PreguntaEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.PreguntaEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PreguntaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PreguntaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PreguntaEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPreguntaForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPreguntaForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalPreguntaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPreguntaForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PreguntaEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarUnidadContenido:function(evento){
        url='AjaxDinamic/Mantenimiento.UnidadContenidoEM@ListUnidadContenido';
        data={};
        masterG.postAjax(url,data,evento);
    },  
};
</script>
