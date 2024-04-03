<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>  
<!-- contenido -->
<div class="container">
    <div class="row text-center mb-3">
        <div class="col-md-6">
            <img src="img/logos/logo1.jpg" alt="logo bitstore" style="width: 40%">
        </div>
    </div>
    <div class="row text-center mb-3">
        <div class="card-header bg-warning text-white mb-2">
            <h4>Detalle de pedido</h4>
            <h5>Cliente: {{ $productos->user->name ." ". $productos->user->lastName}}</h4>
            <h6>Orden: {{ $productos->id }}</h6>
        </div>
    </div>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
        </tr>
        <tbody>
            @foreach ($productos->products as $prod)  
               <tr>
                <td>{{ $prod->productName }}</td>
                <td>${{ $prod->salePrice }}</td>
                <td>{{ $prod->pivot->quantity }}</td>
                <td>${{ $prod->pivot->subTotal }}</td>  
               </tr>                      
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-left">
                    Firma.<img style="width: 200px" src="img/firmas/{{ $productos->user->id }}.png" alt="">
                </th>
                <th colspan="2" class="text-right">Total: ${{ $productos->total }}</th>
            </tr>
        </tfoot>
    </table>       
    <hr class="bg-dark">
   
</div> <!-- contenido -->

    
</body>
</html>