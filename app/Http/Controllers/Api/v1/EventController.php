<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //list all existing events
    public function getAllEvents()
    {
        $events = Event::all();

        return response()->json(
            [
                'success' => true,
                'events' => $events
            ]
        );
    }

    //list all active events
    public function getActiveEvents()
    {
        $activeEvents = Event::whereBetween(Carbon::now(), ['start_at', 'end_at'])->get();

        return response()->json([
            'success' => true,
            'active_events' => $activeEvents
        ]);
    }

    //get specific event by id
    public function getEvent($id)
    {
        $event = Event::find($id);

        return response()->json([
            'success' => true,
            'event' => $event
        ]);
    }

    //create an event
    public function createEvent(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json(array('success' => false, 'errors' => $validator->errors()->all()), $status = 422);
        } else {

            $event = new Event();
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->start_at = $request->startAt;
            $event->end_at = $request->endAt;
            $event->save();

            return response()->json([
                'success' => true,
                'message' => 'New event has been added successfully.'
            ]);
        }
    }

    //update event if exists else create new event
    public function eventUpdate(Request $request, $id)
    {

        //get event
        $event = Event::find($id);

        if ($event) {
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->start_at = $request->startAt;
            $event->end_at = $request->endAt;
            $event->update();

            return response()->json([
                'message' => 'Event updated successfully.'
            ]);
        } else {
            $event = new Event();
            $event->name = $request->name;
            $event->slug = $request->slug;
            $event->start_at = $request->startAt;
            $event->end_at = $request->endAt;
            $event->save();

            return response()->json([
                'message' => 'New event created successfully.'
            ]);
        }
    }

    // delete an event
    public function deleteEvent($id)
    {

        $event = Event::find($id);

        $event->deleted_at = Carbon::now();
        $event->save();

        return response()->json([
            'message' => 'Event deleted successfully.'
        ]);
    }
}
