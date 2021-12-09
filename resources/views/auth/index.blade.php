@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center ">
        <div class="col-xl-8 order-xl-1 mt-4">
            <div class="card">
              <div class="card-header">
                <form action="{{ route('petugas.update',$user->id) }}" method="post">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Edit profile </h3>
                    {{-- flash success  --}}
                    <div class="flash" data-flash="{{ session()->get('success') }}"></div>
                  </div>
                  <div class="col-4 text-right">
                    <button  class="btn btn-primary" type="submit" id="submit">Edit</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  @csrf
                  @method('put')
                  <h6 class="heading-small text-muted mb-4">Informasi Petugas</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Username</label>
                          <input type="text" id="input-username" class="form-control" value="{{ $user->name }}" name="name">
                          @error('name')
                               <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Email address</label>
                          <input type="email" id="input-email" class="form-control" name="email" value="{{ $user->email }}">
                          @error('email')
                               <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">Password</label>
                          <input type="password" id="password" class="form-control" name="password" placeholder="Password" onkeyup="check()">
                          @error('password')
                               <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name">Ulangi Password</label>
                          <input type="password" id="confirm_password" class="form-control" placeholder="Ulangi Password" onkeyup="check()">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="text-center" id="message"></div>
              </div>
            </div>
          </div>
    </div>
@endsection

@push('script')
    <script>

      function check(){
        let password = document.getElementById('password').value;
        let confirm_password = document.getElementById('confirm_password').value;
        let submit = document.getElementById('submit');
        let message = document.getElementById('message');

        // jika password sama dan tidak sama 
        if ( password == confirm_password ) {

            submit.disabled = false;
            // message.style.color= 'green';
            message.innerHTML= '<small class="text-success"> password matches </small>'
        }else {
            submit.disabled = true;
            // message.style.color= 'red';
            message.innerHTML= "<small class='text-danger'> password don't matches </small>"
        }

      }

$(document).ready(function(){

    //data berhasil diedit
    let success = $('.flash').data('flash');
    
    if (success) {
      Swal.fire({
        position: 'center',
        type: 'success',
        title: success,
        showConfirmButton: false,
        timer: 2000
      });
    }

})
    
    </script>
@endpush