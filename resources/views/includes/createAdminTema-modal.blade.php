<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-personalizado" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Tema</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">                           	
                            <form method="POST" action="{{ route('tema.store') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                            @csrf    

                                   
                                    @if(session('notificacion2'))   
                                        <div style="background:#F96666; color:white;" class="alert alert-danger" role="alert">
                                        {{session('notificacion2')}}
                                        </div>
                                    @endif
                                   
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)

                                                    <li>{{ $error }}</li>

                                                @endforeach
                                            </ul>
                                        </div>    
                                    @endif
                                <div class="form-group row" style="margin-top: 15px; margin-bottom: 20px;">
                                    <label class="col-md-4 form-control-label" for="text-input"><b>Nombre del Tema</b></label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 15px;">
                                    <label class="col-md-4 form-control-label" for="text-input"><b>Destacado</b></label>

                                    <div class="col-md-4">
                                        <div class="radio">
                                        <label>
                                            <input type="radio" name="destacado" value="1" @if((old('destacado'))) checked @endif>
                                                Si
                                        </label>
                                         </div>
                                     
                                        
                                    </div>


                                    <div class="col-md-4">
                                      
                                        <div class="radio">
                                        <label>
                                            <input type="radio" name="destacado" value="0" @if(!(old('destacado'))) checked @endif>
                                                No
                                        </label>
                                        </div>
                                        
                                    </div>


                                </div>
                                <div class="form-group row" style="margin-top: 15px;">
                                    <label class="col-md-4 form-control-label" for="text-input"><b>Suscripción</b></label>

                                    <div class="col-md-4">
                                        <div class="radio">
                                        <label>
                                            <input type="radio" name="suscripcion" value="1" @if((old('suscripcion'))) checked @endif>
                                                Si
                                        </label>
                                         </div>
                                        
                                    </div>


                                    <div class="col-md-4">
                                      
                                        <div class="radio">
                                        <label>
                                            <input type="radio" name="suscripcion" value="0" @if(!(old('suscripcion'))) checked @endif>
                                                No
                                        </label>
                                        </div>
                                        
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