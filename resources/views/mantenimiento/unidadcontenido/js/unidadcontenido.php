<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var UnidadContenidoG={id:0,unidad_contenido:"",estado:1,imagen_archivo:'',imagen_nombre:''}; // Datos Globales
$(document).ready(function() {

    $("#TableUnidadContenido").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    

    AjaxUnidadContenido.Cargar(HTMLCargarUnidadContenido);
    
    $("#UnidadContenidoForm #TableUnidadContenido select").change(function(){ AjaxUnidadContenido.Cargar(HTMLCargarUnidadContenido); });
    $("#UnidadContenidoForm #TableUnidadContenido input").blur(function(){ AjaxUnidadContenido.Cargar(HTMLCargarUnidadContenido); });
    
    $('#ModalUnidadContenido').on('shown.bs.modal', function (event) {

        if( AddEdit==1 ){        
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalUnidadContenidoForm").append("<input type='hidden' value='"+UnidadContenidoG.id+"' name='id'>");
        }
        $('#ModalUnidadContenidoForm #txt_unidad_contenido').val( UnidadContenidoG.unidad_contenido );
        $('#ModalUnidadContenidoForm #txt_imagen_nombre').val(UnidadContenidoG.imagen_nombre);
        $('#ModalUnidadContenidoForm #txt_imagen_archivo').val('');
        $('#ModalUnidadContenidoForm .img-circle').attr('src',UnidadContenidoG.imagen_archivo);
        $('#ModalUnidadContenidoForm #txt_tipo_respuesta').focus();
    });

    $('#ModalUnidadContenido').on('hidden.bs.modal', function (event) {
        $("#ModalUnidadContenidoForm input[type='hidden']").not('.mant').remove();
    });
    
});

ValidaForm=function(){
    var r=true;

    if( $.trim( $("#ModalUnidadContenidoForm #txt_unidad_contenido").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Unidad de Contenido',4000);
    }
    else if( $.trim( $("#ModalUnidadContenidoForm #txt_imagen_nombre").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Imagen',4000);
    }

    return r;
}

CambiarEstado=function(estado,id){
    AjaxUnidadContenido.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxUnidadContenido.Cargar(HTMLCargarUnidadContenido);
    }
}

AgregarEditar=function(val,id){
    AddEdit=val;
    UnidadContenidoG.id='';
    UnidadContenidoG.unidad_contenido='';
    UnidadContenidoG.imagen_archivo='';
    UnidadContenidoG.imagen_nombre='';
    if( val==0 ){
        UnidadContenidoG.id=id;
        UnidadContenidoG.unidad_contenido=$("#TableUnidadContenido #trid_"+id+" .unidad_contenido").text();
        UnidadContenidoG.foto=$("#TableUnidadContenido #trid_"+id+" .foto").val();
        if(UnidadContenidoG.foto!='undefined'){
            UnidadContenidoG.imagen_archivo='img/content_unit/'+UnidadContenidoG.foto;
            UnidadContenidoG.imagen_nombre=UnidadContenidoG.foto;
        }else {
            UnidadContenidoG.imagen_archivo='';
            UnidadContenidoG.imagen_nombre='';
        }      
    }
    $('#ModalUnidadContenido').modal('show');
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxUnidadContenido.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalUnidadContenido').modal('hide');
        AjaxUnidadContenido.Cargar(HTMLCargarUnidadContenido);
    }else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarUnidadContenido=function(result){
    var html="";
    $('#TableUnidadContenido').DataTable().destroy();
    
    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }
        
        html+="<tr id='trid_"+r.id+"'>"+
            "<td>";
            if(r.foto!=null){    
            html+="<a  target='_blank' href='img/content_unit/"+r.foto+"'><img src='img/content_unit/"+r.foto+"' style='height: 40px;width: 600px;'></a>";}
            html+="</td>"+
                  "<td class='unidad_contenido'>"+r.unidad_contenido+"</td>"+
                  "<td>";
            html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>";
            html+='<td>';
                if(r.foto!=null){
            html+="<input type='hidden' class='foto' value='"+r.foto+"'>";}
            html+='<a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
            html+="</tr>";
    });
    $("#TableUnidadContenido tbody").html(html); 
    $("#TableUnidadContenido").DataTable({
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
            $('#TableUnidadContenido_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarUnidadContenido','AjaxUnidadContenido',result.data,'#TableUnidadContenido_paginate');
        }
    });

};

onImagen = function (event) {
        var files = event.target.files || event.dataTransfer.files;
        if (!files.length)
            return;
        var image = new Image();
        var reader = new FileReader();
        reader.onload = (e) => {
            $('#ModalUnidadContenidoForm #txt_imagen_archivo').val(e.target.result);
            $('#ModalUnidadContenidoForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalUnidadContenidoForm #txt_imagen_nombre').val(files[0].name);
        console.log(files[0].name);
    };
</script>
