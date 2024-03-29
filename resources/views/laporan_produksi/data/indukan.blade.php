<table id="example2" class="table table-bordered table-hover">
    <thead align="center">
        <tr>
            <th>Tempat Indukan</th>
            <th>Kode Ring</th>
            <th>Jenis Kelamin</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produksis->where('status_produksi', 'Indukan') as $data)
            <tr>
                <td>{{ $data->indukans->kandang->penangkaran->lokasi_penangkaran ?? '' }}
                    {{ $data->indukans->kandang->nama_kandang ?? 'Belum Tersedia' }} </td>
                <td>{{ $data->kode_ring ?? 'Belum tersedia' }} </td>
                <td>{{ $data->jenis_kelamin }}</td>
                <td>{{ $data->keterangan }}
                </td>
                <td align="center" valign="middle">
                    <button type="button" class="btn btn-default  btn-outline-success"
                        onclick="showRead({{ $data->id }})">
                        <ion-icon name="search"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default  btn-outline-warning"
                        onclick="showUpdate({{ $data->id }})">
                        <ion-icon name="open-outline"></ion-icon>
                    </button>
                    <button type="button" class="btn btn-default  btn-outline-info"
                        onclick="printSertifikat({{ $data->id }})">
                        <ion-icon name="print-outline"></ion-icon>
                    </button>
                </td>
            </tr>
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
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function printSertifikat(id) {
        window.open("{{ url('/print-sertifikat') }}/" + id);
    }
</script>
