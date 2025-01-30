@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Rekening') }}
                </h6>
                <div class="ml-auto">
                    @can('rekening_create')
                    <a href="{{ route('admin.rekenings.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('Rekening Baru') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bank</th>
                        <th>Nomor Rekening</th>
                        <th>Nama</th>
                        <th class="text-center" style="width: 30px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rekenings as $rekening)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <!-- <a href="{{ route('admin.rekenings.show', $rekening->id) }}"></a> -->
                                {{ $rekening->bank_name }}
                            </td>
                            <td>{{ $rekening->acc_number }}</td>
                            <td>{{ $rekening->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.rekenings.edit', $rekening) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onclick="return confirm('are you sure !')" action="{{ route('admin.rekenings.destroy', $rekening) }}"
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
                            <td class="text-center" colspan="6">No rekenings found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="float-right">
                                    {!! $rekenings->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
