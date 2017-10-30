<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ContenidoG={id:0,curso_id:0,contenido:'',ruta_contenido:'',tipo_respuesta:0,fecha_inicio:'',
fecha_final:'',fecha_ampliada:'',estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableContenido").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    
    $(".fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: true,
        time:true,
        minView:2,
        autoclose: true,
        todayBtn: false
    }); 
    CargarSlct(1); //Cursos
    $('#ModalContenido').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax3();');
        }
        else{
            
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax3();');
            $("#ModalContenidoForm").append("<input type='hidden' value='"+ContenidoG.id+"' name='id'>");
        }

        $('#ModalContenidoForm #slct_curso_id').selectpicker('val', ContenidoG.curso_id );
        $('#ModalContenidoForm #txt_contenido').val( ContenidoG.contenido );
        $('#ModalContenidoForm #txt_ruta_contenido').val( ContenidoG.ruta_contenido );
        $('#ModalContenidoForm #slct_tipo_respuesta').selectpicker('val', ContenidoG.tipo_respuesta );
        $('#ModalContenidoForm #txt_fecha_inicio').val( ContenidoG.fecha_inicio );
        $('#ModalContenidoForm #txt_fecha_final').val( ContenidoG.fecha_final );
        $('#ModalContenidoForm #txt_fecha_ampliada').val( ContenidoG.fecha_ampliada );
        $('#ModalContenidoForm #slct_estado').selectpicker( 'val',ContenidoG.estado );
        //$('#ModalContenidoForm #txt_razon_social').focus();
    });

    $('#ModalContenido').on('hidden.bs.modal', function (event) {
        $("#ModalContenidoForm input[type='hidden']").not('.mant').remove();
    });
});

ValidaForm3=function(){
    var r=true;

    if( $.trim( $("#ModalContenidoForm #slct_curso_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Curso',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Contenido',4000);
    }
     else if( $.trim( $("#ModalContenidoForm #txt_ruta_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Ruta de Contenido',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #slct_tipo_respuesta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Respuesta',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_inicio").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Inicio',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_final").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Final',4000);
    }
    else if( $.trim( $("#ModalContenidoForm #txt_fecha_ampliada").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Fecha Ampliada',4000);
    }
    return r;
}

AgregarEditar3=function(val,id){
    AddEdit=val;
    ContenidoG.id='';
    ContenidoG.curso_id='0';
    ContenidoG.contenido='';
    ContenidoG.ruta_contenido='';
    ContenidoG.tipo_respuesta='';
    ContenidoG.fecha_inicio='';
    ContenidoG.fecha_final='';
    ContenidoG.fecha_ampliada='';
    ContenidoG.estado='1';

    if( val==0 ){

        ContenidoG.id=id;
        ContenidoG.curso_id=$("#TableContenido #trid_"+id+" .curso_id").val();
        ContenidoG.contenido=$("#TableContenido #trid_"+id+" .contenido").text();
        ContenidoG.ruta_contenido=$("#TableContenido #trid_"+id+" .ruta_contenido").text();
        ContenidoG.tipo_respuesta=$("#TableContenido #trid_"+id+" .tipo_respuesta").val();
        ContenidoG.fecha_inicio=$("#TableContenido #trid_"+id+" .fecha_inicio").text();
        ContenidoG.fecha_final=$("#TableContenido #trid_"+id+" .fecha_final").text();
        ContenidoG.fecha_ampliada=$("#TableContenido #trid_"+id+" .fecha_ampliada").text();
        ContenidoG.estado=$("#TableContenido #trid_"+id+" .estado").val();


    }
    $('#ModalContenido').modal('show');
}

CambiarEstado3=function(estado,id){
    AjaxContenido.CambiarEstado(HTMLCambiarEstado3,estado,id);
}

HTMLCambiarEstado3=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxContenido.Cargar(HTMLCargarContenido);
    }
}

AgregarEditarAjax3=function(){
    if( ValidaForm3() ){
        AjaxContenido.AgregarEditar(HTMLAgregarEditar3);
    }
}

HTMLAgregarEditar3=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalContenido').modal('hide');
        AjaxContenido.Cargar(HTMLCargarContenido);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarContenido=function(result){
    var html="";
    $('#TableContenido').DataTable().destroy();

    $.each(result.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado3(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado3(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='curso'>"+r.curso+"</td>"+
            "<td class='contenido'>"+r.contenido+"</td>"+
            "<td class='ruta_contenido'>"+r.ruta_contenido+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>"+
            "<td class='fecha_ampliada'>"+r.fecha_ampliada+"</td>"+
            "<input type='hidden' class='tipo_respuesta' value='"+r.tipo_respuesta+"'>"+
            "<input type='hidden' class='curso_id' value='"+r.curso_id+"'>"+
            "<td>";
            html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar3(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>'+
            '<td><a class="btn btn-primary btn-sm" onClick="CargarContenidoRespuesta('+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableContenido tbody").html(html); 
    $("#TableContenido").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
        
    });
};
CargarSlct=function(slct){
    if(slct==1){
    AjaxContenido.CargarCurso(SlctCargarCurso);
    }
};
SlctCargarCurso=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.curso+"</option>";
    });
    $("#ModalContenidoForm #slct_curso_id").html(html);
    $("#ModalContenidoForm #slct_curso_id").selectpicker('refresh');

};
CargarContenidoRespuesta=function(id){
     $("#ContenidoRespuestaForm #txt_contenido_id").val(id);
     $("#ModalContenidoRespuestaForm #txt_contenido_id").val(id);
     AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
     $("#ContenidoRespuestaForm").css("display","");
     
};
</script>
