<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

	

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

				<button id="fetchWeatherData" type="button" class="btn btn-info">Fetch & Save weather data</button>

				<div id="location-box" class="hidden">
					<div id="lat"></div>
					<div id="lng"></div>
				</div>
            </div>
        </div>
    </div>

@section('custom_js')
	<script>
	
		function get(url) {
			const options = {
				method: 'GET',
			}
			return axios(url)
		}

		$(document).ready(function(){

		// jQuery methods go here...

			let latitude = $("#lat")
			let longitude = $("#lng")

			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else { 
					location.innerHTML = "Geolocation is not supported by this browser.";
				}
			}

			function showPosition(position) {

				latitude.text(position.coords.latitude)
				longitude.text(position.coords.longitude)

			}
			getLocation()

			$('#fetchWeatherData').on('click', () => {
				// alert('runs')
				let endpoint =`https://api.openweathermap.org/data/2.5/onecall?lat=${latitude.text()}&lon=${longitude.text()}&exclude=minutely&appid=2f8fa5d46f84da6f300bcab135b44fba`

				// get(endpoint).then( response => {

				// 	console.log('response', response)

				// }).catch(error => {
					
				// 	console.log('error', error);
				// })


				$.ajax({url: endpoint, success: (response) => {
					console.log('response', response)

					// Now we need to just save into DB

					$.ajax({
                        url: "{{ url('/weather-data/') }}",
                        dataType: 'json',
                        data: { 
                            _token: $('meta[name="csrf-token"]').attr('content'),
							data: JSON.stringify(response)
                        }, 
                        method: 'POST'
                    }).done( response => {
						// console.log('response: ' response)
						console.log('success');

                    }).fail( (error) => {
						console.log('error: ', error);
                    });

				}});
			})
			

		});
		// let 
		// var location = document.getElementById("location");
		
	</script>
@endsection
	
</x-app-layout>