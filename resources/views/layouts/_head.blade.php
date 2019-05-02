<meta charset="utf-8">
<title> SmartAdmin</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- #CSS Links -->
<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/font-awesome.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css') }} ">  --}}

<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/smartadmin-production-plugins.min.css') }} ">
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/smartadmin-production.min.css') }} ">
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/smartadmin-skins.min.css') }} ">

<!-- SmartAdmin RTL Support -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/smartadmin-rtl.min.css') }} "> 
<!-- IziToast -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }} "> 
<!-- IziToast -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('node_modules/select2/dist/css/select2.min.css') }} "> 

<!-- We recommend you use "your_style.css" to override SmartAdmin
     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
<link rel="stylesheet" type="text/css" media="screen" href=" assets/css/your_style.css"> -->

<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
<link rel="stylesheet" type="text/css" media="screen" href=" {{ asset('assets/css/demo.min.css') }} ">



<!-- #FAVICONS -->
<link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" type="image/x-icon">

<!-- #GOOGLE FONT -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<!-- #APP SCREEN / ICONS -->
<!-- Specifying a Webpage Icon for Web Clip 
     Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
<link rel="apple-touch-icon" href="{{ asset('assets/img/splash/sptouch-icon-iphone.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/splash/touch-icon-ipad.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/splash/touch-icon-iphone-retina.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/splash/touch-icon-ipad-retina.png')}}">

<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Startup image for web apps -->
<link rel="apple-touch-startup-image" href="{{ asset('assets/img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
<link rel="apple-touch-startup-image" href="{{ asset('assets/img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
<link rel="apple-touch-startup-image" href="{{ asset('assets/img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">

<style type="text/css">
 
 	.right_align{
 		text-align: right;
 	}
 	input::placeholder {
	  text-align: left;
	}

</style>