<!DOCTYPE html>
<html lang="en">
<head>
    <link href="..\public\black\css\black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="\public\black\scss\_variables.scss" rel="stylesheet" />
    <link href="\public\black\css\theme.css" rel="stylesheet" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado Personas</title>
</head>
<body>

<div class="main-panel">

    <div class="content">

    <div class="row">

        <div class="table-responsive">
        <table class="table table-striped table-hover"> <thead>
        <th>Id</th>
        <th>Documento Identidad</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo Electrónico</th>
         <th>Telefono</th>
         <th>Rol</th>
        </thead>
        <tbody>
        @foreach($personas as $per)
        <tr >
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
