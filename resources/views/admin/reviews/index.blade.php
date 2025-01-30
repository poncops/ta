@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Ulasan') }}
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Konten</th>
                        <th>Rating</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>DiBuat</th>
                        <th class="text-center" style="width: 30px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                            <a href="{{ route('admin.reviews.show', $review->id) }}">
                                {{ $review->user->first_name ?  $review->user->first_name.' '.$review->user->last_name : $review->user->username }}
                            </a><br>
                            <small>{{ $review->email }}</small><br>
                            </td>
                            <td>{{ $review->content }}</td>
                            <td><span class="badge badge-success">{{ $review->rating }}</span></td>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->status }}</td>
                            <td>{{ $review->created_at ? $review->created_at->format('Y-m-d') : '' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onclick="return confirm('apa kamu yakin !')" action="{{ route('admin.reviews.destroy', $review) }}"
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
                            <td class="text-center" colspan="9">Tidak ada ulasan yang ditemukan.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <div class="float-right">
                                    {!! $reviews->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
