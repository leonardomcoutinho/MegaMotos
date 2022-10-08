@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login flex-column">
        <div class="img-login mb-3">
            <img src="/img/logo.png" alt="Mega Motos" class="img-fluid">
        </div>          
        <div class="card-login">
            <form method="POST" action="{{ route('login') }}" class="m-3">
                @csrf                
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>                    
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class=" mb-3">
                    <label for="password" class="form-label">Senha:</label>                    
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
