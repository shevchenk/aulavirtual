<script type="text/javascript">
var AjaxMenu={
    AgregarEditar:function(evento){
        var data=$("#ModalMenuForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Mantenimiento.MenuMA@New';
        if(AddEdit==0){
            url='AjaxDinamic/Mantenimiento.MenuMA@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#MenuForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#MenuForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#MenuForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.MenuMA@Load';
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalMenuForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalMenuForm").append("<input type='hidden' value='"+id+"' name='id'>");
        var data=$("#ModalMenuForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalMenuForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Mantenimiento.MenuMA@EditStatus';
        masterG.postAjax(url,data,evento);
    }
};
</script>
