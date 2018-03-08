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

CargarContenido=function(id,curso_id,curso,imagen,boton){   
     masterG.pintar_fila(boton);
     CargarSlct(2);
     $("#ContenidoForm #txt_programacion_unica_id").val(id);
     $("#ModalContenidoForm #txt_programacion_unica_id").val(id);
     $("#ModalContenidoForm #txt_curso_id").val(curso_id);
     $("#ModalContenidoForm #txt_curso").val(curso);
     $("#imageCurso").attr("src","img/course/"+imagen);
     AjaxContenido.Cargar(HTMLCargarContenido);
     $("#ContenidoForm").css("display","");
     $("#ContenidoProgramacionForm").css("display","none");
     $("#btn_replicar").attr("onclick",'CargarCopiaContenido('+id+','+curso_id+')');
     
};

CambiarTemplate=function(estado,id){
   // sweetalertG.confirm("¿Estás seguro?", "Confirme la eliminación", function(){
        AjaxProgramacionUnica.CambiarTemplate(HTMLCambiarTemplate,estado,id);
   // });
};

HTMLCambiarTemplate=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxProgramacionUnica.Cargar(HTMLCargarProgramacionUnica);
    }
};

ReplicarTemplate=function(curso_id,id){
   // sweetalertG.confirm("¿Estás seguro?", "Confirme la eliminación", function(){
        AjaxProgramacionUnica.ReplicarTemplate(HTMLReplicarTemplate,curso_id,id);
   // });
};

HTMLReplicarTemplate=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxProgramacionUnica.Cargar(HTMLCargarProgramacionUnica);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
};

HTMLCargarProgramacionUnica=function(result){
    var html="";
    $('#TableProgramacionUnica').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        templatehtml='';
        if(r.cant_contenido>0){
            templatehtml='<a id="'+r.id+'" onClick="CambiarTemplate(1,'+r.id+')" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-thumbs-down"></i></a>';
            if(r.plantilla==1){
                templatehtml='<a id="'+r.id+'" onClick="CambiarTemplate(0,'+r.id+')" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-thumbs-up"></i></a>';
            }  
        }

        html+='<tr id="trid_'+r.id+'" onClick="CargarContenido('+r.id+','+r.curso_id+',\''+r.curso+'\',\''+r.foto_cab+'\',this)" >'+
            "<td class='carrera'>"+r.carrera+"</td>"+
            "<td class='semestre'>"+r.semestre+"</td>"+
            "<td class='ciclo'>"+r.ciclo+"</td>"+
            "<td class='curso'>"+
            "<a target='_blank' href='img/course/"+r.foto+"'>"+
            "<img src='img/course/"+r.foto+"' style='height: 50px;width: 50px;'>"+
            "&nbsp</a>"+r.curso+"</td>"+
            "<td class='docente'>"+r.docente+"</td>"+
            "<td class='fecha_inicio'>"+r.fecha_inicio+"</td>"+
            "<td class='fecha_final'>"+r.fecha_final+"</td>"+
            '<td><a class="btn btn-success btn-sm" href="ReportDinamic/Proceso.ProgramacionUnicaPR@ExportNota?programacion_unica_id='+r.id+'" target="_blank"><i class="glyphicon glyphicon-download-alt"></i> Export</a></td>'+
            '<td>'+templatehtml+'</td><td>';
        if(r.cant_contenido==0){
            html+='<a id="'+r.id+'" onClick="ReplicarTemplate('+r.curso_id+','+r.id+')" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-duplicate"></i></a>';
        }
        html+="</td></tr>";
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
