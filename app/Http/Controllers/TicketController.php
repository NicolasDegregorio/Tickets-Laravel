<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Ticket_user;
use App\User;
use App\State;
use Carbon\Carbon; 



class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'], ['except' => ['getTickets','index']]);
    }
    public function index($id) 
    {
        $ticket = Ticket::findOrFail($id);
        $users  = User::all();
        $states = State::all();
        $ticket_user = Ticket_user::where('responsible', '=', '1')->where('ticket_id', '=', $id)->get();
        $user_id = $ticket_user->pluck('user_id');
        $user_responsible = User::find($user_id);
        $user_responsible_name = $user_responsible[0]->name;
        
        return view('frontend.section.modals.ticket_details')
        ->with('ticket', $ticket)
        ->with('users', $users)
        ->with('states', $states)
        ->with('ticket_user', $ticket_user)
        ->with('responsible', $user_responsible_name);
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
            'description'         => 'required',
            'start_date'          => 'required|date',
            'end_date'            => 'required|date',
            'userId'              => 'required|integer',
            'priority'            => 'required|integer',
            'institution'         => 'required|integer',
            
            
        ], [
            'description.required'   => 'Porfavor Describa el Problema',
            'start_date.required'    => 'Porfavor Cargar una Fecha de Inicio',
            'start_date.date'        => 'El Formato de Fecha es Invalido',
            'end_date.required'      => 'Porfavor Cargar una Fecha Limite',
            'end_date.date'          => 'El Formato de Fecha es Invalido',
            'userId.required'        => 'Porfavor Seleccione un Usuario',
            'userId.integer'         => 'User_id debe ser un Numero',
            'priority.required'      => 'Por Favor Seleccione Una Prioridad',
            'priority.integer'       => 'integer_id debe ser un Numero',
            'institution.required'   => 'Por favor Seleccione una Institucion',
            'institution.required'   => 'institution_id Debe ser un Numero',
            
            
        ]);
        
        $ticket = new Ticket;
        $ticket->description    = $request->description;
        $ticket->start_date     = Carbon::parse($request->start_date)->format('Y/m/d H:i:s');
        $ticket->end_date       = Carbon::parse($request->end_date)->format('Y/m/d H:i:s');
        $ticket->priority_id    = $request->priority;
        $ticket->institution_id = $request->institution;
        $ticket->state_id       = 1;
        
        if ($ticket->save()) {
            $ticket->user()->attach([$request->userId => ['responsible' => 1]]);
            notify()->success('Ticket Creado Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Cargar el Ticket');
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
        $ticket = Ticket::findOrFail($id);
        $ticket_user = Ticket_user::where('responsible', '=', '1')->where('ticket_id', '=', $ticket->id)->get();
        $user_id = $ticket_user->pluck('user_id');
        $user_name = User::find($user_id);
        $ticketJson = 
            ['id' => $ticket->id,
            'ticketCreated'=> $ticket->created_at,
            'description'  => $ticket->description, 
            'institution'  => $ticket->Institution->name,
            'priority'     => $ticket->priority->name,
            'state'        => $ticket->state->name,
            'user'         => $user_name[0]->name,
            'start_date'   => $ticket->start_date,
            'end_date'     => $ticket->end_date
            ];
        return response()->json([
            'ticket' => $ticketJson
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
        $ticket = Ticket::findOrFail($id);

        $data = request()->validate([
            'description'         => 'required',
            'start_date'          => 'required|date',
            'end_date'            => 'required|date',
            'userId'              => 'required|integer',
            'priority'            => 'required|integer',
            'institution'         => 'required|integer',
            
            
        ], [
            'description.required'   => 'Porfavor Describa el Problema',
            'start_date.required'    => 'Porfavor Cargar una Fecha de Inicio',
            'start_date.date'        => 'El Formato de Fecha es Invalido',
            'end_date.required'      => 'Porfavor Cargar una Fecha Limite',
            'end_date.date'          => 'El Formato de Fecha es Invalido',
            'userId.required'        => 'Porfavor Seleccione un Usuario',
            'userId.integer'         => 'User_id debe ser un Numero',
            'priority.required'      => 'Por Favor Seleccione Una Prioridad',
            'priority.integer'       => 'integer_id debe ser un Numero',
            'institution.required'   => 'Por favor Seleccione una Institucion',
            'institution.required'   => 'institution_id Debe ser un Numero',
            
            
        ]);

        $ticket->description    = $request->description;
        $ticket->user_id        = $request->userId;
        $ticket->priority_id    = $request->priority;
        $ticket->institution_id = $request->institution;
        $ticket->state_id = 1;
        $ticket->start_date     = Carbon::parse($request->start_date)->format('Y/m/d H:i:s');
        $ticket->end_date       = Carbon::parse($request->end_date)->format('Y/m/d H:i:s');
        if ($ticket->save()) {
            notify()->success('Ticket Editado Correctamente');
            return redirect()->back();
        }
        else {
            notify()->error('Ocurrio un Error al Editar el Ticket');
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
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        notify()->error('Ticket Eliminado Correctamente');
        return redirect()->back();
    }

    public function change_state(Request $request){
        $ticket = Ticket::findOrFail($request->id);
        $ticket->state_id = $request->state;
        if ($ticket->save()) {
            return response()->json(['message' => "Estado del Ticket Actualizado", "state" => $request->state,]);
        }
        else {
            return response()->json(['message' => "Ocurrio un Error",]);
        }
    }

    public function ticketJson($tickets){
        $arrayTickets = array();
        foreach ($tickets as $ticket) {
            $ticket_user = Ticket_user::where('responsible', '=', '1')->where('ticket_id', '=', $ticket->id)->get();
            $user_id = $ticket_user->pluck('user_id');
            $user_name = User::find($user_id);
            
                $ticketJson = 
                [
                    'DT_RowId' => $ticket->id,
                    'id' => $ticket->id,
                    'ticketCreated' => $ticket->created_at,
                    'description'   => $ticket->description, 
                    'institution'   => $ticket->Institution->name,
                    'priority'      => $ticket->priority->name,
                    'state'         => $ticket->state->name,
                    'user'          => $user_name[0]->name,
                    
                ];
                array_push($arrayTickets, $ticketJson);
            
        }
        
        return datatables($arrayTickets)->toJson();
    }

    public function getTickets($id){
        
        if (auth()->user()->role->name === 'admin') {
            if($id === '0'){
                $ticketsAll = Ticket::all();
                return $this->ticketJson($ticketsAll);
            } elseif($id === '1') {
                $unresolvedTickets  = Ticket::where('state_id', '=', 1)->get();
                return $this->ticketJson($unresolvedTickets);
            } elseif ($id === '2') {
                $ticketsInProgress = Ticket::where('state_id', '=', 2)->get();
                return $this->ticketJson($ticketsInProgress);
            } elseif ($id === '3') {
                $ticketsResolved =  Ticket::where('state_id', '=', 3)->get();
                return  $this->ticketJson($ticketsResolved);
            }
        }else {
            if ($id === '1') {
                $unresolvedTickets  =Ticket::where('state_id', 1 ) 
                ->whereHas('user', function($q) { $q->where('user_id',  auth()->id()); })
                ->get();          
                return $this->ticketJson($unresolvedTickets);
            }elseif($id === '0'){
                $ticketsAll = Ticket::
                whereHas('user', function($q) { $q->where('user_id',  auth()->id()); })
                ->get();          
                return $this->ticketJson($ticketsAll);
            } elseif ($id === '2') {
                $ticketsInProgress = Ticket::where('state_id', 2) 
                ->whereHas('user', function($q) { $q->where('user_id',  auth()->id()); })
                ->get();          
                return $this->ticketJson($ticketsInProgress);
            } elseif ($id === '3') {
                $ticketsResolved =  Ticket::where('state_id', 3) 
                ->whereHas('user', function($q) { $q->where('user_id',  auth()->id()); })
                ->get();          
                return  $this->ticketJson($ticketsResolved);
            }
        }      
        
    }
    public function team_ticket(Request $request){
        $ticket = Ticket::findOrFail($request->ticketId);
        foreach ($request->usersTicket as $user) {
            $ticket->user()->attach([$user => ['responsible' => 0]]);
        }
        notify()->success('Usuario Agregado al Equipo Correctamente');
        return redirect()->back();    
    }

    

    
    
}
