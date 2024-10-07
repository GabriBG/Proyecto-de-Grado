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
</head>
<body>
    <br>
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;" >Reporte de Docentes</h1>
    <h3 class="header" style="justify-content: center; padding-left: 150px">Institución Educativa Regional Simon Bolivar</h3>
    <br>
    <div class="main-panel">




        <div class="table-responsive">
            <table class="table table-striped table-hover"> <thead style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
        <th>Id</th>
        <th>Documento Identidad</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo Electrónico</th>
         <th>Telefono</th>
         <th>Rol</th>
        </thead>
        <tbody>
        @foreach($docentes as $per)
        <tr style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
        <td >{{ $per->id }}</td>
        <td>{{ $per->documento_identidad }}</td>
        <td>{{ $per->nombre }}</td>
        <td>{{ $per->apellido}}</td>
        <td>{{ $per->users->email }}</td>
        <td>{{ $per->telefono }}</td>
        <td>{{ $per->users->roles->pluck('name')->implode(', ') }}</td>

        </a>
        </td>
        </tr>
        @endforeach
        </div>
        </tbody> </table>

</body>
</html>
