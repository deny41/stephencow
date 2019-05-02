<header id="header">
            <div id="logo-group">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="{{ asset('assets/img/logo.png') }}" alt="SmartAdmin"> </span>
                <!-- END LOGO PLACEHOLDER -->

                <!-- Note: The activity badge color changes when clicked and resets the number to 0
                Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
                @if (Auth::user()->privileges == 'master')
                    <span id="activity" class="activity-dropdown"> <i class="fa fa-tasks"> </i> </span>
                @else
                @endif

                <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
                <div class="ajax-dropdown">

                    <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="{{ route('additional_log') }}">
                            Log Activity 
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-refresh"></i>
                            Log Activity 
                        </label>
                    </div>

                    <!-- notification content -->
                    <div class="ajax-notifications custom-scroll">

                        <div class="alert alert-transparent">
                            <h4>Click a button to show messages here</h4>
                            This blank page message helps protect your privacy, or you can show the first message here automatically.
                        </div>

                        <i class="fa fa-lock fa-4x fa-border"></i>

                    </div>
                    <!-- end notification content -->

                    <!-- footer: refresh area -->
                    <span> <a href="{{ route('additional_log_detail') }}" class="btn btn-xs btn-default"> See More</a>
                        
                    </span>
                    <!-- end footer -->

                </div>
                <!-- END AJAX-DROPDOWN -->
            </div>

            <!-- projects dropdown -->
            {{-- <div class="project-context hidden-xs">

                <span class="label">Projects:</span>
                <span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>

                <!-- Suggestion: populate this list with fetch and push technique -->
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Notes on pipeline upgradee</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Assesment Report for merchant account</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
                    </li>
                </ul>
                <!-- end dropdown-menu-->

            </div> --}}
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">
                
                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->
                
                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                            <img src="{{ asset('assets/img/avatars/sunny.png') }}" alt="John Doe" class="online" />  
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();
                                        ">
                            <i class="fa fa-sign-out"></i></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </span>

                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                <!-- input: search field -->
                <form action="search.html" class="header-search pull-right">
                    <input id="search-fld"  type="text" name="param" placeholder="Find reports and more" data-autocomplete='[
                    "ActionScript",
                    "AppleScript",
                    "Asp",
                    "BASIC",
                    "C",
                    "C++",
                    "Clojure",
                    "COBOL",
                    "ColdFusion",
                    "Erlang",
                    "Fortran",
                    "Groovy",
                    "Haskell",
                    "Java",
                    "JavaScript",
                    "Lisp",
                    "Perl",
                    "PHP",
                    "Python",
                    "Ruby",
                    "Scala",
                    "Scheme"]'>
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
                </form>
                <!-- end input: search field -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>


            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
                    
                    {{-- <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="{{ asset('assets/img/avatars/sunny.png') }}" alt="me" class="online" /> 
                        <span>
                            Hy ,{{ auth::user()->username }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                        <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </ul>
                    </a>  --}}

                    <ul class="dropdown">  
                      <!-- your markup -->  
                      <li style="margin-top: 5px;list-style-type: none;margin-left:-40px" data-toggle="dropdown">
                          <span class="myIcons" id="messages">
                              <img src="{{ asset('assets/img/avatars/sunny.png') }}" alt="me" class="online" /> Hy ,{{ auth::user()->username }} <i class="fa fa-angle-down"></i>
                          </span>
                      </li>
                      <!--// your markup -->      
                      <ul class="dropdown-menu" style="margin-left: 100px">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </ul>
                </span>
            </div>
            <!-- end user info -->

            <!-- NAVIGATION : This navigation is also responsive-->
            <nav>
                <ul>
                    <li class="active">
                        <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
                    </li>
                    
                    <li class="">
                        <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Master</span></a>
                        <ul>
                            @if (Auth::user()->privileges == 'master')
                                <li class="{{Request::is('master/admin') ? 'active' : '' || Request::is('master/admin/*') ? 'active' : ''
                                            ||Request::is('master/create_admin') ? 'active' : '' || Request::is('master/create_admin/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_admin') ? 'active' : '' || Request::is('master/*/edit_admin') ? 'active' : '' }}">
                                    <a href="{{ route('master_admin') }}">Admin</a>
                                </li>
                            @else
                            @endif
                            <li class="{{Request::is('master/product') ? 'active' : '' || Request::is('master/product/*') ? 'active' : '' 
                                            ||Request::is('master/create_product') ? 'active' : '' || Request::is('master/create_product/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_product') ? 'active' : '' || Request::is('master/*/edit_product') ? 'active' : ''}}">
                                <a href="{{ route('master_product') }}">Product</a>
                            </li>
                            <li class="{{Request::is('master/bank') ? 'active' : '' || Request::is('master/bank/*') ? 'active' : '' 
                                            ||Request::is('master/create_bank') ? 'active' : '' || Request::is('master/create_bank/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_bank') ? 'active' : '' || Request::is('master/*/edit_bank') ? 'active' : ''}}">
                                <a href="{{ route('master_bank') }}">Bank</a>
                            </li>
                            <li class="{{Request::is('master/keterangan_mem') ? 'active' : '' || Request::is('master/keterangan_mem/*') ? 'active' : '' 
                                            ||Request::is('master/create_keterangan_mem') ? 'active' : '' || Request::is('master/create_keterangan_mem/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_keterangan_mem') ? 'active' : '' || Request::is('master/*/edit_keterangan_mem') ? 'active' : ''}}">
                                <a href="{{ route('master_keterangan_mem') }}">Keterangan Member</a>
                            </li>
                            <li class="{{Request::is('master/keterangan_txn') ? 'active' : '' || Request::is('master/keterangan_txn/*') ? 'active' : '' 
                                            ||Request::is('master/create_keterangan_txn') ? 'active' : '' || Request::is('master/create_keterangan_txn/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_keterangan_txn') ? 'active' : '' || Request::is('master/*/edit_keterangan_txn') ? 'active' : ''}}">
                                <a href="{{ route('master_keterangan_txn') }}">Keterangan Txn</a>
                            </li>
                            <li class="{{Request::is('master/web_regist') ? 'active' : '' || Request::is('master/web_regist/*') ? 'active' : '' 
                                            ||Request::is('master/create_web_regist') ? 'active' : '' || Request::is('master/create_web_regist/*') ? 'active' : ''
                                            ||Request::is('master/*/edit_web_regist') ? 'active' : '' || Request::is('master/*/edit_web_regist') ? 'active' : ''}}">
                                <a href="{{ route('master_web_regist') }}">Web Regist</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Operational</span></a>
                        <ul>
                            <li class="{{Request::is('operational/member') ? 'active' : '' || Request::is('operational/member/*') ? 'active' : '' 
                                            || Request::is('operational/create_member') ? 'active' : '' || Request::is('operational/create_member/*') ? 'active' : ''
                                            || Request::is('operational/*/edit_member') ? 'active' : '' || Request::is('operational/*/edit_member/*') ? 'active' : '' }}">
                                <a href="{{ route('operational_member') }}">Member</a>
                            </li>
                            {{-- <li class="{{Request::is('report/rep_member') ? 'active' : '' || Request::is('report/rep_member/*') ? 'active' : '' }}">
                                <a href="{{ route('rep_member') }}">Report Member</a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{ route('stat_member') }}">Statistics Member</a>
                            </li> --}}
                            <li class="{{Request::is('operational/transaction') ? 'active' : '' || Request::is('operational/transaction/*') ? 'active' : '' 
                                            || Request::is('operational/create_transaction') ? 'active' : '' || Request::is('operational/create_transaction/*') ? 'active' : ''
                                            || Request::is('operational/*/edit_transaction') ? 'active' : '' || Request::is('operational/*/edit_transaction/*') ? 'active' : '' }}">
                                <a href="{{ route('operational_transaction') }}">Transaction</a>
                            </li>
                           {{--  <li class="{{Request::is('report/rep_transaction') ? 'active' : '' || Request::is('report/rep_transaction/*') ? 'active' : '' }}">
                                <a href="{{ route('rep_transaction') }}">Report Transaction</a>
                            </li> --}}
                           {{--  <li>
                                <a href="{{ route('stat_transaction') }}">Statistics Transaction</a>
                            </li> --}}
                            @if (Auth::user()->privileges == 'master')
                            <li class="{{Request::is('close/closebook') ? 'active' : '' || Request::is('close/closebook/*') ? 'active' : '' }}">
                                <a href="{{ route('close_book') }}">Close Book</a>
                            </li>
                            @else
                            @endif
                            
                            @if (Auth::user()->privileges == 'master')
                                <li class="{{Request::is('additional/log_detail') ? 'active' : '' || Request::is('additional/log_detail/*') ? 'active' : '' }}">
                                    <a href="{{ route('additional_log_detail') }}">Log</a>
                                </li>
                            @else
                            @endif
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="#"><i class="fa fa-lg fa-fw fa-calendar"></i> <span class="menu-item-parent">Report</span></a>
                        <ul>
                            
                        </ul>
                    </li> --}}
                </ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"> 
                <i class="fa fa-arrow-circle-left hit"></i> 
            </span>

        </aside>
        <!-- PAGE FOOTER -->
        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white">Esensi Creative <span class="hidden-xs"> - Web Application Framework</span> © 2018</span>
                </div>

                <div class="col-xs-6 col-sm-6 text-right hidden-xs">
                    <div class="txt-color-white inline-block">
                        {{-- <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i> --}}
                        <div class="btn-group dropup">
                            <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                                <i class="fa fa-link"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right text-left">
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Server Load</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <button class="btn btn-block btn-default">refresh</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE FOOTER -->