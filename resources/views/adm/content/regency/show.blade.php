@extends('adm.layouts.app', [
    'wsecond_title' => 'Regency: Detail',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'regency',
    'wheader' => [
        'header_title' => 'Regency: Detail',
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
                'title' => 'Detail',
                'is_active' => true,
                'url' => null
            ], 
        ]
    ]
])

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-lg-row flex-column align-items-center">
            <h3 class="card-title">Regency: Detail</h3>

            <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                <a href="{{ route('adm.regency.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center">
                    <i class="far fa-arrow-alt-circle-left mr-1"></i> Back
                </a>
                <a href="{{ route('adm.regency.edit', $data->id) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                    <i class="far fa-edit mr-1"></i> Edit
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Province</th>
                    <td>
                        <a href="{{ route('adm.province.show', $data->province->id) }}" target="_blank">{{ $data->province->name }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $data->name }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection