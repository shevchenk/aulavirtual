<script type="text/javascript">
var Cargar={
    Programacion:function(evento){
        var data = new FormData($("#ModalMasivoForm")[0]);
        $.ajax({
            url     : 'AjaxDinamic/Proceso.CargaPR@CargaPreguntaRespuesta',
            type    : 'POST',
            data    : data,
            async   : true,
            success : function (obj) { HTMLMsg(obj); $('#btn_cargar').prop('disabled', false).html('<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar'); },
            error   : function(jqXHR, textStatus, error){ alert(jqXHR.responseText); },
            cache   : false,
            contentType: false,
            processData: false
        });
    }
};
</script>
