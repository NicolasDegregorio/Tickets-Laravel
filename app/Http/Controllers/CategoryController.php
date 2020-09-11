<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.stock.category');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'name'   => 'required',
            'description' => 'required|string',
            
            
        ], [
            'name.required'          => 'Campo Nombre Requerido',
            'description.required'   => 'Campo Descripcion Requerido',
            'description.string'     => 'La Descripcion Debe tener Formato de Cadena',

      
        ]);
        $category         = new Category;
        $category->name   = $request->name;
        $category->description = $request->description;
       
        if ($category->save()) {
            notify()->success('Categoria Creada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Crear la Categoria');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categoryJson = 
            [
                'id'          => $category->id,
                'name'        => $category->name,
                'description' => $category->description
                
            ];
        return response()->json([
            'category' => $categoryJson 

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'name'   => 'required',
            'description' => 'required|string',
            
            
        ], [
            'name.required'          => 'Campo Nombre Requerido',
            'description.required'   => 'Campo Descripcion Requerido',
            'description.string'     => 'La Descripcion Debe tener Formato de Cadena',

      
        ]);
        $category         = Category::findOrFail($id);

        $category->name         = $request->name;
        $category->description  = $request->description;
        

        if ( $category->save()) {
            notify()->success('Categoria Editada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Editar la Categoria');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        notify()->error('Categoria Eliminada Correctamente');
        return redirect()->back();
    }

    public function categoryDatatable($categories){
        $arrayCategory = array();

        foreach ($categories as $category) {
            $categoryJson = 
            [
                'DT_RowId'    => $category->id,
                'id'          => $category->id,
                'name'        => $category->name,
                'description' => $category->description, 
               
                
            ];
            array_push($arrayCategory, $categoryJson);
        }
        
        return datatables($arrayCategory)->toJson();
    }

    public function getCategory(){
        $stock = Category::all();
        return $this->categoryDatatable($stock);
    }
}
