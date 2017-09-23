<script type="text/javascript">
$(document).ready(function() {  
    $("#btnIniciar").click(IniciarSession);
    $("#mensaje_msj").fadeOut(3500);
});

IniciarSession=function(){
    if($.trim($("#dni").val())==''){
        msjG.mensaje('warning',"Ingrese su <strong>Usuario</strong>",3000);
    }
    else if($.trim($("#password").val())==''){
        msjG.mensaje('warning',"Ingrese su <strong>Password</strong>",3000);
    }
    else{
        AjaxLogin.IniciarLogin(HTMLIniciarLogin);
    }
}

HTMLIniciarLogin=function(result){
    if( result.rst==1 ){
        window.location='secureaccess.inicio';
    }
}

var masterG={
    postAjax:function(url,data,eventsucces,eventbefore){
      $.ajax({
            url         : url,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $(".content .box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                if( typeof eventbefore!= 'undefined' ){
                  eventbefore();
                }
            },
            success : function(r) {
                $(".content .box .overlay").remove();
                  eventsucces(r);
            },
            error: function(result){
                $(".content .box .overlay").remove();
                if( typeof(result.status)!='undefined' && result.status==422 && result.statusText=='Unprocessable Entity' ){
                    msjG.mensaje('warning','Dni o Password Inválido',4000);
                }
                else{
                    msjG.mensaje('danger','',4000);
                }
            }
        });
    },
    enterGlobal:function(e,etiqueta,selecciona){
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==13){
            e.preventDefault();
            $(etiqueta).click(); 
            if( typeof(selecciona)!='undefined' ){
                $(etiqueta).focus(); 
            }
        }
    }
}

var msjG = {
    mensaje: function (tipo, texto, tiempo) {
      var img=tipo;
        if(tipo=="success"){
          img="check";
        }
        else if(tipo=="danger"){
          img="ban";
        }
        if (tipo == 'danger' && texto.length == 0) {
            texto = 'Ocurrio una interrupción en el proceso, favor de intentar nuevamente.';
        }
        etiqueta='msjG';
        $('.'+etiqueta).html('<div class="alert alert-dismissable alert-' + tipo + '">' +
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                '<h4><i class="icon fa fa-'+img+'"> '+texto+'</h4>'+
                '</div>');
        $('.'+etiqueta).slideToggle(500);
        $('.'+etiqueta).fadeOut(tiempo);
    },
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
