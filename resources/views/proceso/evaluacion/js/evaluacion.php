<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoEvaluacionG={id:0, dni:"", alumno:"", curso:"", fecha_inicio:"", fecha_final:"", docente:"", estado:1}; // estado:1
$(document).ready(function() {

    $("#TableTipoEvaluacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });

    AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);

    $("#TipoEvaluacionForm #TableTipoEvaluacion select").change(function(){ AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion); });
    $("#TipoEvaluacionForm #TableTipoEvaluacion input").blur(function(){ AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion); });

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
        TipoEvaluacionG.curso=$("#TableTipoEvaluacion #trid_"+id+" .curso").text();
        TipoEvaluacionG.estado=$("#TableTipoEvaluacion #trid_"+id+" .estado").val();
    }
    $('#ModalTipoEvaluacion').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxTipoEvaluacion.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxTipoEvaluacion.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalTipoEvaluacion').modal('hide');
        AjaxTipoEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarTipoEvaluacion=function(result){
    var html="";
    $('#TableTipoEvaluacion').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        //estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        /*if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }*/

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='dni'>"+r.dni+"</td>"+
            "<td class='alumno'>"+r.alumno+"</td>"+
            "<td class='curso'>"+r.curso+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td>";

        //html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
        html+='<td><a class="btn btn-default btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableTipoEvaluacion tbody").html(html);
    $("#TableTipoEvaluacion").DataTable({
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
            $('#TableTipoEvaluacion_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarTipoEvaluacion','AjaxTipoEvaluacion',result.data,'#TableTipoEvaluacion_paginate');
        }
    });

};

</script>
