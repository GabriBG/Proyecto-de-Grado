<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Listado Grupos Asignados</title>
</head>
<body>
    <br>
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;" >Reporte de Asignacion de Grupos</h1>
    <br>
<div class="main-panel">



        <div class="table-responsive">
        <table class="table table-striped table-hover"> <thead >
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
