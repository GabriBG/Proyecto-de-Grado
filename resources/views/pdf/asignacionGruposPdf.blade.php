<!DOCTYPE html>
<html lang="en">
<head>
    <link href="..\public\black\css\black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="..\public\images\cuestionario.png" type="image/x-icon">
    <title>Listado Grupos Asignados</title>
</head>
<body>
    <br>
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;" >Reporte de Asignacion de Grupos</h1>
    <br>
<div class="main-panel">



        <div class="table-responsive">
        <table class="table table-striped table-hover"> <thead style="font-family: Verdana, Geneva, Tahoma, sans-serif; color: #ffff;">
            <th>Id</th>
            <th>Nombre de Docente</th>
            <th>Apellido de Docente</th>
            <th>Asignatura</th>
            <th>Numero de Grupo</th>
        </thead>
        <tbody>
            @foreach($asignacion_grupos as $asigna)
            <tr style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <td>{{ $asigna->id }}</td>
            <td>{{ $asigna->personas->nombre }}</td>
            <td>{{ $asigna->personas->apellido }}</td>
            <td>{{ $asigna->asignaturas->nombre }}</td>
            <td>{{ $asigna->grupos->numero_grupo}}</td>

        </a>
        </td>
        </tr>
        @endforeach
        </div>
        </tbody> </table>

</body>
</html>
