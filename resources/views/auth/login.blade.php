@extends('layouts.app')

@section('content')
<div class="page">
    <div class="page-single">
      <div class="container">
        <div class="row">
          <div class="col col-login mx-auto">
            <div class="text-center ">
              <img src="{{ asset('assets/img_core/logo_bps.png') }}" class="h-8" alt="">
              
            </div>
            <div class="text-center mb-6 mt-3">
                <h4>SIBERAS - BPS KOTA SUBULUSSALAM</h4>
            </div>
            <form class="card" action="{{ route('login') }}" method="post">
              @csrf
              <div class="card-body p-6">
                <div class="card-title">Login</div>
                <div class="form-group">
                  <label class="form-label">Alamat Email</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label class="form-label">
                    Password
                   <!-- <a href="#" class="float-right small">Lupa Password?</a>-->
                  </label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
               <!-- <div class="form-group">
                  <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-label">Remember me</span>
                  </label>
                </div>-->
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
              </div>
            </form>
            <div class="text-center text-muted">
              Tidak Punya Akun? <a href="https://wa.me/6282261044800">Hubungi Admin</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
