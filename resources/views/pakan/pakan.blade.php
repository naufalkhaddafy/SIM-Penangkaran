@extends('template.template')
@section('title', 'Supply Pakan')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <td>
                                <button type="button" class="btn btn-block btn-outline-success" onclick="showCreate()">
                                    <ion-icon name="nutrition"></ion-icon> <b>Tambah</b>
                                </button>
                            </td>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="readData"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Dynamic Modal --}}
    <div class="modal fade " id="showModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btnClose" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSubmit" class="btn btn-info"></button>
                    <button type="submit" id="btnDelete" class="btn btn-danger"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            readData()
        });

        function readData() {
            $.get("{{ url('/show-pakan') }}", function(data) {
                $('#readData').html(data);
            });
        }

        function showRead(id) {
            $.get("{{ url('/modal-read-pakan') }}/" + id, function(data) {
                $('#modalLabel').text('Data Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').hide();
                $('#btnSubmit').hide();
                $('#btnDelete').hide();
            });
        }

        function showCreate() {
            $.get("{{ url('/modal-create-pakan') }}", function(data) {
                $('#modalLabel').text('Tambah Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Tambah').attr('onclick', 'tambah()');
                $('#btnDelete').hide();
            });
        }

        function showUpdate(id) {
            $.get("{{ url('/modal-update-pakan') }}/" + id, function(data) {
                $('#modalLabel').text('Update Data Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').show().text('Update').attr('onclick', 'update()');
                $('#btnDelete').hide();
            });
        }

        function showDelete(id) {
            $.get("{{ url('/modal-delete-pakan') }}/" + id, function(data) {
                $('#modalLabel').text('Delete Data Pakan')
                $('#showModalBody').html(data);
                $('#showModal').modal('show');
                $('#btnClose').show();
                $('#btnSubmit').hide();
                $('#btnDelete').show().text('Delete').attr('onclick', 'destroy()');
            });
        }
    </script>
@endpush