@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h4>Admin viewing</h4>
    </div>
    <div class="row">
        
        <div class="panel-heading">Available timeslot <span>[{{ $ms->user->name }}]</span></div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-flex flex-row-reverse">
                <div class="p-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#atModal">Update available timeslot</button>
                </div>
            </div>
            <div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Block no.</th>
                        <th scope="col">Time</th>
                        <th scope="col">More options</th>
                      </tr>
                    </thead>
                    <tbody>                        
                        @if($selectRecords)
                            @foreach ($selectRecords as $rec)
                                <tr>
                                    <td>{{ $rec->availDate }}</td>
                                    <td>{{ $rec->blockNumber }}</td>
                                    <td>
                                        @switch($rec->blockNumber)
                                            @case(0)
                                                0900HRS - 1000HRS
                                                @break
                                            @case(1)
                                                1000HRS - 1100HRS
                                                @break
                                            @case(2)
                                                1100HRS - 1200HRS
                                                @break
                                            @case(3)
                                                1300HRS - 1400HRS
                                                @break
                                            @case(4)
                                                1400HRS - 1500HRS
                                                @break
                                            @case(5)
                                                1500HRS - 1600HRS
                                                @break
                                            @default
                                                NIL
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <form action="{{ route('availtimeslot.destory', ['at' => $rec->id ])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                                <td>No info</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
            </div>
                        
        </div>

    </div>

    <div class="modal fade" id="atModal" tabindex="-1" aria-labelledby="AvailableStimeslot" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="atModalLabel">Update available timeslots</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('availtimeslot.astore', ["ms" => $ms->id]) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if($dates)
                            <select class="form-select col-12 select" size="10" id="setTimeslot[]" name="setTimeslot[]" multiple>
                                @foreach ($dates as $date)
                                    @for ($i = 0; $i < 6; $i++)
                                        @switch($i)
                                            @case(0)
                                                @php ($exitCase = False)                                                   
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "0") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 0900-1000</option>
                                                        @php ($exitCase = True)
                                                        @break  
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "0"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 0900-1000</option>
                                                        @php ($exitCase = True)
                                                        @break 
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 0900-1000</option>
                                                    @break
                                                @endif
                                            @case(1)
                                                @php ($exitCase = False)  
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "1") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 1000-1100</option>
                                                        @php ($exitCase = True)
                                                        @break     
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 1000-1100</option>
                                                        @php ($exitCase = True)
                                                        @break                                               
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 1000-1100</option>
                                                    @break
                                                @endif
                                            @case(2)
                                                @php ($exitCase = False)
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "2") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 1100-1200</option>
                                                        @php ($exitCase = True)
                                                        @break 
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "2"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 1100-1200</option>
                                                        @php ($exitCase = True)
                                                        @break                                                   
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 1100-1200</option>
                                                    @break
                                                @endif
                                            @case(3)
                                                @php ($exitCase = False)
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "3") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 1300-1400</option>
                                                        @php ($exitCase = True)
                                                        @break     
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "3"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 1300-1400</option>
                                                        @php ($exitCase = True)
                                                        @break                                                
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 1300-1400</option>
                                                    @break
                                                @endif
                                            @case(4)
                                                @php ($exitCase = False)
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "4") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 1400-1500</option>
                                                        @php ($exitCase = True)
                                                        @break  
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "4"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 1400-1500</option>
                                                        @php ($exitCase = True)
                                                        @break                                                   
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 1400-1500</option>
                                                    @break
                                                @endif
                                            @case(5)
                                                @php ($exitCase = False)
                                                @foreach ($records as $rec)
                                                    @if(($rec->availDate == $date) && ($rec->blockNumber == "5") && ($rec->status == "1"))
                                                        <option value="{{ $date }}block{{ $i }}" disabled>{{$date}} | 1500-1600</option>
                                                        @php ($exitCase = True)
                                                        @break 
                                                    @elseif(($rec->availDate == $date) && ($rec->blockNumber == "5"))
                                                        <option value="{{ $date }}block{{ $i }}" selected>{{$date}} | 1500-1600</option>
                                                        @php ($exitCase = True)
                                                        @break                                                   
                                                    @endif
                                                @endforeach
                                                @if($exitCase)
                                                    @break
                                                @else
                                                    <option value="{{ $date }}block{{ $i }}">{{$date}} | 1500-1600</option>
                                                    @break
                                                @endif

                                        @endswitch
                                    @endfor
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var options = [].slice.call(document.querySelectorAll("option"));

    options.forEach(function (element)
    {
        // console.log("element", element);
        element.addEventListener("mousedown", 
            function (e)
            {
                e.preventDefault();
                element.parentElement.focus();
                this.selected = !this.selected;
                return false;
            }
            , false
        );
    });
</script>
@endsection 