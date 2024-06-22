@extends('layouts.main')

@section('title', 'Events Laravel')

@section('content') 

<style>
    /* Add custom styles if needed */
    #search-container {
      margin-top: 80px;
    }
  </style>

<main class="content">

  <div class="row">
        <div class="col-12">
            <div class="card card-body border-0 shadow mb-4">
                <div class="d-block mb-4 mb-md-0">
                    <h1 class="h4">Search for Events</h1>
                  </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label htmlFor="search">Insert the event above</label>
                            <form action="/" method="GET">
                              <input
                                class="form-control"
                                id="search"
                                type="text"
                                name="search"
                                placeholder="Game event"
                              />
                            </form>
                        </div>
                    </div>
                  </div>  
              </div>
        </div>
  </div>   
  
  <div class="row">
  <div class="col-12">
    <div class="card card-body border-0 shadow mb-3">
      <div class="d-block mb-3 mb-md-0">
        @if($search)
        <h1 class="h4">Searching for Events: {{ $search }}</h1>
        @else
        <h1 class="h4">Next Events</h1>
        @endif
        <label>Here you can see the next events</label>
      </div>
      <div class="row">
        @foreach($events as $event)
        <div class="col-md-3">
          <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="/img/events/{{ $event->image }}" alt="Card image cap">
            <div class="card-body">
              <h1 class="h4">{{ $event->title }}</h1>
              <p class="card-text">{{ $event->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{ date ("d/m/Y", strtotime($event->date)) }}</li>
              <li class="list-group-item">X participants</li>
            </ul>
            <div class="card-body">
              <a href="/events/{{ $event->id }}" class="btn btn-primary">More info</a>
            </div>
          </div>
        </div>
        @endforeach
        @if (count($events) == 0 && $search)
          <p class="text-center">Could not find any event with: {{ $search }} <a href="/">See all events</a></p>
        @elseif(count($events) == 0)
          <p class="text-center">No events found</p>
        @endif
      </div>
    </div>
  </div>
</div> 

    

</main>



@endsection