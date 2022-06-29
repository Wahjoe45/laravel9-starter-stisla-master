@extends('layouts.app')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Menu Group and Menu Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Menu Group Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Pegawai</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('pgw.create') }}">Create New
                                    Pegawai</a>
                                <a class="btn btn-info btn-primary active import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Pegawai</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('user.export') }}">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Pegawai</a>
                                <a class="btn btn-info btn-primary active search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Pegawai</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- <div class="show-import" style="display: none">
                                <div class="custom-file">
                                    <form action="{{ route('pgw.import') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import_file">
                                        <br/> <br/>
                                        <div class="footer text-right">
                                            <button class="btn btn-primary">Import File</button>
                                        </div>s
                                    </form>
                                </div>
                            </div> --}}

                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('pgw.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">User</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="User Name">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('pgw.index') }}">Reset</a>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama Pegawai</th>
                                            <th>Asal</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                        @foreach ($pgw as $pegawai)

                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td>{{ $pegawai->NIP }}</td>
                                                <td>{{ $pegawai->NamaPegawai }}</td>
                                                <td>{{ $pegawai->Asal }}</td>
                                                <td>{{ $pegawai->Status }}</td>

                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('pgw.show', $pegawai->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            Show</a>

                                                        <a href="{{ route('pgw.edit', $pegawai->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                            Edit</a>

                                                        <form action="{{ route('pgw.destroy', $pegawai->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon "><i
                                                                    class="fas fa-times"></i> Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {{ $pgw->withQueryString()->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if ($message = Session::get('succes'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}
    </section>
@endsection

@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
@endpush
