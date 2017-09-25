<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var TipoRespuestaG={id:0,tipo_respuesta:"",estado:1}; // Datos Globales
$(document).ready(function() {

    $("#TableTipoRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    

    AjaxTipoRespuesta.Cargar(HTMLCargarTipoRespuesta);
    
    $("#TipoRespuestaForm #TableTipoRespuesta select").change(function(){ AjaxTipoRespuesta.Cargar(HTMLCargarTipoRespuesta); });
    $("#TipoRespuestaForm #TableTipoRespuesta input").blur(function(){ AjaxTipoRespuesta.Cargar(HTMLCargarTipoRespuesta); });
    
    $('#ModalTipoRespuesta').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalTipoRespuestaForm").append("<input type='hidden' value='"+TipoRespuestaG.id+"' name='id'>");
        }
        $('#ModalTipoRespuestaForm #txt_tipo_respuesta').val( TipoRespuestaG.tipo_respuesta );
        $('#ModalTipoRespuestaForm #slct_estado').selectpicker( 'val',TipoRespuestaG.estado );
        $('#ModalTipoRespuestaForm #txt_tipo_respuesta').focus();
    });

    $('#ModalTipoRespuesta').on('hidden.bs.modal', function (event) {
        $("#ModalTipoRespuestaForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;

    if( $.trim( $("#ModalTipoRespuestaForm #txt_tipo_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Tipo Respuesta',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    TipoRespuestaG.id='';
    TipoRespuestaG.tipo_respuesta='';
    TipoRespuestaG.estado='1';
    if( val==0 ){
        TipoRespuestaG.id=id;
        TipoRespuestaG.tipo_respuesta=$("#TableTipoRespuesta #trid_"+id+" .tipo_respuesta").text();
        TipoRespuestaG.estado=$("#TableTipoRespuesta #trid_"+id+" .estado").val();
    }
    $('#ModalTipoRespuesta').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxTipoRespuesta.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxTipoRespuesta.Cargar(HTMLCargarTipoRespuesta);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxTipoRespuesta.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalTipoRespuesta').modal('hide');
        AjaxTipoRespuesta.Cargar(HTMLCargarTipoRespuesta);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarTipoRespuesta=function(result){
    var html="";
    $('#TableTipoRespuesta').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='tipo_respuesta'>"+r.tipo_respuesta+"</td>"+
            "<td>";
            
        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableTipoRespuesta tbody").html(html); 
    $("#TableTipoRespuesta").DataTable({
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
            $('#TableTipoRespuesta_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarTipoRespuesta','AjaxTipoRespuesta',result.data,'#TableTipoRespuesta_paginate');
        }
    });

};

</script>
