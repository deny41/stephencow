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
        <li>Home</li><li>Member</li>
    </ol>
</div>
@endsection

@section('content')

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Report Member </h2>
    </header>

     <!-- widget div-->
    <div>
        <form id="save" class="smart-form" novalidate="novalidate">
        <fieldset>
            <div class="row">
                <section class="col col-4">
                    <label class="label">Date First</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker" name="date_first">
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label">Date End</label>
                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" class="date_picker" name="date_end">
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
                <section class="col col-4">
                    <label class="label">Date</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <select class="select2" name="om_date">
                            <option value="">- All -</option>
                            <option value="date">date</option>
                            <option value="month">month</option>
                        </select>
                    </label>
                </section>
            </div>
            
            <div>
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
            <div class="drop">
                <div class="responsive">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>                         
                        <tr>
                            <th data-hide="phone">No</th>
                            <th data-hide="phone"><i class="fa fa-fw fa-key text-muted hidden-md hidden-sm hidden-xs"></i> Code</th>
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> member</th>
                            {{-- <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Product</th> --}}
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Reg Date</th>
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Sales</th>
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Purchase</th>
                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-th txt-color-blue hidden-md hidden-sm hidden-xs"></i> Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i => $p)
                            @foreach ($seq as $s)
                                @if ($p->om_code == $s->ot_member)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $p->om_code }}</td>
                                    <td>{{ $p->om_name }}</td>
                                    {{-- <td>{{ $p->mp_name }}</td> --}}
                                    <td>{{ $p->om_created_at }}</td>
                                    <td align="right"><span class="pull-left">Rp.</span>{{ number_format($s->sales,0,'','.') }}</td>
                                    <td align="right"><span class="pull-left">Rp.</span>{{ number_format($s->purchase,0,'','.') }}</td>
                                    <td>{{ $p->name }}</td>
                                </tr>
                                @endif
                            @endforeach
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
