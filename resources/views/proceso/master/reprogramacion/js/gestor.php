<script type="text/javascript">
$(document).ready(function() {

    $("#TableProgramacionUnica").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    
    AjaxProgramacionUnica.Cargar(HTMLCargarProgramacionUnica);
    
    $("#ProgramacionUnicaForm #TableProgramacionUnica select").change(function(){ AjaxProgramacionUnica.Cargar(HTMLCargarProgramacionUnica); });
    $("#ProgramacionUnicaForm #TableProgramacionUnica input").blur(function(){ AjaxProgramacionUnica.Cargar(HTMLCargarProgramacionUnica); });
    
});

CargarEvaluacion=function(id, curso_id,curso, imagen, boton){
     masterG.pintar_fila(boton);
     $("#imageCurso").attr("src","img/course/"+imagen);
     $("#EvaluacionForm #txt_programacion_unica_id").val(id);
     AjaxEvaluacion.Cargar(HTMLCargarTipoEvaluacion);
     $("#EvaluacionForm").css("display","");
};

HTMLCargarProgramacionUnica=function(result){
    var html="";
    $('#TableProgramacionUnica').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
                                        
        html+='<tr id="trid_'+r.id+'" onClick="CargarEvaluacion('+r.id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto_cab+'\',this)">'+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='curso'>"+
            "<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 50px;width: 50px;'>"+
            "&nbsp</a>"+r.curso+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>";
        html+="</tr>";
    });
    $("#TableProgramacionUnica tbody").html(html); 
    $("#TableProgramacionUnica").DataTable({
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
            $('#TableProgramacionUnica_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarProgramacionUnica','AjaxProgramacionUnica',result.data,'#TableProgramacionUnica_paginate');
        }
    });

};

</script>
