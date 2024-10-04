<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .header {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 class="header">Reporte de Clase</h2>

    <p><strong>Docente:</strong> {{ $docente->nombre }} {{ $docente->apellido }}</p>
    <p><strong>Asignatura:</strong> {{ $asignatura->nombre }}</p>
    <p><strong>Grupo:</strong> {{ $grupo->numero_grupo }}</p>
    <p><strong>Fecha:</strong> {{ $fecha }}</p>
    <p><strong>Horario:</strong> {{ $horario->hora_inicio }} - {{ $horario->hora_final }}</p>
    <p><strong>Sede:</strong> {{ $sede }}</p>
    <p><strong>Aula:</strong> {{ $aula }}</p>
    <p><strong>Asistencia:</strong> {{ ucfirst($clase->asistencia) }}</p>

    @if($asistencia == 'inasistida')
        <p><strong>Observación:</strong> {{ $clase->observacionClase }}</p>
        @elseif($asistencia == 'pendiente')
        <p><strong>CLASE PENDIENTE</strong></p>
    @else
        <h3>Estudiantes Asistidos</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clase->asistencias as $index => $asistencia)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $asistencia->estudiante->nombres }} {{ $asistencia->estudiante->apellidos }}</td>
                        <td>{{ $asistencia->asistencia == '1' ? 'Asistió' : 'No asistió' }}</td>
                        <td>{{ $asistencia->observacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
