@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Pengiriman') }}
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Pesanan ID</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Total Qty</th>
                        <th>Total Barat (gram)</th>
                        <th class="text-center" style="width: 30px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($shipments as $shipment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $shipment->order->code }}<br>
                                <span class="badge badge-info" style="font-size: 12px; font-weight: normal"> {{ $shipment->order->order_date }}</span>
                            </td>
                            <td>{{ $shipment->order->customer_full_name }}</td>
                            <td>
                                {{ $shipment->status }}
                                <br>
                                @if ($shipment->shipped_at)
                                <span class="badge badge-info" style="font-size: 12px; font-weight: normal"> {{ $shipment->shipped_at }}</span>
                                @endif
                            </td>
                            <td>{{ $shipment->total_qty }}</td>
                            <td>{{ $shipment->total_weight }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.orders.show', $shipment->order->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="12">Tidak ada produk yang ditemukan.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                <div class="float-right">
                                    {!! $shipments->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
