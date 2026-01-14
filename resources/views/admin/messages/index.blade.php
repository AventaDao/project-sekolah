@extends('layouts.dashboard')

@section('title', 'Pesan Masuk')

@section('content')
<div class="pc-content">
    <div class="row">
        <div class="col-sm-12">
            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold" style="color: #333; font-size: 28px;">📬 Pesan Masuk</h2>
                <p class="text-muted" style="font-size: 14px;">Kelola dan balas semua pesan yang masuk dari masyarakat</p>
            </div>

            <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden;">
                <!-- Card Header dengan Gradient -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" style="font-size: 18px; font-weight: 600;">Daftar Pesan</h5>
                        <span style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 20px; font-size: 13px;">
                            Total: {{ $messages->total() }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div style="overflow-x: auto;">
                        <table class="table table-hover mb-0" style="border: none;">
                            <thead style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                <tr>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Support ID</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Nama</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Email</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Subject</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Kategori</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Status</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none;">Dikirim</th>
                                    <th style="color: #667eea; font-weight: 600; padding: 15px 20px; border: none; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $msg)
                                <tr style="border-bottom: 1px solid #e9ecef; transition: all 0.3s ease;">
                                    <td style="padding: 15px 20px; border: none;">
                                        <strong style="color: #667eea;">{{ $msg->support_id }}</strong>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        <span style="color: #333; font-weight: 500;">{{ $msg->name }}</span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        <span style="color: #666; font-size: 13px;">{{ $msg->email }}</span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        <span style="color: #333; max-width: 200px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $msg->subject }}</span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        <span style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); color: #667eea; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                            {{ $msg->category }}
                                        </span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        @php
                                            $statusColors = [
                                                'open' => ['bg' => '#667eea', 'text' => '🔵 Dibuka'],
                                                'in_progress' => ['bg' => '#ffa500', 'text' => '🟡 Diproses'],
                                                'closed' => ['bg' => '#4caf50', 'text' => '🟢 Selesai'],
                                                'resolved' => ['bg' => '#4caf50', 'text' => '🟢 Terselesaikan']
                                            ];
                                            $status = strtolower($msg->status);
                                            $statusColor = $statusColors[$status] ?? ['bg' => '#999', 'text' => ucfirst($status)];
                                        @endphp
                                        <span style="background: {{ $statusColor['bg'] }}20; color: {{ $statusColor['bg'] }}; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; border-left: 3px solid {{ $statusColor['bg'] }};">
                                            {{ $statusColor['text'] }}
                                        </span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none;">
                                        <span style="color: #999; font-size: 13px;">{{ $msg->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td style="padding: 15px 20px; border: none; text-align: center;">
                                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block;">
                                            👁️ Lihat
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="padding: 40px; text-align: center; border: none;">
                                        <p style="color: #999; font-size: 16px; margin-bottom: 0;">📭 Tidak ada pesan saat ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Styling -->
                    <div style="padding: 20px;">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05) !important;
        transform: translateX(2px);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    /* Pagination styling */
    .pagination .page-link {
        color: #667eea;
        border-color: #e9ecef;
        border-radius: 6px;
        margin: 0 3px;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }
</style>
@endsection
