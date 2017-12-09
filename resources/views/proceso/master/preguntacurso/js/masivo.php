<script type="text/javascript">
$(document).ready(function() {

    $("#log_fallas").hide();

    $('#btn_cargar').on('click', function(){
    	$(this).prop('disabled', true).html('<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Procesando..');
    	Cargar.Programacion();
    });
    $('#ModalMasivo').on('hidden.bs.modal', function (event) {
        $("#ModalMasivoForm input").not('.mant').val('');
        $('#resultado').html('<td>&nbsp;</td>');
        $("#log_fallas").hide();
    });
});

HTMLMsg=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
    }
    else if( result.rst==2 ){
        $("#log_fallas").show();
        $('#resultado').html('<tr><td style="text-align: center; font-weight: bold; color: red;">'+result.no_pasa+' filas</td></tr>');
        msjG.mensaje('warning',result.msj,4000);
        var html_rl = '<tr><td style="text-align: center; font-weight: bold; color: red;"><pre>';
            html_rl += result.error_carga;
            html_rl += '</pre></td></tr>';
        $('#resultado_log').html(html_rl);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

</script>
