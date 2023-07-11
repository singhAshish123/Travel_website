@extends('admin.layout.app')

@section('heading', 'Manage User')


@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    
@endpush

