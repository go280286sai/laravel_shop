<div class="container-fluid my-carousel">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
         data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            @foreach($sliders as $slider)
                @if($slider->id == 1)
                    <div class="carousel-item active">
                                <img src=" {{\Illuminate\Support\Facades\Storage::url($slider->img)}}"
                                     class="d-block w-100" alt="...">
                            </div>
                        @else
                            <div class="carousel-item">
                                <img src=" {{\Illuminate\Support\Facades\Storage::url($slider->img)}}"
                                     class="d-block w-100" alt="...">
                    </div>
                @endif
                    @endforeach
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('messages.previous')}}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('messages.next')}}</span>
                    </button>
        </div>
    </div>

