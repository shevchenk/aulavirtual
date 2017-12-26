<script type="text/javascript">
var AjaxBalotario={
    AgregarEditar:function(evento){
        var data=$("#ModalBalotarioForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.BalotarioEM@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.BalotarioEM@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        if( typeof(pag)!='undefined' ){
            $("#BalotarioForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#BalotarioForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.BalotarioEM@Load';
        $("#BalotarioForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalBalotarioForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalBalotarioForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalBalotarioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalBalotarioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.BalotarioEM@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    GenerarBalotario:function(evento,id){
        $("#ModalBalotarioForm").append("<input type='hidden' value='"+id+"' name='id'>");
  
        var data=$("#ModalBalotarioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalBalotarioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.BalotarioEM@GenerateBallot';
        masterG.postAjax(url,data,evento);
    },
    CargarTipoEvaluacion:function(evento){
        url='AjaxDinamic/Mantenimiento.PreguntaEM@ListTipoEvaluacion';
        data={};
        masterG.postAjax(url,data,evento);
    },
};
</script>
