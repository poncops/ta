@extends('layouts.frontend')
@section('title', 'Order Items')
@section('content')
	<div class="breadcrumb-area breadcrumb-padding bg-breadcrumb" style="background-image: url({{ asset('frontend/assets/img/sakinah_mart.png') }})">
		<div class="container-fluid">
			<div class="breadcrumb-content text-center">
				<h2>Pesanan Saya</h2>
				<ul>
					<li><a href="{{ url('/') }}">home</a></li>
					<li>Pesanan Saya</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="shop-page-wrapper shop-page-padding ptb-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
                <h3 class="sidebar-title">Menu Pengguna</h3>
                    <div class="sidebar-categories">
                        <ul>
							<li><a href="{{ route('profile.index') }}">Profil</a></li>
                            <li><a href="{{ route('orders.index') }}">Pesanan</a></li>
                            <li><a href="{{ route('favorite.index') }}">Favorit</a></li>
                        </ul>
                    </div>
				</div>
				<div class="col-lg-9">
					<div class="shop-product-wrapper res-xl">
						<div class="table-content table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<th>Pesanan ID</th>
									<th>Jumlah keseluruhan</th>
									<th>Status</th>
									<th>Pembayaran</th>
									<th>Aksi</th>
								</thead>
								<tbody>
									@forelse ($orders as $order)
										<tr>    
											<td>
												{{ $order->code }}<br>
												<span style="font-size: 12px; font-weight: normal"> {{ $order->order_date }}</span>
											</td>
											<td>{{ number_format($order->grand_total) }}</td>
											<td>{{ $order->status }}</td>
											<td>{{ $order->payment_status }}</td>
											<td>
												<a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">details</a>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="5">Tidak ada catatan yang ditemukan</td>
										</tr>
									@endforelse
								</tbody>
							</table>
							{{ $orders->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection