@extends('layouts.main')

@section('title', 'Create Events')

@section('content') 

<div id="event-create-container" class="col-md-6-offset-md-3">
    <h1 class="h4">Create Event</h1>
    <form action="/events" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Event Image:</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Event:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Event name">
        </div>
        <div class="form-group">
            <label for="title">Event date</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="title">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="city name">
        </div>
        <div class="form-group">
            <label for="title">Event is private?</label>
            <select class="form-control" id="private" name="private">
            <option value="0">No</option>
            <option value="1">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Description:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Event description"></textarea>
        </div>
        <div class="form-group">
            <label for="title">Add Infrastructure Items:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Bebidas grátis"> Bebidas grátis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food"> Open food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>
        <input type="submit" class="btn btn-secondary" value="Create Event">
    </form>
</div>

@endsection