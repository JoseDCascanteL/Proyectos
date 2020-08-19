$('#formLogin').submit(function(e){
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());    
    var contrasenia =$.trim($("#contrasenia").val());    
    if(usuario.length == "" || contrasenia == ""){
        alert("debe ingresar usuario y/o contrasenia");
       return false; 
     } else{
        $.ajax({
            url:"bd/login.php",
            type:"POST",
            datatype: "json",
            data: {usuario:usuario, contrasenia:contrasenia}, 
            success:function(data){ 
            if(data == "null"){
                alert("usuario y/o contrasenia");
            }else{
                window.location.href = "vistas/home.php";
            }
           }    
        });
    }    
 });

$(document).ready(function() {    
    tablaAnimales =$('#animales').DataTable({
        "columnDefs":[{
            "targets": -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnEliminar'>Eliminar</button></div></div>"  
           }],
            
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            }
    });     
});

$("#btnNuevo").click(function(){
    $("#formAnimales").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Animal");            
    $("#modalCRUD").modal("show");        
    opcion = 1; //alta
});  

var fila;

$(document).on("click", ".btnEditar", function(){

    fila = $(this).closest("tr");
    codigo = fila.find('td:eq(0)').text();
    nombre = fila.find('td:eq(1)').text();
    raza = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();

    $("#codigo").val(codigo);
    $("#nombre").val(nombre);
    $("#raza").val(raza);
    $("#tipo").val(tipo);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona"); 
    $("#modalCRUD").modal("show");
}); 

$("#formAnimales").submit(function(e){
    e.preventDefault();  
    codigo = $.trim($("#codigo").val());  
    nombre = $.trim($("#nombre").val());
    raza = $.trim($("#raza").val());
    tipo = $.trim($("#tipo").val()); 
    dueno_id = $.trim($("#tipo").val());   
    $.ajax({
        url: "data/consultas.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, raza:raza, tipo:tipo, codigo:codigo, dueno_id:dueno_id},
        success: function(data){  
            console.log(data);
            codigo = data[0].codigo;            
            nombre = data[0].nombre;
            raza = data[0].raza;
            tipo = data[0].tipo;
            dueno_id = data[0].dueno_id;
            tablaAnimales.row.add([codigo,nombre,raza,tipo]).draw();
        }        
    });
    $("#modalCRUD").modal("hide");    
    
}); 

function enviarDatos(e){
    e.preventDefault(); 
    codigo = $.trim($("#codigo").val()); 
    alert("entro",codigo);
}