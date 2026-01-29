<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Fruta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h1 class="mb-4">Detalle del Fruta</h1>

    @if($mensaje == 'error')
        <div class="alert alert-danger">
            Fruta no encontrado.
        </div>
        <a href="/" class="btn btn-secondary">← Volver al listado</a>
    @else
        <div class="card" style="max-width: 600px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $fruta->nombre }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th style="width: 40%;">ID:</th>
                        <td>{{ $fruta->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td>{{ $fruta->nombre }}</td>
                    </tr>
                    <tr>
                        <th>Fecha recolección:</th>
                        <td><code>{{ $fruta->fecha_recoleccion->format('d/m/Y') }}</code></td>
                    </tr>
                    <tr>
                        <th>Fecha caducidad:</th>
                        <td>{{ $fruta->fecha_caducidad->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Conservación:</th>
                        <td>
                            @if($fruta->conservacion == 'Ambiente')
                                <span class="badge bg-danger">Ambiente</span>
                            @else
                                <span class="badge bg-primary">Frío</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Origen:</th>
                        <td>{{ $fruta->fecha_caducidad->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>KGs en stock:</th>
                        <td>{{ $fruta->kg_totales }} KGs</td>
                    </tr>
                    <tr>
                        <th>Precio por KG:</th>
                        <td>{{ $fruta->precio_kg }} €</td>
                    </tr>
                    <tr>
                        <th>Sueldo Base:</th>
                        <td><strong class="text-success">{{ $fruta->proveedor_id }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="/frutas" class="btn btn-secondary">← Volver</a>
                <a href="/frutaes/{{ $fruta->id }}/editar" class="btn btn-warning">Editar</a>
                <a href="/frutaes/{{ $fruta->id }}/eliminar" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
