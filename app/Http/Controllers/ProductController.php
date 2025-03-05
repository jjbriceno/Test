<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Currency;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Muestra una lista de productos.
     * 
     * Ruta GET /products
     */
    public function index()
    {
        $products = Product::all();

        $response = [
            'success' => true,
            'data' => $products,
            'message' => 'Listado de productos'
        ];

        return response()->json($response, 200);
    }

    /**
     * Crea un nuevo recurso.
     * 
     * Ruta POST /products
     */
    public function store(Request $request)
    {
        // Código para guardar un nuevo producto
        $product = new Product($request->all());

        $product->save();

        $response = [
            'success' => true,
            'data' => $product,
            'message' => 'Producto guardado'
        ];

        return response()->json($response, 201);
    }

    /**
     * Muestra un producto específico.
     * 
     * Ruta GET /products/{id}
     */
    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Producto encontrado'
            ];
            return response()->json($response, 200);
        }

        $response = [
            'success' => false,
            'data' => 'Empty',
            'message' => 'Producto no encontrado'
        ];
        return response()->json($response, 404);
    }

    /**
     * Actualiza un recurso específico.
     * 
     * Ruta PUT /products/{id}
     */
    public function update(Request $request, $id)
    {
        // Código para editar un producto
        $product = Product::find($id);

        $product->update($request->all());

        $response = [
            'success' => true,
            'data' => $product,
            'message' => 'Producto actualizado'
        ];

        return response()->json($response, 200);
    }

    /**
     * Elimina un recurso específico.
     * 
     * Ruta DELETE /products/{id}
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Producto eliminado'
            ];
            return response()->json($response, 200);
        }

        $response = [
            'success' => false,
            'data' => 'Empty',
            'message' => 'Producto no encontrado'
        ];
        return response()->json($response, 404);
    }

    /**
     * Devuelve el precio de un producto.
     * 
     * Ruta GET /products/{id}/prices
     */
    public function prices($id)
    {
        $product = Product::find($id);

        $productPrices = $product->currencies()->withPivot('price')->get();

        $response = [
            'success' => true,
            'data' => $productPrices,
            'message' => 'Listado de precios del producto'
        ];

        return response()->json($response, 200);
    }

    /**
     * Crea un nuevo precio para un producto.
     * 
     * Ruta POST /products/{id}/prices
     */
    public function createPrice(Request $request, $id)
    {
        $product = Product::find($id);

        $currency_id = $request->get('currency_id');

        $currency = Currency::find($currency_id);

        if (!$currency) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Divisa no encontrada'
            ];
            return response()->json($response, 404);
        }

        $product->currencies()->attach($currency->id, ['price' => $product->price * $currency->exchange_rate]);

        $response = [
            'success' => true,
            'data' => $product->currencies()->where('currency_id', $currency->id)->withPivot('price')->get(),
            'message' => 'Precio guardado'
        ];

        return response()->json($response, 201);
    }
}
