<script type="text/javascript">
var AjaxPrivilegio={
    AgregarEditar:function(evento){
        var data=$("#ModalPrivilegioForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.PrivilegioMA@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.PrivilegioMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#PrivilegioForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#PrivilegioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#PrivilegioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PrivilegioMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalPrivilegioForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalPrivilegioForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalPrivilegioForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalPrivilegioForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.PrivilegioMA@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarOpcion:function(evento){
        url='AjaxDinamic/Mantenimiento.OpcionMA@ListOpcion';
        data={};
        masterG.postAjax(url,data,evento);
    }
};
</script>
