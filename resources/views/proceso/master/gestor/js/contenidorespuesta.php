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
        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='alumno'>"+r.alumno+"</td>"+
            "<td class='respuesta'>"+r.respuesta+"</td>"+
            "<td class='ruta_respuesta'><a href='file/content/"+r.ruta_respuesta+"' target='blank'>"+r.ruta_respuesta+"</a></td>"+
            "<td class='created_at'>"+r.created_at+"</td>";
        /*if (r.nota != null) {
            html+='<td class="nota">'+r.nota+'</td>';
            html+='<td class="nota"><button type="button" onClick="" class="btn btn-default" disabled>Guardar</button></td>';          
        } else {*/
            html+='<td class="nota"><input type="number" class="form-control" id="nota'+r.id+'" name="nota'+r.id+'" style="width: 30%;" value="'+(r.nota*1)+'" max="99"></td>';
            html+='<td class="nota"><button type="button" onClick="guardarNotaRpta('+r.id+', '+r.contenido_id+');" class="btn btn-primary">Guardar</button></td>';
        //}

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

    $("#ContenidoRespuestaForm #txt_contenido_id").val(contenido_id);
    $("#ContenidoRespuestaForm #txt_contenido_respuesta_id").val(id);
    $("#ContenidoRespuestaForm #txt_nota_cr").val($('#nota'+id).val());

    swal({
      title: "¿Confirmación?",   
      text: "Desea guardar la nota, no podrá reversar los cambios...!",   
      //type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#8CD4F5",
      confirmButtonText: "Continuar!",
      closeOnConfirm: true
    },
    function(){
        //alert($('#nota'+id).val());
        AjaxContenidoRespuesta.GuardarNotaRpta(HTMLGuardarNotaRpta);
    });
    
};

HTMLGuardarNotaRpta=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        //var id = $("#ContenidoRespuestaForm #txt_contenido_id").val();
        AjaxContenidoRespuesta.Cargar(HTMLCargarContenidoRespuesta);
    }
}
</script>
