<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-personalizado modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Articulo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.14.1/ckeditor.js"></script>
                            <form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
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
                                    <label class="col-md-4 form-control-label" for="text-input"><b>Activar</b></label>

                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="activo" value="1" @if((old('activo'))) checked @endif>
                                                    Si
                                            </label>
                                         </div>
                                     
                                        
                                    </div>


                                    <div class="col-md-4">
                                      
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="activo" value="0" @if(!(old('activo'))) checked @endif>
                                                    No
                                            </label>
                                        </div>
                                        
                                    </div>


                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Nombre del articulo</b></label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Tema</b></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="tema_id">
                                            @foreach($temasTodos as $tema)
                                                <option value="{{ $tema->id }}" @if(old('tema_id') == $tema->id) selected @endif>{{ $tema->nombre }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input"><b>Contenido</b></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5" name="contenido">{{ old('contenido') }}</textarea>
                                        <script>
                                            CKEDITOR.replace('contenido');
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Imagenes</b></label>
                                    <div class="col-md-9">
                                        @for($i=0;$i<3;$i++)
                                            <div class="col-md-1"><input type="file" name="foto{{ $i }}"></input></div>
                                            
                                        @endfor
                                        
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
          