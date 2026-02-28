<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Frutas
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
