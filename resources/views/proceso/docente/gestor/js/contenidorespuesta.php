<script type="text/javascript">

$(document).ready(function() {
     $("#TableContenidoRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

});


HTMLCargarContenidoRespuesta=function(result){
    var html="";
    $('#TableContenidoRespuesta').DataTable().destroy();    

    $.each(result.data,function(index,r) {
        if(r.nota != null)
            var nota = r.nota;
        else
            var nota = '';

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='alumno'>"+r.alumno+"</td>"+
            "<td class='respuesta'>"+r.respuesta+"</td>"+
            "<td class='ruta_respuesta'><a href='file/content/"+r.ruta_respuesta+"' target='blank'>"+r.ruta_respuesta+"</a></td>"+
            "<td class='created_at'>"+r.created_at+"</td>"+
            '<td class="nota"><textarea class="form-control" id="nota'+r.id+'" name="nota'+r.id+'" rows="4" style="width: 100%;">'+nota+'</textarea></td>'+
            '<td class="nota"><button type="button" onClick="guardarNotaRpta('+r.id+', '+r.contenido_id+');" class="btn btn-primary" style="margin-top: 20%;">Guardar</button></td>';
        html+="</tr>";
    });
    $("#TableContenidoRespuesta tbody").html(html); 
    $("#TableContenidoRespuesta").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
        
    });
};


guardarNotaRpta=function(id, contenido_id){
    //alert($('#nota'+id).val());
    $("#ContenidoRespuestaForm #txt_contenido_id").val(contenido_id);
    $("#ContenidoRespuestaForm #txt_contenido_respuesta_id").val(id);
    $("#ContenidoRespuestaForm #txt_nota_cr").val($('#nota'+id).val());
    AjaxContenidoRespuesta.GuardarNotaRpta(HTMLGuardarNotaRpta);
};

/*CambiarEstado=function(estado,id){
    AjaxTipoEvaluacion.CambiarEstado(HTMLCambiarEstado,estado,id);
}*/

HTMLGuardarNotaRpta=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        //var id = $("#ContenidoRespuestaForm #txt_contenido_id").val();
        AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
    }
}
</script>
