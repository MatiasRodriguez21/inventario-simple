<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Controlador de Productos
 * Maneja las operaciones CRUD del inventario usando sesiones de Laravel
 */
class ProductoController extends Controller
{
    /**
     * Mostrar todos los productos
     * Obtiene los productos de la sesión y los muestra en la vista
     */
    public function index()
    {
        $productos = Session::get('productos', []);
        return view('productos.index', ['productos' => $productos]);
    }

    /**
     * Guardar nuevo producto
     * Recibe los datos del formulario y los guarda en la sesión
     */
    public function store(Request $request)
    {
        // Obtener productos existentes de la sesión
        $productos = Session::get('productos', []);
        
        // Crear nuevo producto con datos del formulario
        $nuevoProducto = [
            'id' => uniqid(), // Generar ID único
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion ?? '',
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'categoria' => $request->categoria ?? 'Sin categoría',
        ];

        // Agregar producto al array y guardar en sesión
        $productos[] = $nuevoProducto;
        Session::put('productos', $productos);

        return redirect('/')->with('success', 'Producto agregado');
    }

    /**
     * Actualizar producto existente
     * Busca el producto por ID y actualiza sus datos
     */
    public function update(Request $request, $id)
    {
        $productos = Session::get('productos', []);
        
        // Buscar y actualizar el producto
        foreach ($productos as $key => $producto) {
            if ($producto['id'] == $id) {
                $productos[$key]['nombre'] = $request->nombre;
                $productos[$key]['descripcion'] = $request->descripcion ?? '';
                $productos[$key]['cantidad'] = $request->cantidad;
                $productos[$key]['precio'] = $request->precio;
                $productos[$key]['categoria'] = $request->categoria ?? 'Sin categoría';
                break;
            }
        }

        Session::put('productos', $productos);
        return redirect('/')->with('success', 'Producto actualizado');
    }

    /**
     * Eliminar producto
     * Busca el producto por ID y lo elimina del array
     */
    public function destroy($id)
    {
        $productos = Session::get('productos', []);
        
        // Buscar y eliminar el producto
        foreach ($productos as $key => $producto) {
            if ($producto['id'] == $id) {
                unset($productos[$key]);
                break;
            }
        }

        // Reindexar array y guardar en sesión
        Session::put('productos', array_values($productos));
        return redirect('/')->with('success', 'Producto eliminado');
    }
}

