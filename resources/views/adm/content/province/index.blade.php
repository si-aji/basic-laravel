@extends('adm.layouts.app', [
    'wsecond_title' => 'Province',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'province',
    'wheader' => [
        'header_title' => 'Province: List',
        'header_breadcrumb' => [
            [
                'title' => 'Dashboard',
                'is_active' => false,
                'url' => route('adm.index')
            ], [
                'title' => 'Province',
                'is_active' => false,
                'url' => null
            ], [
                'title' => 'List',
                'is_active' => true,
                'url' => null
            ], 
        ]
    ]
])

@section('css_plugins')
    <link href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-column flex-lg-row align-items-center">
            <h3 class="card-title">Province List</h3>

            <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                <a href="{{ route('adm.province.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                    <i class="fas fa-plus mr-1"></i> Add New
                </a>
                <a href="{{ route('adm.province.export') }}" class="btn btn-sm btn-success d-flex align-items-center">
                    <i class="fas fa-download mr-1"></i> Export
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="province-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Regency</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('js_plugins')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endsection

@section('js_inline')
    <script>
        $(document).ready((e) => {
            const provinceTable = $("#province-table").DataTable({
                order: [0, 'asc'],
                lengthMenu: [5, 10, 25],
                stateSave: true,
                stateSaveCallback: function(settings, data) {
                    localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                    console.log(settings);
                    return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('adm.datatable.province.all') }}",
                    type: "GET",
                },
                success: (result) => {
                    console.log(result);
                },
                columns: [
                    { "data": "name" },
                    { "data": "regency_count" },
                    { "data": "" }
                ],
                columnDefs: [
                    {
                        "targets": "_all",
                        "className": 'vertical-middle'
                    }, {
                        "targets": 0,
                        "render": (row, type, data) => {
                            return `${row}`;
                        }
                    }, {
                        "targets": 1,
                        "searchable": false,
                        "render": (row, type, data) => {
                            return `${row}`;
                        }
                    }, {
                        "targets": 2,
                        "searchable": false,
                        "sortable": false,
                        "render": (row, type, data) => {
                            return `
                                <div class='btn-group'>
                                    <a href="{{ route('adm.province.index') }}/${data.id}/edit" class="btn btn-caction btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-caction btn-danger btn-sm" onclick="deleteAction('${data.id}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('adm.province.index') }}/${data.id}" class="btn btn-caction btn-info btn-sm">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }
                ],
                responsive: true
            });
        });

        const deleteAction = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                html: `Related data with it's relation will be deleted`,
                icon: 'warning',
                showLoaderOnConfirm: true,
                reverseButtons: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: (login) => {
                    return $.post(`{{ route('adm.province.index') }}/${id}`, {
                        '_method': 'DELETE', 
                        '_token': "{{ csrf_token() }}",
                    }, 
                    (result) => {
                        // console.log(result);
                    }).done(function(){
                        $("#province-table").DataTable().ajax.reload(null, false);
                    });
                },
            }).then((result) => {
                if(result.value){
                    console.log(result);
                    Swal.fire({
                        title: "Action: Success",
                        text: result.value.message,
                        icon: 'success',
                    }).then((result) => {
                        $("#province-table").DataTable().ajax.reload(null, false);
                    });
                }
            });
        }
    </script>
@endsection