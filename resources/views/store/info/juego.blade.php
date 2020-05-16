<!DOCTYPE html>
<html lang="en" style="background-color: #1D1C1C" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Bitstore - juego</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logos/ico2.png') }}" />
  <link rel="stylesheet" href="{{ asset('store/css/plantilla.css') }}">
  <link rel="stylesheet" href="{{ asset('store/css/style-tiles.css') }}">  

</head>
<body style="background-color: #1D1C1C">
<!-- partial:index.partial.html -->
<div class="container">
   <div class="row justify-content-center mb-3">
       <div class="col-md-6">
           <a href="{{ route("store.index") }}">
              <img class="img-fluid" src="{{ asset('img/logos/logo4.png') }}" alt="">
           </a>
           <figcaption class="figure-caption text-center">A jugar...</figcaption>
       </div>
   </div>
  <div class="heading">
    <h1 class="title">2048</h1>
    <div class="score-container">0</div>
  </div>
  <p class="game-intro">Une números y llega a la <strong>ficha 2048</strong></p>

  <div class="game-container">
    <div class="game-message">
      <p></p>
      <div class="lower">
        <a class="retry-button">Intentar de nuevo</a>
      </div>
    </div>

    <div class="grid-container">
      <div class="grid-row">
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
      </div>
      <div class="grid-row">
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
      </div>
      <div class="grid-row">
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
      </div>
      <div class="grid-row">
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
        <div class="grid-cell"></div>
      </div>
    </div>

    <div class="tile-container">

    </div>
  </div>

  <p class="game-explanation">
    <strong class="important">Como jugar:</strong> usa las <strong>flechas del teclado</strong> para mover las fichas, Cuando dos fichas con el mismo número se tocan, <strong>¡Se suman entre si!</strong>
  </p>
  <hr>  
  <div class="row justify-content-center">
    <div class="col-7">
      <a href="{{ route('store.index') }}"  class="btn btn-warning " style="text-decoration-line: none;"><i class="fas fa-store fa-lg"></i> Regresar a la tienda</a>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/hammer.js/1.0.6/hammer.min.js'></script>  
  <script  src="{{ asset('store/js/script-tiles.js') }}"></script>

</body>
</html>
