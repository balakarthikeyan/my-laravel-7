@extends('pages.layout') 

@section('title', 'Highcharts Example')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="{{ URL::asset('scripts/theme.js') }}"></script>
@endpush

@section('content')
    <div id="chartcontainer"></div>
@endsection

@section('extra-script')
<script type="text/javascript">
    var users =  <?php echo json_encode($users) ?>;
    Highcharts.chart('chartcontainer', {
        title: {
            text: 'New User Growth, 2019'
        },
        subtitle: {
            text: 'Source: codechief.org'
        },
         xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Users',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
@endsection