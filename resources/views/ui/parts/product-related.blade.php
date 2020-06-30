<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-left ftco-animate fadeInUp ftco-animated">
        <h2 class="mb-4">Productos Relacionados</h2>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <!-- each product -->
      @foreach ($related as $key => $p)
        <?php $imagen = asset('uploads/'.$p->img); if (is_null($p->img)) { $imagen = "https://colorlib.com/preview/theme/vegefoods/images/product-1.jpg";} ?>
        <div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">
          <div class="product">
            <a href="{{url('/producto/'.str_replace(' ', '-', $p->ProductosNombre).'/'.($p->ProductosID+3301))}}" class="img-prod"><img class="img-fluid cover" src="{{$imagen}}" alt="Colorlib Template">
              <!-- <span class="status">30%</span> -->
              <div class="overlay"></div>
            </a>
            <div class="text pt-3 px-3 text-left">
              <h3><a href="#">{{$p->ProductosNombre}}</a></h3>
              <p>{{$p->CategoriaNombre}}</p>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span class="price-sale">${{$p->PrecioUnitario}}</span></p>
                </div>
              </div>
              <hr>
              <div class="row py-2  px-2 block-add">
                <a class="btn btn-link btn-block text-left text-dark" href="#"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
