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
                BUAT AKUN BARU
            </h1>
            <p style="color:var(--colors-mute); font-size:0.9rem; line-height:1.7; font-family:'Inter',sans-serif;">
                Daftarkan diri Anda untuk mengakses sistem manajemen mahasiswa.
            </p>
        </div>

        <!-- Footer text -->
        <p style="color:rgba(255,255,255,0.3); font-size:0.75rem; font-weight:600; font-family:'Inter',sans-serif; text-transform:uppercase; letter-spacing:0.5px;">
            &copy; {{ date('Y') }} Sistem Mahasiswa.
        </p>
    </div>

    <!-- RIGHT PANEL (Form) -->
    <div style="flex:1; display:flex; align-items:center; justify-content:center; padding:3rem; background:var(--colors-canvas); overflow-y:auto;">
        <div style="width:100%; max-width:400px;">

            <div style="margin-bottom:2.5rem;">
                <h2 style="font-size:1.8rem; font-weight:800; color:var(--colors-ink); text-transform:uppercase; letter-spacing:-0.5px; margin-bottom:0.5rem; font-family:'Inter',sans-serif;">
                    Buat Akun 🚀
                </h2>
                <p style="color:var(--colors-body); font-size:0.9rem; font-family:'Inter',sans-serif; font-weight:500;">Isi data di bawah untuk mendaftar.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div style="margin-bottom:1.25rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Nama Lengkap
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            placeholder="Nama lengkap Anda"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            style="width:100%; padding-left:2.75rem;">
                    </div>
                    @error('name')
                        <span style="color:var(--colors-primary); font-size:0.8rem; margin-top:0.4rem; display:block; font-weight:600;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom:1.25rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Alamat Email
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="email@contoh.com"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            style="width:100%; padding-left:2.75rem;">
                    </div>
                    @error('email')
                        <span style="color:var(--colors-primary); font-size:0.8rem; margin-top:0.4rem; display:block; font-weight:600;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom:1.25rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Password
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            style="width:100%; padding-left:2.75rem;">
                    </div>
                    @error('password')
                        <span style="color:var(--colors-primary); font-size:0.8rem; margin-top:0.4rem; display:block; font-weight:600;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom:1.75rem;">
                    <label class="form-label" style="display:block; margin-bottom:0.5rem;">
                        Konfirmasi Password
                    </label>
                    <div style="position:relative;">
                        <span style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:1rem; pointer-events:none;">
                            <i class="bi bi-shield-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="form-control"
                            style="width:100%; padding-left:2.75rem;">
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-pill-primary" style="width:100%; justify-content:center; padding:0.85rem !important;">
                    <i class="bi bi-person-plus-fill"></i>
                    Buat Akun
                </button>

                <!-- Login link -->
                <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem; color:var(--colors-body); font-weight:500;">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" style="color:var(--colors-primary); font-weight:700; text-decoration:none;">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
