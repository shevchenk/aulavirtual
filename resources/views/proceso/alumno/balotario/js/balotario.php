<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var BalotarioG={id:0,tipo_evaluacion_id:0,cantidad_maxima:'',cantidad_pregunta:'',estado:1}; // Datos Globales
$(document).ready(function() {
     $("#TableBalotario").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
//    $("#BalotarioForm #TableBalotario select").change(function(){ AjaxBalotario.Cargar(HTMLCargarBalotario); });
    $("#BalotarioForm #TableBalotario input").blur(function(){ AjaxBalotario.Cargar(HTMLCargarBalotario); });
    
    $('#ModalBalotario').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{

            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
            $("#ModalBalotarioForm").append("<input type='hidden' value='"+BalotarioG.id+"' name='id'>");
        }

        $('#ModalBalotarioForm #slct_tipo_evaluacion_id').selectpicker('val', BalotarioG.tipo_evaluacion_id );
        $('#ModalBalotarioForm #txt_cantidad_maxima').val( BalotarioG.cantidad_maxima );
        $('#ModalBalotarioForm #txt_cantidad_pregunta').val( BalotarioG.cantidad_pregunta );
        $('#ModalBalotarioForm #slct_estado').selectpicker( 'val',BalotarioG.estado );
    });

    $('#ModalBalotario').on('hidden.bs.modal', function (event) {
        $("#ModalBalotarioForm input[type='hidden']").not('.mant').remove();

    });

});

ValidaForm2=function(){
    var r=true;

    if( $.trim( $("#ModalBalotarioForm #slct_tipo_evaluacion_id").val() )=='0' ){
        r=false;
        msjG.mensaje('warning','Seleccione Tipo de Evaluacición',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #txt_cantidad_maxima").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cantidad Máxima de Preguntas',4000);
    }
    else if( $.trim( $("#ModalBalotarioForm #txt_cantidad_pregunta").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Cantidad de Preguntas',4000);
    }
    return r;
}

AgregarEditar2=function(val,id){
    AddEdit=val;
    BalotarioG.id='';
    BalotarioG.tipo_evaluacion_id='0';
    BalotarioG.cantidad_maxima='';
    BalotarioG.cantidad_pregunta='';
    BalotarioG.estado='1';

    if( val==0 ){

        BalotarioG.id=id;
        BalotarioG.tipo_evaluacion_id=$("#TableBalotario #trid_"+id+" .tipo_evaluacion_id").val();
        BalotarioG.cantidad_maxima=$("#TableBalotario #trid_"+id+" .cantidad_maxima").text();
        BalotarioG.cantidad_pregunta=$("#TableBalotario #trid_"+id+" .cantidad_pregunta").text();
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
        msjG.mensaje('warning',result.msj,2000);
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
            "<td class='tipo_evaluacion'>"+r.tipo_evaluacion+"</td>";
//            "<td>"+
//            "<input type='hidden' class='tipo_evaluacion_id' value='"+r.tipo_evaluacion_id+"'>";
//        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
        if(r.modo==0 || (r.cantidad_maxima==0 || r.cantidad_pregunta==0)){
            html+='<td></td>';
        }else{
            html+='<td><a class="btn btn-white" onClick="VerBalotario2('+r.id+')"><i class="fa fa-search fa-lg"></i>Ver Balotario</a></td>';
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

SlctCargarTipoEvaluacion=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.tipo_evaluacion+"</option>";
    });
    $("#ModalBalotario #slct_tipo_evaluacion_id").html(html);
    $("#ModalBalotario #slct_tipo_evaluacion_id").selectpicker('refresh');

};
CargarSlct=function(slct){
    if(slct==3){
    AjaxBalotario.CargarTipoEvaluacion(SlctCargarTipoEvaluacion);
    }
};
VerBalotario2=function(id){
         window.open("ReportDinamic/Mantenimiento.BalotarioEM@GenerarPDF?balotario_id="+id,
                "PrevisualizarPlantilla",
                "toolbar=no,menubar=no,resizable,scrollbars,status,width=900,height=700");
}
</script>
