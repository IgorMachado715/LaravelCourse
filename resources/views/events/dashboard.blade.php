@extends('layouts.main')

@section('title', 'Dashboard')

@section('content') 


<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 class="h4">My events</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">participants</th>
                <th scope="col">Actions</th>
            </tr>
    
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td> 
                        <a class="btn btn-info edit-btn" href="/events/edit/{{$event->id}}"><ion-icon name="create-outline"> Edit</a> 
                        <form action="/events/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center">No events found, <a href="/events/create">Create events</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 class="h4">My events as participant</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsasparticipant) > 0)
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">participants</th>
                <th scope="col">Actions</th>
            </tr>
    
        <tbody>
            @foreach($eventsasparticipant as $event)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td> 
                        <form action="/events/leave/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"> Leave</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center">You have not joined any event<a href="/">see all events</a></p>
    @endif
</div>

@endsection