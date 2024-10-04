<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del Estudiante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 20px;
        }
        .no-records {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte del Estudiante</h2>
        <p><strong>Nombre:</strong> {{ $estudiante->nombres }}</p>
        <p><strong>Apellido:</strong> {{ $estudiante->apellidos }}</p>
        <p><strong>Grupo:</strong> {{ $grupo->numero_grupo   }}</p>
        <p><strong>Total de Asistencias:</strong> {{ $totalAsistencias }}</p>
        <p><strong>Total de Inasistencias:</strong> {{ $totalInasistencias }}</p>
    </div>

    <h3>Detalle de Inasistencias</h3>

    @if(count($inasistenciasDetalles) > 0)
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Asignatura</th>
                    <th>Docente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inasistenciasDetalles as $detalle)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($detalle['fecha'])->format('d/m/Y') }}</td>
                        <td>{{ $detalle['asignatura'] }}</td>
                        <td>{{ $detalle['nombredocente'] }} {{ $detalle['apellidodocente'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-records">No hay inasistencias registradas para este estudiante.</p>
    @endif
</body>
</html>
