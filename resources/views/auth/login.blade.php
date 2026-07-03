@extends('layouts.app')

@section('content')
<div style="min-height:100vh; display:flex; background:var(--colors-canvas-soft); flex-wrap: wrap;">

    <!-- LEFT PANEL (Hero Banner) -->
    <div style="width:420px; min-height: 100vh; flex-shrink:0; background:var(--colors-ink); display:flex; flex-direction:column; justify-content:space-between; padding:3rem; border-right: 1px solid var(--colors-ink);">
        
        <div>
            <!-- Brand & Speechmark Logo Orb -->
            <div style="display:flex; align-items:center; gap:0.9rem; margin-bottom:4rem;">
                <div class="brand-logo-orb">
                    <i class="bi bi-quote"></i>
                </div>
                <div>
                    <div style="color:#ffffff; font-weight:800; font-size:1.1rem; line-height:1.2; text-transform:uppercase; letter-spacing:-0.5px;">Sistem Mahasiswa</div>
                    <div style="color:var(--colors-mute); font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px;">Manajemen Akademik</div>
                </div>
            </div>

            <!-- Massive display headline -->
            <h1 style="color:#ffffff; font-weight:800; font-size:2.6rem; line-height:1.1; letter-spacing:-1.5px; text-transform:uppercase; margin-bottom:1.5rem; font-family:'Inter',sans-serif;">
                MANAJEMEN DATA AKADEMIK
            </h1>
            <p style="color:var(--colors-mute); font-size:0.9rem; line-height:1.7; font-family:'Inter',sans-serif; margin-bottom:2.5rem;">
                Platform manajemen data mahasiswa yang modern, cepat, dan mudah digunakan untuk mengelola informasi akademik.
            </p>

            <!-- Feature list -->
            <div style="display:flex; flex-direction:column; gap:1rem;">
                @foreach([
                    ['bi-check-circle-fill','var(--colors-primary)','CRUD Data Mahasiswa'],
                    ['bi-check-circle-fill','var(--colors-primary)','Dashboard Statistik Real-time'],
                    ['bi-check-circle-fill','var(--colors-primary)','Filter & Pencarian Data'],
                ] as $f)
                <div style="display:flex; align-items:center; gap:0.8rem;">
                    <i class="bi {{ $f[0] }}" style="color:{{ $f[1] }}; font-size:1rem; flex-shrink:0;"></i>
                    <span style="color:#ffffff; font-size:0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; font-family:'Inter',sans-serif;">{{ $f[2] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer text -->
        <p style="color:rgba(255,255,255,0.3); font-size:0.75rem; font-weight:600; font-family:'Inter',sans-serif; text-transform:uppercase; letter-spacing:0.5px;">
            &copy; {{ date('Y') }} Sistem Mahasiswa.
        </p>
    </div>

    <!-- RIGHT PANEL (Form) -->
    <div style="flex:1; display:flex; align-items:center; justify-content:center; padding:3rem; background:var(--colors-canvas);">
        <div style="width:100%; max-width:400px;">

            <div style="margin-bottom:2.5rem;">
                <h2 style="font-size:1.8rem; font-weight:800; color:var(--colors-ink); text-transform:uppercase; letter-spacing:-0.5px; margin-bottom:0.5rem; font-family:'Inter',sans-serif;">
                    Selamat Datang 👋
                </h2>
                <p style="color:var(--colors-body); font-size:0.9rem; font-family:'Inter',sans-serif; font-weight:500;">Masukkan kredensial Anda untuk melanjutkan.</p>
            </div>

            @if(session('status'))
                <div class="alert alert-success" style="margin-bottom:1.5rem;">
                    <i class="bi bi-check-circle-fill" style="color:#10b981;"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom:1.25rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Alamat Email
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                            placeholder="admin@gmail.com"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            style="width:100%; padding-left:2.75rem;">
                    </div>
                    @error('email')
                        <span style="color:var(--colors-primary); font-size:0.8rem; margin-top:0.4rem; display:block; font-weight:600;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom:1.5rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Password
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            style="width:100%; padding-left:2.75rem; padding-right:2.75rem;">
                        <button type="button" onclick="togglePass()" style="position:absolute; right:1rem; top:50%; transform:translateY(-50%); background:none; border:none; color:var(--colors-body); cursor:pointer; padding:0; display:flex; align-items:center;">
                            <i class="bi bi-eye" id="eye-icon" style="font-size:1.1rem;"></i>
                        </button>
                    </div>
                    @error('password')
                        <span style="color:var(--colors-primary); font-size:0.8rem; margin-top:0.4rem; display:block; font-weight:600;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember me + Forgot -->
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem;">
                    <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.85rem; color:var(--colors-body); font-weight:600; user-select:none;">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            style="width:16px; height:16px; accent-color:var(--colors-primary); cursor:pointer;">
                        Ingat Saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:0.85rem; color:var(--colors-primary); text-decoration:none; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-pill-primary" style="width:100%; justify-content:center; padding:0.85rem !important;">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                    Masuk ke Sistem
                </button>

                <!-- Register link -->
                @if (Route::has('register'))
                <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem; color:var(--colors-body); font-weight:500;">
                    Belum punya akun?
                    <a href="{{ route('register') }}" style="color:var(--colors-primary); font-weight:700; text-decoration:none;">Daftar sekarang</a>
                </p>
                @endif
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
function togglePass() {
    const el = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (el.type === 'password') {
        el.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        el.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endsection
@endsection
