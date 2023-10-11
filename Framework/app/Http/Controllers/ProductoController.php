<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;

use  Illuminate\Validation\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        return Inertia::render('Inventario/Productos/ProductosLista',['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|max:30|unique:productos,barcode',
            'plu' => 'max:6',
            'descripcion_producto' => 'required|max:25',
            'precio_venta_producto' => 'required|max:11',
            'precio_compra_producto' => 'required|max:11',
            'precio_reparto_producto' => 'required|max:11',
            'estado_producto' => 'required|max:1',
            'imagen_producto' => 'required|max:2048|image|mimes:jpg,jpeg,png',
            'existencia' => 'required|max:50',
        ]);

        /* // put image in the public storage
        $file = Storage::disk('images')->put('images', request()->file('images'), 'images');
        // get the image path in the url
        $path = Storage::url($file); */

        // Obtener el archivo subido
        $file = $request->file('imagen_producto');
        // Crear una instancia de Image con el archivo
        $image = Image::make($file);
        // Redimensionar la imagen a 200x200 sin mantener la relación de aspecto
        $image->resize(200, 200, null); 
        // Generar un nombre único usando la hora actual y la extensión .webp
        $name = $request->barcode .".webp";
        // Guardar la imagen en el disco público, en la carpeta images, con el formato .webp y la calidad 80%
        $image->encode('webp', 80)->save(public_path('images/'.$name));


        $producto = new Producto($request->input());
        $producto->imagen_producto = 'images/'.$name;
        $producto->fecha = now();
        $producto->save();

        return redirect('productos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {

        $request->validate([
            'barcode' => 'required|max:30|unique:productos,barcode,'. $producto->id,
            'plu' => 'max:6',
            'descripcion_producto' => 'required|max:25',
            'precio_venta_producto' => 'required|max:11',
            'precio_compra_producto' => 'required|max:11',
            'precio_reparto_producto' => 'required|max:11',
            'estado_producto' => 'required|max:1',
            'imagen_producto' => 'required',
            'existencia' => 'required|max:50',
        ]);

        $producto->update($request->input());

        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect('productos');
    }
}
