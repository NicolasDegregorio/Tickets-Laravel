<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.administracion.institutions');
        
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
            'adress' => 'required|string',
            'cue'    => 'required|integer',
            
            
        ], [
            'name.required'     => 'Campo Nombre Requerido',
            'adress.required'   => 'Campo Direccion Requerido',
            'adress.string'     => 'La Direccion Debe tener Formato de Cadena',
            'cue.required'      => 'Campo Cue Requerido',
            'cue.integer'       => 'El Cue debe ser un Numero',
            
            
        ]);
        $institution         = new Institution;
        $institution->name   = $request->name;
        $institution->adress = $request->adress;
        $institution->cue    = $request->cue;

        if ($institution->save()) {
            notify()->success('Institucion Creada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Crear la Institucion');
            return redirect()->back();
        }
        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = Institution::findOrFail($id);
        $tinstitutionJson = 
            ['id' => $institution->id,
            'name' => $institution->name,
            'adress' => $institution->adress,
            'cue'  => $institution->cue
            ];
        return response()->json([
            'institution' => $tinstitutionJson 

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = request()->validate([
            'name'   => 'required',
            'adress' => 'required|string',
            'cue'    => 'required|integer',
            
            
        ], [
            'name.required'     => 'Campo Nombre Requerido',
            'adress.required'   => 'Campo Direccion Requerido',
            'adress.string'     => 'La Direccion Debe tener Formato de Cadena',
            'cue.required'      => 'Campo Cue Requerido',
            'cue.integer'       => 'El Cue debe ser un Numero',
            
            
        ]);
        $institution         = Institution::findOrFail($id);

        $institution->name   = $request->name;
        $institution->adress = $request->adress;
        $institution->cue    = $request->cue;

        if ($institution->save()) {
            notify()->success('Institucion Editada Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Editar la Institucion');
            return redirect()->back();
        }
                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();
        notify()->error('Institution Eliminada Correctamente');
        return redirect()->back();
    }

    public function institutionsDataTable($institutions){
        $arrayInstitution = array();

        foreach ($institutions as $institution) {
            $institutionJson = 
            [
                'DT_RowId' => $institution->id,
                'id' => $institution->id,
                'name' => $institution->name,
                'adress' => $institution->adress,
                'cue'  => $institution->cue
                          
            ];
            array_push($arrayInstitution, $institutionJson);
        }
        
        
        return datatables($arrayInstitution)->toJson();
    }

    public function getInstitutions(){
        $institutions = Institution::all();
        return $this->institutionsDataTable($institutions);
    }


}
