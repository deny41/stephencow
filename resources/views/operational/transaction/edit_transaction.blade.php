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
        <li><a href="{{ route('home') }}">home</a></li><li><a href="{{ route('operational_transaction') }}">Transaction</a></li><li>Create</li>
    </ol>
</div>
@endsection

@section('content')

<article class="col-sm-12 col-md-12 col-lg-12">
            
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
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
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Form Transaction </h2>             
                    
                </header>

                <!-- widget div-->
                <div>
                    
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                        
                    </div>
                    <!-- end widget edit box -->
                    
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        
                        <form id="save" class="smart-form" novalidate="novalidate">

                            <input type="text" class="readonly" hidden="" value="{{ $data->ot_id }}" name="ot_id" placeholder="Auto Generate" readonly="">
                            
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Code</label>
                                        <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                            <input type="text" class="readonly" value="{{ $data->ot_code  }}" name="ot_code" id="ot_code" placeholder="Auto Generate">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Operator</label>
                                        <label class="input">
                                            <select class="select2" name="ot_admin" id="ot_admin">
                                                <option value="">- Pilih Admin -</option>
                                                 @if (Auth::user()->privileges == 'master')
                                                    <option value="">- Pilih Admin -</option>
                                                    @foreach ($admin as $ad)
                                                        @if ($data->ot_operator == $ad->id)
                                                            <option value="{{ $ad->id }}" selected="">{{ $ad->id  }} - {{ $ad->name }}</option>
                                                        @else
                                                            <option value="{{ $ad->id }}">{{ $ad->id  }} - {{ $ad->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    @else
                                                         <option value="{{ Auth::user()->id }}" selected="">{{ Auth::user()->id }} - {{ Auth::user()->name }}</option>
                                                    @endif
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Member</label>
                                        <label class="input">
                                            <select class="select2" name="ot_member" id="ot_member">
                                                <option value="">- Pilih member -</option>
                                                @foreach ($member as $mm)
                                                    @if ($data->ot_member == $mm->om_code)
                                                       <option value="{{ $mm->om_code }}" 
                                                        data-name="{{ $mm->om_name }}" 
                                                        data-bank="{{ $mm->om_bank }}"
                                                        data-norek="{{ $mm->om_no_rek }}"
                                                        data-namerek="{{ $mm->om_name_rek }}"
                                                        selected="">{{ $mm->om_code }} - {{ $mm->om_name }}</option>
                                                    @else
                                                       <option value="{{ $mm->om_code }}" 
                                                        data-name="{{ $mm->om_name }}" 
                                                        data-bank="{{ $mm->om_bank }}"
                                                        data-norek="{{ $mm->om_no_rek }}"
                                                        data-namerek="{{ $mm->om_name_rek }}"
                                                        >{{ $mm->om_code }} - {{ $mm->om_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                <div class="row" hidden>
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Name</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text"  value="{{ $data->om_name }}" name="ot_name" id="ot_name" placeholder="Full Name">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Bank Name</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text"  value="{{ $data->om_bank }} - {{ $data->om_no_rek }} - {{ $data->om_name_rek }}" name="ot_bank_temp_name" id="ot_bank_temp_name" placeholder="Bank Name" readonly="">
                                            <input type="hidden" value="{{ $data->ot_code }}" name="ot_bank_name" id="ot_bank_name" placeholder="Bank Name" readonly="">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Product</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" readonly="" name="ot_product" id="ot_product" value="{{ $data->ot_product }}" placeholder="product">
                                        </label>

                                    </section>
                                </div>
                                
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">First Credit</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" class="mask_money11 mask_money right_align"  value="{{ number_format($data->ot_first_credit,0,'','.') }}" name="ot_first_credit" id="ot_first_credit" placeholder="Transaction First Credit">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Penjualan</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" class="mask_money11 mask_money right_align"  value="{{ number_format($data->ot_sales,0,'','.') }}" name="ot_sales" id="ot_sales" placeholder="Transaction Sales">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Pembelian</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text"  class="mask_money11 mask_money right_align"  value="{{ number_format($data->ot_purchase,0,'','.') }}" name="ot_purchase" id="ot_purchase" placeholder="Transaction Purchase">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Nominal Promo</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text"  class="mask_money11 mask_money_1 right_align"  value="{{ number_format($data->ot_nominal_promo,0,'','.') }}" name="ot_nominal_promo" id="ot_nominal_promo" placeholder="Transaction Promo">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Last Credit</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" class="mask_money11 mask_money right_align"  value="{{ number_format($data->ot_last_credit,0,'','.') }}" name="ot_last_credit" readonly="" id="ot_last_credit" placeholder="Transaction Last Credit">
                                        </label>
                                    </section>
                                </div>
                                
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Date</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_date }}" name="ot_date" id="ot_date" placeholder="Transaction Date">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                    <label class="label">Keterangan</label>
                                        <label class="input">
                                            <select class="select2" name="ot_keterangan_txn" id="ot_keterangan_txn">
                                                <option value="">- Pilih Keterangan Member -</option>
                                                @foreach ($keterangan_txn as $txn)
                                                    @if ($data->ot_keterangan_txn == $txn->mt_code)
                                                       <option value="{{ $txn->mt_code }}" selected="">{{ $txn->mt_code }} - {{ $txn->mt_desc }}</option>
                                                    @else
                                                       <option value="{{ $txn->mt_code }}">{{ $txn->mt_code }} - {{ $txn->mt_desc }}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Comment</label>
                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="4" name="ot_notes" id="ot_notes">{{ $data->ot_notes }}</textarea> 
                                        </label>
                                    </section>
                                </div>
                            </fieldset>

                            <footer >
                                <button type="button" class="btn btn-sm btn-danger confirmation" value="{{ $data->ot_code }}">
                                    <i class="fa fa-eraser"></i> Delete
                                </button>
                                <button type="button" class="btn btn-primary save">
                                    <i class="fa fa-paper-plane-o"></i> Update
                                </button>
                            </footer>
                        </form>

                    </div>
                    <!-- end widget content -->
                    
                </div>
                <!-- end widget div -->
                
            </div>
        </article>

@endsection

@section('extra_scripts')

<script type="text/javascript">

    window.onload = function(){

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

                            // window.location=();

                            $.ajax({
                                url  : baseUrl+'/master'+'/'+this_val+'/delete_trasaction',
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
            
        });


         $('#ot_date').datepicker({
            dateFormat : 'dd-mm-yy',
            onSelect: function(date, instance) {
                $.ajax
                ({
                      type: "get",
                      url: ('{{ route('operational_code_transaction') }}'),
                      data: "date="+date,
                      success: function(result)
                      {
                          $('#ot_code').val(result.status)
                      }
                 });  
             }
        }).datepicker("setDate",'now');


        function hitung() {
            var ot_first_credit = $('#ot_first_credit').val();
            var ot_sales        = $('#ot_sales').val();
            var ot_nominal_promo= $('#ot_nominal_promo').val();
            var ot_purchase     = $('#ot_purchase').val();

            var ot_first_credit = ot_first_credit.replace(/[A-Za-z$. ,-]/g, "");
            var ot_sales        = ot_sales.replace(/[A-Za-z$. ,-]/g, "");
            var ot_purchase     = ot_purchase.replace(/[A-Za-z$. ,-]/g, "");
            var ot_nominal_promo= ot_nominal_promo.replace(/[A-Za-z$. ,]/g, "");

            var hitung = parseFloat(ot_first_credit)+parseFloat(ot_sales)-parseFloat(ot_purchase);
            if (ot_nominal_promo < 0) {
                hitung_1 = hitung + parseFloat(ot_nominal_promo);
            }else{
                hitung_1 = hitung +  parseFloat(ot_nominal_promo);
            }

            var ot_last_credit = $('#ot_last_credit').val(accounting.formatMoney(hitung_1,"",0,'.',',')); 
        }

        $('.mask_money11').keyup(function(){
            hitung();
        })

        $('#ot_member').change(function(){
            $('#ot_name').attr('readonly',true);
            $('#ot_bank_temp_name').attr('readonly',true);

            $('#ot_name').val($(this).find(':selected').data('name'));
            $('#ot_bank_temp_name').val($(this).find(':selected').data('bank') +' - '+ $(this).find(':selected').data('norek') +' - '+ $(this).find(':selected').data('namerek') );
            $('#ot_bank_name').val($(this).find(':selected').data('norek'));
        })


        $('.save').click(function(){

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
                    ['<button style="background-color:#37b4a2;"> Save </button>', function (instance, toast) {

                        var ot_admin = $('#ot_admin').val();
                        var ot_product = $('#ot_product').val();
                        var ot_member = $('#ot_member').val();
                        var ot_bank_name = $('#ot_bank_name').val();
                        var ot_first_credit = $('#ot_first_credit').val();
                        var ot_sales = $('#ot_sales').val();
                        var ot_purchase = $('#ot_purchase').val();
                        var ot_last_credit = $('#ot_last_credit').val();
                        var ot_date = $('#ot_date').val();


                        if (ot_product == '') {
                            iziToast.error({position: 'topRight',message: 'Transaction Product Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (ot_member == '') {
                            iziToast.error({position: 'topRight',message: 'Transaction Member Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (ot_sales == 0 && ot_purchase == 0) {
                            iziToast.error({position: 'topRight',message: 'Harus Diisi salah satu Pembelian atau Penjualan! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (ot_date == '') {
                            iziToast.error({position: 'topRight',message: 'Transaction Date Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        } 
                        
                        $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                        $.ajax({
                            url  : ('{{ route('operational_update_transaction') }}'),
                            data : $('#save').serialize(),
                            type :'post',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully Saved!'});
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

        })


            
    }
        
    
    

</script>
@endsection
