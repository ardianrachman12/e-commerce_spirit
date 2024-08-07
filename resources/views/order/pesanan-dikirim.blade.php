@extends('layouts.app')

@section('title', 'Data Pesanan')

@section('content')
    @include('layouts.alert')
    <div class="card shadow mb-4">
        <div class="card-header py3">
            <h4 class="card-title">Pesanan dikirim</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Nama Pembeli</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->users->name }}</td>
                                <td>{{ $item->payments->first()->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('detailpesanan', $item->id) }}" class="btn btn-warning btn-sm">view</a>
                                    <form action="{{ route('delivered', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mt-1">selesai</button>
                                    </form>
                                    <form action="{{ route('cancel', $item->id) }}" method="post"
                                        onsubmit="return confirm('Yakin akan dicancel?')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm mt-1">cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
