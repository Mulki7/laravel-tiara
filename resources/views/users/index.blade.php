@extends('layouts.app')

@section('page-title-bar')
<div>
    <h4 style="font-weight: 300; font-size: 1.8rem; margin: 0;">Data User</h4>
    <p style="color: var(--colors-body); font-size: 0.85rem; margin: 0; margin-top: 2px;">Total <strong>{{ $users->count() }}</strong> pengguna terdaftar.</p>
</div>
@endsection

@section('content')

<div style="max-width:720px;">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td><div class="row-num">{{ $index + 1 }}</div></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:0.75rem;">
                            <div style="width:32px; height:32px; background:var(--colors-canvas-soft); border:1px solid var(--colors-mute); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:800; color:var(--colors-ink); flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:700; color:var(--colors-ink);">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--colors-body); font-weight:500;">{{ $user->email }}</td>
                    <td style="color:var(--colors-body); font-size:0.85rem; font-weight:500;">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="bi bi-people empty-icon"></i>
                            <p>Belum ada data user</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
