<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Office of the Head of the Civil Service | HCMIS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="favicons.ico">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="assets/main/css/fonts.css">
    <link rel="stylesheet" href="assets/main/css/style.css">
</head>


<body class="auth">
    <div id="main-wrapper" class="show">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 p-0 b-center bg-size">
                   <div class="text-center" >
                       <img class="img-fluid" src="images/ohcslogo.png" alt="MOF PEEP" style="margin-top:300px;">
                   </div>
                </div>
                <div class="col-xl-5 p-0">
                    <div class="login-tabib">
                        <div>
                            <div class="text-center ">
                                <a class="logo" href="/">
                                    <img class="img-fluid" src="images/ohcslogo.png" alt="MOF LOGO">
                                </a>
                            </div>
                            <div class="login-main">
                                @if (session('success'))
                                <p class="alert alert-success" align="center">{{session('success')}}</p>
                               @endif
           
                               @if (session('error'))
                               <p class="alert alert-danger" align="center">{{session('error')}}</p>
                              @endif
           
                               <form class="theme-form" method="POST" action="{{route('authenticate-user-process')}}">
                                   @csrf
                                   <h4>Sign in to account</h4>
                                   <p>Enter your email & password to login </p>
                                   <div class="form-group m-b-10">
                                       <label class="col-form-label">OHCS Email</label>
                                       <input class="form-control" type="email" name="email" placeholder="" value="{{old('username')}}">
                                   @error('email') <small style="color:red">{{$message}}</small> @enderror
                                   </div>
                                   <div class="form-group m-b-10">
                                       <label class="col-form-label">Password</label>
                                       <div class="form-input position-relative">
                                           <input class="form-control" type="password" name="password" placeholder="">
                                           <div class="show-hide"><span class="show"></span></div>
                                       </div>
                                       @error('password') <small style="color:red">{{$message}}</small> @enderror
                                   </div>
                                   <div class="form-group mb-0">
                                       <div class="checkbox p-0">
                                           <input id="checkbox1" type="checkbox">
                                           <label class="text-muted" for="checkbox1">Remember password</label>
                                       </div>
                                       
                                       <div class="mt-3">
                                           <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                       </div>
                                   </div>
                                   
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JQuery v3.5.1 -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- popper js -->
    <script src="assets/plugins/popper/popper.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Moment -->
    <script src="assets/plugins/moment/moment.min.js"></script>

    <!-- Date Range Picker -->
    <script src="assets/plugins/daterangepicker/daterangepicker.min.js"></script>

    <!-- Main Custom JQuery -->
    <script src="assets/js/toggleFullScreen.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/option-themes.js"></script>

</body>

</html>