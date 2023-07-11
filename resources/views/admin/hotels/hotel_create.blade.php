@extends('admin.layout.app')

@section('heading', 'Create Hotel')

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
                    @if (session()->get('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    <form action="{{route('hotel_submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hotel_name">Hotel Name *</label>
                                    <input type="text" class="form-control" name="hotel_name" id="hotel_name">
                                    @error('hotel_name')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hotel_email">Hotel Email *</label>
                                    <input type="text" class="form-control " name="hotel_email" id="hotel_email">
                                    @error('hotel_email')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address *</label>
                                    <input type="text" class="form-control" name="address" id="address">
                                    @error('address')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code *</label>
                                    <input type="text" class="form-control" name="postal_code" id="postal_code">
                                    @error('postal_code')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country_id">Country *</label>
                                    <select class="form-control" name="country_id" id="country-dd">
                                        <option value="">Select Country</option>
                                        <!-- Add options dynamically from your database -->
                                        @foreach ($countries as $data)
                                            <option value="{{$data->id}}">
                                                {{$data->name}}
                                            </option>
                            @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state_id">State *</label>
                                    <select class="form-control" name="state_id" id="state-dd">
                                        <option value="">Select State</option>
                                    </select>
                                    @error('state_id')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city_id">City *</label>
                                    <select class="form-control" name="city_id" id="city-dd">
                                        <option value="">Select City</option>
                                    </select>
                                    @error('city_id')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_rooms">Total Room *</label>
                                    <input type="text" class="form-control" name="total_rooms" id="total_rooms">
                                    @error('total_rooms')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                    @error('logo')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room Types</label><br>
                                    @foreach ($roomtypes as $roomType)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="room_types[]" value="{{$roomType->id}}">
                                            <label class="form-check-label">{{$roomType->room_type}}</label>
                                        </div>
                                    @endforeach
                                    @error('room_types')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description"> Room Price</label>
                                   <input type="number" class="form-control" name="one_room_price">
                                  
                                   @error('one_room_price')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" id="facilities-container">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Facilities</label><br>
                                    <div class="facility-input-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control col-md-6" name="facilities[]" placeholder="Facility 1">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-add-facility">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('facilities')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="row" >
                              
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Add Photos</label><br>
                                    <input type="file" class="form-control" name="image[]" id="images" multiple="multiple" >
                                    @error('logo')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                   
                                </div>
                            </div>
                        </div>
                        <div class="user-image mb-3 text-center">
                            <div class="imgPreview"> </div>
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

    <script>
        $(document).ready(function () {
    $('#country-dd').on('change', function () {
        var idCountry = this.value;
       
        $("#state-dd").html('');
        $.ajax({
            url: "{{ route('fetch-states') }}", 
            type: "POST",
            data: {
                country_id: idCountry,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#state-dd').html('<option value="">Select State</option>');
                $.each(result.states, function (key, value) {
                    $("#state-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                $('#city-dd').html('<option value="">Select City</option>');
            }
        });
    });

    $('#state-dd').on('change', function () {
        var idState = this.value;
        
        $("#city-dd").html('');
        $.ajax({
            url: "{{ route('fetch-cities') }}", 
            type: "POST",
            data: {
                state_id: idState,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#city-dd').html('<option value="">Select City</option>');
                $.each(res.cities, function (key, value) {
                    $("#city-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

    </script>
    <script>
        // JavaScript to handle dynamic addition of facility input fields
        document.addEventListener('DOMContentLoaded', function() {
            var container = document.getElementById('facilities-container');
            var addButton = document.querySelector('.btn-add-facility');
    
            addButton.addEventListener('click', function() {
                var facilityInputGroup = document.createElement('div');
                facilityInputGroup.className = 'facility-input-group';
    
                var input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.name = 'facilities[]';
                input.placeholder = 'Facility ' + (container.children.length + 1);
    
                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'btn btn-primary btn-remove-facility';
                button.textContent = '-';
                button.addEventListener('click', function() {
                    facilityInputGroup.remove();
                });
    
                facilityInputGroup.appendChild(input);
                facilityInputGroup.appendChild(button);
    
                container.appendChild(facilityInputGroup);
            });
        });
    </script>
    
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });    
    </script>
@endsection
