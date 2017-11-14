<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoProgramacionG={id:0,programacion_id:0,persona:'',fecha_ampliacion:'',estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableContenidoProgramacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $('#ModalContenidoProgramacion').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{
            
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalContenidoProgramacionForm").append("<input type='hidden' value='"+ContenidoProgramacionG.id+"' name='id'>");
        }

        $('#ModalContenidoProgramacionForm #txt_persona').val(ContenidoProgramacionG.persona);
        $('#ModalContenidoProgramacionForm #txt_programacion_id').val(ContenidoProgramacionG.programacion_id);
        $('#ModalContenidoProgramacionForm #txt_fecha_ampliacion').val( ContenidoProgramacionG.fecha_ampliacion );
        $('#ModalContenidoProgramacionForm #slct_estado').selectpicker( 'val',ContenidoProgramacionG.estado );
        //$('#ModalContenidoProgramacionForm #txt_razon_social').focus();
    });

    $('#ModalContenidoProgramacion').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoProgramacionForm input[type='hidden']").not('.mant').remove();
    });
});

ValidaForm2=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoProgramacionForm #txt_programacion_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Alumno',4000);
    }
    else if( $.trim( $("#ModalContenidoProgramacionForm #txt_fecha_ampliacion").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha de Ampliación',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    ContenidoProgramacionG.id='';
    ContenidoProgramacionG.persona='';
    ContenidoProgramacionG.programacion_id='';
    ContenidoProgramacionG.fecha_ampliacion='';
    ContenidoProgramacionG.estado='1';

    if( val==0 ){

        ContenidoProgramacionG.id=id;
        ContenidoProgramacionG.persona=$("#TableContenidoProgramacion #trid_"+id+" .alumno").text();
        ContenidoProgramacionG.programacion_id=$("#TableContenidoProgramacion #trid_"+id+" .programacion_id").val();
        ContenidoProgramacionG.fecha_ampliacion=$("#TableContenidoProgramacion #trid_"+id+" .fecha_ampliacion").text();
        ContenidoProgramacionG.estado=$("#TableContenidoProgramacion #trid_"+id+" .estado").val();


    }
    $('#ModalContenidoProgramacion').modal('show');
}

CambiarEstado2=function(estado,id){
    sweetalertG.confirm("¿Estás seguro?", "Confirme la eliminación", function(){
       AjaxContenidoProgramacion.CambiarEstado(HTMLCambiarEstado2,estado,id);
    });
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxContenidoProgramacion.Cargar(HTMLCargarContenidoProgramacion);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxContenidoProgramacion.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalContenidoProgramacion').modal('hide');
        AjaxContenidoProgramacion.Cargar(HTMLCargarContenidoProgramacion);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarContenidoProgramacion=function(result){
    var html="";
    $('#TableContenidoProgramacion').DataTable().destroy();

    $.each(result.data,function(index,r){
        estadohtml='<a id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>';
        if(r.estado==1){
            estadohtml='<a id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='alumno'>"+r.alumno+"</td>"+
            "<td class='fecha_ampliacion'>"+r.fecha_ampliacion+"</td>"+
            "<input type='hidden' class='programacion_id' value='"+r.programacion_id+"'>"+
            "<td>";
            html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
//            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableContenidoProgramacion tbody").html(html); 
    $("#TableContenidoProgramacion").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
        
    });
};
</script>
