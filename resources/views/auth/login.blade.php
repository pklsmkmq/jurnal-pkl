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
        <div class="row conya">
            <div class="col-lg-8 kiri">
                <div class="sid-layy">
                    <div class="row slid-roo">
                        <div class="data-portion">
                            <h2 class="text-justify">Ada sahabat yang pernah bertanya pada Nabi <i>shallallahu ‘alaihi wa sallam</i> :</h2>
                            <h3 class="text-right mb-3">أَىُّ الْكَسْبِ أَطْيَبُ قَالَ عَمَلُ الرَّجُلِ بِيَدِهِ وَكُلُّ بَيْعٍ مَبْرُورٍ</h3>
                            <p class="text-justify">“Wahai Rasulullah, mata pencaharian (kasb) apakah yang paling baik?” Beliau bersabda, “Pekerjaan seorang laki-laki dengan tangannya sendiri dan setiap jual beli yang mabrur (diberkahi).” (HR. Ahmad, 4:141, hasan lighoirihi)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 kanan pt-5">
                <img src="{{ url('assets/images/logo.png') }}" alt="logo smk" class="img-responsive">
                <h2>Login into Your Account</h2>
                
                <x-jet-validation-errors class="mb-4" style="color: red; font-size: 12px"/>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm">
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
                        <p>Copyright 2021 @ IT Corps SMK MADINATULQURAN</p> 
                    </div>
                </form>
            </div>
        </div>
    </div>   
</body>

<script src="{{ url('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/script.js') }}"></script>


</html>