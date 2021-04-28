<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestor de archivos</a>
    </nav>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
        <!-- Alert dar mensaje de que algo a sido creado o cambiado-->
              
            <?php if(isset($_SESSION['message'])){ ?>
                <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert"> 
                    <?= $_SESSION['message']?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset();}?>
                <div class="card">
                    <div class="card-body">
                        <h5>Ingresé archivo ó carpeta</h5>
            <!-- Aqui está el formulario de las carpetas -->
                        <form action="controladores/controlador.php" method="get">
                            <div class="form-group">
                                <label for="ruta">Ruta</label>
                                <?php
                                    if(!empty($_GET["ruta"])){
                                        $ruta = $_GET["ruta"];
                                        
                                    }else{
                                        $ruta = "raiz";
                                    }
                                echo "<input  id='ruta' class='form-control' type='text' placeholder='raiz' value=$ruta>"
                                ?>
                            </div>
                            <div class="form-group">
                                <input  class="form-control" type="text" placeholder="Ingresé nombre" id="nombre">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Selecioné una opción</label>
                                <select class="custom-select custom-select-lg mb-3">
                                    <option value="archivo">Archivo</option>
                                    <option value="carpeta">Carpeta</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" name="action" value="crear">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Aquí está la tabla -->
            <div class="col-md-7">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Usarios</td>
                            <td>Permisos</td>
                            <td>
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <select class="custom-select">
                                                <option value="copiar">copiar</option>
                                                <option value="pegar">cortar</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-success btn-block">Aplicar</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>Carpera</td>
                                <td>Diego</td>
                                <td>777</td>
                                <td>
                                    <button class="btn btn-danger" title="eliminar" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-success" title="editar" type="submit"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-info" title="permisos" type="submit"><i class="far fa-user"></i></button>
                                    <button class="btn btn-warning" title="informacion" type="submit"><i class="fas fa-question-circle"></i></button>
                                    <input class="seleccionar ml-4" type="checkbox" name="checkbox" id="checkbox"/>
                                </td>          
                            </tr>
                        </tbody>
                </table>
                <form>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-outline-secondary btn-block">Pegar</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary btn-block">Volver</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
    </div>
</body>
</html>