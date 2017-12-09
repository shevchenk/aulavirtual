<script type="text/javascript">
var ContenidoG={}; // Datos Globales
$(document).ready(function() {

  $('#div_contenido_respuesta').hide();

});

HTMLCargarTipoEvaluacion=function(result){
    var html="";
    //console.log(result.data.data);
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

                html+='<button type="button" id="btniniciareval" name="btniniciareval" class="btn btn-default" onClick="iniciarEvaluacion('+r.id+')" style="font-weight: bold;">Iniciar Evaluación</button>';

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


iniciarEvaluacion=function(){
  $("#TipoEvaluacionForm").slideUp('slow');
  $("#EvaluacionForm").slideUp('slow');

  //var html = '';
  var html = '<div class="panel panel-primary">'+
              '<div class="panel-heading" >'+
                  '<label>PCI</label> <label>CURSO</label> <label>HORA</label>'+
              '</div>'+
              '<div class="box-body table-responsive no-padding">'+
                '<div class="col-md-12">'+
                'EN CONSTRUCCIÓN...'+
                '</div>'+
              '</div>'+
            '</div>';

  $("#resultado").html(html)
  $("#ResultEvaluacion").slideDown('slow');

};

</script>
