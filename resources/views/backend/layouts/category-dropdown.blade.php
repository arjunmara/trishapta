@if($data['rows']->isNotEmpty())
    @foreach($data['rows'] as $row)
        <option value="{{$row->id}}">{{$row->title}}</option>
    @endforeach
@else
    <option value="">No Option Available!</option>
@endif