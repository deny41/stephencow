
<table class="table table-striped">
    @foreach ($data as $i => $log)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $log->ml_operator }}</td>
            <td>{{ str_replace("'","",$log->ml_notes) }}</td>
            <td>{{ date('d-M-y H:i',strtotime($log->ml_created_at)) }}</td>
        </tr>
    @endforeach
</table>
