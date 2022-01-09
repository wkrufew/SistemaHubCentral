<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-personalizado modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Institución</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           	
                            <form method="POST" action="{{ route('universidades.store') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                            @csrf    
                                   
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)

                                                    <li>{{ $error }}</li>

                                                @endforeach
                                            </ul>
                                        </div>    
                                    @endif
                               
                                <div class="form-group row" style="margin-top: 15px;">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Dirección web</b></label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Ejm. https://www.espoch.edu.ec" name="url" value="{{ old('url') }}">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Imagenes</b></label>
                                    <div class="col-md-9">
                                            <div class="col-md-1"><input type="file" name="foto"></input></div>
                                    </div>
                                </div>
                                <div class="modal-footer ">
                                    <button style="border-radius: 40px" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button style="border-radius: 40px" type="submit" class="btn btn-perzonalizado">Añadir</button>                                   
                                </div>
                            </form>
                        </div>
                       
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>