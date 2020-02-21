@extends('admin.index')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">      
        <div class="card-header">
          <h4 class="card-title">Proveedores</h4>            
          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#supplierModal">Nuevo</button>
          <!-- Modal -->
        <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @include('admin.suppliers.formSuppliers')                             
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
              </div>
            </div>
          </div>
        </div>  <!-- Modal -->
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table">           
                <thead class="text-primary">              
                  <tr>
                    <th>Compañia</th>
                    <th>Contacto</th>
                    <th>Cargo</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Creación</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($suppliers as $supp)
              <tr>
                <td>{{ $supp->companyName }}</td>
                <td>{{ $supp->contactName }}</td>
                <td>{{ $supp->title }}</td>
                <td>{{ $supp->email }}</td>
                <td>{{ $supp->phone }}</td>
                <td>{{ $supp->created_at->format('M-d-Y, h:i:s A') }}</td>
                <td></td>
              </tr>
            @endforeach
                </tbody>
              </table>
          </div>
        </div>
    </div>
  </div>    
</div>
@endsection
