<script type="text/javascript">
var AjaxListapersona={
    Cargar:function(evento,pag){
        if( typeof(pag)!='undefined' ){
            $("#ListapersonaForm").append("<input type='hidden' value='"+pag+"' name='page'>");
        }
        if( LPfiltrosG!='' ){
          filtros=LPfiltrosG;
          dfiltros=filtros.split("|");
          for(i=0;i<dfiltros.length;i++){
              $("#ListapersonaForm").append("<input type='hidden' value='"+dfiltros[i].split(":")[1]+"' name='"+dfiltros[i].split(":")[0]+"'>");
          }
        }
        data=$("#ListapersonaForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ListapersonaForm input[type='hidden']").remove();
        url='AjaxDinamic/Proceso.ProgramacionPR@ListPersonaInProgramacionMaster';
        masterG.postAjax(url,data,evento);
    }
};
</script>
