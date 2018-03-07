<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoEvaluacionG={id:0, dni:"", alumno:"", curso:"", fecha_inicio:"", fecha_final:"", docente:"", estado:1}; // estado:1
$(document).ready(function() {

    $("#TableEvaluacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);

    $("#TipoEvaluacionForm #TableEvaluacion select").change(function(){ AjaxEvaluacion.Cargar(HTMLCargarEvaluacion); });
    $("#TipoEvaluacionForm #TableEvaluacion input").blur(function(){ AjaxEvaluacion.Cargar(HTMLCargarEvaluacion); });

    $('#ModalTipoEvaluacion').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalTipoEvaluacionForm").append("<input type='hidden' value='"+TipoEvaluacionG.id+"' name='id'>");
        }
        $('#ModalTipoEvaluacionForm #txt_dni').val( TipoEvaluacionG.dni );
        $('#ModalTipoEvaluacionForm #txt_alumno').val( TipoEvaluacionG.alumno );
        $('#ModalTipoEvaluacionForm #txt_curso').val( TipoEvaluacionG.curso );
        $('#ModalTipoEvaluacionForm #txt_fecha_inicio').val( TipoEvaluacionG.fecha_inicio );
        $('#ModalTipoEvaluacionForm #txt_fecha_final').val( TipoEvaluacionG.fecha_final );
        $('#ModalTipoEvaluacionForm #txt_docente').val( TipoEvaluacionG.docente );
        //$('#ModalTipoEvaluacionForm #slct_estado').selectpicker( 'val',TipoEvaluacionG.estado );
        $('#ModalTipoEvaluacionForm #txt_curso').focus();
    });

    $('#ModalTipoEvaluacion').on('hidden.bs.modal', function (event) {
        $("#ModalTipoEvaluacionForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm=function(){
    var r=true;

    if( $.trim( $("#ModalTipoEvaluacionForm #txt_curso").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Tipo Evaluacion',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    TipoEvaluacionG.id='';
    TipoEvaluacionG.curso='';
    TipoEvaluacionG.estado='1';
    if( val==0 ){
        TipoEvaluacionG.id=id;
        TipoEvaluacionG.curso=$("#TableEvaluacion #trid_"+id+" .curso").text();
        TipoEvaluacionG.estado=$("#TableEvaluacion #trid_"+id+" .estado").val();
    }
    $('#ModalTipoEvaluacion').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxEvaluacion.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxEvaluacion.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalTipoEvaluacion').modal('hide');
        AjaxEvaluacion.Cargar(HTMLCargarEvaluacion);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarEvaluacion=function(result){
    var html="";
    $('#TableEvaluacion').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        //estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        /*if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }*/

        html+='<tr id="trid_'+r.id+'" onClick="CargarContenido('+r.id+','+r.pu_id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto_cab+'\',this)">'+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='curso'>"+
            //"<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 40px;width: 40px;'>"+
            "&nbsp"+r.curso+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>";
        //html+='<a class="btn btn-default btn-sm" onClick="verContenido(0,'+r.id+')"><i class="fa fa-plus fa-lg"></i> </a></td>';
     //   html +='<a class="btn btn-primary btn-sm" onClick="CargarContenido('+r.pu_id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto+'\',this)"><i class="fa fa-plus fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableEvaluacion tbody").html(html);
    $("#TableEvaluacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [10],
        "language": {
            "info": "Mostrando página "+result.data.current_page+" / "+result.data.last_page+" de "+result.data.total,
            "infoEmpty": "No éxite registro(s) aún",
        },
        "initComplete": function () {
            $('#TableEvaluacion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarEvaluacion','AjaxEvaluacion',result.data,'#TableEvaluacion_paginate');
        }
    });
};


CargarContenido=function(programacion_id,id,curso_id,curso,imagen,boton){
     masterG.pintar_fila(boton);
     $("#ContenidoForm #txt_programacion_id").val(programacion_id);
     $("#ContenidoForm #txt_programacion_unica_id").val(id);
     $("#ModalContenidoForm #txt_programacion_unica_id").val(id);
     $("#ModalContenidoForm #txt_curso_id").val(curso_id);
     $("#ModalContenidoForm #txt_curso").val(curso);
     $("#imageCurso").attr("src","img/course/"+imagen);
     AjaxContenido.Cargar(HTMLCargarContenido);
     $("#ContenidoForm").css("display","");
     $("#ContenidoProgramacionForm").css("display","none");

     $('#div_contenido_respuesta').hide();
};

</script>
