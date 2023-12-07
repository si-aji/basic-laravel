@extends('adm.layouts.app', [
    'wsecond_title' => 'Dashboard',
    'sidebar_menu' => 'dashboard',
    'sidebar_submenu' => null,
    'wheader' => [
        'header_title' => 'Dashboard',
        'header_breadcrumb' => [
            [
                'title' => 'Dashboard',
                'is_active' => true,
                'url' => null
            ], 
        ]
    ]
])

@section('css_plugins')
    <link href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/select2/css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Linked dropdown</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <label>Province</label>
                    <select name="province_id" class="form-control" id="input-province_id">
                        <option value="">Select province</option>
                    </select>
                </div>
        
                <div class="col-12 col-md-4">
                    <label>Regency</label>
                    <select name="regency_id" class="form-control" id="input-regency_id" disabled>
                        <option value="">Select Regency</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_plugins')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.js') }}"></script>
@endsection

@section('js_inline')
    <script>
        $(document).ready((e) => {
            $("#input-province_id").select2({
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
            $("#input-regency_id").select2({
                placeholder: 'Search Province',
                theme: 'bootstrap4',
                allowClear: true,
                ajax: {
                    url: "{{ route('adm.select2.regency.all') }}",
                    delay: 250,
                    data: function (params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                            province: $("#input-province_id").val()
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
        });

        // Store selected data to temporary field
        $("#input-province_id").change((e) => {
            let disabled = true;
            let select_data = $(e.target).select2('data');

            if($(e.target).val()){
                disabled = false;
            } 

            $("#input-regency_id").attr('disabled', disabled);
        });
    </script>
@endsection