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
        <li>Home</li><li>Keterangan Txn</li><li>Create</li>
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
                    <h2>Form Keterangan Txn </h2>             
                    
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
                        
                        <form id="update" class="smart-form" novalidate="novalidate">

                            <fieldset>

                                {{-- HIDDEN ID --}}

                                <input type="hidden" name="mt_id" value="{{ $data->mt_id }}">

                                {{-- END HIDDEN --}}

                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                            <input type="text" class="readonly" value="{{ $data->mt_code }}" name="mt_code" placeholder="Auto Generate" readonly="">
                                        </label>
                                    </section>
                                    
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" name="mt_desc" value="{{ $data->mt_desc }}" id="mt_desc" placeholder="Procuct Name">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-1">
                                                        
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Comment</label>
                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="4" name="mt_notes"  id="mt_notes">{{ $data->mt_notes }}</textarea> 
                                        </label>
                                    </section>
                                </div>
                            </fieldset>

                            <footer >
                                <button type="button" class="btn btn-sm btn-danger confirmation" value="{{ $data->mt_code }}">
                                    <i class="fa fa-eraser"></i> Delete
                                </button>
                                <button type="button" class="btn btn-primary update">
                                    <i class="fa fa-paper-plane-o"></i> update
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
                            url  : baseUrl+'/master'+'/'+this_val+'/delete_keterangan_txn',
                            data : $('#update').serialize(),
                            type :'get',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully Deleted!'});
                                    window.location=('{{ route('master_keterangan_txn') }}')
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

        $('.update').click(function(){

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
                    ['<button style="background-color:#37b4a2;"> update </button>', function (instance, toast) {

                        var desc = $('#mt_desc').val();
                        var notes = $('#mt_notes').val();
                        if (desc == '') {
                            iziToast.warning({position: 'topRight',message: 'Keterangan Txn Desc Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }/*else if (notes == '') {
                            iziToast.error({position: 'topRight',message: 'Notes Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }*/
                        
                        $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                        $.ajax({
                            url  : ('{{ route('master_update_keterangan_txn') }}'),
                            data : $('#update').serialize(),
                            type :'post',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully updated!'});
                                    window.location=('{{ route('master_keterangan_txn') }}')
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
