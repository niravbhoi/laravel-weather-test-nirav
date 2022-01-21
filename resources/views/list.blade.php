<!DOCTYPE html>
<html>
<head>
    <title>Weather List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>

<div class="container">
    <h1>Weather List</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="city">City :</label>
                        <select id='city' class="form-control">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- width="100%" --}}
                <div class="col-md-12">
                    <table class="table table-bordered table-responsive" id="weatherTable" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>City</th>
                                <th>Sunrise</th>
                                <th>Sunset</th>
                                <th>Temprature</th>
                                <th>Feels Like</th>
                                <th>Pressure</th>
                                <th>Humidity</th>
                                <th>UVI</th>
                                <th>Clouds</th>
                                <th>Visibility</th>
                                <th>Wind speed</th>
                                <th>Wind degree</th>
                                <th>Wind gust</th>
                                <th>Weather</th>
                                <th>Weather Description</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>

</body>

<script type="text/javascript">
  $(function () {

    var table = $('#weatherTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth : false,
        ajax: {
          url: "{{ route('weatherlist') }}",
          data: function (d) {
                d.city = $('#city').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'city_name', name: 'city_name'},
            {data: 'sunrise', name: 'sunrise'},
            {data: 'sunset', name: 'sunset'},
            {data: 'temp', name: 'temp'},
            {data: 'feels_like', name: 'feels_like'},
            {data: 'pressure', name: 'pressure'},
            {data: 'humidity', name: 'humidity'},
            {data: 'uvi', name: 'uvi'},
            {data: 'clouds', name: 'clouds'},
            {data: 'visibility', name: 'visibility'},
            {data: 'wind_speed', name: 'wind_speed'},
            {data: 'wind_deg', name: 'wind_deg'},
            {data: 'wind_gust', name: 'wind_gust'},
            {data: 'weather_title', name: 'weather_title'},
            {data: 'weather_description', name: 'weather_description'},
        ]
    });

    $('#city').change(function(){
        table.draw();
    });

  });
</script>
</html>
