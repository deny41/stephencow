<!DOCTYPE html>
<html lang="en-us">
    <head>
       @include('layouts._head')
    </head>
        
    <body class="">
        @include('layouts._sidebar')
    </body>
    
    <div id="main" role="main">
            @yield('breadcrumb')
        <div id="content">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('layouts._scripts')
    @yield('extra_scripts')

</html>

