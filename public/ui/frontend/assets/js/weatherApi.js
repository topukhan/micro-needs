document.addEventListener('DOMContentLoaded', () => {
    let city = 'tongi';
    const apiKey = '130224f19d8e4567a66153053240302';
    let apiUrl = `https://api.weatherapi.com/v1/current.json?q=${city}&key=${apiKey}`;

    // city search form submission
    document.getElementById('weatherApiForm').addEventListener('submit', citySearch)

    function citySearch(event) {
        event.preventDefault()
        city = document.getElementById('cityNameInput').value
        apiUrl = `https://api.weatherapi.com/v1/current.json?q=${city}&key=${apiKey}`;

        console.log('searched city: ', city);

        // console.log(apiUrl);

        // call checkweather function with inputted city name
        checkWeather()
    }

    async function checkWeather() {
        const response = await fetch(apiUrl);

        if (response.status === 403) {
            console.error('API key is not authorized. Check your WeatherAPI key.');
            return;
        }
        let data = await response.json();
        console.log('response: ', response);
        console.log('data : ', data);

        if (response.status === 200) {
            document.getElementById('responseMessage').innerHTML = ''

            console.log('city name: ', data.location.name);

            document.getElementById('temperature').innerHTML = data.current.temp_c
            document.getElementById('cityName').innerHTML = data.location.name
            document.getElementById('humidity').innerHTML = data.current.humidity
            document.getElementById('windSpeed').innerHTML = data.current.wind_kph
            document.getElementById('localTime').innerHTML = data.current.last_updated
            document.getElementById('skyCondition').innerHTML = data.current.condition.text
            document.getElementById('weatherIcon').setAttribute('src', data.current.condition.icon)
        } else if (data.error.code == 1006) {
            console.log(data.error.message)
            document.getElementById('responseMessage').innerHTML = data.error.message
            setTimeout(() => {
                document.getElementById(
                    "responseMessage"
                ).innerHTML = "";
            }, 5000);

        } else {
            console.log('something went wrong')

        }

    }
    checkWeather();
})