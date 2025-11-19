<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-admin.head />

<body>
    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-block">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="{{ asset('storage/' . ui_value('auth-setting', 'image')) }}"
                    alt="" 
                    class="w-100 h-100 object-fit-cover"
                    style="@media (max-width: 768px) { width: 100% !important; }">
            </div>
        </div>

        <div class="auth-right px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <h4 class="mb-12 mt-12 text-center">{{ ui_value('web-setting', 'title') }}</h4>
                    <p class="text-secondary text-center">Please login to continue</p>
                </div>
                
    

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" 
                            name="email" 
                            class="form-control h-54-px bg-neutral-50 radius-12"
                            placeholder="Email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="position-relative mb-20">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" 
                                name="password" 
                                class="form-control h-54-px bg-neutral-50 radius-12"
                                id="your-password" 
                                placeholder="Password" 
                                required>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                            onclick="togglePassword()"></span>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{route('admin.password.request')}}" class="text-primary-600 fw-semibold">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-10 py-14 w-100 radius-12 mt-16">
                        Login
                    </button>

                </form>
            </div>
        </div>
    </section>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('your-password');
            const toggleButton = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('ri-eye-line');
                toggleButton.classList.add('ri-eye-off-line');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('ri-eye-off-line');
                toggleButton.classList.add('ri-eye-line');
            }
        }
    </script>

    <x-admin.script />
</body>
</html>