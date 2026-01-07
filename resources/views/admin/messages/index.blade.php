@extends('layouts.dashboard')

@section('title', 'Pesan Masuk')

@section('content')
<div class="pc-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Pesan Masuk</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Support ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Dikirim</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $msg)
                            <tr>
                                <td><strong>{{ $msg->support_id }}</strong></td>
                                <td>{{ $msg->name }}</td>
                                <td>{{ $msg->email }}</td>
                                <td>{{ $msg->subject }}</td>
                                <td>{{ $msg->category }}</td>
                                <td>{{ ucfirst($msg->status) }}</td>
                                <td>{{ $msg->created_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-primary">Lihat</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
