<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Buscar</title>
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
    <style type="text/css">
        /*search box css start here*/
.search-sec{
    padding: 2rem;
}
.search-slt{
    display: block;
    width: 100%;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #55595c;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
.wrn-btn{
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    text-transform: capitalize;
    height: calc(3rem + 2px) !important;
    border-radius:0;
}
@media (min-width: 992px){
    .search-sec{
        position: relative;
        top: -114px;
        background: rgba(26, 70, 104, 0.51);
    }
}

@media (max-width: 992px){
    .search-sec{
        background: #1A4668;
    }
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

</div>
<section>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/lugar.jpg')}}" class="d-block w-100" alt="...">
            </div>
            
        </div>        
    </div>
</section>
<section class="search-sec">
    <div class="container">
        <form action="{{ route('destinos.search') }}" method="post">
            @csrf            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Lugar" name="lugar">
                        </div>
                        <div class="col-md-2 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Ingresa Ciudad" name="ciudad">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" name="categoria">
                                <option value="">Selecciona categoria</option>
                                <option value="centro comercial">Centro comercial</option>
                                <option value="parque">Parque</option>
                                <option value="monumentos">Monumentos</option>
                                <option value="playas">Playas</option>
                                <option value="montaña">Montaña</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" name="departamento">
                                <option value="">Selecciona departamento</option>
                                <option value="santa ana">Santa Ana</option>
                                <option value="Sonsonate">Sonsonate</option>
                                <option value="ahuchapan">Ahuchapan</option>
                                <option value="chalatenango">Chalatenango</option>
                                <option value="la libertad">La libertad</option>
                                <option value="san salvador">San salvador</option>
                                <option value="cuscatlan">Cuscatlán</option>
                                <option value="cabañas">Cabañas</option>
                                <option value="la paz">La paz</option>
                                <option value="san vicente">San vicente</option>
                                <option value="san miguel">San miguel</option>
                                <option value="usulutan">Usulutan</option>
                                <option value="morazan">Morazan</option>                               
                                <option value="la union">La union</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>


</section>

<div align="center">
        <div class="col-md-12 table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="btn-danger">id</th>
                <th class="btn-danger">Lugar</th>
                <th class="btn-danger">Ciudad</th>
                <th class="btn-danger">Departamento</th>
                <th class="btn-danger">Categoria</th>
                <th class="btn-danger">Telefono</th>
              </tr>
            </thead>
            <tbody>
              @forelse($destinos as $destino)
              <tr>
                <td>{{ $destino->id }}</td>
                <td>{{ $destino->lugar }}</td>
                <td>{{ $destino->ciudad }}</td>
                <td>{{ $destino->deprtamento }}</td>
                <td>{{ $destino->categoria }}</td>
                <td>{{ $destino->telefono }}</td>
              </tr>
              @empty
              <th colspan="6" class="text-center">No se encontraron coincidencias</th>
              @endforelse
            </tbody>
          </table>
        </div>

</div>


</body>
</html>
