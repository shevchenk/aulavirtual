<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var BalotarioG={id:0,tipo_evaluacion_id:0,tipo_evaluacion:'',cantidad_maxima:'',cantidad_pregunta:'',estado:1}; // Datos Globales
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

        $('#ModalBalotarioForm #txt_tipo_evaluacion_id').val(BalotarioG.tipo_evaluacion_id );
        $('#ModalBalotarioForm #txt_tipo_evaluacion').val( BalotarioG.tipo_evaluacion );
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

    if( $.trim( $("#ModalBalotarioForm #txt_cantidad_maxima").val() )=='' ){
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
    BalotarioG.tipo_evaluacion='';
    BalotarioG.cantidad_maxima='';
    BalotarioG.cantidad_pregunta='';
    BalotarioG.estado='1';

    if( val==0 ){

        BalotarioG.id=id;
        BalotarioG.tipo_evaluacion_id=$("#TableBalotario #trid_"+id+" .tipo_evaluacion_id").val();
        BalotarioG.cantidad_maxima=$("#TableBalotario #trid_"+id+" .cantidad_maxima").text();
        BalotarioG.tipo_evaluacion=$("#TableBalotario #trid_"+id+" .tipo_evaluacion").text();
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
            "<td class='tipo_evaluacion'><input type='hidden' class='tipo_evaluacion_id' value='"+r.tipo_evaluacion_id+"'>"+r.tipo_evaluacion+"</td>";
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

SlctCargarTipoEvaluacion=function(result){
    var html="<option value='0'>.::Seleccione::.</option>";
    $.each(result.data,function(index,r){
        html+="<option value="+r.id+">"+r.tipo_evaluacion+"</option>";
    });
    $("#ModalBalotario #slct_tipo_evaluacion_id").html(html);
    $("#ModalBalotario #slct_tipo_evaluacion_id").selectpicker('refresh');

};

VerBalotario2=function(id){
         window.open("ReportDinamic/Mantenimiento.BalotarioEM@GenerarPDF?balotario_id="+id,
                "PrevisualizarPlantilla",
                "toolbar=no,menubar=no,resizable,scrollbars,status,width=900,height=700");
}

HTMLCargarTipoEvaluacion=function(result){
    var programacion_id = $("#EvaluacionForm #txt_programacion_id").val();
    var programacion_unica_id = $("#EvaluacionForm #txt_programacion_unica_id").val();
    var curso = $("#EvaluacionForm #txt_curso").val();
    var html="";

    $.each(result.data.data,function(index, r){
        if(index == 0){
          html+='<div class="col-md-12">';
        }

        html+='<div class="col-lg-4">'+
            '<div class="panel panel-primary rotar" style="-moz-box-shadow: 0 0 7px #337ab7; -webkit-box-shadow: 0 0 7px #337ab7; box-shadow: 0 0 7px #337ab7;">'+
              '<div class="panel-heading text-center" style="text-transform: uppercase; text-shadow: 2px 2px 4px #FFFFFF;">'+
                '<h2 class="panel-title" style="font-size: 18px;">'+r.tipo_evaluacion+'</h2>'+
              '</div>'+
              '<div class="panel-body text-center">';

          if(r.estado_cambio == 0){
            html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-default" onClick="iniciarEvaluacion('+r.id+','+programacion_id+','+programacion_unica_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Masiva</button>'+
                  '<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-default" onClick="iniciarEvaluacion('+r.id+','+programacion_id+','+programacion_unica_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Individual</button>';
          } else {
            html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-primary" onClick="verEvaluacion('+r.evaluacion_id+','+programacion_id+',\''+r.tipo_evaluacion+'\',\''+curso+'\')" style="font-weight: bold;">Ver Resultados</button>';
          }
        html+='</div>'+
            '</div>'+
          '</div>';

        if((index+1) % 3 == 0){
            html+='</div>';
            html+='<div class="col-md-12">';
        }
    });
    if(result.data.length>0){
        html+='</div>';
    }
    $("#DivContenido").html(html);
};
</script>
