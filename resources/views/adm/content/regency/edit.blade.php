@extends('adm.layouts.app', [
    'wsecond_title' => 'Regency: Edit',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'regency',
    'wheader' => [
        'header_title' => 'Regency: Edit',
        'header_breadcrumb' => [
            [
                'title' => 'Dashboard',
                'is_active' => false,
                'url' => route('adm.index')
            ], [
                'title' => 'Regency',
                'is_active' => false,
                'url' => route('adm.regency.index')
            ], [
                'title' => 'Edit',
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
    <form action="{{ route('adm.regency.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header d-flex flex-lg-row flex-column align-items-center">
                <h3 class="card-title">Regency: Edit</h3>
    
                <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                    <a href="{{ route('adm.regency.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center">
                        <i class="far fa-arrow-alt-circle-left mr-1"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Province</label>
                    
                    <select name="province_id" class="form-control @error('province_id') is-invalid @enderror" id="input-province_id">
                        <option value="">Select province</option>

                        {{-- Handle previous input --}}
                        @if ($data->province()->exists())
                            <option value="{{ $data->province->id }}" selected>{{ $data->province->name }}</option>
                        @endif
                    </select>

                    @error('province_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input-name" value="{{ $data->name }}" placeholder="Regency Name">

                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <button type="reset" id="btn-reset" class="btn btn-sm btn-danger">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
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
        });
    </script>
@endsection