@extends('layouts.dashboard')

@section('title', 'Detail Pesan')

@section('content')
<div class="pc-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pesan</h5>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <h6>Support ID</h6>
                    <p><strong>{{ $message->support_id }}</strong></p>

                    <h6>Pengirim</h6>
                    <p><strong>{{ $message->name }}</strong> &middot; {{ $message->email }} &middot; {{ $message->phone }}</p>

                    <h6>Subjek</h6>
                    <p>{{ $message->subject }}</p>

                    <h6>Pesan</h6>
                    <p>{{ $message->message }}</p>

                    <h6>Status</h6>
                    <p>{{ ucfirst($message->status) }} @if($message->replied_at) &middot; Dibalas {{ $message->replied_at->diffForHumans() }} @endif</p>

                    <hr>

                    <h6>Balas Pesan</h6>
                    <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="reply" class="form-control" rows="6">{{ old('reply', $message->reply) }}</textarea>
                            @error('reply')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Kirim Balasan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
