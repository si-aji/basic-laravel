@extends('adm.layouts.app', [
    'wsecond_title' => 'Province: Edit',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'province',
    'wheader' => [
        'header_title' => 'Province: Edit',
        'header_breadcrumb' => [
            [
                'title' => 'Dashboard',
                'is_active' => false,
                'url' => route('adm.index')
            ], [
                'title' => 'Province',
                'is_active' => false,
                'url' => route('adm.province.index')
            ], [
                'title' => 'Edit',
                'is_active' => true,
                'url' => null
            ], 
        ]
    ]
])

@section('content')
    <form action="{{ route('adm.province.update', $data->id) }}" method="POST">
        @csrf
        @method("PUT")

        <div class="card">
            <div class="card-header d-flex flex-lg-row flex-column align-items-center">
                <h3 class="card-title">Province: Edit</h3>
    
                <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                    <a href="{{ route('adm.province.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center">
                        <i class="far fa-arrow-alt-circle-left mr-1"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="input-name" value="{{ $data->name }}" placeholder="Province Name">

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