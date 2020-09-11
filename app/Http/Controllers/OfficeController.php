<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Office;


class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.stock.office');
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
            
        ], [
            'name.required' => 'Campo Nombre Requerido',
            
        ]);
        $office         = new Office;
        $office->name   = $request->name;
        
        if ( $office->save()) {
            notify()->success('Oficina Creada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Crear la Oficina');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = Office::findOrFail($id);
        $officeJson = 
            [
                'id'          => $office->id,
                'name'        => $office->name
                
            ];
        return response()->json([
            'office' => $officeJson 

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'name' => 'required',
            
        ], [
            'name.required' => 'Campo Nombre Requerido',
            
        ]);
        $office = Office::findOrFail($id);
        $office->name   = $request->name;

        if ( $office->save()) {
            notify()->success('Oficina Editada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Editar la Oficina');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id);
        $office->delete();
        notify()->error('Oficina Eliminada Correctamente');
        return redirect()->back();
    }

    public function officeDatatable($offices){
        $arrayOffice = array();

        foreach ($offices as $office) {
            $officeJson = 
            [
                'DT_RowId'  => $office->id,
                'id'        => $office->id,
                'name'      => $office->name    
            ];
            array_push($arrayOffice, $officeJson);
        }
        
        return datatables($arrayOffice)->toJson();
    }

    public function getOffices(){
        $office = office::all();
        return $this->officeDatatable($office);
    }
}
