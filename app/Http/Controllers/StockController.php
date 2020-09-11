<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Stock;
use App\Office;
use App\Category;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $offices    = Office::all();
            $categories = Category::all();
            return view('frontend.stock.index')
            ->with('offices', $offices)
            ->with('categories',$categories);
                        
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
            'name'         => 'required',
            'quantity'            => 'required|integer',
            'category'            => 'required|integer',
            'office'              => 'required|integer',
            
            
        ], [
            'name.required'     => 'Campo Nombre Requerido',
            'quantity.required' => 'Campo Cantidad Requerido',
            'quantity.integer'  => 'La Cantidad debe ser un Numero',
            'category.required' => 'Campo Categoria Requerido',
            'category.integer'  => 'campo_id debe ser un Numero',
            'office.required'   => 'Campo Oficina Requerido',
            'office.required'   => 'office_id Debe ser un Numero',
            
            
        ]);
         

        $stock = new StocK;
        $stock->name        = $request->name;
        $stock->quantity    = $request->quantity;
        $stock->category_id = $request->category;
        $stock->office_id   = $request->office;
        

        if ($stock->save()) {
            notify()->success('Articulo Creado Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Cargar el Articulo');
            return redirect()->back();
        }


       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $stockJson = 
            [
                'id'        => $stock->id,
                'name'      => $stock->name,
                'quantity'      => $stock->quantity,
                'category'  => $stock->category->name, 
                'office'    => $stock->office->name
            
            ];
        return response()->json([
            'stock' => $stockJson
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = request()->validate([
            'name'                => 'required',
            'quantity'            => 'required|integer',
            'category'            => 'required|integer',
            'office'              => 'required|integer',
            
            
        ], [
            'name.required'     => 'Campo Nombre Requerido',
            'quantity.required' => 'Campo Cantidad Requerido',
            'quantity.integer'  => 'La Cantidad debe ser un Numero',
            'category.required' => 'Campo Categoria Requerido',
            'category.integer'  => 'campo_id debe ser un Numero',
            'office.required'   => 'Campo Oficina Requerido',
            'office.required'   => 'office_id Debe ser un Numero',
            
            
        ]);
        $stock = Stock::findOrFail($id);

        $stock->name        = $request->name;
        $stock->quantity    = $request->quantity;
        $stock->category_id = $request->category;
        $stock->office_id   = $request->office;

        if ($stock->save()) {
            notify()->success('Articulo Editado Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Editar el Articulo');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        
        notify()->error('Articulo Eliminado Correctamente');
        return redirect()->back();
    }

    public function stockDatatable($stocks){
        $arrayStock = array();

        foreach ($stocks as $stock) {
            $stockJson = 
            [
                'DT_RowId'  => $stock->id,
                'id'        => $stock->id,
                'name'      => $stock->name,
                'quantity'  => $stock->quantity,
                'category'  => $stock->category->name, 
                'office'    => $stock->office->name
                
            ];
            array_push($arrayStock, $stockJson);
        }
        
        return datatables($arrayStock)->toJson();
    }

    public function getStocks(){
        $stock = Stock::all();
        return $this->stockDatatable($stock);
    }

}
