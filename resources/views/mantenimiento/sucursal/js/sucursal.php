<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var SucursalG={id:0,
sucursal:"",
direccion:"",
telefono:"",
celular:"",
email:"",
imagen_nombre:"",
foto:"",
imagen_archivo:"",
estado:1}; // Datos Globales
$(document).ready(function() {
    $("#TableSucursal").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    AjaxSucursal.Cargar(HTMLCargarSucursal);
    $("#SucursalForm #TableSucursal select").change(function(){ AjaxSucursal.Cargar(HTMLCargarSucursal); });
    $("#SucursalForm #TableSucursal input").blur(function(){ AjaxSucursal.Cargar(HTMLCargarSucursal); });

    $('#ModalSucursal').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalSucursalForm").append("<input type='hidden' value='"+SucursalG.id+"' name='id'>");
        }

        $('#ModalSucursalForm #txt_sucursal').val( SucursalG.sucursal );
        $('#ModalSucursalForm #txt_direccion').val( SucursalG.direccion );
        $('#ModalSucursalForm #txt_telefono').val( SucursalG.telefono );
        $('#ModalSucursalForm #txt_celular').val( SucursalG.celular );
        $('#ModalSucursalForm #txt_email').val( SucursalG.email );

        $('#ModalSucursalForm #slct_estado').val( SucursalG.estado );
        $('#ModalSucursalForm #txt_imagen_nombre').val(SucursalG.imagen_nombre);
        $('#ModalSucursalForm #txt_imagen_archivo').val('');
        $('#ModalSucursalForm .img-circle').attr('src',SucursalG.imagen_archivo);
        $('#ModalSucursalForm #txt_sucursal').focus();
    });

    $('#ModalSucursal').on('hidden.bs.modal', function (event) {
        $("ModalSucursalForm input[type='hidden']").not('.mant').remove();
       // $("ModalSucursalForm input").val('');
    });

    $(document).on('click', '#btnexport', function(event) {
        $(this).attr('href','ReportDinamic/Mantenimiento.SucursalEM@ExportSucursal?d=1');
    });

});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalSucursalForm #txt_sucursal").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese ODE',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    SucursalG.id='';
    SucursalG.sucursal='';
    SucursalG.direccion='';
    SucursalG.telefono='';
    SucursalG.celular='';
    SucursalG.email='';
    SucursalG.imagen_nombre='';
    SucursalG.imagen_archivo='';
    SucursalG.estado='1';
    if( val==0 ){
        SucursalG.id=id;
        SucursalG.sucursal=$("#TableSucursal #trid_"+id+" .sucursal").text();
        SucursalG.direccion=$("#TableSucursal #trid_"+id+" .direccion").text();
        SucursalG.telefono=$("#TableSucursal #trid_"+id+" .telefono").text();
        SucursalG.celular=$("#TableSucursal #trid_"+id+" .celular").text();
        SucursalG.email=$("#TableSucursal #trid_"+id+" .email").text();
        SucursalG.foto=$("#TableSucursal #trid_"+id+" .foto").val();
        
        if(SucursalG.foto!='undefined'){
            SucursalG.imagen_archivo='img/sucursa/'+SucursalG.foto;
            SucursalG.imagen_nombre=SucursalG.foto;
        }else {
            SucursalG.imagen_archivo='';
            SucursalG.imagen_nombre='';
        }      
        SucursalG.estado=$("#TableSucursal #trid_"+id+" .estado").val();
    }
    $('#ModalSucursal').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxSucursal.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxSucursal.Cargar(HTMLCargarSucursal);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxSucursal.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalSucursal').modal('hide');
        AjaxSucursal.Cargar(HTMLCargarSucursal);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarSucursal=function(result){
    var html="";
    $('#TableSucursal').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td>";
            if(r.foto!=null){    
            html+="<a  target='_blank' href='img/sucursa/"+r.foto+"'><img src='img/sucursa/"+r.foto+"' style='height: 40px;width: 40px;'></a>";}
            html+="</td>"+
            "<td class='sucursal'>"+r.sucursal+"</td>"+
            "<td class='direccion'>"+r.direccion+"</td>"+
            "<td class='telefono'>"+r.telefono+"</td>"+
            "<td class='celular'>"+r.celular+"</td>"+
            "<td class='email'>"+r.email+"</td>"+
            "<td>";
        if(r.foto!=null){
        html+="<input type='hidden' class='foto' value='"+r.foto+"'>";}

        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableSucursal tbody").html(html); 
    $("#TableSucursal").DataTable({
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
            $('#TableSucursal_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarSucursal','AjaxSucursal',result.data,'#TableSucursal_paginate');
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
            $('#ModalSucursalForm #txt_imagen_archivo').val(e.target.result);
            $('#ModalSucursalForm .img-circle').attr('src',e.target.result);
        };
        reader.readAsDataURL(files[0]);
        $('#ModalSucursalForm #txt_imagen_nombre').val(files[0].name);
        console.log(files[0].name);
    };
</script>
