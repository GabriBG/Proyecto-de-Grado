<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reporte de Asistencia</title>
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
    <h1>Reporte de Asistencia</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Grupo</th>
                <th>Docente</th>
                <th>Asignatura</th>
                <th>Fecha</th>
                <th>Estado de Asistencia</th>
                <th>Horario</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id }}</td>
                    <td>{{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}</td>
                    <td>{{ $asistencia->clase->grupos->numero_grupo }}</td>
                    <td>{{ $asistencia->clase->personas->nombre }} {{ $asistencia->clase->personas->apellido }}</td>
                    <td>{{ $asistencia->clase->asignaturas->nombre }}</td>
                    <td>{{ $asistencia->created_at->format('d-m-Y') }}</td>
                    <td>{{ $asistencia->asistencia == 1 ? 'Asistida' : 'Inasistida' }}</td>
                    <td>{{ $asistencia->clase->horarios->hora_inicio }} - {{ $asistencia->clase->horarios->hora_final }}</td>
                    <td>{{ $asistencia->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
