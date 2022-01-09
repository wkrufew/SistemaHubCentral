@extends('layouts.app')





@section('content')

<section class="features3 cid-rPhEktC2uU" id="features3-8" style="padding-top: 200px; margin-button: 200px">
  
      <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(255, 255, 255);">
      </div>
  
        <div class="container">
          <div class="row">
            <div class="col-10">
              <label style="color: #941b94; font-size:25px; text-align:right;"><b>Este tema no existe, por favor busque otro</b></label>
            </div>
          </div>
        </div> 

</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif
