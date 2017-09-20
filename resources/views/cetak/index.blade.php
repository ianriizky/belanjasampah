<div class="col-xs-12">
    <!-- Tabel data -->
    <table class="table table-striped table-bordered table-hover" v-else>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th>Nama Nasabah</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total transaksi</th>
                <th>Ditambahkan pada</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->customer->user->name }}</td>
                    <td>{{ $receipt->detailreceipts->good->name }}</td>
                    <td>{{ $receipt->detailreceipts->damount }}</td>
                    <td>{{ $receipt->detailreceipts->dprice }}</td>
                    <td>Rp{{ $receipt->total }}</td>
                    <td>{{ $receipt->created_at }}</td>
                    <td>{{ $receipt->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>