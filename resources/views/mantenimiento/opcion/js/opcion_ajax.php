<script type="text/javascript">
var AjaxOpcion={
    AgregarEditar:function(evento){
        var data=$("#ModalOpcionForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.OpcionMA@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.OpcionMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#OpcionForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#OpcionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#OpcionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.OpcionMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalOpcionForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalOpcionForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalOpcionForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalOpcionForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.OpcionMA@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarMenu:function(evento){
        url='AjaxDinamic/Mantenimiento.MenuMA@ListMenu';
        data={};
        masterG.postAjax(url,data,evento);
    }
};
</script>
