@extends('layouts.admin')

@section('content')
	<div class="container">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Laporan Pendapatan</h2>
                        </div>
                        <div class="card-body">
                            <form action="" class="mb-5">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-2">
                                            <input type="text" class="form-control datepicker" readonly="" value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}" name="start" placeholder="Dari">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" class="form-control datepicker" readonly="" value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end" placeholder="Ke">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <select name="export" class="form-control">
                                                <option value="xlsx">excel</option>
                                                <option value="pdf">pdf</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <button type="submit" class="btn btn-primary btn-default">Go</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                           <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Tanggal</th>
                                        <th>Pesanan</th>
                                        <th>Pendapatan Kotor</th>
                                        <th>Pajak</th>
                                        <th>Pengiriman</th>
                                        <th>Pendapatan Bersih</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalOrders = 0;
                                            $totalGrossRevenue = 0;
                                            $totalTaxesAmount = 0;
                                            $totalShippingAmount = 0;
                                            $totalNetRevenue = 0;
                                        @endphp
                                        @forelse ($revenues as $revenue)
                                            <tr>    
                                                <td>{{ $revenue->date }}</td>
                                                <td>
                                                    <a href="{{ url('admin/orders?start='. $revenue->date .'&end='. $revenue->date . '&status=completed') }}">{{ $revenue->num_of_orders }}</a>
                                                </td>
                                                <td>{{ number_format($revenue->gross_revenue) }}</td>
                                                <td>{{ number_format($revenue->taxes_amount) }}</td>
                                                <td>{{ number_format($revenue->shipping_amount) }}</td>
                                                <td>{{ number_format($revenue->net_revenue) }}</td>
                                            </tr>

                                            @php
                                                $totalOrders += $revenue->num_of_orders;
                                                $totalGrossRevenue += $revenue->gross_revenue;
                                                $totalTaxesAmount += $revenue->taxes_amount;
                                                $totalShippingAmount += $revenue->shipping_amount;
                                                $totalNetRevenue += $revenue->net_revenue;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="6">No records found</td>
                                            </tr>
                                        @endforelse
                                        
                                        @if ($revenues)
                                            <tr>
                                                <td>Total</td>
                                                <td><strong>{{ number_format($totalOrders) }}</strong></td>
                                                <td><strong>{{ number_format($totalGrossRevenue) }}</strong></td>
                                                <td><strong>{{ number_format($totalTaxesAmount) }}</strong></td>
                                                <td><strong>{{ number_format($totalShippingAmount) }}</strong></td>
                                                <td><strong>{{ number_format($totalNetRevenue) }}</strong></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-alt')
<script src="{{ asset('backend/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
			format: 'yyyy-mm-dd'
		});
    </script>
@endpush