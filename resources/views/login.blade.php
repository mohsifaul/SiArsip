<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | SiArsip</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/archive-logo.png') }}" />
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}" />
    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/dist/aos.css') }}" />
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.min.css?v=2.0.0') }}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css?v=2.0.0') }}" />
    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark.min.css') }}" />
    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css') }}" />
    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}" />
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>
<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>    
    </div>
    <!-- loader END -->
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">            
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                @if ($errors->any())
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Login Gagal!!',
                                            text: '{{ $errors->first('message') }}',
                                        });
                                    </script>
                                @endif
                                <div class="card-body">
                                    <a href="../../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">                                    
                                        <!--Logo start-->
                                        <div class="logo-main">
                                            <div class="logo-normal">
                                                <img src="{{ asset('assets/images/Si-Arsip.png') }}" alt="" width="150px">
                                            </div>
                                            <div class="logo-mini">
                                                <img src="{{ asset('assets/images/Si-Arsip.png') }}" alt="" width="100px">
                                            </div>
                                        </div>
                                    </a>
                                    <h2 class="mb-2 text-center fw-bold">Log In</h2>
                                    <p class="text-center">Silahkan Melakukan Login</p>
                                    <form action="{{ route('masuk') }}" method="post" id="login-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="email" class="form-control" id="username" name="email" placeholder="Masukkan username" autofocus>
                                            <div class="mb-3" id="email-error"></div>
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="userpass" class="form-control" placeholder="Masukkan Password" aria-describedby="password" name="password">
                                                <span class="input-group-text cursor-pointer" id="togglePassword"><i class="fa-solid fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                            <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                            <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                            <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                            <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="../../assets/images/auth/01.png" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('userpass');
            const eyeIcon = document.querySelector('#togglePassword i');

            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
        window.addEventListener('load', function () {
            var form = document.getElementById('login-form');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                var email = document.getElementById('username').value;
                var password = document.getElementById('userpass').value;

                // Lakukan validasi sesuai kebutuhan Anda
                if (email.trim() === '' || password.trim() === '') {
                    // Tampilkan SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: 'Silahkan Masukkan Username dan Password',
                    });
                } else {
                    // Jika validasi sukses, submit formulir
                    form.submit();
                }
            });
        });
        var emailInput = document.getElementById('username');
        var emailError = document.getElementById('email-error');

        // Tambahkan event listener untuk event blur pada input username
        emailInput.addEventListener('blur', function () {
            // Definisikan pola ekspresi reguler untuk domain email yang diizinkan
            var allowedDomains = /(gmail\.com|yahoo\.com|hotmail\.com)$/i;

            // Periksa apakah input kosong
            if (emailInput.value.trim() === '') {
                // Tampilkan pesan kesalahan jika input kosong saat fokus berpindah
                emailError.innerHTML = '';
            } else if (!allowedDomains.test(emailInput.value)) {
                // Tampilkan pesan kesalahan jika tidak sesuai dengan pola domain yang diizinkan
                emailError.innerHTML = '<span class="text-danger">* Email tidak valid.</span>';
            } else {
                // Hapus pesan kesalahan jika email valid
                emailError.innerHTML = '';
            }
        });
    </script>
    <!-- Library Bundle Script -->
    <script src="../../assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="../../assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="../../assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="../../assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="../../assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="../../assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="../../assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="../../assets/js/hope-ui.js" defer></script>
    
    
  </body>
</html>