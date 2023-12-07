@extends('adm.layouts.app', [
    'wsecond_title' => 'Province: Detail',
    'sidebar_menu' => 'location',
    'sidebar_submenu' => 'province',
    'wheader' => [
        'header_title' => 'Province: Detail',
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
            <h3 class="card-title">Province: Detail</h3>

            <div class="card-tools ml-lg-auto mr-0 mt-3 mt-lg-1 btn-group">
                <a href="{{ route('adm.province.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center">
                    <i class="far fa-arrow-alt-circle-left mr-1"></i> Back
                </a>
                <a href="{{ route('adm.province.edit', $data->id) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                    <i class="far fa-edit mr-1"></i> Edit
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th>Regency Count</th>
                    <td>{{ $data->regency()->count() }}</td>
                </tr>
                <tr>
                    <th>Random Regency</th>
                    <td>
                        @if ($data->regency()->exists())
                            <span>{{ implode(', ', $data->regency()->pluck('name')->toArray()) }}</span>
                        @else
                            <span>No regency data</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection