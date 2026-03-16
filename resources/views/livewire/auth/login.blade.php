<section class="d-flex flex-column align-items-center justify-content-center py-5" style="min-height:100vh; background:linear-gradient(135deg,#fff8e1,#ffffff);  overflow:hidden; font-family:'Kantumruy Pro',sans-serif;"> 
    <div class="container">
        <div class="card shadow-lg border-0 mx-auto animate__animated animate__fadeInUp"
             style="max-width:950px;border-radius:25px;overflow:hidden;">
            <div class="row g-0"> 
                <div class="col-lg-6 bg-white d-flex flex-column justify-content-center p-5">
                    <div class="text-center">
                        <div class="floating-logo mb-4">
                            <img src="{{ asset('assets/images/ciclelogo121.png') }}" alt="Phsar121" width="110" height="110" style="border-radius:50%; border:2px solid #5AC559; box-shadow:0 4px 15px rgba(0,0,0,.1);">
                        </div> 
                        <h4 class="fw-bold mb-1" style="color:#5AC559;">សូមស្វាគមន៍ចំពោះការត្រឡប់មកវិញ!</h4>
                        <p class="text-muted small mb-4"> សូមធ្វើការបញ្ជូលព័ត៌មានផ្ទាល់ខ្លួនរបស់អ្នកដើម្បីចូលទៅកាន់ប្រព័ន្ធគ្រប់គ្រង់
                        </p>
                    </div> 
                    <form wire:submit.prevent="doLogin">
                        <div class="mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" wire:model.defer="username" autofocus style="border-radius:12px;padding:12px 16px;">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" id="passwordInput" class="form-control pe-5" placeholder="Password" wire:model.defer="password" style="border-radius:12px;padding:12px 16px;">
                            <button type="button" id="togglePassword" class="btn position-absolute border-0 bg-transparent" style="top:50%;right:14px;transform:translateY(-50%);">
                                <img id="eyeIcon" src="{{ asset('assets/icon/eyebrow.png') }}" style="height:22px;">
                            </button> 
                        </div> 
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="remember_me" id="rememberMe">
                                <label class="form-check-label small" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                        </div> 
                        <button type="submit" class="btn w-100 text-white login-btn" wire:loading.attr="disabled" wire:target="doLogin">
                            <span wire:loading.remove wire:target="doLogin">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </span>
                            <span wire:loading wire:target="doLogin">
                                <span class="spinner-border spinner-border-sm me-1"></span>
                                Processing...
                            </span>
                        </button> 
                    </form>
                </div> 
                <div class="col-lg-6 d-none d-lg-block position-relative overflow-hidden">
                    <img src="{{ asset('assets/img/cover.png') }}" class="animated-image" style="width:100%;height:100%;object-fit:cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(90,197,89,.35);"></div> 
                    <div class="position-absolute text-white px-5" style="bottom:10%;left:5%;">
                        <h2 style="font-family:AKbalthom HighSchool;">POS Management System </h2>

                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!-- STYLES -->
    <style>
        .floating-logo { animation: float 4s ease-in-out infinite; }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animated-image {
            animation: zoomInOut 8s ease-in-out infinite alternate;
        }
        @keyframes zoomInOut {
            from { transform: scale(1); }
            to { transform: scale(1.08); }
        }

        .login-btn {
            background: linear-gradient(90deg,#5AC559,#8de085);
            font-weight:600;
            border-radius:12px;
            padding:12px;
            transition:.3s;
        }
        .login-btn:hover {
            box-shadow:0 6px 20px rgba(90,197,89,.4);
            transform: translateY(-2px);
        }

        .form-control:focus {
            border-color:#5AC559;
            box-shadow:0 0 0 .2rem rgba(90,197,89,.25);
        }
    </style>

    <!-- SCRIPT -->
    <script>
        document.addEventListener('livewire:init', () => {
            const toggle = document.getElementById('togglePassword');
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');

            toggle.addEventListener('click', e => {
                e.preventDefault();
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.src = show
                    ? "{{ asset('assets/icon/eye_Open.gif') }}"
                    : "{{ asset('assets/icon/eyebrow.png') }}";
            });

            Livewire.on('login-failed', data => {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: data.message ?? 'Invalid credentials',
                    confirmButtonColor: '#5AC559'
                });
            });
        });
    </script>
</section>
