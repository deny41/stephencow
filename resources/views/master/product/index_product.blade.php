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
        <li><a href="{{ route('home') }}">Home</a></li><li>Product</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Master Product </h2>
        <button class="btn btn-primary btn-sm pull-right " style="margin-right: 1%" onclick="window.location=('{{ route('master_create_product') }}')"><i class="fa fa-plus"></i> Add New</button>
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
                        <th data-hide="phone"> Code</th>
                        <th data-class="expand"> Name</th>
                        <th data-hide="phone"> Notes</th>
                        <th data-hide="phone,tablet"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $p)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $p->mp_code }}</td>
                            <td>{{ $p->mp_name }}</td>
                            <td>{{ $p->mp_notes }}</td>
                            <td align="center">
                               <div class="btn-group">
                                  <a href="{{ $p->mp_code }}/edit_product" class="btn btn-sm txt-color-white bg-color-orange"><i class="fa fa-pencil-square-o"></i></a>
                                  <button class="btn btn-sm btn-danger confirmation" value="{{ $p->mp_code }}"><i class="fa fa-eraser"></i></button>
                                </div>
                            </td>
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

    $('.confirmation').on('click', function () {

       var this_val = $(this).val();

       iziToast.question({
                theme: 'dark',
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                backgroundColor: '#1f1f22',
                icon: 'fa fa-info-circle',
                title: 'Are you Sure!',
                message: '',
                position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)',
                buttons: [
                    ['<button style="background-color:red;"> Delete </button>', function (instance, toast) {

                        $.ajax({
                            url  : baseUrl+'/master'+'/'+this_val+'/delete_product',
                            data : $('#update').serialize(),
                            type :'get',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully Deleted!'});
                                    window.location=('{{ route('master_product') }}')
                                }else{
                                    iziToast.error({position: 'topRight',message: 'Error Check your data! '});
                                }
                            },
                            error:function(data){

                            }

                        })

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true], // true to focus
                    ['<button> Cancel </button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(instance, toast, closedBy){
                                console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                            }
                        }, toast, 'buttonName');
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ],
                onOpening: function(instance, toast){
                    console.info('callback abriu!');
                },
                onClosing: function(instance, toast, closedBy){
                    console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                }
            });
        
    });

</script>
@endsection
