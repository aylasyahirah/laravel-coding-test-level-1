<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::paginate();

        return view('events.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'eventName' => 'required|string',
            'slug' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json(array('success' => false, 'errors' => $validator->errors()->all()), $status = 422);
        } else {

            $startAt = null;
            $endAt = null;

            if ($request->start_at) {
                $dateStart = Carbon::createFromFormat('d/m/Y h:i A', $request->startAt);
                $startAt = $dateStart->format('Y-m-d H:i:s');
            }

            if ($request->end_at) {
                $dateEnd = Carbon::createFromFormat('d/m/Y h:i A', $request->endAt);
                $endAt = $dateEnd->format('Y-m-d H:i:s');
            }

            $event = new Event();
            $event->id = Str::uuid()->toString();
            $event->name = $request->eventName;
            $event->slug = $request->slug;
            $event->start_at = $startAt;
            $event->end_at = $endAt;
            $event->save();

            return redirect('/events');
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
        //
        $event = Event::find($id);

        return view('events.show')
            ->with('event', $event);
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
        $event = Event::find($id);
        $startAt = date_create($event->start_at);
        $endAt = date_create($event->end_at);

        return view('events.edit')
            ->with('event', $event)
            ->with('startAt', date_format($startAt, 'd/m/Y H:i A'))
            ->with('endAt', date_format($endAt, 'd/m/Y H:i A'));
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
        //
        $validator = Validator::make($request->all(), [
            'eventName' => 'required|string',
            'slug' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json(array('success' => false, 'errors' => $validator->errors()->all()), $status = 422);
        } else {
            dd($request->all());

            $startAt = null;
            $endAt = null;

            if ($request->start_at) {
                $dateStart = Carbon::createFromFormat('d/m/Y h:i A', $request->startAt);
                $startAt = $dateStart->format('Y-m-d H:i:s');
            }

            if ($request->end_at) {
                $dateEnd = Carbon::createFromFormat('d/m/Y h:i A', $request->endAt);
                $endAt = $dateEnd->format('Y-m-d H:i:s');
            }

            $event = Event::find($id);
            $event->name = $request->eventName;
            $event->slug = $request->slug;
            $event->start_at = $startAt;
            $event->end_at = $endAt;
            $event->update();

            return redirect('/events');
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
        //
        $event = Event::find($id);

        if ($event) {
            $event->deleted_at = Carbon::now();
            $event->save();

            return redirect('/events');
        }
    }
}
