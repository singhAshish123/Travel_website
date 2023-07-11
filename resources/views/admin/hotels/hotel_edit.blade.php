@extends('admin.layout.app')

@section('heading', 'Edit Hotel')

@section('button')
<div>
    <a href="{{route('hotel')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
</div>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{route('hotels.update',$hotel->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group">
                                <div>
                                    <label><strong>Existing Image</strong> </label>
                                </div>
                                @if($hotel->logo)
                                    <img src="{{ $imageUrl }}" alt="Existing Image" style="max-width: 200px;">
                                @else
                                    <span>No existing image</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hotel Name *</label>
                                    <input type="text" class="form-control" name="hotel_name" value="{{ $hotel->hotel_name }}">
                                    @error('hotel_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hotel Email *</label>
                                    <input type="text" class="form-control" name="hotel_email" value="{{ $hotel->hotel_email }}">
                                    @error('hotel_email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address *</label>
                                    <input type="text" class="form-control" name="address" value="{{ $hotel->address }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postal Code *</label>
                                    <input type="text" class="form-control" name="postal_code" value="{{ $hotel->postal_code }}">
                                    @error('postal_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <select class="form-control" name="country_id">
                                        <option>Select Country</option>
                                        <!-- Add options dynamically from your database -->
                                        @foreach ($countries as $country)
                                        <option value="{{ $hotel->country_id }}" {{ $country->name == $hotel->country_id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State *</label>
                                    <select class="form-control" name="state_id">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $hotel->state_id }}" {{ $state->name == $hotel->state_id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                    @error('state_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City *</label>
                                    <select class="form-control" name="city_id">
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $hotel->city_id }}" {{ $city->name == $hotel->city_id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                    
                                    </select>
                                    @error('city_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Room *</label>
                                    <input type="number" class="form-control" name="total_rooms" value="{{$hotel->total_rooms}}">
                                    @error('total_rooms')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" >{{$hotel->description}}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control-file" name="logo">
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection