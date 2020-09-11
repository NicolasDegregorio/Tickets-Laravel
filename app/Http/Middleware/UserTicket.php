<?php

namespace App\Http\Middleware;

use Closure;
use App\Ticket;

class UserTicket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ticketId =  $request->id;
        $ticket   = Ticket::findOrFail($ticketId);
        $ticketUser = $ticket->user;
        if ($ticketUser->contains(auth()->user()->id)) {
            return $next($request);
        }
        else{
            return redirect('/');
        }



    }
}
