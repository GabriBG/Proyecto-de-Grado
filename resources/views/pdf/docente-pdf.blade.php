<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Docente</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte del Docente</h2>
        <h3 class="header">Institución Educativa Regional Simon Bolivar</h3>
        <h3>{{ $docente->nombre }} {{ $docente->apellido }}</h3>
    </div>
    <div class="content">
        <h4>Asignaturas:</h4>
        <ul>
            @foreach($asignaturas as $asignatura)
                <li>{{ $asignatura->nombre }}</li>
            @endforeach
        </ul>

        <h4>Grupos:</h4>
        <ul>
            @foreach($grupos as $grupo)
                <li>Grupo: {{ $grupo->numero_grupo }}</li>
            @endforeach
        </ul>

        <h4>Clases Inasistidas:</h4>
        @if($inasistencias->isEmpty())
            <p>No hay inasistencias registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Grupo</th>
                        <th>Asignatura</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inasistencias as $clase)
                        <tr>
                            <td>{{ $clase->fecha }}</td>
                            <td>{{ $clase->asignacionGrupos->grupos->numero_grupo }}</td>
                            <td>{{ $clase->asignacionGrupos->asignaturas->nombre }}</td>
                            <td>{{ $clase->observacionClase }}</td> <!-- Asumiendo que la observación está en la clase -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
