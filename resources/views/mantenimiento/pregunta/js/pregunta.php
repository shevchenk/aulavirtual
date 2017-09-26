<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var DatosG={id:0,pregunta:"",puntaje:0,curso_id:0,tipo_evaluacion_id:0,estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableDatos").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

//    $('#ModalData').css('z-index', 1050);
//    $('#ModalListadocente').css('z-index', 1050);
//    $('#ModalDocente').css('z-index', 1060);
//    $('#ModalListapersona').css('z-index', 1070);
//    $('#ModalPersona').css('z-index', 1080);
//
    CargarSlct(1); //Cursos
    CargarSlct(3); //Tipo Evaluaciones
    AjaxData.Cargar(HTMLCargarDatos);

    $("#DataForm #TableDatos select").change(function(){ AjaxData.Cargar(HTMLCargarDatos); });
    $("#DataForm #TableDatos input").blur(function(){ AjaxData.Cargar(HTMLCargarDatos); });

    $('#ModalData').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalDatosForm").append("<input type='hidden' value='"+DatosG.id+"' name='id'>");
        }
        $('#ModalDatosForm #txt_pregunta').val( DatosG.pregunta );
        $('#ModalDatosForm #txt_puntaje').val( DatosG.puntaje );
        $('#ModalDatosForm #slct_curso_id').selectpicker('val', DatosG.curso_id );
        $('#ModalDatosForm #slct_tipo_evaluacion_id').selectpicker('val', DatosG.tipo_evaluacion_id );
        $('#ModalDatosForm #slct_estado').selectpicker( 'val',DatosG.estado );
        $('#ModalDatosForm #txt_pregunta').focus();
    });

    $('#ModalData').on('hidden.bs.modal', function (event) {
        $("#ModalDatosForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalDatosForm #slct_curso_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Curso',4000);
    }
    else if( $.trim( $("#ModalDatosForm #slct_tipo_evaluacion_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo Evaluación',4000);
    }
    else if( $.trim( $("#ModalDatosForm #txt_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Pregunta',4000);
    }
    else if( $.trim( $("#ModalDatosForm #txt_puntaje").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Puntaje',4000);
    }
    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    // Limpia los valores de las cajas, select, etc.
    DatosG.id='';
    DatosG.pregunta='';
    DatosG.puntaje='';
    DatosG.curso_id='0';
    DatosG.tipo_evaluacion_id='0';
    DatosG.estado='1';
    //Nombre de los campos definido por Fila de cada Registro. Ejemplo: class="pregunta"
    if( val==0 ){
        DatosG.id=id;
        DatosG.pregunta=$("#TableDatos #trid_"+id+" .pregunta").text();
        DatosG.puntaje=$("#TableDatos #trid_"+id+" .puntaje").text();
        DatosG.curso_id=$("#TableDatos #trid_"+id+" .curso_id").val();
        DatosG.tipo_evaluacion_id=$("#TableDatos #trid_"+id+" .tipo_evaluacion_id").val();
        DatosG.estado=$("#TableDatos #trid_"+id+" .estado").val();
    }
    $('#ModalData').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxData.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxData.Cargar(HTMLCargarDatos);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxData.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalData').modal('hide');
        AjaxData.Cargar(HTMLCargarDatos);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarDatos=function(result){
    var html="";
    $('#TableDatos').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='curso'>"+r.curso+"</td>"+
            "<td class='tipo_evaluacion'>"+r.tipo_evaluacion+"</td>"+
            "<td class='pregunta'>"+r.pregunta+"</td>"+
            "<td class='puntaje'>"+r.puntaje+"</td>"+
            "<td>"+
            "<input type='hidden' class='curso_id' value='"+r.curso_id+"'>"+
            "<input type='hidden' class='tipo_evaluacion_id' value='"+r.tipo_evaluacion_id+"'>";
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableDatos tbody").html(html);
    $("#TableDatos").DataTable({
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
            $('#TableDatos_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarDatos','AjaxData',result.data,'#TableDatos_paginate');
        }
    });

};

// COMBO BOX / SELECT para mostrar listado en Nuevo/Editar.
CargarSlct=function(slct){
    if(slct==1){
    AjaxData.CargarCurso(SlctCargarCurso);
    }
    if(slct==3){
    AjaxData.CargarTipoEvaluacion(SlctCargarTipoEvaluacion);
    }
}

SlctCargarCurso=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.curso+"</option>";
    });
    $("#ModalData #slct_curso_id").html(html);
    $("#ModalData #slct_curso_id").selectpicker('refresh');

};

SlctCargarTipoEvaluacion=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.tipo_evaluacion+"</option>";
    });
    $("#ModalData #slct_tipo_evaluacion_id").html(html);
    $("#ModalData #slct_tipo_evaluacion_id").selectpicker('refresh');

};
// --
</script>
