@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Berita</h3>
                    @can('wartawan')
                        <a href="{{ route('news.create') }}" class="btn btn-primary float-right">Tambah Berita</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @can('editor')
                                            @if($item->status == 'draft')
                                                <form action="{{ route('news.approve', $item) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Setujui</button>
                                                </form>
                                                <form action="{{ route('news.reject', $item) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection