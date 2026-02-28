<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear fruta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h1 class="mb-4">Crear nueva fruta</h1>

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
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Datos de la fruta</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('frutas.store') }}" method="POST">
                @csrf
                {{-- NOMBRE, FECHA_RECOLECCION, FECHA_CADUCIDAD, CONSERVACIÓN (SELECT), ORIGEN, KG_TOTALES, PRECIO_KG, PROVEEDOR --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                           name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fecha_recoleccion" class="form-label">Fecha de recolección *</label>
                    <input type="date" class="form-control @error('fecha_recoleccion') is-invalid @enderror" 
                           name="fecha_recoleccion" id="ffecha_recoleccion" value="{{ old('fecha_recoleccion') }}" required>
                    @error('fecha_recoleccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fecha_caducidad" class="form-label">Fecha de caducidad *</label>
                    <input type="date" class="form-control @error('fecha_caducidad') is-invalid @enderror" 
                           name="fecha_caducidad" id="fecha_caducidad" value="{{ old('fecha_caducidad') }}" required>
                    @error('fecha_caducidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="conservacion" class="form-label">Conservación *</label>
                    <select class="form-select @error('conservacion') is-invalid @enderror" name="conservacion" id="conservacion" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="Ambiente" {{ old('conservacion') == 'Ambiente' ? 'selected' : '' }}>Ambiente</option>
                        <option value="Frio" {{ old('conservacion') == 'Frio' ? 'selected' : '' }}>Frío</option>
                    </select>
                    @error('conservacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="kg_totales" class="form-label">Kg en stock *</label>
                    <input type="number" class="form-control @error('kg_totales') is-invalid @enderror" 
                           name="kg_totales" id="kg_totales" value="{{ old('kg_totales') }}" 
                           step="0.01" min="0" required>
                    @error('kg_totales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="precio_kg" class="form-label">Precio/kg (€) *</label>
                    <input type="number" class="form-control @error('precio_kg') is-invalid @enderror" 
                           name="precio_kg" id="precio_kg" value="{{ old('precio_kg') }}" 
                           step="0.01" min="0" required>
                    @error('precio_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="sexo" class="form-label">Proveedor *</label>
                    <select class="form-select @error('sexo') is-invalid @enderror" name="sexo" id="sexo" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->name . ', ' . $proveedor->email }}</option>
                        @endforeach
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <hr>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('frutas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
