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
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Creditos</th>
        </thead>
        <tbody>
        @foreach($asignaturas as $asi)
        <tr >
            <td>{{ $asi->id }}</td>
            <td>{{ $asi->codigo }}</td>
            <td>{{ $asi->nombre }}</td>
            <td>{{ $asi->creditos}}</td>

        </a>
        </td>
        </tr>
        @endforeach
        </div>
        </tbody> </table>

</body>
</html>
