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
        <h2>Statistic Member </h2>
        {{-- <button class="btn btn-primary btn-sm pull-right " style="margin-right: 1%" onclick="window.location=('{{ route('operational_create_member') }}')"><i class="fa fa-plus"></i> Create</button> --}}
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
                        <select class="select2" name="om_admin">
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
                        <select class="select2" name="om_product">
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
                       {{--  <button class="btn btn-info btn-sm pull-right" type="button"><i class="fa fa-file-excel-o"></i> PDF</button>
                        <button class="btn btn-warning btn-sm pull-right" style="margin-right: 3px;" type="button"><i class="fa fa-file-pdf-o"></i> Excel</button> --}}
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
            
        </div>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->
    
</div>

@endsection

@section('extra_scripts')

<script type="text/javascript">

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
                    $('.drop').html(data);
                },
                error:function(data){

                }

            })
                    

        })


</script>
@endsection
