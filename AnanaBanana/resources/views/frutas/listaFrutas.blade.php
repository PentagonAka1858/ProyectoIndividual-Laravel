<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        
        <div class="mb-3">
            <a href="{{ route('frutas.create') }}" class="btn btn-success">+ Nueva fruta</a>
        </div>
        
        @if($mensaje == 'vacio')
            <div class="alert alert-warning">
                No hay frutas registrados.
            </div>
        @else
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha recolección</th>
                                <th>Fecha caducidad</th>
                                <th>Conservación</th>
                                <th>Origen</th>
                                <th>KG en stock</th>
                                <th>Precio/kg</th>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($frutas as $fruta)
                                <tr>
                                    <td>{{ $fruta->id }}</td>
                                    <td>{{ $fruta->nombre }}</td>
                                    <td>{{ $fruta->fecha_recoleccion->format('d/m/Y') }}</td>
                                    <td>{{ $fruta->fecha_caducidad->format('d/m/Y') }}</td>
                                    <td>
                                        @if($fruta->conservacion == 'Ambiente')
                                            <span class="badge bg-danger">Ambiente</span>
                                        @else
                                            <span class="badge bg-primary">Frío</span>
                                        @endif
                                    </td>
                                    <td>{{ $fruta->origen }}</td>
                                    <td>{{ $fruta->kg_totales }} kg</td>
                                    <td>{{ $fruta->precio_kg }} €</td>
                                    <td>{{ $fruta->proveedor_id }}</td>
                                    <td>
                                        <a href="/frutas/{{ $fruta->id }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="/frutas/{{ $fruta->id }}/editar" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="/frutas/{{ $fruta->id }}/eliminar" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta fruta?')">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $frutas->links('pagination::bootstrap-5') }}
            </div>
            
        @endif
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
