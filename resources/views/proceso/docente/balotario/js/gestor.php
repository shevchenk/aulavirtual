<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var ProgramacionUnicaG={id:0,tipo_respuesta:"",estado:1}; // Datos Globales
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

CargarBalotario=function(id,curso_id,curso,imagen,boton){   
     masterG.pintar_fila(boton);
     $("#BalotarioForm #txt_programacion_unica_id").val(id);
     $("#ModalBalotarioForm #txt_programacion_unica_id").val(id);
     $("#ModalBalotarioForm #txt_curso_id").val(curso_id);
     $("#ModalBalotarioForm #txt_curso").val(curso);
     $("#imageCurso").attr("src","img/course/"+imagen);
     CargarSlct(1);
     AjaxBalotario.Cargar(HTMLCargarBalotario);
     AjaxBalotario.CargarUnidadPregunta(HTMLCargarUnidadPregunta,curso_id);
     $("#BalotarioForm").css("display","");
};

HTMLCargarProgramacionUnica=function(result){
    var html="";
    $('#TableProgramacionUnica').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){

        html+='<tr id="trid_'+r.id+'" onClick="CargarBalotario('+r.id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto_cab+'\',this)">'+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='curso'>"+
            //"<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 40px;width: 40px;'>"+
            "&nbsp"+r.curso+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>";
//            '<td><a class="btn btn-info btn-sm" onClick="CargarBalotario('+r.id+','+r.curso_id+',\''+r.curso+'\',this)"><i class="fa fa-th-list fa-lg"></i> </a></td>';
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
