@extends('adm.layouts.app', [
    'wsecond_title' => 'Regency',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'regency',
    'wheader' => [
        'header_title' => 'Regency: List',
        'header_breadcrumb' => [
            [
                'title' => 'Dashboard',
                'is_active' => false,
                'url' => route('adm.index')
            ], [
                'title' => 'Regency',
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

    {{-- Select2 --}}
    <link href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-column flex-lg-row align-items-center">
            <h3 class="card-title">Regency List</h3>

            <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                <a href="{{ route('adm.regency.create') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                    <i class="fas fa-plus mr-1"></i> Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter</h3>
                </div>
                <div class="card-body">
                    <div class="col-4">
                        <label>Province</label>

                        <select class="form-control" id="input_filter-province_id">
                            <option value="">Select province</option>
                        </select>
                    </div>
                </div>
            </div>

            <table id="regency-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
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

    {{-- Select2 --}}
    <script src="{{ asset('assets/plugins/select2/js/select2.full.js') }}"></script>
@endsection

@section('js_inline')
    <script>
        $(document).ready((e) => {
            $("#input_filter-province_id").select2({
                placeholder: 'Search Province',
                theme: 'bootstrap4',
                allowClear: true,
                ajax: {
                    url: "{{ route('adm.select2.province.all') }}",
                    delay: 250,
                    data: function (params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data, params) {
                        var items = $.map(data.data, function(obj){
                            obj.id = obj.id;
                            obj.text = `${obj.name}`;

                            return obj;
                        });
                        params.page = params.page || 1;

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: items,
                            pagination: {
                                more: params.page < data.last_page
                            }
                        };
                    },
                },
                language: {
                    searching: function (params) {
                        // Intercept the query as it is happening
                        select2_query = params;
                        
                        // Change this to be appropriate for your application
                        return 'Searching...';
                    }
                }
            });

            const regencyTable = $("#regency-table").DataTable({
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
                    url: "{{ route('adm.datatable.regency.all') }}",
                    type: "GET",
                    data: function(d){
                        d.filter_province = $("#input_filter-province_id").val()
                    }
                },
                success: (result) => {
                    console.log(result);
                },
                columns: [
                    { "data": "name" },
                    { "data": "" }
                ],
                columnDefs: [
                    {
                        "targets": "_all",
                        "className": 'vertical-middle'
                    }, {
                        "targets": 0,
                        "render": (row, type, data) => {
                            let extra = '';
                            if(data.province){
                                extra = `<div class=""><small>Province: <a href="{{ route('adm.province.index') }}/${data.province.id}" target="_blank"><u>${data.province.name}</u></a></small></div>`;
                            }

                            return `
                                <span>${row}</span>
                                ${extra}
                            `;
                        }
                    }, {
                        "targets": 1,
                        "searchable": false,
                        "sortable": false,
                        "render": (row, type, data) => {
                            return `
                                <div class='btn-group'>
                                    <a href="{{ route('adm.regency.index') }}/${data.id}/edit" class="btn btn-caction btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-caction btn-danger btn-sm" onclick="deleteAction('${data.id}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('adm.regency.index') }}/${data.id}" class="btn btn-caction btn-info btn-sm">
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
                html: `Related data will be deleted`,
                icon: 'warning',
                showLoaderOnConfirm: true,
                reverseButtons: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: (login) => {
                    return $.post(`{{ route('adm.regency.index') }}/${id}`, {
                        '_method': 'DELETE', 
                        '_token': "{{ csrf_token() }}",
                    }, 
                    (result) => {
                        // console.log(result);
                    }).done(function(){
                        $("#regency-table").DataTable().ajax.reload(null, false);
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
                        $("#regency-table").DataTable().ajax.reload(null, false);
                    });
                }
            });
        }

        // Reload datatable on select2 change
        $("#input_filter-province_id").change((e) => {
            $("#regency-table").DataTable().ajax.reload();
        });
    </script>
@endsection