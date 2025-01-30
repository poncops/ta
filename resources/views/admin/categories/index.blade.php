@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Kategori') }}
                </h6>
                <div class="ml-auto">
                    @can('category_create')
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('Kategori Baru') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Jumlah Brg</th>
                        <th>Induk</th>
                        <th class="text-center" style="width: 30px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($category->cover)
                                    <img src="{{ Storage::url('images/categories/' . $category->cover) }}"
                                        width="60" height="60" alt="{{ $category->name }}">
                                @else
                                    <span class="badge badge-primary">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td><a href="{{ route('admin.categories.show', $category->id) }}">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->parent->name ?? '' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onclick="return confirm('apa kamu yakin !')" action="{{ route('admin.categories.destroy', $category) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">Tidak ada kategori yang ditemukan.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="float-right">
                                    {!! $categories->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
