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
        <li><a href="{{ route('home') }}">Home</a></li><li>Transaction</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Operational Transaction </h2>
        <button class="btn btn-primary btn-sm pull-right " style="margin-right: 1%" onclick="window.location=('{{ route('operational_create_transaction') }}')"><i class="fa fa-plus"></i> Add New</button>
    </header>
    <form id="save" class="smart-form" novalidate="novalidate">
        <fieldset>
            <div class="row">
                <section class="col col-4">
                    <label class="label">Date First</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker_today" name="date_first" id="date_first">
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label">Date End</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker_today" name="date_end" id="date_end">
                    </label>
                </section>
            </div>
            <div class="row">
                <section class="col col-4">
                    <label class="label">Admin</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <select class="select2" name="om_admin" id="om_admin">
                            <option value="">- All -</option>
                            @foreach ($admin as $ad)
                                <option value="{{ $ad->id }}">{{ $ad->username }}</option>
                            @endforeach
                        </select>

                    </label>
                </section>
                <section class="col col-4">
                    <label class="label">Product</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <select class="select2" name="om_product" id="om_product">
                            <option value="">- All -</option>
                            @foreach ($product as $pr)
                                <option value="{{ $pr->mp_code }}">{{ $pr->mp_code }} - {{ $pr->mp_name }}</option>
                            @endforeach
                        </select>
                    </label>
                </section>
            </div>
            <div class="row">
                <section class="col col-4">
                    <label class="label">name</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <select class="select2" name="ot_member" id="ot_member">
                            <option value="">- All -</option>
                            @foreach ($member as $mm)
                                <option value="{{ $mm->om_code }}">{{ $mm->om_code }} - {{ $mm->om_name }}</option>
                            @endforeach
                        </select>
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label"> &nbsp;</label>
                        <button class="btn btn-primary btn-sm search" type="button"><i class="fa fa-search"></i> Search</button>
                        @if (Auth::user()->privileges == 'master')
                            <button class="btn btn-info btn-sm pull-right pdf" type="button"><i class="fa fa-file-excel-o"></i> PDF</button>
                            <button class="btn btn-warning btn-sm pull-right excel" style="margin-right: 3px;" type="button"><i class="fa fa-file-pdf-o"></i> Excel</button>
                        @else
                        @endif
                    </label>
                </section>
            </div>
        </fieldset>
    </form>
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
            <div class="responsive">
                <div class="drop">
                    <table id="Transaction" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>                         
                            <tr>
                                <th  data-class="expand" data-hide="phone"> Code</th>
                                <th data-hide="phone"> Name</th>
                                <th data-hide="phone"> Credit awal</th>
                                <th data-hide="phone"> Sales</th>
                                <th data-hide="phone"> Purchase</th>
                                <th data-hide="phone"> Promo</th>
                                <th data-hide="phone"> Credit Akhir</th>
                                <th data-hide="phone"> Keterangan</th>
                                <th data-hide="phone,tablet"> Txn Date</th>
                                <th data-hide="phone,tablet"> D input</th>
                                <th data-hide="phone,tablet"> OP</th>
                                <th data-hide="phone,tablet"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->
    
</div>

@endsection

@section('extra_scripts')

<script type="text/javascript">

      // window.onload = function(){
        $('#Transaction').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url:'{{ route('operational_datatable_transaction') }}',
                },
                
                columnDefs: [
                        {
                            targets: 3 ,
                            className: 'right'
                        },
                        {
                            targets: 5 ,
                            className: 'center'
                        },
                        {
                            targets: 6 ,
                            className: 'center'
                        },
                    ],
                columns: [
                    {data: 'ot_code', name: 'ot_code'},
                    {data: 'om_name', name: 'om_code'},
                    {data: 'ot_first_credit', name: 'om_name',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_sales', name: 'sales',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )  },
                    {data: 'ot_purchase', name: 'purchase',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'promo', name: 'promo',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_last_credit', name: 'om_bank',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp. ' )},
                    {data: 'ot_keterangan_txn', name: 'om_web_regist'},
                    {data: 'ot_date', name: 'detail'},   
                    {data: 'ot_created_at', name: 'detail'},   
                    {data: 'name', name: 'detail'},   
                    {data: 'aksi', name: 'aksi'},   
                ]
            });

        // }

        $('.search').click(function(){
            var date_first   = $('#date_first').val();
            var date_end     = $('#date_end').val();
            var om_admin     = $('#om_admin').val();
            var om_product   = $('#om_product').val();
            var ot_member    = $('#ot_member').val();

            if (date_first == '') {
                iziToast.warning({position: 'topRight',message: 'Date First Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }else if (date_end == '') {
                iziToast.warning({position: 'topRight',message: 'Date End Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }
            
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url  : ('{{ route('rep_search_transaction') }}'),
                data : $('#save').serialize(),
                type :'get',
                success:function(data){
                   if (data.status == 'kosong') {
                        $('.drop').hide();
                        iziToast.warning({position: 'topRight',message: 'Data Not Found! '});
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                   }else{
                        $('.drop').show();
                        $('.drop').html(data);
                   }
                },
                error:function(data){

                }

            })
                    

        })

        $('.pdf').click(function(){
            var date_first   = $('#date_first').val();
            var date_end     = $('#date_end').val();
            var om_admin     = $('#om_admin').val();
            var om_product   = $('#om_product').val();
            var ot_member    = $('#ot_member').val();

            if (date_first == '') {
                iziToast.warning({position: 'topRight',message: 'Date First Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }else if (date_end == '') {
                iziToast.warning({position: 'topRight',message: 'Date End Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }
            
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url  : ('{{ route('rep_pdf_transaction') }}'),
                data : $('#save').serialize(),
                type :'post',
                success:function(data){
                   if (data.status == 'kosong') {
                        iziToast.warning({position: 'topRight',message: 'Data Not Found! '});
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        $('.drop').html('');
                   }else{
                        var win = window.open();
                        win.document.write(data);
                   }
                },
                complete:function(data){
                        
                },
                error:function(data){

                }

            })
        })

        $('.excel').click(function(){
            var date_first   = $('#date_first').val();
            var date_end     = $('#date_end').val();
            var om_admin     = $('#om_admin').val();
            var om_product   = $('#om_product').val();
            var ot_member    = $('#ot_member').val();

            if (date_first == '') {
                iziToast.warning({position: 'topRight',message: 'Date First Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }else if (date_end == '') {
                iziToast.warning({position: 'topRight',message: 'Date End Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }
            
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url  : ('{{ route('rep_excel_transaction') }}'),
                data : $('#save').serialize(),
                type :'get',
                success:function(data){
                   if (data.status == 'kosong') {
                        iziToast.warning({position: 'topRight',message: 'Data Not Found! '});
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        $('.drop').html('');
                   }else{
                    window.open(this.url,'_blank');
                   }
                },
                complete:function(data){
                        
                },
                error:function(data){

                }

            })
        })

       function confirmation(argument) {
           var this_val = argument;

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

                            // window.location=();

                            $.ajax({
                                url  : baseUrl+'/operational'+'/'+this_val+'/delete_transaction',
                                data : $('#update').serialize(),
                                type :'get',
                                success:function(data){
                                    if (data.status == 'sukses') {
                                        iziToast.success({position: 'topRight',message: 'Successfully Deleted!'});
                                        window.location=('{{ route('operational_transaction') }}')
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
       }

       


   
</script>
@endsection
