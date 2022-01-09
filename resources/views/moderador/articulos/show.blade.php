
<div class="modal fade" id="modal2Eliminar{{$articulo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-personalizado modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detalles del Artículo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="GET" action="{{ route('moderador.articulos.show',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
                        @csrf
                        <div class="modal-body">
                            <div style="text-align:center; margin-top:40px; margin-bottom:40px;">

                            <div style="margin-top:20px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                                <b>{{ $articulo->titulo }}</b>
                            </div>

                            <div class="row ">

                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-4"></div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    @foreach($articulo->imagenes as $imagen)
                                        <img width="230px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                    @endforeach
                                </div>
                            </div>
                            <div style=" margin-top: 20px" class="row">
                                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    {!! $articulo->contenido !!}
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button style="border-radius: 40px"  type="button" class="btn btn-perzonalizado" data-dismiss="modal">Salir</button>
                          
                        </div>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>



