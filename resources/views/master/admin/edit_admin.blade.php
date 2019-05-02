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

                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <fieldset>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->name }}" name="name" id="name" placeholder="Username" readonly="">
                                        </label>
                                    </section>
                                </div>

                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->username }}" name="username" id="username" placeholder="Name">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="text" value="{{ $data->email }}" name="email" id="email" placeholder="Email">
                                        </label>
                                    </section>
                                </div>
                                    
                                <div class="row">
                                <section class="col col-1">
                                </section>
                                <section class="col col-10">
                                    <label class="select">
                                        <select name="privileges" class="privileges" id="privileges">
                                            <option value="">- Pilih Privileges -</option>
                                            @if ($data->privileges == 'master')
                                                <option value="master" selected="">Admin</option>
                                                <option value="admin">Operator</option>
                                            @else
                                                <option value="master">Admin</option>
                                                <option value="admin" selected="">Operator</option>
                                            @endif
                                            
                                        </select> <i></i> </label>
                                </section>
                                </div>

                                <div class="row">
                                    <section class="col col-1">
                                    </section>
                                    <section class="col col-10">
                                        <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                            <input type="password" name="password" id="password" placeholder="password">
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

                        
                        var name        = $('#name').val();
                        var username    = $('#username').val();
                        var email       = $('#email').val();
                        var password    = $('#password').val();
                        var privileges    = $('#privileges').val();

                        if (name == '') {
                            iziToast.warning({position: 'topRight',message: 'Username Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (username == '') {
                            iziToast.error({position: 'topRight',message: 'Name Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (email == '') {
                            iziToast.error({position: 'topRight',message: 'Email Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (privileges == '') {
                            iziToast.error({position: 'topRight',message: 'Privileges Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }else if (password == '') {
                            iziToast.error({position: 'topRight',message: 'Password Cannot be Empty! '});
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            return false;
                        }

                        $.ajaxSetup({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url  : ('{{ route('master_update_admin') }}'),
                            data : $('#save').serialize(),
                            type :'post',
                            success:function(data){
                                if (data.status == 'sukses') {
                                    iziToast.success({position: 'topRight',message: 'Successfully Saved!'});
                                    window.location=('{{ route('master_admin') }}')
                                }else if(data.status == 'ada user'){
                                    iziToast.warning({position: 'topRight',message: 'Username has already been taken!'});
                                }else if(data.status == 'ada email'){
                                    iziToast.warning({position: 'topRight',message: 'Email has already been taken!'});
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
