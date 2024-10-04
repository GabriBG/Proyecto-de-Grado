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
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;" >Reporte de Asignaturas </h1>
    <br>
<div class="main-panel">



        <div class="table-responsive">
        <table class="table table-striped table-hover"> <thead>
            <th>Id</th>
            <th>Codigo</th>
            <th>Nombre</th>
        </thead>
        <tbody>
        @foreach($asignaturas as $asi)
        <tr style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <td>{{ $asi->id }}</td>
            <td>{{ $asi->codigo }}</td>
            <td>{{ $asi->nombre }}</td>

        </a>
        </td>
        </tr>
        @endforeach
        </div>
        </tbody> </table>

</body>
</html>
