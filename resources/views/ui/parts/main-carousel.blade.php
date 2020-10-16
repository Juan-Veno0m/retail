<section>
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner vh-100">
            <div class="carousel-item active">
                <div class="overlay">
                    <img src="{{asset('/carousel/home-clean.webp')}}" class="d-block w-100 vh-100" alt="description">
                    <div class="carousel-caption d-md-block">
                      <h1 class="text-center">
                        <div class="carousel-title">Yolkan</div>
                        <div class="carousel-subtitle">Tienda orgánica en línea</div>
                      </h1><p><a href="{{url('/registro')}}" class="btn btn-warning" title="registro"><b>¡Únete a nosotros!</b></a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay">
                    <img data-src="{{asset('/carousel/home-barries.webp')}}" class="d-block w-100 vh-100 lazyload" alt="description">
                    <div class="carousel-caption d-md-block">
                      <h2 class="text-center">
                        <div class="carousel-title">Productos naturales</div>
                        <div class="carousel-subtitle">Tienda organica.</div>
                      </h2><p><a href="{{url('/tienda')}}" class="btn btn-warning" title="tienda"><b>¡Comprar ahora!</b></a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev" title="imagen anterior">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next" title="imagen siguiente">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
