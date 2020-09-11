<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        return view('frontend.report.index');
    }

    public function report()
    {
        return view('frontend.report.report');
    }

    

    public function filter_range(Request $request){
        $start_date = Carbon::parse($request->start)->format('Y/m/d H:i:s');
        $end_date = Carbon::parse($request->end)->format('Y/m/d H:i:s');

        if (auth()->user()->role->name === 'admin') {
            $tickets = DB::table('tickets') 
            ->whereBetween('start_date', [$start_date, $end_date]) 
            ->groupBy('month','state') 
            ->orderBy('month', 'ASC') 
            ->get([ DB::raw('MONTH(start_date) as month'), DB::raw('state_id as state'),DB::raw('COUNT(*) as value') ]);
            
            return $tickets;
        }else{
            $tickets = Ticket::
            whereHas('user', function($q) { $q->where('user_id',  auth()->id()); }) 
            ->whereBetween('start_date', [$start_date, $end_date]) 
            ->groupBy('month','state') 
            ->orderBy('month', 'ASC') 
            ->get([ DB::raw('MONTH(start_date) as month'), DB::raw('state_id as state'),DB::raw('COUNT(*) as value') ]);
            
            return $tickets;
        }

    }

    public function ticket_situation(Request $request){
        $start_date = Carbon::parse($request->start)->format('Y/m/d H:i:s');
        $end_date = Carbon::parse($request->end)->format('Y/m/d H:i:s');
       
        if (auth()->user()->role->name === 'admin') {
            $ticketsAll = Ticket ::whereBetween('start_date', [$start_date, $end_date])->count();    
            $unresolvedTickets = Ticket ::whereBetween('start_date', [$start_date, $end_date])->where('state_id', 1)->count();
            $ticketsInProgress = Ticket ::whereBetween('start_date', [$start_date, $end_date])->where('state_id', 2)->count();
            $ticketsResolved = Ticket ::whereBetween('start_date', [$start_date, $end_date])->where('state_id', 3)->count();
        }else{
    
            $ticketsAll = Ticket ::
                        whereHas('user', function($q) { $q->where('user_id',  auth()->id()); }) 
                        ->whereBetween('start_date', [$start_date, $end_date])
                        ->count();    
            $unresolvedTickets = Ticket ::
                                whereHas('user', function($q) { $q->where('user_id',  auth()->id()); }) 
                                ->whereBetween('start_date', [$start_date, $end_date])
                                ->where('state_id', 1)
                                ->count();
            $ticketsInProgress = Ticket ::
                                whereHas('user', function($q) { $q->where('user_id',  auth()->id()); }) 
                                ->whereBetween('start_date', [$start_date, $end_date])
                                ->where('state_id', 2)
                                ->count();
            $ticketsResolved = Ticket ::
                            whereHas('user', function($q) { $q->where('user_id',  auth()->id()); }) 
                            ->whereBetween('start_date', [$start_date, $end_date])
                            ->where('state_id', 3)
                            ->count();
        
        }
        

        $ticketJson = 
                [
                    'ticketsAll'        => $ticketsAll,
                    'unresolvedTickets' => $unresolvedTickets,
                    'ticketsInProgress' => $ticketsInProgress,
                    'ticketsResolved'   => $ticketsResolved, 
                    
                    
                ];
        return $ticketJson;
    }

    
}
