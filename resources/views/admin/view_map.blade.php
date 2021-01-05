
@extends('adminlte::page')
@section('title', 'Webclues - View Map')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">View Map</h3>
          </div>
          <!-- /.box-header -->
          <div id="map" class="mapping"></div>   
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
<script type="text/javascript">
 var locations_arry = '<?php echo $cardata; ?>'; 
 var mark_url="{{asset('vendor/assets/images/mark.png')}}"; 
</script>
<script type="text/javascript" src="{{asset('js/multiple_map.js')}}"></script>
@stop