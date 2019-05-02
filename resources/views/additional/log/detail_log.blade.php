@extends('main')

@section('breadcrumb')
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span class="breadcrumb_icon">
            <i class="fa fa-home txt-color-white"></i>
        </span> 
    </span>
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Home</li><li>Log Detail</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Log Detail</h2>
    </header>

    <!-- widget div-->
    <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox" data-widget-colorbutton="true">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->
        <div class="jarviswidget-editbox">
        </div>
        <!-- widget content -->
        <div class="widget-body no-padding">

            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>                         
                    <tr>
                        <th data-hide="phone">No</th>
                        <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Admin</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-key txt-color-blue hidden-md hidden-sm hidden-xs"></i> Ref</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-user txt-color-blue hidden-md hidden-sm hidden-xs"></i> Member</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Transaction</th>
                        <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Notes</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $log)
				        <tr>
				            <td>{{ $i+1 }}</td>
				            <td>{{ $log->ml_operator }}</td>
				            <td>{{ $log->ml_ref }}</td>
				            <td>{{ $log->ml_member }}</td>
				            <td>{{ $log->ml_transaction }}</td>
				            <td>{{ str_replace("'","",$log->ml_notes) }}</td>
				            <td>{{ date('d-M-y H:i',strtotime($log->ml_created_at)) }}</td>
				        </tr>
				    @endforeach
                </tbody>
            </table>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->
    
</div>

@endsection

@section('extra_scripts')

<script type="text/javascript">

</script>
@endsection
