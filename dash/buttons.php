<?php
require_once "vistas/parte_superior.php"
?>
<div class="container">
  <h1>Registro Animales</h1>
<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT codigo, nombre, raza, tipo, duenio_id FROM animal";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Animal</button>    
            </div>    
        </div>    
    </div>    
    <br> 
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="animales" class="table table-striped table-bordered " style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>RAZA</th>
                                <th>TIPO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['codigo'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['raza'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAnimales" onsubmit="enviarDatos()">    
            <div class="modal-body">
                <div class="form-group">
                <label for="codigo" class="col-form-label">Codigo:</label>
                <input type="text" class="form-control" id="codigo" name="codigo">
                </div> 
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>                
                <div class="form-group">
                <label for="raza" class="col-form-label">Raza:</label>
                <input type="text" class="form-control" id="raza">
                </div>
                <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo">
                </div>   
                <div class="form-group">
                <input type="hidden" class="form-control" id="dueno_id" value="1">
                </div>           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

</div>
<?php
require_once "vistas/parte_inferior.php"
?>