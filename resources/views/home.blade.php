@extends('main')

@section('breadcrumb')
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span class="breadcrumb_icon">
            <i class="fa fa-home"></i>
        </span> 
    </span>
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Home</li><li>Dashboard</li>
    </ol>
</div>
@endsection

<style type="text/css">
    /*.ui-datepicker-calendar {
        display: none;
    }*/
</style>
  

@section('content')

	<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Statistic Transaction </h2>
    </header>

    <!-- widget div-->
    <div>
        <form id="save_transaction" class="form-horizontal" novalidate="novalidate">
        <fieldset>
            <div class="row">
                <div class="form-group">
                    <label class="col-md-1 control-label">Tipe Transaksi :</label>
                    <div class="col-md-3">
                        <input type="checkbox" checked="" name="penjualan" id="penjualan"> Penjualan
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" checked="" name="pembelian" id="pembelian"> Pembelian
                    </div>
                </div>
            </div>
            <div class="hide_tanggal">
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Start</label>
                        <div class="col-md-3">
                            <input type="text" class="date_picker_m7 form-control date_first_transaction" name="date_first" id="">
                        </div>
                        <label class="col-md-1 control-label">End</label>
                        <div class="col-md-3">
                            <input type="text" class="date_picker_today form-control date_end_transaction" name="date_end" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-md-1 control-label">Periode</label>
                    <div class="col-md-3">
                       <select class="select2 " name="om_periode" id="om_periode_transaction">
                            {{-- <option value="">- All -</option> --}}
                            <option value="tanggal">Tanggal</option>
                            <option value="bulan">Month</option>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Product</label>
                    <div class="col-md-3">
                       <select class="select2" name="om_product" id="om_product_transaction">
                            <option value="">- All -</option>
                            @foreach ($product as $pr)
                                <option value="{{ $pr->mp_code }}">{{ $pr->mp_code }} - {{ $pr->mp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="form-group">
                    <label class="col-md-1 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-sm search_transaction" type="button"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <br>
        <div class="jarviswidget-editbox" data-widget-colorbutton="true">
        </div>
        <div class="jarviswidget-editbox">
        </div>
        <div class="widget-body no-padding">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                            <div class="drop_transaction">
                                <div id="container_transaction" style="min-width: 310px; height: 400px; margin: 0 auto">
                                </div>
                            </div>
                    </div>
            </article>
        </div>
    </div>
</div>






	 {{-- <======================== STATISTIK MEMBER ======================>  --}}

<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0">
                             
    <header>
        <span class="widget-icon"><i class="fa fa-table"></i></span>
        <h2>Statistic Member </h2>
        {{-- <button class="btn btn-primary btn-sm pull-right " style="margin-right: 1%" onclick="window.location=('{{ route('operational_create_member') }}')"><i class="fa fa-plus"></i> Create</button> --}}
    </header>

     <!-- widget div-->
    <div>
        <form id="save" class="form-horizontal" novalidate="novalidate">
        <fieldset>
            <div class="hide_member">
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Start</label>
                        <div class="col-md-3">
                            <input type="text" class="date_picker_m7 form-control" name="date_first" id="date_first_member">
                        </div>
                        <label class="col-md-1 control-label">End</label>
                        <div class="col-md-3">
                            <input type="text" class="date_picker_today form-control" name="date_end" id="date_end_member">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-md-1 control-label">Admin</label>
                    <div class="col-md-3">
                        <select class="select2" name="om_admin">
                            <option value="">- All -</option>
                            @foreach ($admin as $ad)
                                <option value="{{ $ad->id }}">{{ $ad->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Product</label>
                    <div class="col-md-3">
                        <select class="select2" name="om_product">
                            <option value="">- All -</option>
                            @foreach ($product as $pr)
                                <option value="{{ $pr->mp_code }}">{{ $pr->mp_code }} - {{ $pr->mp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-md-1 control-label">name</label>
                    <div class="col-md-3">
                        <select class="select2" name="ot_member" id="ot_member">
                            <option value="">- All -</option>
                            @foreach ($member as $mm)
                                <option value="{{ $mm->om_code }}">{{ $mm->om_code }} - {{ $mm->om_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-1 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-sm search" type="button"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <br>
        <div class="jarviswidget-editbox" data-widget-colorbutton="true">
        </div>
        <div class="jarviswidget-editbox">
        </div>
        <div class="widget-body no-padding">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                            <div class="drop_member">
                                <div id="container_member" style="min-width: 310px; height: 400px; margin: 0 auto">
                                </div>
                            </div>
                    </div>
            </article>
        </div>
    <!-- end widget div -->
    
</div>

@endsection

@section('extra_scripts')

<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate() - 7);
    console.log(date);

    $('.date_picker_m7').datepicker({
            dateFormat : 'yy-mm-dd',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>',
    }).datepicker("setDate",date);
  

    $('.search_transaction').click(function(){
        var date_first   = $('.date_first_transaction').val();
        var date_end     = $('.date_end_transaction').val();
        var om_product   = $('#om_product_transaction').val();
        var om_periode   = $('#om_periode_transaction').val();
        // var pembelian    = $('#pembelian').val();
        // var penjualan    = $('#penjualan').val();

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
            url  : ('{{ route('stat_search_transaction') }}'),
            data : $('#save_transaction').serialize(),
            type :'get',
            success:function(data){
                if (data.status == 'kosong') {
                    iziToast.error({position: 'topRight',message: 'Data Cannot be found! '});
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }
                $('.drop_transaction').html(data);
            },
            error:function(data){
            }
        })
    })

     

    

	

	Highcharts.chart('container_transaction', {
    title: {
        text: 'STATISTIK TRANSAKSI'
    },
    subtitle: {
        text: 'statistik'
    },
    xAxis: {
            categories: [
                @foreach ($data_transaction as $element)
                    '{{ $element->ot_date or null }}',
                @endforeach
            ]
    },
    yAxis: [{
        className: 'highcharts-color-0',
        title: {
            text: 'Data Transaksi'
        }
    }, {
        className: 'highcharts-color-1',
        opposite: true,
        title: {
            text: 'Data Transaksi'
        }
    }],

    series: [{
            name: 'Sales',
            data: [
                @foreach ($data_transaction as $element)
                    {{ $element->sales_total or null }},
                @endforeach
            ],
            zoneAxis: 'x',
            zones: [{
                value: 8
            }, {
                dashStyle: 'dot'
            }]
        },
        {
            name: 'Purchase',
            data: [
                @foreach ($data_transaction as $element)
                    {{ $element->sales_purchase or null }},
                @endforeach
            ],
            zoneAxis: 'x',
            zones: [{
                value: 8
            }, {
                dashStyle: 'dot'
            }]
        }]
    });



	// <======================== STATISTIK MEMBER ======================>




    $('.search').click(function(){
            var date_first   = $('#date_first').val();
            var date_end     = $('#date_end').val();
            var om_product   = $('#om_product').val();
            var om_periode   = $('#om_periode').val();
            // var pembelian    = $('#pembelian').val();
            // var penjualan    = $('#penjualan').val();

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
                url  : ('{{ route('stat_search_member') }}'),
                data : $('#save').serialize(),
                type :'get',
                success:function(data){
                    if (data.status == 'kosong') {
                        iziToast.error({position: 'topRight',message: 'Data Cannot be found! '});
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }
                    $('.drop_member').html(data);
                },
                error:function(data){

                }

            })
                    

        })


        Highcharts.chart('container_member', {

        chart: {
            type: 'column'
        },
        xAxis: {
            categories: [
                @foreach ($tgl as $index1 => $d)
                    ('{{ $d->ot_date }}'),
                @endforeach
            ]
        },
        title: {
            text: 'DIAGRAM BATANG '
        },

        yAxis: [{
            className: 'highcharts-color-0',
            title: {
                text: 'Data Transaksi'
            }
        }, {
            className: 'highcharts-color-1',
            opposite: true,
            title: {
                text: 'Data Transaksi'
            }
        }],

        plotOptions: {
            column: {
                borderRadius: 0
            }
        },

        series: [
        @foreach ($tgl as $index1 => $d)
            @foreach ($product_transaction as $index2 => $p)
                @if ($d->ot_date == $p->ot_date) 
                    {
                        name: ('{{ $p->ot_product }}'),
                        data: [{{ $p->prd }},]
                    },
                @endif
            @endforeach
        @endforeach
        ]    
    });

</script>

@endsection