<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index() {
        $search = request('search');
    
        if($search) {
            $events = Event::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $events = Event::all();
        }
    
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            
            $extension = $request->file('image')->getClientOriginalExtension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->file('image')->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')-> with('msg', 'Event created successfully');
    }

    public function show($id){
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
        }
    }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')-> with('msg', 'Event deleted successfully');
    }

    public function edit($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        $event->date = new \DateTime($event->date);

        if($user->id != $event->user_id){
            return redirect('/dashboard')-> with('msg', 'You are not the owner of this event');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request){

        $data = $request->all();
        
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            
            $extension = $request->file('image')->getClientOriginalExtension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->file('image')->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')-> with('msg', 'Event updated successfully');

    }

    public function joinEvent($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);
        // Check if the user is already a participant of the event
        if ($user->eventsAsParticipant()->where('event_id', $id)->exists()) {
            return redirect('/dashboard')->with('msg', 'You have already joined the event ' . $event->title);
        }

        // Attach the user to the event
        $user->eventsAsParticipant()->attach($id);

        return redirect('/dashboard')-> with('msg', 'You have joined the event '. $event->title);
    }

    public function leaveEvent($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);
        // Check if the user is already a participant of the event
        if (!$user->eventsAsParticipant()->where('event_id', $id)->exists()) {
            return redirect('/dashboard')->with('msg', 'You have not joined the event ' . $event->title);
        }

        // Detach the user from the event
        $user->eventsAsParticipant()->detach($id);

        return redirect('/dashboard')-> with('msg', 'You have left the event '. $event->title);
    }
}
