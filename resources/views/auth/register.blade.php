@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login flex-column">                 
        <div class="card-login">
            <div class="img-login my-3 d-flex justify-content-center">
                <img src="/img/logo.png" alt="Mega Motos" class="img-fluid" width="200px">
            </div>
            <form method="POST" action="{{ route('register') }}" class="m-3">
                @csrf                
                <div class="mb-3">
                    <input id="name" type="text" class="ttr @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror        
                </div>
                <div class="mb-3">
                     <input id="email" type="email" class="ttr @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input id="password" type="password" class="ttr @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <div class="mb-3">
                    <input id="password-confirm" type="password" class="ttr" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">        
                </div>    
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn">
                         Cadastrar
                    </button>
                </div>
            </form>
        </div>            
    </div> 
                
</div>
@endsection