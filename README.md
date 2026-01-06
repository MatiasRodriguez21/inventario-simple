# Sistema de Inventario Simple

Sistema de inventario simple desarrollado con **Laravel PHP**. Diseño moderno y código simple para demostrar conocimientos de PHP y Laravel.

## 🚀 Características

- ✅ **Laravel 10** - Framework PHP moderno
- ✅ **PHP 8.1+** - Lenguaje de programación
- ✅ **Sesiones** - Almacenamiento simple sin base de datos
- ✅ **CRUD Completo** - Crear, Leer, Actualizar, Eliminar productos
- ✅ **Diseño Moderno** - Tailwind CSS
- ✅ **Responsive** - Funciona en móviles y desktop

## 📁 Estructura del Código

```
app/Http/Controllers/
  └── ProductoController.php    # Lógica PHP/Laravel (CRUD)

routes/
  └── web.php                    # Rutas de Laravel

resources/views/
  ├── layouts/app.blade.php      # Layout principal
  └── productos/index.blade.php  # Vista con Blade (PHP)
```

## 💻 Código Principal

### Controlador (PHP/Laravel)
```php
// app/Http/Controllers/ProductoController.php
- index()    // Mostrar productos
- store()    // Guardar producto
- update()   // Actualizar producto
- destroy()  // Eliminar producto
```

### Rutas (Laravel)
```php
// routes/web.php
GET    /              → Muestra productos
POST   /productos     → Guarda producto
PUT    /productos/{id} → Actualiza producto
DELETE /productos/{id} → Elimina producto
```

### Vistas (Blade - PHP en HTML)
```blade
// resources/views/productos/index.blade.php
@foreach($productos as $producto)
    {{ $producto['nombre'] }}
@endforeach
```

## 🛠️ Instalación

```bash
# 1. Instalar dependencias
composer install

# 2. Generar clave de aplicación
php artisan key:generate

# 3. Ejecutar servidor local
php artisan serve
```

## 📦 Tecnologías

- **Laravel 10** - Framework PHP
- **PHP 8.1+** - Lenguaje backend
- **Blade** - Motor de plantillas de Laravel
- **Tailwind CSS** - Estilos
- **Sesiones** - Almacenamiento temporal

## 📝 Notas

- Los datos se guardan en **sesiones de Laravel** (temporales)
- Perfecto para **portafolio** y demostraciones
- Código **simple y fácil de entender**
- Sin base de datos requerida

## 🚀 Desplegar en Vercel

Ver archivo `DEPLOY.md` para instrucciones completas.

