<?php

namespace App\Http\Controllers;
use App\User;
use App\Institution;
use App\Priority;
use App\Ticket;
use Calendar;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
        //Funcion que envia los modelos al Frontend
        public function index(){
            if (auth()->user()->role->name === 'admin') {
                    $ticketsTotal    = Ticket::all()->count();
                    $unresolvedTickets  = Ticket::where('state_id', '=', 1)->count();
                    $ticketsInProgress = Ticket::where('state_id', '=', 2)->count();
                    $ticketsResolved =  Ticket::where('state_id', '=', 3)->count();
            }else {
                $ticketsTotal       = Ticket::whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $unresolvedTickets  = Ticket::where('state_id', 1 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $ticketsInProgress  = Ticket::where('state_id', 2 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $ticketsResolved    = Ticket::where('state_id', 3 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
            }  
            
            $users = User::all();
            $institutions = Institution::all();
            $priorities = Priority::all();
            $tickets = Ticket::all();

    
            return view('frontend.section.content')
            ->with('users', $users)
            ->with('institutions',$institutions)
            ->with('priorities',$priorities)
            ->with('tickets', $tickets)
            ->with('ticketsTotal',$ticketsTotal)
            ->with('unresolvedTickets',$unresolvedTickets)
            ->with('ticketsInProgress',$ticketsInProgress)
            ->with('ticketsResolved',$ticketsResolved);
                        
        }

        public function users(){
            return view('frontend.administracion.users');
        }

        public function calendar()
        {
            $events = [];
            if (auth()->user()->role->name === 'admin') {
                $data = Ticket::all();
            }else{
                $data = Ticket::whereHas('user', function($q) 
                        { $q->where('user_id',  auth()->id());})
                        ->get();    
            }
            
            
            if($data->count()) {
                foreach ($data as $key => $value) {
                    if ($value->state->name === "Sin Resolver" || $value->state->name === "En Progreso") {
                        if ($value->priority->name == "Alta") {
                            $color = '#FA1300';
                        }elseif ($value->priority->name == "Media") {
                            $color = '#FFF818';
                        }elseif ($value->priority->name == "Baja") {
                            $color = '#1877FF';
                        }
                        $events[] = Calendar::event(
                            $value->institution->name.' | '.$value->description,
                            true,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date.' +1 day'),
                            null,
                            
                            // Add color and link on event
                            [
                                'color' => $color,
                                'url' => url('tickets/'.$value->id),
                            ]
                        );
                    }

                    
                }
            }
            $calendar = Calendar::addEvents($events);
            return view('frontend.calendar', compact('calendar'));
        }

        public function ticketsSituation(){
            if (auth()->user()->role->name === 'admin') {
                $ticketsTotal    = Ticket::all()->count();
                $unresolvedTickets  = Ticket::where('state_id', '=', 1)->count();
                $ticketsInProgress = Ticket::where('state_id', '=', 2)->count();
                $ticketsResolved =  Ticket::where('state_id', '=', 3)->count();
            }else {
                $ticketsTotal       = Ticket::whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $unresolvedTickets  = Ticket::where('state_id', 1 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $ticketsInProgress  = Ticket::where('state_id', 2 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
                $ticketsResolved    = Ticket::where('state_id', 3 ) 
                                    ->whereHas('user', function($q) { $q->where('user_id',  auth()->id());})
                                    ->get()->count();
            } 
            
            $ticketJson = 
            ['total' => $ticketsTotal,
            'unresolved'=> $unresolvedTickets,
            'inProgress'  => $ticketsInProgress, 
            'resolved'  => $ticketsResolved
            ];

            return response()->json([
                'ticket' => $ticketJson
            ]);
        }
    
}
