<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" /></head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{asset('../../images/logo11.png')}}" alt="logo" >
                        </div>
                      </div>
                  </div>
              <h4>Ajouter nouvau utulisateur</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form method="POST" action="{{ route('register') }}"  class="pt-3"  enctype="multipart/form-data">
                        @csrf
                <div class="form-group">
                  <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="Username" required autocomplete="name" autofocus>
                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                <div class="form-group">
                  <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"  placeholder="mot de passe" required autocomplete="new-password">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control  form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="confirmer mot de passe">
                  </div>

                  <div class="form-group">
                    <input id="telephone" type="text" class="form-control form-control-lg @error('telephone') is-invalid @enderror" name="telephone"  placeholder="telephone" required autocomplete="telephone">
                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" id="exampleInputUsername1" name="image"  placeholder="image" required autocomplete="image">
                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <input id="type" type="text" class="form-control form-control-lg @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}"  placeholder="type" required autocomplete="type" autofocus>
                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                <div class="form-group ">
                <select name="service_id" class="form-select form-control-lg" id="exampleFormControlSelect2">
            @foreach ($service as $service)
                <option value="{{ $service -> id }}">
                    {{ $service -> nom_service }}
                </option>
            @endforeach
        </select>   
                </div>
                <div class="form-group">
                <select name="specialiter_id" class="form-select form-control-lg" id="exampleFormControlSelect2">
            @foreach ($specialiter as $specialiter)
                <option value="{{ $specialiter -> id }}">
                    {{ $specialiter -> nom_specialiter }}
                </option>
            @endforeach
        </select>   
                </div>
                <div class="form-group">
                <select name="role_id" class="form-select form-control-lg" id="exampleFormControlSelect2">
            @foreach ($role as $role)
                <option value="{{ $role -> id }}">
                    {{ $role -> nom_role }}
                </option>
            @endforeach
        </select>   
                </div>
              
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="createbox">
                      peut cree
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <input type="submit" value="Add"  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.html" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
