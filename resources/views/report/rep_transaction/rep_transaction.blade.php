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
        <li>Home</li><li>Transaction</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Report Transaction </h2>
    </header>

    <!-- widget div-->
    <div>
        <form id="save" class="smart-form" novalidate="novalidate">
        <fieldset>
            <div class="row">
                <section class="col col-4">
                    <label class="label">Date First</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker" name="date_first" id="date_first">
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label">Date End</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker" name="date_end" id="date_end">
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
    <br>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox" data-widget-colorbutton="true">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->
        <div class="jarviswidget-editbox">
        </div>
        <!-- widget content -->
        <div class="widget-body no-padding">
            <div class="drop">
                <div class="responsive">
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>                         
                            <tr>
                                <th data-class="expand">No</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-key text-muted hidden-md hidden-sm hidden-xs"></i> Code</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> FC</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Sales</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Purchase</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> LC</th>
                                <th data-hide="phone"><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> Keterangan</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Txn Date</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> D input</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> OP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $p)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $p->ot_code }}</td>
                                    <td>{{ $p->om_name }}</td>
                                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_first_credit,0,'','.') }}</td>
                                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_sales,0,'','.') }}</td>
                                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_purchase,0,'','.') }}</td>
                                    <td align="right"><span class="pull-left">Rp .</span> {{ number_format($p->ot_last_credit,0,'','.') }}</td>
                                    <td>{{ $p->ot_notes }}</td>
                                    <td>{{ date('d-M-y',strtotime($p->ot_date)) }}</td>
                                    <td>{{ date('d-M-y H:i',strtotime($p->ot_created_at)) }}</td>
                                    <td>{{ $p->ot_operator }}</td>
                                </tr>
                            @endforeach
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
        $('#datatable').DataTable();

  window.onload = function(){


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

                        var temp_sales = 0;
                        $('.ot_sales').each(function(i){
                            temp_sales += parseFloat($(this).val());
                        })

                        var temp_purchase = 0;
                        $('.ot_purchase').each(function(i){
                            temp_purchase += parseFloat($(this).val());
                        })

                        $('.total_sales').html('Rp. '+'<span>'+(accounting.formatMoney(temp_sales,"",0,'.',','))+'</span>');
                        $('.total_purchase').html('Rp. '+'<span>'+(accounting.formatMoney(temp_purchase,"",0,'.',','))+'</span>');

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

            
    }
        
   
</script>
@endsection
