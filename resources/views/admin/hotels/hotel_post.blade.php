@extends('admin.layout.app')

@section('heading', 'Hotel Posts')

@section('button')
<div>
    <a href="{{route('post_submit')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
</div>
@endsection

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
