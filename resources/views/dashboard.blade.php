@extends('layouts.app')

@section('page-title-bar')
<div>
    <h4 style="font-weight: 300; font-size: 1.8rem; margin: 0; text-transform: capitalize;">Dashboard</h4>
    <p style="color: var(--colors-body); font-size: 0.85rem; margin: 0; margin-top: 2px;">Selamat datang kembali, {{ Auth::user()->name }}.</p>
</div>
@endsection

@section('content')

<!-- STAT CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-card brand-hero">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Total Mahasiswa</div>
                <div class="stat-number">{{ $totalMahasiswa }}</div>
                <div class="stat-sub">Terdaftar di sistem</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card brand-flat">
            <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
            <div>
                <div class="stat-label">Total Jurusan</div>
                <div class="stat-number">{{ $totalJurusan }}</div>
                <div class="stat-sub">Program studi aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card brand-flat">
            <div class="stat-icon"><i class="bi bi-activity"></i></div>
            <div>
                <div class="stat-label">Status Sistem</div>
                <div class="stat-number" style="font-size:1.6rem; padding-top:0.4rem; font-weight:800;">Aktif</div>
                <div class="stat-sub">Berjalan normal</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card brand-flat">
            <div class="stat-icon"><i class="bi bi-calendar-check-fill"></i></div>
            <div>
                <div class="stat-label">Tahun Akademik</div>
                <div class="stat-number" style="font-size:1.6rem; padding-top:0.4rem; font-weight:800;">{{ date('Y') }}/{{ date('Y')+1 }}</div>
                <div class="stat-sub">Periode aktif</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Mahasiswa per Program Studi -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <span style="width:8px;height:8px;background:var(--colors-primary);border-radius:50%;display:inline-block;"></span>
                Mahasiswa per Program Studi
            </div>
            <div class="card-body">
                @if($jurusanStats->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-icon"></i>
                        <p>Belum ada data program studi</p>
                    </div>
                @else
                    <div style="display:flex; flex-direction:column; gap:0.6rem;">
                        @foreach($jurusanStats as $stat)
                        <div class="breakdown-card">
                            <div>
                                <div class="name">{{ ucwords($stat->program_studi) }}</div>
                                <div class="sub">Program Studi</div>
                            </div>
                            <div class="count">{{ $stat->total }}</div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mahasiswa Terbaru -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span style="width:8px;height:8px;background:var(--colors-primary);border-radius:50%;display:inline-block;"></span>
                    Mahasiswa Terbaru
                </div>
                <a href="{{ route('mahasiswa.index') }}" style="font-size:0.8rem; color:var(--colors-primary); text-decoration:none; font-weight:700; display:flex; align-items:center; gap:0.3rem; text-transform:uppercase; letter-spacing:0.5px;">
                    Lihat semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($mahasiswaTerbaru->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-icon"></i>
                        <p>Belum ada data mahasiswa</p>
                    </div>
                @else
                    <table class="table" style="font-size:0.855rem;">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswaTerbaru as $mhs)
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <div style="width:32px; height:32px; background:var(--colors-canvas-soft); border:1px solid var(--colors-mute); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:800; color:var(--colors-ink); flex-shrink:0;">
                                            {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:700; color:var(--colors-ink);">{{ $mhs->nama }}</div>
                                            @if($mhs->email)
                                                <div style="font-size:0.75rem; color:var(--colors-body);">{{ $mhs->email }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-capitalize" style="color:var(--colors-body); font-weight:500;">{{ $mhs->program_studi }}</td>
                                <td><span class="badge-chip">Sem. {{ $mhs->semester }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
