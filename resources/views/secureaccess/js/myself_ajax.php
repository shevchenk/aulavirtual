<script type="text/javascript">
var MyselfAjax={
    Editar:function(evento){
        var data=$("#MyselfForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/SecureAccess.PersonaSA@EditPassword';
        masterG.postAjax(url,data,evento);
    }
};
</script>
