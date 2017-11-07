<script type="text/javascript">
var AjaxProgramacionUnica={
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#ProgramacionUnicaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        data=$("#ProgramacionUnicaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ProgramacionUnicaForm input[type='hidden']").not('.mant').remove();
        
        if($('#txt_dni').val() != '')
          url='AjaxDinamic/Proceso.ProgramacionUnicaPR@Load';
        else
          url='AjaxDinamic/Proceso.ProgramacionUnicaPR@validarProgramacion';
        masterG.postAjax(url,data,evento);
    }
};

</script>
