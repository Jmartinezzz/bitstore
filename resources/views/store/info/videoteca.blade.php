@extends('store.partials.principal')
@section('title', 'Videoteca')
@section('activeMedia',"active")
@section('content')
	<div class="container mb-5">
    <h1 class="display-3 text-center my-4">Videoteca Informativa</h1>
    <div class="row">
       @forelse($videos as $video)
       <div class="col-md-4">
         <div class="card border-warning mb-3">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $video->product->productName }}</h5> 
            @foreach ($video->product->images as $img)
             <img src="{{ asset('img/productos/' . $img->img) }}" class="img-fluid" style="height: 150px">
             @break
            @endforeach           
          </div>
          <div class="card-footer bg-transparent text-center">
            <button  class="btn btn-outline-warning btn-sm btnVerVideo">Ver</button>
            <input class="urlh" type="hidden" value="{{  $video->video }}">          
          </div>
        </div>
       </div>
       @empty

       @endforelse
     </div>
   <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">                    
            <div class="embed-responsive embed-responsive-16by9">
              <iframe id="video" class="embed-responsive-item" src="" allowfullscreen></iframe>
            </div>
                  
        </div>
      </div>
    </div>
    <!-- Modal -->
  </div>
@endsection
@section('scriptsFooter')
<script>
  var url;
  $('.btnVerVideo').on('click', function(){
    url = $(this).siblings('.urlh').val();
    url2 = url.replace("watch?v=", "embed/");
    $('#video').attr('src', url2);
    $('#videoModal').modal('show');
    
  });

  $('#videoModal').on('hidden.bs.modal', function (e) {
    $('#video').removeAttr('src');    
  })
  
</script>

@endsection