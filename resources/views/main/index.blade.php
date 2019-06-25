@extends('components.layout')

@section('style')
@endsection

@section('body')

<div class="row" style="margin-top: 40px">
    <div class="col-md-10 offset-md-1">
        <form class="form-inline">
            <div class="form-group">
                <label for="city">Select City</label> &nbsp;
                <select class="form-control" id="city" name="city">
                    <option value="Tokyo">Tokyo</option>
                    <option value="Yokohama">Yokohama</option>
                    <option value="Kyoto">Kyoto</option>
                    <option value="Osaka">Osaka</option>
                    <option value="Sapporo">Sapporo</option>
                    <option value="Nagoya">Nagoya</option>
                </select>
            </div>
        </form>

        <div class="card weatherbg" style="margin-top: 20px">
            <img class="card-img-top" src="{{ asset('images/banner.jpg') }}" height="250px" alt="Card image cap">
            <div class="card-body">
                <div class="col-md-12" style="margin-top: 20px">
                    <div id="fiveDayWeather" class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function(){

    var defaultCity = "Tokyo";

    getCityForecast(defaultCity);

    $('select').on('change', function() {
        $('#fiveDayWeather').empty();
        getCityForecast(this.value);
    });

    function getCityForecast(_city) {

        $.ajax({
            url: "{{ url('weatherForecast') }}" + '/' + _city,
            type: 'GET',
            cache: false,
            success: function(response){
                // $("#preloader").hide();

                console.log(response);
                var weatherList = response.data.list;

                for(var i= 0; i < weatherList.length; i+=8) {
                    // console.log(weatherList[i].weather[0]);

                    var data = weatherList[i].weather[0];
                    var currentWeather = data.main;
                    var tempKelvin = weatherList[i].main.temp;
                    console.log(tempKelvin);
                    var tempCelcius = tempKelvin - 273.15;
                    var description = data.description;
                    var dateTime = weatherList[i].dt_txt;

                    var date = weatherList[i].dt_txt.toLocaleString().replace(/\s\d{2}:\d{2}:\d{2,4}$/, '');
                    var dt = new Date(dateTime);
                    var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                    var iconCode = data.icon

                    var iconUrl = "http://openweathermap.org/img/w/" + iconCode + ".png";

                    $("#fiveDayWeather").append('<div class="card">' +
                    '<div class="card-header weatherDate text-center">' +
                    date + '<br/>' + days[dt.getDay()].toUpperCase() +
                    '</div>' +
                    '<img class="card-img-top mx-auto d-block" id="weatherIcon" src="' + iconUrl + '" alt="weatherIcon">' +
                    '<div class="card-body">' +
                    '<p class="card-text text-center"><span id="temp">' + tempCelcius.toFixed(2) + '&#8451;</span>' +
                    '<br/><span id="description">' + description +'</span></p>' +
                    '</div>' +
                    '</div>');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
});
</script>
@endsection
