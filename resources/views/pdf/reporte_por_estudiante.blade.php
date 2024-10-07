<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado Clases</title>
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
</head>
<body>
    <br>
    <h1>Reporte de Clases</h1>
    <h3 class="header" style="justify-content: center; padding-left: 150px">Institución Educativa Regional Simon Bolivar</h3>
    <br>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Docente</th>
                <th>Asignatura</th>
                <th>Numero de Grupo</th>
                <th>Horario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clases as $cla)
            <tr>
                <td>{{ $cla->id }}</td>
                <td>{{ $cla->asignacionGrupos->personas->nombre }} {{ $cla->asignacionGrupos->personas->apellido }}</td>
                <td>{{ $cla->asignacionGrupos->asignaturas->nombre }}</td>
                <td>{{ $cla->asignacionGrupos->grupos->numero_grupo }}</td>
                <td>{{ $cla->horarios->hora_inicio }} - {{ $cla->horarios->hora_final }}</td>
                <td>{{ ucfirst($cla->asistencia) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
