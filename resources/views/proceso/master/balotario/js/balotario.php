<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var BalotarioG={id:0,tipo_evaluacion_id:0,unidad_contenido_id:'',tipo_evaluacion:'',cantidad_maxima:'',cantidad_pregunta:'',modo:0,estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableBalotario").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
    $("#BalotarioForm #TableBalotario select").change(function(){ AjaxBalotario.Cargar(HTMLCargarBalotario); });
    $("#BalotarioForm #TableBalotario input").blur(function(){ AjaxBalotario.Cargar(HTMLCargarBalotario); });
    
    $('#ModalBalotario').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{

            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalBalotarioForm").append("<input type='hidden' value='"+BalotarioG.id+"' name='id'>");
        }
        var unidad_contenido_id = BalotarioG.unidad_contenido_id.split(",");
        $('#ModalBalotarioForm #txt_tipo_evaluacion_id').val(BalotarioG.tipo_evaluacion_id );
        $('#ModalBalotarioForm #txt_tipo_evaluacion').val( BalotarioG.tipo_evaluacion );
        $('#ModalBalotarioForm #txt_cantidad_maxima').val( BalotarioG.cantidad_maxima );
        $('#ModalBalotarioForm #txt_cantidad_pregunta').val( BalotarioG.cantidad_pregunta );
        $('#ModalBalotarioForm #slct_unidad_contenido_id').selectpicker('val',unidad_contenido_id);
        $('#ModalBalotarioForm #slct_estado').selectpicker( 'val',BalotarioG.estado );
        if(BalotarioG.modo==1){
            $('#ModalBalotarioForm #txt_cantidad_maxima').prop('readonly', true);
        }
    });

    $('#ModalBalotario').on('hidden.bs.modal', function (event) {
        $("#ModalBalotarioForm input[type='hidden']").not('.mant').remove();

    });

});

ValidaForm2=function(){
    var r=true;

    if( $.trim( $("#ModalBalotarioForm #txt_cantidad_maxima").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cantidad de Preguntas de Balotario',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )=='' || $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )<4){
        r=false;
        msjG.mensaje('warning','Ingrese Cantidad de Preguntas de Evaluación mayor o igual a 4',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )!=4 && $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )!=5 && 
             $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )!=10 && $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )!=20 ){
        r=false;
        msjG.mensaje('warning','Cantidad de Preguntas de Evaluación debe ser múltiplo de 20',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #txt_cantidad_maxima").val() ) < $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() ) ){
        r=false;
        msjG.mensaje('warning','Cantidad de Preguntas de Balotario debe ser mayor o igual a Cantidad de Preguntas de Evaluación',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #slct_unidad_contenido_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Seleccione Unidades de Contenido',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    BalotarioG.id='';
    BalotarioG.tipo_evaluacion_id='0';
    BalotarioG.tipo_evaluacion='';
    BalotarioG.cantidad_maxima='';
    BalotarioG.cantidad_pregunta='';
    BalotarioG.unidad_contenido_id='';
    BalotarioG.modo='';
    BalotarioG.estado='1';

    if( val==0 ){

        BalotarioG.id=id;
        BalotarioG.tipo_evaluacion_id=$("#TableBalotario #trid_"+id+" .tipo_evaluacion_id").val();
        BalotarioG.cantidad_maxima=$("#TableBalotario #trid_"+id+" .cantidad_maxima").text();
        BalotarioG.tipo_evaluacion=$("#TableBalotario #trid_"+id+" .tipo_evaluacion").text();
        BalotarioG.cantidad_pregunta=$("#TableBalotario #trid_"+id+" .cantidad_pregunta").text();
        BalotarioG.unidad_contenido_id=$("#TableBalotario #trid_"+id+" .unidad_contenido_id").val();
        BalotarioG.modo=$("#TableBalotario #trid_"+id+" .modo").val();
        BalotarioG.estado=$("#TableBalotario #trid_"+id+" .estado").val();

    }
    $('#ModalBalotario').modal('show');
}

CambiarEstado2=function(estado,id){
        AjaxBalotario.CambiarEstado(HTMLCambiarEstado2,estado,id);
}

HTMLCambiarEstado2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxBalotario.Cargar(HTMLCargarBalotario);
    }
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxBalotario.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalBalotario').modal('hide');
        AjaxBalotario.Cargar(HTMLCargarBalotario);
    }
    else{
        msjG.mensaje('warning',result.msj,2000);
    }
}

GenerarBalotario2=function(id){
        AjaxBalotario.GenerarBalotario(HTMLGenerarBalotario2,id);
}

HTMLGenerarBalotario2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxBalotario.Cargar(HTMLCargarBalotario);
    }
    else{
        msjG.mensaje('warning',result.msj,6000);
    }
}

HTMLCargarBalotario=function(result){
    var html="";
    $('#TableBalotario').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado2(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='cantidad_maxima'>"+r.cantidad_maxima+"</td>"+
            "<td class='cantidad_pregunta'>"+r.cantidad_pregunta+"</td>"+
            "<td class='tipo_evaluacion'>"+
            "<input type='hidden' class='modo' value='"+r.modo+"'>"+
            "<input type='hidden' class='tipo_evaluacion_id' value='"+r.tipo_evaluacion_id+"'><input type='hidden' class='unidad_contenido_id' value='"+r.unidad_contenido_id+"'>"+r.tipo_evaluacion+"</td>";
//            "<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
        html+='<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar2(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        if(r.cantidad_maxima!=0 && r.cantidad_pregunta!=0){
        if(r.modo==0){
            html+='<td><a class="btn btn-info" onClick="GenerarBalotario2('+r.id+')"><i class="fa fa-edit fa-lg"></i>Generar Balotario</a></td>';
        }else{
            html+='<td><a class="btn btn-white" onClick="VerBalotario2('+r.id+')"><i class="fa fa-search fa-lg"></i>Ver Balotario</a></td>';
        }}else{
             html+='<td></td>';
        }
        html+="</tr>";
    });
    $("#TableBalotario tbody").html(html); 
    $("#TableBalotario").DataTable({
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
            $('#TableBalotario_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarBalotario','AjaxBalotario',result.data,'#TableBalotario_paginate');
        }
    });
};
HTMLCargarUnidadPregunta=function(result){
    var html="";
    $('#TableUnidadPregunta').DataTable().destroy();

    $.each(result.data,function(index,r){
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='unidad_contenido'>"+r.unidad_contenido+"</td>"+
            "<td class='cant'>"+r.cant+"</td>";
        html+="</tr>";
    });
    $("#TableUnidadPregunta tbody").html(html); 
    $("#TableUnidadPregunta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
        
    });
};

SlctCargarUnidadContenido=function(result){
    var html="";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.unidad_contenido+"</option>";
    });
    $("#ModalBalotarioForm #slct_unidad_contenido_id").html(html);
    $("#ModalBalotarioForm #slct_unidad_contenido_id").selectpicker('refresh');

};
CargarSlct=function(slct){
    if(slct==1){
    AjaxBalotario.CargarUnidadContenido(SlctCargarUnidadContenido);
    }
};
VerBalotario2=function(id){
         window.open("ReportDinamic/Mantenimiento.BalotarioEM@GenerarPDF?balotario_id="+id,
                "PrevisualizarPlantilla",
                "toolbar=no,menubar=no,resizable,scrollbars,status,width=900,height=700");
}
</script>
