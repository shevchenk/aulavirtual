<script type="text/javascript">
var AddEdit=0; //0: Editar | 1: Agregar
var MenuG={id:0,
                        menu:"",
                        class_icono:"",
                        estado:1}; // Datos Globales
$(document).ready(function() {
    $("#TableMenu").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
    AjaxMenu.Cargar(HTMLCargarMenu);
    $("#MenuForm #TableMenu select").change(function(){ AjaxMenu.Cargar(HTMLCargarMenu); });
    $("#MenuForm #TableMenu input").blur(function(){ AjaxMenu.Cargar(HTMLCargarMenu); });

    $('#ModalMenu').on('shown.bs.modal', function (event) {
        if( AddEdit==1 ){
            $(this).find('.modal-footer .btn-primary').text('Guardar').attr('onClick','AgregarEditarAjax();');
        }
        else{
            $(this).find('.modal-footer .btn-primary').text('Actualizar').attr('onClick','AgregarEditarAjax();');
            $("#ModalMenuForm").append("<input type='hidden' value='"+MenuG.id+"' name='id'>");
        }

        $('#ModalMenuForm #txt_menu').val( MenuG.menu );
        $('#ModalMenuForm #txt_class_icono').val( MenuG.class_icono );
        
        $('#ModalMenuForm #slct_estado').val( MenuG.estado );
        $('#ModalMenuForm #txt_menu').focus();
    });

    $('#ModalMenu').on('hidden.bs.modal', function (event) {
        $("ModalMenuForm input[type='hidden']").not('.mant').remove();
       // $("ModalMenuForm input").val('');
    });
});

ValidaForm=function(){
    var r=true;
    if( $.trim( $("#ModalMenuForm #txt_menu").val() )=='' ){
        r=false;
        msjG.mensaje('warning','Ingrese Menu',4000);
    }

    return r;
}

AgregarEditar=function(val,id){
    AddEdit=val;
    MenuG.id='';
    MenuG.menu='';
    MenuG.detalle='';
    MenuG.class_icono='';
    MenuG.estado='1';
    if( val==0 ){
        MenuG.id=id;
        MenuG.menu=$("#TableMenu #trid_"+id+" .menu").text();
        MenuG.class_icono=$("#TableMenu #trid_"+id+" .class_icono").text();
        
        MenuG.estado=$("#TableMenu #trid_"+id+" .estado").val();
    }
    $('#ModalMenu').modal('show');
}

CambiarEstado=function(estado,id){
    AjaxMenu.CambiarEstado(HTMLCambiarEstado,estado,id);
}

HTMLCambiarEstado=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        AjaxMenu.Cargar(HTMLCargarMenu);
    }
}

AgregarEditarAjax=function(){
    if( ValidaForm() ){
        AjaxMenu.AgregarEditar(HTMLAgregarEditar);
    }
}

HTMLAgregarEditar=function(result){
    if( result.rst==1 ){
        msjG.mensaje('success',result.msj,4000);
        $('#ModalMenu').modal('hide');
        AjaxMenu.Cargar(HTMLCargarMenu);
    }
    else{
        msjG.mensaje('warning',result.msj,3000);
    }
}

HTMLCargarMenu=function(result){
    var html="";
    $('#TableMenu').DataTable().destroy();

    $.each(result.data.data,function(index,r){
        estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(1,'+r.id+')" class="btn btn-danger">Inactivo</span>';
        if(r.estado==1){
            estadohtml='<span id="'+r.id+'" onClick="CambiarEstado(0,'+r.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr id='trid_"+r.id+"'>"+
            "<td class='menu'>"+r.menu+"</td>"+
            "<td class='class_icono'>"+r.class_icono+"</td>"+
            "<td>";

        html+="<input type='hidden' class='estado' value='"+r.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" onClick="AgregarEditar(0,'+r.id+')"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#TableMenu tbody").html(html); 
    $("#TableMenu").DataTable({
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
            $('#TableMenu_paginate ul').remove();
            masterG.CargarPaginacion('HTMLCargarMenu','AjaxMenu',result.data,'#TableMenu_paginate');
        }
    });
};
</script>
