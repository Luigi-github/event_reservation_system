<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'integer|required|exists:users,id',
            'event_id' => 'integer|required|exists:events,id'
        ]);
        if ($validator->fails()) {
            return response($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $attendee_limit = Event::attendee_limit($data['event_id']);
        $attendee_count = Ticket::countAttendee($data);

        if ($attendee_count < $attendee_limit->attendee_limit){
            return response([
                'message' => 'The ticket has been reserved.',
                'ticket' => Ticket::create($data)
            ], Response::HTTP_CREATED);
        }else{
            return response('The event has no more reservations', Response::HTTP_BAD_REQUEST);
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
        $ticket = Ticket::find($id);
        if(!isset($ticket)){
            return response([
                'message' => 'The ticket is not reserved.'
            ], Response::HTTP_CONFLICT);
        }

        return response($ticket, Response::HTTP_OK);
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => 'integer|required|exists:clients',
            'user_id' => 'integer|required',
            'event_id' => 'integer|required'
        ]);
        if ($validator->fails()) {
            response($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        // Crear ticket
        $ticket = Ticket::find($id);
        $ticket->fill($data);
        $ticket->save();

        return response([
            'message' => 'The ticket has been modified.',
            'ticket' => ticket::create($data)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if(!isset($ticket)){
            return response([
                'message' => 'The ticket is not reserved.'
            ], Response::HTTP_CONFLICT);
        }

        $ticket->delete();

        return response([
            'message' => 'The ticket has been deleted.'
        ], Response::HTTP_OK);
    }
}
