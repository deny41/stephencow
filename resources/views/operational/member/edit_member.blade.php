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
        <li><a href="{{ route('home') }}">Home</a></li><li><a href="{{ route('operational_member') }}">Member</a></li><li>Edit</li>
    </ol>
</div>
@endsection

@section('content')

<article class="col-sm-12 col-md-12 col-lg-12">
            
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Form member </h2>             
                    
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
                            {{-- Hidden --}}

                                <input type="hidden" name="om_id" value="{{ $data->om_id }}">

                            {{-- end hidden --}}
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Admin</label>
                                        <label class="input">
                                            <select class="select2" id="om_admin" class="om_admin" name="om_admin">
                                                <option value="">- Pilih Operator -</option>
                                                @foreach ($admin as $ad)
                                                    @if ($data->om_operator == $ad->id)
                                                        <option value="{{ $ad->id }}" selected="">{{ $ad->name }}</option>
                                                    @else
                                                        <option value="{{ $ad->id }}">{{ $ad->name }}</option>
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
                                        <label class="label">Web</label>
                                        <label class="input">
                                            <select class="select2" id="om_web_regist" class="om_web_regist" name="om_web_regist">
                                                <option value="">- Pilih Web Registrasi -</option>
                                                @foreach ($web_regist as $wr)
                                                    @if ($data->om_web_regist == $wr->mw_code)
                                                       <option value="{{ $wr->mw_code }}" selected="">{{ $wr->mw_code }}</option>
                                                    @else
                                                    @endif<option value="{{ $wr->mw_code }}">{{ $wr->mw_code }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Product</label>
                                        <label class="input">
                                            <select class="select2" id="om_product" class="om_product" name="om_product">
                                                <option value="">- Pilih Product -</option>
                                                @foreach ($product as $pr)
                                                    @if ($data->om_product == $pr->mp_code)
                                                       <option value="{{ $pr->mp_code }}" selected="">{{ $pr->mp_code }}</option>
                                                    @else
                                                       <option value="{{ $pr->mp_code }}">{{ $pr->mp_code }}</option>
                                                    @endif
                                                @endforeach
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
                                    <label class="label">Code</label>
                                        <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                            <input type="text" value="{{ $data->om_code }}" class="readonly" value="{{ $data }}" name="om_code" placeholder="Auto Generate" readonly="">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Full Name</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_name }}" name="om_name" id="om_name" placeholder="Full name">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Phone 1</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_phone1 }}" name="om_phone1" id="om_phone1" class="phone" placeholder="Phone1">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Phone 2</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_phone2 }}" name="om_phone2" id="om_phone2" class="phone" placeholder="Phone2">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">BBM</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_bbm }}" name="om_bbm" id="om_bbm" placeholder="Pin BBM">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Line</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_line }}" name="om_line" id="om_line" placeholder="Line">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Email</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="email"value="{{ $data->om_email }}"  name="om_email" id="om_email" placeholder="E-mail">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Bank</label>
                                        <label class="input"> 
                                            <select class="select2" name="om_bank" id="om_bank" class="om_bank">
                                                <option value="">- Pilih Bank -</option>
                                                @foreach ($bank as $bk)
                                                    @if ($data->om_bank == $bk->mb_code)
                                                       <option value="{{ $bk->mb_code }}" selected="">{{ $bk->mb_code }} - {{ $bk->mb_name }}</option>
                                                    @else
                                                       <option value="{{ $bk->mb_code }}">{{ $bk->mb_code }} - {{ $bk->mb_name }}</option>
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
                                        <label class="label">Name Rek</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_name_rek }}" name="om_name_rek" id="om_name_rek" placeholder="Name Rek">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">No Rek</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_no_rek }}" name="om_no_rek" id="om_no_rek" placeholder="Nomor Rek">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">No Refeal</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_no_referal }}" name="om_no_referal" id="om_no_referal" placeholder="No Referal">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Name Refeal</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->om_name_referal }}" name="om_name_referal" id="om_name_referal" placeholder="Name Referal">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Registration date</label>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                           <input type="text" value="{{ $data->om_date }}" name="om_date" placeholder="Registration Date" id="om_date" class="om_date" data-dateformat="yy/mm/dd">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input">
                                        <label class="label">Keterangan</label>
                                            <select class="select2" name="om_keterangan" id="om_keterangan" class="om_keterangan">
                                                <option value="">- Pilih Keterangan -</option>
                                                @foreach ($keterangan_mem as $km)
                                                    @if ($data->om_keterangan_mem == $km->mk_code)
                                                       <option value="{{ $km->mk_code }}" selected="">{{ $km->mk_code }} - {{ $km->mk_desc }}</option>
                                                    @else
                                                       <option value="{{ $km->mk_code }}">{{ $km->mk_code }} - {{ $km->mk_desc }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </label>
                                    </section>
                                </div>
                            <footer >
                                <button type="button" class="btn btn-sm btn-danger confirmation" value="{{ $data->om_code }}">
                                    <i class="fa fa-eraser"></i> Delete
                                </button>
                                <button type="button" class="btn btn-primary save">
                                    <i class="fa fa-paper-plane-o"></i> Save
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
        $(".phone").keypress(function (e) {
             if (e.which != 8 && (e.which < 48 || e.which > 57)) {
                return false;
             }
        });

        $("#om_name_rek").keypress(function (e) {
             if (e.which != 8 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
                return false;
             }
        });

         $("#om_no_rek").keypress(function (e) {
             if (e.which != 8 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122) && (e.which < 48 || e.which > 57)) {
                return false;
             }
        });

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
                                    url  : baseUrl+'/operational'+'/'+this_val+'/delete_member',
                                    data : $('#update').serialize(),
                                    type :'get',
                                    success:function(data){
                                        if (data.status == 'sukses') {
                                            iziToast.success({position: 'topRight',message: 'Successfully Deleted!'});
                                            window.location=('{{ route('operational_member') }}')
                                        }if (data.status == 'ada transaksi') {
                                            iziToast.warning({position: 'topRight',message: "Member ini sudah memiliki transaksi, Silahkan hapus transaksinya terlebih dahulu!"});
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

                        
                        var om_admin = $('#om_admin').val();
                        var om_web_regist = $('#om_web_regist').val();
                        var om_product = $('#om_product').val();
                        var om_code = $('#om_code').val();
                        var om_name = $('#om_name').val();
                        var om_phone2 = $('#om_phone2').val();
                        var om_phone2 = $('#om_phone2').val();
                        var om_bbm = $('#om_bbm').val();
                        var om_line = $('#om_line').val();
                        var om_email = $('#om_email').val();
                        var om_bank = $('#om_bank').val();
                        var om_no_rek = $('#om_om_no_rek').val();
                        var om_no_referal = $('#om_om_no_referal').val();
                        var om_name_referal = $('#om_om_name_referal').val();
                        var om_date = $('#om_date').val();
                        var om_keterangan = $('#om_om_keterangan').val();

                        if (om_code == '') {
                            iziToast.warning({position: 'topRight',message: 'Code Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_name == '') {
                            iziToast.warning({position: 'topRight',message: 'Name Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_phone1 == '') {
                            iziToast.warning({position: 'topRight',message: 'Phone 1 Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_phone2 == '') {
                            iziToast.warning({position: 'topRight',message: 'Phone 2 Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_email == '') {
                            iziToast.warning({position: 'topRight',message: 'Email Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_bank == '') {
                            iziToast.warning({position: 'topRight',message: 'Name Rek Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (om_no_rek == '') {
                            iziToast.warning({position: 'topRight',message: 'No Rek Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }
                        
                        $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                        $.ajax({
                            url  : ('{{ route('operational_update_member') }}'),
                            data : $('#save').serialize(),
                            type :'post',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({message: 'Successfully Saved!'});
                                    window.location=('{{ route('operational_member') }}')
                                }else{
                                    iziToast.error({message: 'Error Check your data! '});
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
