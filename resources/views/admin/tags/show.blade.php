@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $tag->name }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">
                        <span class="text">Kembali ke tag</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Jumlah Brg</th>
                        <th>DiBuat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->product ?? '' }}</td>
                        <td>{{ $tag->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
