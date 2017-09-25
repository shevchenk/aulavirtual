<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoEvaluacionG={id:0,tipo_evaluacion:"",estado:1}; // Datos Globales
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
        $('#ModalTipoEvaluacionForm #txt_tipo_evaluacion').val( TipoEvaluacionG.tipo_evaluacion );
        $('#ModalTipoEvaluacionForm #slct_estado').selectpicker( 'val',TipoEvaluacionG.estado );
        $('#ModalTipoEvaluacionForm #txt_tipo_evaluacion').focus();
    });

    $('#ModalTipoEvaluacion').on('hidden.bs.modal', function (event) {
        $("#ModalTipoEvaluacionForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;

    if( $.trim( $("#ModalTipoEvaluacionForm #txt_tipo_evaluacion").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Tipo Evaluacion',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    TipoEvaluacionG.id='';
    TipoEvaluacionG.tipo_evaluacion='';
    TipoEvaluacionG.estado='1';
    if( val==0 ){
        TipoEvaluacionG.id=id;
        TipoEvaluacionG.tipo_evaluacion=$("#TableTipoEvaluacion #trid_"+id+" .tipo_evaluacion").text();
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
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='tipo_evaluacion'>"+r.tipo_evaluacion+"</td>"+
            "<td>";
            
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
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
