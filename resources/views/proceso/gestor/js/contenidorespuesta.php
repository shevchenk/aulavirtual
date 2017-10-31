<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoRespuestaG={id:0,programacion_id:0,respuesta:'',ruta_respuesta:'',estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableContenidoRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $('#ModalContenidoRespuesta').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{
            
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalContenidoRespuestaForm").append("<input type='hidden' value='"+ContenidoRespuestaG.id+"' name='id'>");
        }

        $('#ModalContenidoRespuestaForm #txt_respuesta').val( ContenidoRespuestaG.respuesta );
        $('#ModalContenidoRespuestaForm #txt_ruta_respuesta').val( ContenidoRespuestaG.ruta_respuesta );
        $('#ModalContenidoRespuestaForm #slct_estado').selectpicker( 'val',ContenidoRespuestaG.estado );
        //$('#ModalContenidoRespuestaForm #txt_razon_social').focus();
    });

    $('#ModalContenidoRespuesta').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoRespuestaForm input[type='hidden']").not('.mant').remove();
    });
});

ValidaForm2=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoRespuestaForm #txt_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Respuesta',4000);
    }
    else if( $.trim( $("#ModalContenidoRespuestaForm #txt_ruta_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Ruta de Respuesta',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    ContenidoRespuestaG.id='';
    ContenidoRespuestaG.respuesta='';
    ContenidoRespuestaG.ruta_respuesta='';
    ContenidoRespuestaG.estado='1';

    if( val==0 ){

        ContenidoRespuestaG.id=id;
        ContenidoRespuestaG.respuesta=$("#TableContenidoRespuesta #trid_"+id+" .respuesta").text();
        ContenidoRespuestaG.ruta_respuesta=$("#TableContenidoRespuesta #trid_"+id+" .ruta_respuesta").text();
        ContenidoRespuestaG.estado=$("#TableContenidoRespuesta #trid_"+id+" .estado").val();


    }
    $('#ModalContenidoRespuesta').modal('show');
}

CambiarEstado2=function(estado,id){
    AjaxContenidoRespuesta.CambiarEstado(HTMLCambiarEstado2,estado,id);
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxContenidoRespuesta.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalContenidoRespuesta').modal('hide');
        AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarContenidoRespuesta=function(result){
    var html="";
    $('#TableContenidoRespuesta').DataTable().destroy();

    $.each(result.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='respuesta'>"+r.respuesta+"</td>"+
            "<td class='ruta_respuesta'>"+r.ruta_respuesta+"</td>"+
            "<input type='hidden' class='programacion_id' value='"+r.programacion_id+"'>"+
            "<td>";
            html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableContenidoRespuesta tbody").html(html); 
    $("#TableContenidoRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
        
    });
};
</script>
