@extends('store.partials.principal')
@section('title', '¿Quienes somos?')
@section('activeQs',"active")
@section('content')
<div class="container">      
    <h1 class="mt-4 mb-3">¿Quienes somos?,
       <small>te lo contamos.</small>
    </h1>
      <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-6 text-center">
          <img class="img-fluid rounded" src="{{ asset('img/locales/logo1.jpg') }}" alt="btstore" style="height: 85%; width: 65%">
        </div>
        <div class="col-lg-6">
          <h2>Sobre nuestra empresa.</h2>
          <p class="text-justify">Somos una plataforma ecommerce que busca lo comercialización de dispositivos electrónicos, en este caso placas arduino y tambinén sensores que ayudan al desarrollo de diferentes proyectos, con precios accesibles y distinción en la forma de compra mas envío del producto.</p>
          <p class="text-justify">Nuestro ideal es tener un catálogo en línea que sea fácil de utilizar y ver, detallar bien las especificaciones de nuestros productos para que la experiencia de nuetros usuarios sea sencilla y rápida, para poder tener un crecimeinto y empezar a consolidarnos.</p>
        </div>
    </div>
    <br><br><br>
      <!-- /.row -->
      <!-- Team Members -->
    <h2>Nuestro Equipo.</h2>

      <div class="row mt-4 mb-5">
        <div class="col-lg-4 mb-4">
          <div class="card text-center border-warning">
            <img class="card-img-top img-responsive"  src="img/perfiles/fercho.jpeg" alt="">
            <div class="card-body">
              <h4 class="card-title">Fabio Portillo</h4>
              <h6 class="card-subtitle mb-2 text-muted">Desarrollador y DBA.</h6>
              <p class="card-text">Estudiante de 5to año de la carrera de ingeniería en sistemas computacionales de la universidad envangélica de El salvador, con grandes capacidades y metas que lograr.</p>
            </div>
            <div class="card-footer">
              <a href="#">fabio.bts@bitstoresv.com</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card text-center border-warning">
            <img class="card-img-top img-responsive" src="img/perfiles/jorge.jpeg" alt="">
            <div class="card-body">
              <h4 class="card-title">Jorge Martínez.</h4>
              <h6 class="card-subtitle mb-2 text-muted">Desarrollador back y front end.</h6>
              <p class="card-text">Estudiante de 5to año de la carrera de ingeniería en sistemas computacionales de la universidad envangélica de El salvador, con ganas de aprender siempre y con grandes propositos.</p>
            </div>
            <div class="card-footer">
              <a href="#">jorge.bts@bitstoresv.com</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card text-center border-warning">
            <img class="card-img-top img-responsive" style="height: 36%;" src="img/perfiles/yil.jpeg" alt="">
            <div class="card-body">
              <h4 class="card-title">David Córdoba.</h4>
              <h6 class="card-subtitle mb-2 text-muted">Desarrollador y DBA</h6>
              <p class="card-text">Estudiante de 5to año de la carrera de ingeniería en sistemas computacionales de la universidad envangélica de El salvador, con fé en lograr las metas propuestas y firme en el aprendizaje.</p>
            </div>
            <div class="card-footer">
              <a href="#">cordoba.bts@bitstoresv.com</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Our Customers -->
      <!-- <h2>Our Customers</h2>
      <div class="row">
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
        <div class="col-lg-2 col-sm-4 mb-4">
          <img class="img-fluid" src="http://placehold.it/500x300" alt="">
        </div>
      </div> -->
      <!-- /.row -->

    </div>
@endsection