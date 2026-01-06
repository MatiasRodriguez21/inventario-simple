@extends('layouts.app')

@section('title', 'Inventario de Productos')

@section('content')
<div class="space-y-6">
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Productos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ count($productos) }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-boxes text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Stock</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        @php
                            $totalStock = 0;
                            foreach($productos as $p) {
                                $totalStock += $p['cantidad'];
                            }
                            echo $totalStock;
                        @endphp
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-warehouse text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Valor Total</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        @php
                            $valorTotal = 0;
                            foreach($productos as $p) {
                                $valorTotal += $p['cantidad'] * $p['precio'];
                            }
                        @endphp
                        ${{ number_format($valorTotal, 2) }}
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-dollar-sign text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Categorías</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        @php
                            $categorias = [];
                            foreach($productos as $p) {
                                if(!in_array($p['categoria'], $categorias)) {
                                    $categorias[] = $p['categoria'];
                                }
                            }
                            echo count($categorias);
                        @endphp
                    </p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-tags text-orange-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Agregar Producto -->
    <div class="flex justify-end">
        <button onclick="abrirModal()" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 font-semibold flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Agregar Producto</span>
        </button>
    </div>

    <!-- Lista de Productos -->
    @if(count($productos) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($productos as $producto)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $producto['nombre'] }}</h3>
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $producto['categoria'] }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editarProducto({{ json_encode($producto) }})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="eliminarProducto('{{ $producto['id'] }}')" class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        @if($producto['descripcion'])
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto['descripcion'] }}</p>
                        @endif

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Cantidad:</span>
                                <span class="font-semibold text-gray-800 {{ $producto['cantidad'] < 10 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $producto['cantidad'] }} unidades
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Precio:</span>
                                <span class="font-bold text-indigo-600">${{ number_format($producto['precio'], 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                <span class="text-gray-600 text-sm font-medium">Valor Total:</span>
                                <span class="font-bold text-lg text-purple-600">
                                    ${{ number_format($producto['cantidad'] * $producto['precio'], 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay productos en el inventario</h3>
            <p class="text-gray-500 mb-6">Comienza agregando tu primer producto</p>
            <button onclick="abrirModal()" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                Agregar Primer Producto
            </button>
        </div>
    @endif
</div>

<!-- Modal para Agregar/Editar Producto -->
<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h2 id="modal-titulo" class="text-2xl font-bold text-gray-800">Agregar Producto</h2>
            <button onclick="cerrarModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="producto-form" method="POST" action="/productos">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">
            <input type="hidden" id="producto-id" name="producto_id">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Producto *</label>
                    <input type="text" name="nombre" id="nombre" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cantidad *</label>
                        <input type="number" name="cantidad" id="cantidad" min="0" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio *</label>
                        <input type="number" name="precio" id="precio" min="0" step="0.01" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <input type="text" name="categoria" id="categoria"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                           placeholder="Ej: Electrónica, Ropa, etc.">
                </div>
            </div>

            <div class="flex space-x-3 mt-6">
                <button type="button" onclick="cerrarModal()"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit"
                        class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Formulario oculto para eliminar -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    function abrirModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('producto-form').reset();
        document.getElementById('form-method').value = 'POST';
        document.getElementById('producto-form').action = '/productos';
        document.getElementById('modal-titulo').textContent = 'Agregar Producto';
        document.getElementById('producto-id').value = '';
    }

    function cerrarModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function editarProducto(producto) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal-titulo').textContent = 'Editar Producto';
        document.getElementById('nombre').value = producto.nombre;
        document.getElementById('descripcion').value = producto.descripcion;
        document.getElementById('cantidad').value = producto.cantidad;
        document.getElementById('precio').value = producto.precio;
        document.getElementById('categoria').value = producto.categoria;
        document.getElementById('producto-id').value = producto.id;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('producto-form').action = `/productos/${producto.id}`;
    }

    function eliminarProducto(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            const form = document.getElementById('delete-form');
            form.action = `/productos/${id}`;
            form.submit();
        }
    }

    // Cerrar modal al hacer clic fuera
    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });
</script>
@endsection

