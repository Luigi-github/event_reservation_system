<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::get();
        if(!isset($event)){
            return response([
                'message' => 'The event is not registered.'
            ], Response::HTTP_CONFLICT);
        }

        return response($event, Response::HTTP_OK);
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
            'title' => 'string|required',
            'description' => 'string|required',
            'date' => 'required|date_format:Y-m-d',
            'location' => 'string|required',
            'email' => 'nullable|email:rfc|max:255',
            'price' => 'regex:/^\d+(\.\d{1,2})?$/|required',
            'attendee_limit' => 'integer|required'
        ]);
        if ($validator->fails()) {
            response($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        return response([
            'message' => 'The event has been created.',
            'event' => Event::create($data)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if(!isset($event)){
            return response([
                'message' => 'The event is not registered.'
            ], Response::HTTP_CONFLICT);
        }

        return response($event, Response::HTTP_OK);
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
            'title' => 'string|required',
            'description' => 'string|required',
            'date' => 'required|date_format:Y-m-d',
            'location' => 'string|required',
            'email' => 'nullable|email:rfc|max:255',
            'price' => 'regex:/^\d+(\.\d{1,2})?$/|required',
            'attendee_limit' => 'integer|required'
        ]);
        if ($validator->fails()) {
            response($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        // Create event
        $event = Event::find($id);
        $event->fill($data);
        $event->save();

        return response([
            'message' => 'The event has been modified.',
            'event' => Event::create($data)
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
        $event = Event::find($id);
        if(!isset($event)){
            return response([
                'message' => 'The event is not registered.'
            ], Response::HTTP_CONFLICT);
        }
        $event->delete();
        return response([
            'message' => 'The event has been deleted.'
        ], Response::HTTP_OK);
    }
}
