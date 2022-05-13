<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurnal Prakerin</title>
    <link rel="shortcut icon" href="{{ url('assets/images/logo.png') }}">
    <link rel="stylesheet" href="{{ url('bs5/css/bootstrap.min.css') }}">
</head>
<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="{{ url('assets/images/logo/mysmk.png') }}" style="width: 30vh;" alt="mysmk logo">
                    </div>
                    <div class="card border-light">
                        <div class="card-body p-3">
                            <x-jet-validation-errors class="alert alert-danger alert-dismissible fade show" role="alert"/>

                            <form action="{{ route('login') }}" method="post" class="needs-validation" autocomplete="off">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="email" class="form-label fs-5">Alamat Email</label>
                                    <input type="email" class="form-control fs-5" placeholder="name@example.com" id="email" name="email" required autofocus :value="old('email')">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label fs-5">Kata Sandi</label>
                                    <input type="password" class="form-control fs-5" placeholder="*********" id="password" name="password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input bg-success" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Masuk Otomatis
                                    </label>
                                </div>
                                <div class="mb-3 form-group">
                                    <button type="submit" class="btn btn-success w-100 fs-5">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
						Copyright &copy; 2021-2022 &mdash; IT Corps SMK Madinatul Qur'an 
					</div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ url('bs5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>