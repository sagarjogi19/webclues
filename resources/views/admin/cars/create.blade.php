@extends('adminlte::page')
@section('title', 'Webclues - Car Add')

@section('content')
@if(isset($car->make_date))
@php
$day=date('d',strtotime($car->make_date));
$month=date('m',strtotime($car->make_date));
$year=date('Y',strtotime($car->make_date));
@endphp
@endif
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{isset($car)?'Edit':'Add'}} Car</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" name="frmCar" id="frmCar" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <input type="hidden" id="car_id" name="car_id" value="{{ isset($car)?be64($car->id):'' }}">
                   
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($car)?ucfirst($car->name):old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Color<span class="required"> * </span></label>
                        <div class="col-sm-4">
                            <select class="form-control" name="color" id="color">
                                <option value="">Select Color</option>
                                @foreach(config('cars.color') as $k=>$v)
                                <option value="{{$v}}" {{isset($car)?($car->color==$v)?'selected':'':''}}>{{$k}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="make_date" class="col-sm-2 control-label">Make Date<span class="required"> * </span></label>
                        <div class="col-sm-2">
                            <select class="form-control" name="day" id="day">
                                <option value="">Select Day</option>
                                @for($i=1; $i<=31; $i++)
                                <option value="{{$i}}" {{isset($car)?($day==$i)?'selected':'':''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="month" id="month">
                                <option value="">Select Month</option>
                                @for($i=1; $i<=12; $i++)
                                <option value="{{$i}}" {{isset($car)?($month==$i)?'selected':'':''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="year" id="year">
                                <option value="">Select Year</option>
                                @for($i=1991; $i<=2021; $i++)
                                <option value="{{$i}}" {{isset($car)?($year==$i)?'selected':'':''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Fuel Type<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            @foreach(config('cars.fuel_type') as $k=>$v)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="fuel_type" id="fuel_type_{{$v}}" value="{{$v}}" {{isset($car)?($car->fuel_type==$v)?'checked':'':''}}>
                                    {{$k}}
                                </label>
                            </div>
                            @endforeach
                             <label for="fuel_type" class="error" style="display:none;">Please select fuel type</label>
                        </div>
                       
                    </div>


                    <div class="form-group">
                        <label for="profileImage" class="col-sm-2 control-label">Car Icon</label>
                        <div class="col-sm-8">
                            <input type="file" id="icon" name="icon" class="form-control-file" accept="image/*">
                            <img id="iconImage" src="{{isset($car)?Storage::disk('public')->url('icons/'.$car->icon):Storage::disk('public')->url('icons/car.png')}}" style="width: 100px;height: 100px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" cols="4" name="description" placeholder="Description">{{ isset($car)?$car->description:old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ isset($car)?$car->location:old('location') }}">
                            <input type="hidden" class="form-control" id="lat" name="lat" value="{{ isset($car)?$car->lat:old('lat') }}">
                            <input type="hidden" class="form-control" id="lng" name="lng" value="{{ isset($car)?$car->lng:old('lng') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profileImage" class="col-sm-2 control-label">Car Images<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <input type="file" id="images" name="images[]" class="form-control-file" accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Status<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="is_active" id="status_1" value="1" {{isset($car)?($car->is_active==1)?'checked':'':''}}>Active
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="is_active" id="status_0" value="0" {{isset($car)?($car->is_active==0)?'checked':'':''}}>InActive
                                </label>
                            </div>
                            <label for="is_active" class="error" style="display:none;">Please select status</label>
                        </div>
                        
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary submit">Submit</button>
                    <a href="{{route('admin.cars.index')}}" class="btn btn-info">Back</a>
                </div>
            </form>
        </div>

        <!-- /.box-body -->

        <!-- /.box-footer -->

    </div>
    <!-- /.box -->
    <!-- general form elements disabled -->

    <!-- /.box -->
</div>

@endsection
@section('css')

@stop
@section('js')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaGutB-33lg0jkFrBPKeQnusQSv2I2hyA&sensor=false&libraries=places"></script>
<script>
    /* For select location using google map API */
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            $('#lat').val(latitude);
            $('#lng').val(longitude);
        });
    });
    var imgArr=[];
    $("#images").change(function(e){
            var files = e.target.files;
            $.each(files, function (k, v) {
                imgArr.push(files[k]);
            });
    });
$("#icon").change(function () {
        readImageData(this);//Call image read and render function
    });
    function readImageData(imgData) {
        if (imgData.files && imgData.files[0]) {
            var readerObj = new FileReader();

            readerObj.onload = function (element) {
                $('#iconImage').attr('src', element.target.result);
            }

            readerObj.readAsDataURL(imgData.files[0]);
        }
    }
 $("#frmCar").validate({
  rules: {
    name: "required",
    color: "required",
    day: "required",
    month: "required",
    year: "required",
    fuel_type: "required",
    description: "required",
    is_active: "required",
    images: "required",
  },
  messages: {
    name: "Please enter name",
    color: "Please select color",
    day: "Please select day",
    month: "Please select month",
    year: "Please select year",
    fuel_type: "Please select fuel type",
    description: "Please enter description",
    is_active: "Please select status",
    images: "Please select car images",
  },
  submitHandler: function(form) {
       var formData = new FormData($('#frmCar')[0]);
       for (var index = 0; index < imgArr.length; index++) {
            formData.append("files[]", imgArr[index]);
       }
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({
        url: '{{ route('admin.cars.store') }}',
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        success: function( response ) {
        }
      });
      location.href ="{{url('admin/cars')}}";
  }
});
</script>
@stop