<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weather Forecast') }}
        </h2>
    </x-slot>

	

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

				<button type="button" class="btn btn-info">Fetch & Save weather data</button>

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
			return axios(url, options)
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

		});
		// let 
		// var location = document.getElementById("location");
		
	</script>
@endsection
	
</x-app-layout>