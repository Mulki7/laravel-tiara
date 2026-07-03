@extends('layouts.app')

@section('page-title-bar')
<div>
    <h4 style="font-weight: 300; font-size: 1.8rem; margin: 0;">Edit Data Mahasiswa</h4>
    <p style="color: var(--colors-body); font-size: 0.85rem; margin: 0; margin-top: 2px;">Ubah data mahasiswa <strong>{{ $mahasiswa->nama }}</strong>.</p>
</div>
@endsection

@section('content')

<div style="max-width:680px;">
    <!-- Info card -->
    <div style="background:var(--colors-canvas); border:1px solid var(--colors-ink); border-radius:6px; padding:1rem 1.25rem; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.85rem;">
        <div style="width:36px; height:36px; background:var(--colors-canvas-soft); border:1px solid var(--colors-mute); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1rem; font-weight:800; color:var(--colors-ink); flex-shrink:0;">
            {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
        </div>
        <div>
            <div style="font-weight:800; font-size:0.9rem; color:var(--colors-ink); text-transform:uppercase; letter-spacing:0.5px;">{{ $mahasiswa->nama }}</div>
            <div style="font-size:0.8rem; color:var(--colors-body); font-weight:500;">NIM: {{ $mahasiswa->nim }} &bull; {{ ucwords($mahasiswa->program_studi) }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Form Edit Mahasiswa
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- NIM -->
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM <span style="color:var(--colors-primary);">*</span></label>
                    <input type="text"
                           class="form-control @error('nim') is-invalid @enderror"
                           id="nim" name="nim"
                           value="{{ old('nim', $mahasiswa->nim) }}"
                           placeholder="Masukkan NIM"
                           required maxlength="20">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap <span style="color:var(--colors-primary);">*</span></label>
                    <input type="text"
                           class="form-control @error('nama') is-invalid @enderror"
                           id="nama" name="nama"
                           value="{{ old('nama', $mahasiswa->nama) }}"
                           placeholder="Masukkan nama lengkap"
                           required maxlength="255">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                        <span style="font-size:0.75rem; font-weight:400; color:var(--colors-body); margin-left:0.25rem; text-transform:none; letter-spacing:0;">(Opsional)</span>
                    </label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $mahasiswa->email) }}"
                           placeholder="contoh@email.com"
                           maxlength="255">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div class="mb-3">
                    <label for="program_studi" class="form-label">Program Studi <span style="color:var(--colors-primary);">*</span></label>
                    <input type="text"
                           class="form-control @error('program_studi') is-invalid @enderror"
                           id="program_studi" name="program_studi"
                           value="{{ old('program_studi', $mahasiswa->program_studi) }}"
                           placeholder="Contoh: sistem informasi"
                           required maxlength="255">
                    @error('program_studi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Semester -->
                <div class="mb-4">
                    <label for="semester" class="form-label">Semester <span style="color:var(--colors-primary);">*</span></label>
                    <select class="form-select @error('semester') is-invalid @enderror"
                            id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 14; $i++)
                            <option value="{{ $i }}" {{ old('semester', $mahasiswa->semester) == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Divider -->
                <div style="height:1px; background:var(--colors-ink); margin-bottom:1.5rem;"></div>

                <!-- Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-pill-primary">
                        <i class="bi bi-check-circle-fill"></i> Update Data
                    </button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn-pill-outline-dark">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
