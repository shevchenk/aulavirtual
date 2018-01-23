<script type="text/javascript">
var AjaxContenido={
    AgregarEditar:function(evento){
        var data=$("#ModalContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoPR@New';
        if(AddEdit==0){
            url='AjaxDinamic/Proceso.ContenidoPR@Edit';
        }
        masterG.postAjax(url,data,evento);
    },
    Cargar:function(evento){
        var programacion_unica_id=$("#ContenidoForm #txt_programacion_unica_id").val();
        var data={programacion_unica_id:programacion_unica_id};
        url='AjaxDinamic/Proceso.ContenidoPR@LoadContenidoProgra';
        $("#ContenidoForm input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstado:function(evento,AI,id){
        $("#ModalContenidoForm").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#ModalContenidoForm").append("<input type='hidden' value='"+id+"' name='id'>");

        var data=$("#ModalContenidoForm").serialize().split("txt_").join("").split("slct_").join("");
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.ContenidoPR@EditStatus';
        masterG.postAjax(url,data,evento);
    },
    CargarCurso:function(evento){
        url='AjaxDinamic/Mantenimiento.PreguntaEM@ListCursos';
        data={};
        masterG.postAjax(url,data,evento);
    },
    AgregarRespuestaContenido:function(evento){
        var data=$("#frmRepuestaAlum").serialize().split("txt_").join("").split("slct_").join("");
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@New';
        //if(AddEdit==0){
        //    url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Edit';
        //}
        masterG.postAjax(url,data,evento);
    },
    CargarRespuestaContenido:function(evento){
        var contenido_id=$("#frmRepuestaAlum #txt_contenido_id").val();
        var programacion_id=$("#ContenidoForm #txt_programacion_id").val();
        var data={contenido_id:contenido_id,programacion_id:programacion_id};
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@Load';
        $("#frmRepuestaAlum input[type='hidden']").not('.mant').remove();
        masterG.postAjax(url,data,evento);
    },
    CambiarEstadoRespuestaContenido:function(evento,AI,id){
        $("#frmRepuestaAlum").append("<input type='hidden' value='"+AI+"' name='estadof'>");
        $("#frmRepuestaAlum").append("<input type='hidden' value='"+id+"' name='id'>");

        var data=$("#frmRepuestaAlum").serialize().split("txt_").join("").split("slct_").join("");
        $("#frmRepuestaAlum input[type='hidden']").not('.mant').remove();
        url='AjaxDinamic/Proceso.ContenidoRespuestaPR@EditStatus';
        masterG.postAjax(url,data,evento);
    },
};
</script>
