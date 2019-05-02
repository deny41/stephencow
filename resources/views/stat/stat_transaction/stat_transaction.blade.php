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
        <h2>Statistic Transaction </h2>
    </header>

    <!-- widget div-->
    <div>
        <form id="save" class="smart-form" novalidate="novalidate">
        <fieldset>
            <div class="row">
                <section class="col col-2">
                    <label class="label">Tipe Transaksi :</label>
                </section>
                <section class="col col-2">
                    <input type="checkbox" checked="" name="penjualan" id="penjualan"> Penjualan
                </section>
                <section class="col col-2">
                    <input type="checkbox" checked="" name="pembelian" id="pembelian"> Pembelian
                </section>
                <section class="col col-2">
                    <label class="label"></label>
                </section>
            </div>
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
                    <label class="label">Periode</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <select class="select2" name="om_periode" id="om_periode">
                            <option value="">- All -</option>
                            <option value="tanggal">Tanggal</option>
                            <option value="bulan">Month</option>
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
                    <label class="label"> &nbsp;</label>
                        <button class="btn btn-primary btn-sm search" type="button"><i class="fa fa-search"></i> Search</button>
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
                <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                                <!-- widget options:
                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                                data-widget-colorbutton="false"
                                data-widget-editbutton="false"
                                data-widget-togglebutton="false"
                                data-widget-deletebutton="false"
                                data-widget-fullscreenbutton="false"
                                data-widget-custombutton="false"
                                data-widget-collapsed="true"
                                data-widget-sortable="false"

                                -->
                               

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                        <div class="drop">
                                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
                                            </div>
                                        </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            <!-- end widget -->

                            <!-- Widget ID (each widget will need unique ID)-->
                            
                            <!-- end widget -->

                        </article>
                        <!-- WIDGET END -->
            </div>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->
    
</div>

@endsection

@section('extra_scripts')

<script type="text/javascript">


// var date = new Date();
// var y = date.getFullYear();
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
                url  : ('{{ route('stat_search_transaction') }}'),
                data : $('#save').serialize(),
                type :'get',
                success:function(data){
                    if (data.status == 'kosong') {
                        iziToast.error({position: 'topRight',message: 'Data Cannot be found! '});
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }
                    $('.drop').html(data);
                },
                error:function(data){

                }

            })
                    

        })

Highcharts.chart('container', {
    title: {
        text: 'Zone with dash style'
    },
    subtitle: {
        text: 'Dotted line typically signifies prognosis'
    },
    xAxis: {
            categories: [
                @foreach ($data as $element)
                    '{{ $element->ot_date or null }}',
                @endforeach
            ]
    },
    series: [{
            name: 'Sales',
            data: [
                @foreach ($data as $element)
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
                @foreach ($data as $element)
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
   
</script>
@endsection
