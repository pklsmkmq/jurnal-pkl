<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard PKL</title>

    <link rel="shortcut icon" href="{{ url('assets/images/fav.jpg') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fontawsom-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}" />
</head>

<body>
    <div class="container-fluid conya">
        <div class="side-left">
            <div class="sid-layy">
                <div class="row slid-roo">
                    <div class="data-portion">
                        <h2>Ada sahabat yang pernah bertanya pada Nabi shallallahu ‘alaihi wa sallam:</h2>
                        <h3>أَىُّ الْكَسْبِ أَطْيَبُ قَالَ عَمَلُ الرَّجُلِ بِيَدِهِ وَكُلُّ بَيْعٍ مَبْرُورٍ</h3>
                        <p>“Wahai Rasulullah, mata pencaharian (kasb) apakah yang paling baik?” Beliau bersabda, “Pekerjaan seorang laki-laki dengan tangannya sendiri dan setiap jual beli yang mabrur (diberkahi).” (HR. Ahmad, 4:141, hasan lighoirihi)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-right">
            <img src="{{ url('assets/images/logo.png') }}" alt="logo smk" class="img-responsive">
            <h2>Login into Your Account</h2>
            
            <x-jet-validation-errors class="mb-4" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus class="form-control">
                </div>
                
                 <div class="form-row">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                </div>
                
                 <div class="form-row row skjh">
                  <div class="col-6 left no-padding">
                       <input type="checkbox" id="remember_me" name="remember" class="form-control stay float-left">
                       <span>{{ __('Remember me') }}</span>
                  </div>
                  {{-- <div class="col-6">
                      <span> <a href="{{ route('password.request') }}">{{ __('Forget Password ?') }}</a></span>
                  </div> --}}
                </div>

                <div class="form-row dfr">
                    <button class="btn btn-success" type="submit">Login</button>
                </div>
    
                <div class="foot">
                    <p>Copyright 2021 @ IT Coprs SMK MADINATULQURAN</p> 
                </div>
            </form>
        </div>
    </div>   
</body>

<script src="{{ url('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/script.js') }}"></script>


</html>