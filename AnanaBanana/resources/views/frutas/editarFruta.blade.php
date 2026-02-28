<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar fruta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h1 class="mb-4">Editar fruta</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Errores de validación:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="max-width: 600px;">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Datos de la fruta</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('frutas.update', $fruta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                           name="nombre" id="nombre" value="{{ old('nombre', $fruta->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_recoleccion" class="form-label">Fecha de recolección *</label>
                    <input type="date" class="form-control @error('fecha_recoleccion') is-invalid @enderror"
                           name="fecha_recoleccion" id="fecha_recoleccion" value="{{ old('fecha_recoleccion', $fruta->fecha_recoleccion->format('Y-m-d')) }}" required>
                    @error('fecha_recoleccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_caducidad" class="form-label">Fecha de caducidad *</label>
                    <input type="date" class="form-control @error('fecha_caducidad') is-invalid @enderror"
                           name="fecha_caducidad" id="fecha_caducidad" value="{{ old('fecha_caducidad', $fruta->fecha_caducidad->format('Y-m-d')) }}" required>
                    @error('fecha_caducidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="conservacion" class="form-label">Conservación *</label>
                    <select class="form-select @error('conservacion') is-invalid @enderror" name="conservacion" id="conservacion" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="Ambiente" {{ old('conservacion', $fruta->conservacion) == 'Ambiente' ? 'selected' : '' }}>Ambiente</option>
                        <option value="Frio" {{ old('conservacion', $fruta->conservacion) == 'Frio' ? 'selected' : '' }}>Frío</option>
                    </select>
                    @error('conservacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="origen" class="form-label">Origen *</label>
                    <input type="text" class="form-control @error('origen') is-invalid @enderror"
                           name="origen" id="origen" value="{{ old('origen', $fruta->origen) }}" required>
                    @error('origen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kg_totales" class="form-label">Kg en stock *</label>
                    <input type="number" class="form-control @error('kg_totales') is-invalid @enderror"
                           name="kg_totales" id="kg_totales" value="{{ old('kg_totales', $fruta->kg_totales) }}"
                           step="0.01" min="0" required>
                    @error('kg_totales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio_kg" class="form-label">Precio/kg (€) *</label>
                    <input type="number" class="form-control @error('precio_kg') is-invalid @enderror"
                           name="precio_kg" id="precio_kg" value="{{ old('precio_kg', $fruta->precio_kg) }}"
                           step="0.01" min="0" required>
                    @error('precio_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor *</label>
                    <select class="form-select @error('proveedor_id') is-invalid @enderror" name="proveedor_id" id="proveedor_id" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $fruta->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->name . ', ' . $proveedor->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <button type="submit" class="btn btn-warning text-white">Guardar cambios</button>
                <a href="{{ route('frutas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
