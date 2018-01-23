<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var EvaluacionG={id:0,programacion_unica_id:0,programacion_id:0,persona:'',fecha_reprogramada:''}; // Datos Globales
$(document).ready(function() {
    
    $(".fecha").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: true,
        time:true,
        minView:2,
        autoclose: true,
        todayBtn: false
    });
    
    $('#ModalEvaluacion').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax2();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax2();');
        }

        $('#ModalEvaluacionForm #txt_persona').val(EvaluacionG.persona);
        $('#ModalEvaluacionForm #txt_programacion_id').val(EvaluacionG.programacion_id);
        $('#ModalEvaluacionForm #txt_tipo_evaluacion_id').val(EvaluacionG.tipo_evaluacion_id);
        $('#ModalEvaluacionForm #txt_programacion_unica_id').val(EvaluacionG.programacion_unica_id);
        $('#ModalEvaluacionForm #txt_fecha_reprogramada_inicial').val( EvaluacionG.fecha_reprogramada );
        $('#ModalEvaluacionForm #txt_fecha_reprogramada_final').val( EvaluacionG.fecha_reprogramada );
    });

    $('#ModalEvaluacion').on('hidden.bs.modal', function (event) {
        $("#ModalEvaluacionForm input[type='hidden']").not('.mant').remove();
    });

});

ValidaForm2=function(){
    var r=true;
    
    if( $.trim( $("#ModalEvaluacionForm #txt_programacion_id").val() )=='' && AddEdit==0){
        r=false;
        msjG.mensaje('warning','Seleccione Alumno',4000);
    }
    else if( $.trim( $("#ModalEvaluacionForm #txt_fecha_reprogramada_inicial").val() )=='' || $.trim( $("#ModalEvaluacionForm #txt_fecha_reprogramada_final").val() )==''){
        r=false;
        msjG.mensaje('warning','Ingrese Rango de Fechas de Reprogramación',4000);
    }
    else if( $.trim( $("#ModalEvaluacionForm #txt_fecha_reprogramada_inicial").val() ) > $.trim( $("#ModalEvaluacionForm #txt_fecha_reprogramada_final").val() )){
        r=false;
        msjG.mensaje('warning','La fecha Inicial debe ser menor o igual a la Final',4000);
    }
    return r;
}

GenerarReprogramacion=function(val,programacion_unica_id,tipo_evaluacion_id){
         
    AddEdit=val;
    $("#ModalEvaluacionForm #individual").css("display","none");
    EvaluacionG.id='';
    EvaluacionG.persona='';
    EvaluacionG.programacion_id='';
    EvaluacionG.programacion_unica_id=programacion_unica_id;
    EvaluacionG.tipo_evaluacion_id=tipo_evaluacion_id;
    EvaluacionG.fecha_reprogramada='';

    if( val==0 ){
        $("#ModalEvaluacionForm #individual").css("display","");
        $("#ModalEvaluacionForm #btn_listarpersona").data( 'filtros', 'estado:1|programacion_unica_id:'+programacion_unica_id);
    }
    $('#ModalEvaluacion').modal('show');
}

AgregarEditarAjax2=function(){
    if( ValidaForm2() ){
        AjaxEvaluacion.AgregarEditar(HTMLAgregarEditar2);
    }
}

HTMLAgregarEditar2=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalEvaluacion').modal('hide');
        AjaxEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
    }
    else{
        msjG.mensaje('warning',result.msj,6000);
    }
}

HTMLCargarTipoEvaluacion=function(result){
    var programacion_unica_id = $("#EvaluacionForm #txt_programacion_unica_id").val();
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

          if(r.estado_cambio == 0 || r.estado_cambio == 3){
            html+='<button type="button" class="btn btn-default" onClick="GenerarReprogramacion(1,'+programacion_unica_id+','+r.id+')" style="font-weight: bold;">Masiva</button>'+
                  '<button type="button" class="btn btn-default" onClick="GenerarReprogramacion(0,'+programacion_unica_id+','+r.id+')" style="font-weight: bold;">Individual</button>';
          } else {
            html+='';
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
