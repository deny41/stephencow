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
        <li><a href="{{ route('home') }}">Home</a></li><li><a href="{{ route('master_product') }}">Product</a></li><li>Create</li>
    </ol>
</div>
@endsection

@section('content')

<article class="col-sm-12 col-md-12 col-lg-12">
            
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
             
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Form Product </h2>             
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

                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                            <input type="text" class="mp_code" value="{{ $data }}" name="mp_code" placeholder="Auto Generate">
                                        </label>
                                    </section>
                                    
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" name="mp_name" id="mp_name" placeholder="Product Name">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-1">
                                                        
                                    </section>
                                    <section class="col col-10">
                                        <label class="label">Comment</label>
                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="4" name="mp_notes" id="mp_notes"></textarea> 
                                        </label>
                                    </section>
                                </div>
                            </fieldset>

                            <footer >
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

                        var code  = $('#mp_code').val();
                        var name  = $('#mp_name').val();
                        var notes = $('#mp_notes').val();

                        if (code == '') {
                            iziToast.warning({position: 'topRight',message: 'Product Code Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (name == '') {
                            iziToast.error({position: 'topRight',message: 'Product Name Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }

                        $.ajaxSetup({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url  : ('{{ route('master_save_product') }}'),
                            data : $('#save').serialize(),
                            type :'post',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully Saved!'});
                                    window.location=('{{ route('master_product') }}')
                                }else if(data.status == 'ada'){
                                    iziToast.warning({position: 'topRight',message: 'Data is already existed!'});
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
