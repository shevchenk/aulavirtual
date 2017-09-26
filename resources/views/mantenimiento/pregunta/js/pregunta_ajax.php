<script type="text/javascript">
var AjaxData={
    AgregarEditar:function(evento){
        var data=$("#ModalDatosForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.PreguntaEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.PreguntaEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#DataForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#DataForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#DataForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PreguntaEM@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalDatosForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalDatosForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalDatosForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalDatosForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PreguntaEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarCurso:function(evento){
        url='AjaxDinamic/Mantenimiento.PreguntaEM@ListCursos';
        data={};
        masterG.postAjax(url,data,evento);
    },
    CargarTipoEvaluacion:function(evento){
        url='AjaxDinamic/Mantenimiento.PreguntaEM@ListTipoEvaluacion';
        data={};
        masterG.postAjax(url,data,evento);
    }
};
</script>
