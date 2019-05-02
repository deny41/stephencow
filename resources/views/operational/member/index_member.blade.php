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
        <li><a href="{{ route('home') }}">Home</a></li><li>Member</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Operational Member </h2>
        <button class="btn btn-primary btn-sm pull-right " style="margin-right: 1%" onclick="window.location=('{{ route('operational_create_member') }}')"><i class="fa fa-plus"></i> Add new</button>
    </header>

    <!-- widget div-->
    <div>
        <form id="save" class="smart-form" novalidate="novalidate">
            <fieldset>
                <div class="row">
                    <section class="col col-4">
                        <label class="label">Date First</label>
                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                            <input type="text" class="date_picker_today" name="date_first">
                        </label>
                    </section>
                    <section class="col col-4">
                        <label class="label">Date End</label>
                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                            <input type="text" class="date_picker_today" name="date_end">
                        </label>
                    </section>
                </div>
                <div class="row">
                    <section class="col col-4">
                        <label class="label">Product</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <select class="select2" name="om_product">
                                <option value="">- All -</option>
                                @foreach ($product as $pr)
                                    <option value="{{ $pr->mp_code }}">{{ $pr->mp_code }} - {{ $pr->mp_name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </section>
                    {{-- <section class="col col-4">
                        <label class="label">Date</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                            <select class="select2" name="om_date">
                                <option value="">- All -</option>
                                <option value="date">date</option>
                                <option value="month">month</option>
                            </select>
                        </label>
                    </section> --}}
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
                </div>
                <div class="row">
                    
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
        <!-- widget edit box -->
        <div class="jarviswidget-editbox" data-widget-colorbutton="true">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->
        <div class="jarviswidget-editbox">
        </div>
        <!-- widget content -->
        <div class="widget-body no-padding">
            <div class="responsive" style="overflow-x:scroll; ">
                <div class="drop">
                    <table id="member" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>                         
                            <tr>
                                <th data-hide="phone">No</th>
                                <th data-hide="phone" data-class="expand"> Login id</th>
                                <th data-hide="phone,tablet"> member</th>
                                <th data-hide="phone,tablet"> Sales</th>
                                <th data-hide="phone,tablet"> Purchase</th>
                                <th data-hide="phone,tablet"> Detail</th>
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

@include('operational.member.table_detail')
@section('extra_scripts')

<script type="text/javascript">

    window.onload = function(){
        $('.search').click(function(){
            var date_first   = $('#date_first').val();
            var date_end     = $('#date_end').val();
            var om_admin     = $('#om_admin').val();
            var om_product   = $('#om_product').val();
            var ot_member    = $('#ot_member').val();

            if (date_first == '') {
                iziToast.warning({message: 'Date First Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }else if (date_end == '') {
                iziToast.warning({message: 'Date End Cannot be Empty! '});
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                return false;
            }
            
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url  : ('{{ route('rep_search_member') }}'),
                data : $('#save').serialize(),
                type :'get',
                success:function(data){
                   if (data.status == 'kosong') {
                        $('.drop').hide();
                        iziToast.warning({message: 'Data Not Found! '});
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

        $('#member').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url:'{{ route('operational_datatable_member') }}',
                },
                columnDefs: [
                        {
                            targets: 0 ,
                            className: 'center'
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
                    {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                    {data: 'om_code', name: 'om_code'},
                    {data: 'om_name', name: 'om_name'},
                    {data: 'sales', name: 'sales'},
                    {data: 'purchase', name: 'purchase'},
                    {data: 'detail', name: 'detail'},   
                    {data: 'aksi', name: 'aksi'},   
                ]
            });

        }
       function detail(argument){
                
        $.ajax({
            url  : ('{{ route('operational_detail_member') }}'),
            data : {id:argument},
            type : 'get',
            success:function(){
                $("#detail").modal("show");
            }
        })
       }
       $('.pdf').click(function(){
                var date_first   = $('#date_first').val();
                var date_end     = $('#date_end').val();
                var om_admin     = $('#om_admin').val();
                var om_product   = $('#om_product').val();
                var ot_member    = $('#ot_member').val();

                if (date_first == '') {
                    iziToast.warning({message: 'Date First Cannot be Empty! '});
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    return false;
                }else if (date_end == '') {
                    iziToast.warning({message: 'Date End Cannot be Empty! '});
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    return false;
                }
                
                $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $.ajax({
                    url  : ('{{ route('rep_pdf_member') }}'),
                    data : $('#save').serialize(),
                    type :'post',
                    success:function(data){
                       if (data.status == 'kosong') {
                            iziToast.warning({message: 'Data Not Found! '});
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
                    iziToast.warning({message: 'Date First Cannot be Empty! '});
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    return false;
                }else if (date_end == '') {
                    iziToast.warning({message: 'Date End Cannot be Empty! '});
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    return false;
                }
                
                $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $.ajax({
                    url  : ('{{ route('rep_excel_member') }}'),
                    data : $('#save').serialize(),
                    type :'get',
                    complete:function(data){
                    window.open(this.url,'_blank');
                    },
                    error:function(data){

                    }

                })
            })
</script>
@endsection
