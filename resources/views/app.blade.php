<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" link="resources/css/app.css">



    <title>Prueba Empleados</title>
</head>

<body style="margin: 50px 250px 0 250px">
    <!-- Titulo !-->
    <h1>Crear empleado</h1>
    <div class="alert alert-info" role="alert">
        Los campos con asteriscos (*) son obligatorios
    </div>
    <!-- Nombre Completo !-->
    <form>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align:right; font-weight: bold;">Nombre
                completo *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Nombre completo del empleado">
            </div>
        </div>
        <!-- Correo electronico !-->
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
                style="text-align:right; font-weight: bold;">Correo electronico *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Correo electronico">
            </div>
        </div>
        <!-- Sexo !-->
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0" style="text-align:right; font-weight: bold;">Sexo *</legend>
            <!-- Masculino !-->
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1"
                        checked>
                    <label class="form-check-label" for="gridRadios1">
                        Masculino
                    </label>
                </div>
                <!-- Femenino !-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Femenino
                    </label>
                </div>
            </div>
        </fieldset>
        <!-- Area !-->
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align:right; font-weight: bold;">Area
                *</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Ventas</option>
                    <option value="1">Tic</option>
                    <option value="2">Calidad</option>
                    <option value="3">Produccion</option>
                </select>
            </div>
        </div>
        <!-- Descripcion !-->
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
                style="text-align:right; font-weight: bold;">Descripcion *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Descripcion de la experiencia del empleado">
            </div>
        </div>
        <!-- Boletin informativo !-->
        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                        Deseo recibir boletin informativo
                    </label>
                </div>
            </div>
        </div>


        <!-- Roles !-->

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0" style="text-align:right; font-weight: bold;">Roles *</legend>
            <!-- Profesional de proyectos !-->
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Profesional de proyectos - Desarrollador
                    </label>
                </div>
                <!-- Gerente estrategico !-->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Gerente estrategico
                    </label>
                </div>
                <!-- Auxiliar administrativo !-->
                <div class="form-check" class="row mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Auxiliar administrativo
                    </label>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" >Guardar</button>
                    </div>
                </div>
            </div>
        </fieldset>

    </form>
</body>

</html>
