<script type="text/javascript">
$(document).ready(function() {
    $("#MyselfForm #txt_password").focus();
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#MyselfForm #txt_password").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Contraseña',4000);
    }
    else if( $.trim( $("#MyselfForm #txt_password_confirm").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Confirmación de Contraseña',4000);
    }
    else if( $.trim( $("#MyselfForm #txt_password_actual").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese su Contraseña Actual',4000);
    }
    else if( $.trim( $("#MyselfForm #txt_password_confirm").val() ) != 
             $.trim( $("#MyselfForm #txt_password").val() ) 
    ){
        r=false;
        msjG.mensaje('warning','Contraseña y Contraseña de confirmación no son'+
                     ' iguales',4000);
    }
    return r;
}

EditarAjax=function(){
    if( ValidaForm() ){
        MyselfAjax.Editar(HTMLEditar);
    }
}

HTMLEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $("#MyselfForm input").val('');
        $("#MyselfForm #txt_password").focus();
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}
</script>
