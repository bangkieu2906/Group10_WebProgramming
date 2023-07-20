<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/BE/img/apple-icon.png') }}'">
  <link rel="icon" type="image/png" href="{{ asset('/BE/img/favicon.png') }}'">
  <title>
    Registor
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/BE/css/nucleo-icons.css') }}'" rel="stylesheet" />
  <link href="{{ asset('/BE/css/nucleo-svg.css') }}'" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/BE/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/BE/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-md-6 d-flex flex-column mx-auto login">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome</h3>
                  <p class="mb-0">Enter your information</p>

                </div>
                <div class="card-body">
                  <form method="POST" action="{{ URL::to ('/registor') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Username</label>

                                    <input type="text" name="name" 
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        value="{{ old('name') }}" 
                                        required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>

                            
                                    <input type="text" name="email" 
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{ old('email') }}" 
                                        required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>

                            <div class="mb-3">
                                <label for="password" >Password</label>

                              
                                    <input type="password" name="password" 
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                              
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" >Password Confirmation</label>

                                
                                    <input type="password" name="password_confirmation" 
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                                   
                               
                            </div>
                            <!-- <div class="form-group row">
                                <label for="password_confirmation" class="col-md-5 col-form-label text-md-right">Password Confirmation</label>

                                <div class="col-md-12">
                                    <input type="password" name="password_confirmation"  required>
                                   
                                </div>
                            </div> -->
                            
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                        Let's Go
                                    </button>
                                </div>
                           
                        </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Have an account?
                    <a href="{{ URL::to('/flogin') }}" class="text-info text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
                <a href="{{ URL::to('/trangchu') }}" class="btn bg-gradient-info w-100 mt-4 mb-0">Back Home</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ asset('/BE/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/BE/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/BE/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/BE/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/BE/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

  


</body>

</html>