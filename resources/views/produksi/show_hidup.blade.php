<table id="tableData" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Ring</th>
            <th>Asal Burung</th>
            <th>Tanggal Menetas</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach (auth()->user()->penangkaran->kandangs ?? [] as $auth)
            @foreach ($auth->produksis->where('status_produksi', 'Hidup') as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->kode_ring ?? 'belum tersedia' }} </td>
                    <td><b>{{ $data->kandang->nama_kandang }}</b> Telur
                        {{ $data->status_telur }} </td>
                    <td>{{ date('d M Y', strtotime($data->tgl_menetas)) }}</td>
                    <td>{{ $data->jenis_kelamin }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->tgl_menetas)->diffInDays($tgl_today) }} Hari
                    </td>
                    <td align="center">
                        <button type="button" class="btn btn-default  btn-outline-success"
                            onclick="showRead({{ $data->id }})">
                            <ion-icon name="search"></ion-icon>
                        </button>
                        <button type="button" class="btn btn-default  btn-outline-success"
                            onclick="showUpdate({{ $data->id }})">
                            <ion-icon name="open-outline"></ion-icon>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#tableData').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
