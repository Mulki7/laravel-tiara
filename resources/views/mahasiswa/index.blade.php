@extends('layouts.app')

@section('page-title-bar')
<div>
    <h4 style="font-weight: 300; font-size: 1.8rem; margin: 0;">Data Mahasiswa</h4>
    <p style="color: var(--colors-body); font-size: 0.85rem; margin: 0; margin-top: 2px;">Total <strong>{{ $mahasiswas->count() }}</strong> mahasiswa terdaftar.</p>
</div>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible mb-3" role="alert">
    <i class="bi bi-check-circle-fill" style="color:#10b981; font-size:1.1rem;"></i>
    <span style="flex:1; font-size:0.875rem; font-weight:600;">{{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="margin:0;"></button>
</div>
@endif

<!-- TOOLBAR -->
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex align-items-center gap-2">
        <div style="position:relative;">
            <span style="position:absolute; left:0.85rem; top:50%; transform:translateY(-50%); color:var(--colors-body); font-size:0.85rem; pointer-events:none;">
                <i class="bi bi-funnel"></i>
            </span>
            <select name="program_studi"
                onchange="this.form.submit()"
                style="padding:0.65rem 2.2rem 0.65rem 2.2rem; border:1px solid var(--colors-ink); border-radius:6px; font-size:0.85rem; font-family:'Inter',sans-serif; color:var(--colors-ink); background:#fff; appearance:auto; outline:none; cursor:pointer; min-width:220px;">
                <option value="">Semua Program Studi</option>
                @foreach($programStudiList as $ps)
                    <option value="{{ $ps->program_studi }}" {{ request('program_studi') == $ps->program_studi ? 'selected' : '' }}>
                        {{ ucwords($ps->program_studi) }}
                    </option>
                @endforeach
            </select>
        </div>
        @if(request('program_studi'))
        <a href="{{ route('mahasiswa.index') }}" class="btn-pill-outline-dark" style="padding:0.5rem 1.2rem !important; font-size:0.8rem !important; height: 38px;">
            <i class="bi bi-x"></i> Reset
        </a>
        @endif
    </form>

    <a href="{{ route('mahasiswa.create') }}" class="btn-pill-primary">
        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
    </a>
</div>

<!-- TABLE -->
<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th style="width:60px;">No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Program Studi</th>
                <th>Semester</th>
                <th style="text-align:right; padding-right:1.5rem;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $index => $mahasiswa)
            <tr>
                <td>
                    <div class="row-num">{{ $index + 1 }}</div>
                </td>
                <td>
                    <span class="nim-badge">{{ $mahasiswa->nim }}</span>
                </td>
                <td>
                    <div style="display:flex; align-items:center; gap:0.75rem;">
                        <div style="width:32px; height:32px; background:var(--colors-canvas-soft); border:1px solid var(--colors-mute); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:800; color:var(--colors-ink); flex-shrink:0;">
                            {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
                        </div>
                        <span style="font-weight:700; color:var(--colors-ink);">{{ $mahasiswa->nama }}</span>
                    </div>
                </td>
                <td style="color:var(--colors-body);">{{ $mahasiswa->email ?? '—' }}</td>
                <td class="text-capitalize" style="color:var(--colors-ink); font-weight:500;">{{ $mahasiswa->program_studi }}</td>
                <td><span class="badge-chip">Sem. {{ $mahasiswa->semester }}</span></td>
                <td>
                    <div style="display:flex; gap:0.5rem; justify-content:flex-end; padding-right:0.25rem;">
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                            title="Edit"
                            class="btn-action-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                               method="POST" style="display:inline;"
                               onsubmit="return confirm('Yakin ingin menghapus data {{ $mahasiswa->nama }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" class="btn-action-delete">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-icon"></i>
                        @if(request('program_studi'))
                            <p>Tidak ada mahasiswa di program studi <strong>{{ ucwords(request('program_studi')) }}</strong></p>
                        @else
                            <p>Belum ada data mahasiswa. <a href="{{ route('mahasiswa.create') }}" style="color:var(--colors-primary); font-weight:700; text-decoration:none;">Tambah sekarang</a></p>
                        @endif
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
