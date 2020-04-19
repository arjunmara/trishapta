@if($data['rows']->isNotEmpty())
    <?php $i = 1; ?>
    @foreach($data['rows'] as $row)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$row->client->name}}</td>
            <td>{{$row->time}}</td>
            <td>{{$row->keynotes}}</td>
            <td>{{$row->visit_type}}</td>
            <td>@switch($row->task_status)
                    @case('yes')
                    Complete
                    @break
                    @case('no')
                    Cancelled
                    @break
                    @default
                    Pending
                    @break
                @endswitch
            </td>
            <td>@switch($row->sales_status)
                    @case('yes')
                    Sold
                    @break
                    @case('no')
                    Not Sold
                    @break
                    @default
                    No Info
                    @break
                @endswitch</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->next_followup_date}}</td>
            <td>{{$row->created_at}}</td>
            <td></td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="11" class="text-center">No Data Available!</td>
    </tr>
@endif