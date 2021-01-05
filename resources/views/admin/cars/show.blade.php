@extends('adminlte::page')
@section('title', 'Webclues - Car View')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Car Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="box-body">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ucfirst($car->name)}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Color<span class="required"> * </span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{config('cars.color_value')[$car->color]}}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="make_date" class="col-sm-2 control-label">Make Date<span class="required"> * </span></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{date('d-m-Y',strtotime($car->make_date))}}" disabled>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Fuel Type<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{config('cars.fuel_value')[$car->fuel_type]}}" disabled>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="profileImage" class="col-sm-2 control-label">Car Icon</label>
                        <div class="col-sm-8">
                            <img id="iconImage" src="{{isset($car)?Storage::disk('public')->url('icons/'.$car->icon):Storage::disk('public')->url('icons/car.png')}}" style="width: 100px;height: 100px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Description<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" cols="4" name="description" placeholder="Description" disabled>{{ $car->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ $car->location}}" disabled>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profileImage" class="col-sm-2 control-label">Car Images<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            @if(!$car->images->isEmpty())
                            @foreach($car->images as $v)
                            <img id="iconImage" src="{{Storage::disk('public')->url('images/'.$v->image)}}" style="width: 100px;height: 100px;">
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Status<span class="required"> * </span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{{ ($car->is_active==1)?'Active':'Inactive'}}" disabled>

                        </div>

                    </div>



                </div>
                <div id="map" class="mapping"></div>
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaGutB-33lg0jkFrBPKeQnusQSv2I2hyA&sensor=false&libraries=places"></script>
<script>
var mark_url = "{{asset('vendor/assets/images/mark.png')}}";
var car_name = '{{$car->name}}';
var loc = '{{$car->location}}';    
var lat='{{$car->lat}}';
var lng='{{$car->lng}}';
</script>
<script type="text/javascript" src="{{asset('js/single_map.js')}}"></script>
@stop