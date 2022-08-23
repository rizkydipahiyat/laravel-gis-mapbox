<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Map Box
                </div>
                <div class="card-body">
                    <div wire:ignore id='map' style='width: 100%; height: 70vh;'></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Form
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Longtitude</label>
                                <input wire:model="long" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input wire:model="lat" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [106.74238268224798, -6.172900872411461]
            mapboxgl.accessToken = '{{env("MAPBOX_KEY")}}';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                center: defaultLocation, // starting position [lng, lat]
                zoom: 11.15, // starting zoom
                projection: 'globe' // display the map as a 3D globe
            });

            // map.on('style.load', () => {
            //     map.setFog({}); // Set the default atmosphere style
            // });
            
            // light-v10, outdoors-v11, satellite-v, streets-v11, dark-v10
            const style = "dark-v10"
            map.setStyle(`mapbox://styles/mapbox/${style}`)

            map.addControl(new mapboxgl.NavigationControl())

            map.on('click', (e) => {
                const longtitude = e.lngLat.lng
                const latitude = e.lngLat.lat
                
                @this.long = longtitude
                @this.lat = latitude
            })
        })
    </script>
@endpush