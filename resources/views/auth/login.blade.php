@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login flex-column">
        <div class="img-login mb-3">
            
        </div>          
        <div class="card-login">
            <div class="img-login my-3 d-flex justify-content-center">
                <img src="/img/logo.png" alt="Mega Motos" class="img-fluid" width="200px">
            </div>  
            <form method="POST" action="{{ route('login') }}" class="m-3">
                @csrf                
                <div class="mb-3">                                        
                    <input id="email" type="email" class="tt @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Insira seu e-mail">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class=" mb-3">                                        
                    <input id="password" type="password" class="tt @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Insira sua senha">
                    @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror                    
                </div>             
                 <div class="d-flex justify-content-between">
                    <button type="submit" class="btn">Login</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                    @endif
                </div>
            </form>
        </div>            
    </div>    
</div>
@endsection
