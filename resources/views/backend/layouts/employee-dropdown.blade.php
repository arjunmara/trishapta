@if($data['rows']->isNotEmpty())
    <option value="" selected disabled>Select</option>
    @foreach($data['rows'] as $row)
        <option value="{{$row->id}}">{{$row->name}}</option>
    @endforeach
@else
    <option value="">No Option Available!</option>
@endif