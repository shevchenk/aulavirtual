<script type="text/javascript">
$(document).ready(function() {
    
    $('#ModalCopiaContenido').on('shown.bs.modal', function (event) {

        $(this).find('.modal-footer .btn-primary').text('Replicar').attr('onClick','AgregarEditarAjax4();');

    });

    $('#ModalCopiaContenido').on('hidden.bs.modal', function (event) {
        $("#ModalCopiaContenidoForm input[type='hidden']").not('.mant').remove();
    });
});

ValidaForm4=function(){
    var r=true;

    if( $.trim( $("#ModalCopiaContenidoForm #txt_programacion_unica_id").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Error',4000);
    }
    return r;
}


AgregarEditarAjax4=function(){
    if( ValidaForm4() ){
        AjaxCopiaContenido.AgregarEditar(HTMLAgregarEditar4);
    }
}

HTMLAgregarEditar4=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalCopiaContenido').modal('hide');
        AjaxContenido.Cargar(HTMLCargarContenido);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarCopiaContenido=function(result){
    var html="";
    $.each(result.data,function(index,r){
        estadohtml='onClick="CambiarEstado3(1,'+r.id+')"';
        if(r.estado==1){
            estadohtml='onClick="CambiarEstado3(0,'+r.id+')"';
        }
        if(index==0){
            html+='<div class="col-md-12">';
        }
        html+='<div class="col-lg-6" id="trid_'+r.id+'" style="margin-top: 15px; -moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888;">'+
               '<input type="hidden" class="ruta_contenido" value="'+r.ruta_contenido+'">'+
               '<input type="hidden" class="fecha_inicio" value="'+r.fecha_inicio+'">'+
               '<input type="hidden" class="fecha_final" value="'+r.fecha_final+'">'+
               '<input type="hidden" class="fecha_ampliada" value="'+r.fecha_ampliada+'">'+
               '<input type="hidden" class="tipo_respuesta" value="'+r.tipo_respuesta+'">'+
               '<input type="hidden" class="referencia" value="'+r.referencia+'">'+
               '<input type="hidden" class="estado" value="'+r.estado+'">'+
               '<div class="row">'+
                    '<div class="col-md-12">'+
                            '<div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                                '<p>'+r.curso+'</p>'+
                                "<small><input type='checkbox' name='id[]' id='id' value='"+r.id+"' class='flat '></small>"+
                            '</div>'+
                        '</div>'+
                    '<div class="col-md-5 text-center" style="border-right: 2px solid #e9e9e9;">'+
                            '<a href="file/content/'+r.ruta_contenido+'" target="blank"><img class="img-responsive" src="img/course/'+r.foto+'" alt="" width="100%" height="" style="margin:10px auto;"></a>'+
                        '</div>'+
                    '<div class="col-md-7" style="border-left: 2px solid #e9e9e9;">'+
                        '<div class="text-justify" style="margin-bottom: 15px; margin-top:10px; font-size: 15px; padding: 5px 5px; background-color: #F5F5F5; border-radius: 10px; border: 3px solid #F8F8F8;">'+
                            '<p class="contenido">'+r.contenido+'</p>'+
                        '</div>';

                if(r.tipo_respuesta == 1){
                 html+='<div>'+
                            '<p style="font-weight: normal;">'+
                                '<label style="font-weight: bold;">Fecha Ini. : </label> '+r.fecha_inicio+'</br>'+
                                '<label style="font-weight: bold;">Fecha Fin. : </label> '+r.fecha_final+'</br>'+
                                '<label style="font-weight: bold;">Fecha Amp. : </label> '+ r.fecha_ampliada +
                            '</p>'+
                        '</div>';
                }else{
                  html+='<div style="height: 85px;"></div>';
                }

                html+='</div>'+
                '</div>';

                if(r.referencia)
                {
                  var res_uri = r.referencia.split("|");
                  html+='<div class="row">'+
                            '<div class="col-md-12 btn-default" style="font-weight: normal; padding-right: 5px; padding-left: 5px; margin-top: 5px; overflow:hidden;">'+
                                '';
                                for (i = 0; i < res_uri.length; i++) {
                                  html+='<span class="fa fa-book fa-lg"></span> <a href="http://'+res_uri[i]+'" target="blank">'+ res_uri[i] +'</a><br/>';
                                }
                      html+='</div>'+
                        '</div>';
                }
           html+='</div>';
        if((index+1)%2==0){
            html+='</div>';
            html+='<div class="col-md-12">';
        }
    });
    if(result.data.length>0){
        html+='</div>';
    }
    $("#DivCopiaContenido").html(html);
    $('#ModalCopiaContenidoForm input[type="checkbox"].flat').iCheck({
          checkboxClass: 'icheckbox_flat-green'
    })
};
CargarCopiaContenido=function(id,curso_id){   
     $("#ModalCopiaContenidoForm #txt_programacion_unica_id").val(id);
     $("#ModalCopiaContenidoForm #txt_curso_id").val(curso_id);
     AjaxCopiaContenido.Cargar(HTMLCargarCopiaContenido);
     $("#ModalCopiaContenido").modal('show');
     
};
</script>
