@extends('layouts.main')

@section('title', 'Dashboard')

@section('content') 


<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 class="h4">Dashboard</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    @else
    <p class="text-center">No events found, <a href="/events/create">Create events</a></p>
    @endif
</div>

@endsection