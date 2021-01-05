@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fas fa-fw fa-car ne"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Cars</span>
            <span class="info-box-number" id="total_cars"></span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
@stop

@section('js')
<script>

        $(document).ready(function () {
            $.ajax({
                type: 'get',
                url: '{{ route('admin.get-dashboard-data') }}',
                success: function (response) {
                    console.log(response.data);
                    $('#total_cars').text(response.data.total_cars);
                },
                error: function (errors) {
                }
            });
        });

</script>
@stop
