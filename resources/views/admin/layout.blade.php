<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>

	<title>SB Admin 2 - Login</title>

    
    <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        



    <!-- Custom styles for this template-->
    <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet"> -->

    <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link href="{{url('assets/css/selectize.css')}}" rel="stylesheet" type="text/css"/>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- <link href="{{url('assets/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css">



    <link href="{{url('assets/css/custom.css')}}" rel="stylesheet">

    
    @yield('header_scripts')

</head>
<body id="page-top" ng-app="app">
	<div id="wrapper">
		@include('admin.sidebar')

		<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.page_header')

                <div class="container-fluid">
                	@yield('main')
                </div>
             
            </div>
           
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer> -->
            
        </div>

    	
    </div>

    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->


    <script src="{{url('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/js/demo/datatables-demo.js')}}"></script>

    <!-- <script src="{{url('assets/scripts/gijgo.min.js')}}" type="text/javascript"></script> -->
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker4').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
    </script>


    <script type="text/javascript" src="{{url('assets/scripts/selectize.min.js')}}" ></script>
    

    <!--Begin Angular scripts -->

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>
    
    <script type="text/javascript" src="{{url('assets/scripts/ng-file-upload-shim.min.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/scripts/ng-file-upload.min.js')}}" ></script>
   
    <script type="text/javascript" src="{{url('assets/scripts/angular-selectize.js')}}" ></script>

    <!-- End Angular Scripts -->
    <?php $version = "1.2.3"; ?>
    <script type="text/javascript" src="{{url('assets/js/custom.js?v='.$version)}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js?v='.$version)}}" ></script>
    @yield('footer_scripts')

    <script type="text/javascript" src="{{url('assets/scripts/core/services.js?v='.$version)}}" ></script>

    <script>
      angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
    </script>


</body>
</html>