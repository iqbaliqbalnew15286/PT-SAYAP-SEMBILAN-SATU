@extends('admin.layouts.app')

@section('title', 'Kelola Feedback')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Feedback</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Subjek</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->id }}</td>
                                        <td>{{ $feedback->name }}</td>
                                        <td>{{ $feedback->email }}</td>
                                        <td>{{ Str::limit($feedback->subject, 30) }}</td>
                                        <td>
                                            @if($feedback->status === 'unread')
                                                <span class="badge badge-danger">Belum Dibaca</span>
                                            @elseif($feedback->status === 'read')
                                                <span class="badge badge-warning">Sudah Dibaca</span>
                                            @else
                                                <span class="badge badge-success">Sudah Dibalas</span>
                                            @endif
                                        </td>
                                        <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.feedbacks.show', $feedback) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada feedback yang diterima.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
