@extends('layouts.app')

@section('content')

  <div class="wrapper fadeInDown" style="text-align: -webkit-center">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Sign In </h2>
      
  
      <!-- Icon -->
      
  
      <!-- Login Form -->
      <div class="wrapper">
        <form method="POST" action="{{ route('login') }}" style="display: inline-grid; width: 400px">
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
        <label for="username">{{ __('E-Mail Address') }}</label>
        <input type="text" id="login" class="fadeIn second" name="email" placeholder="login" style="width: auto">
       
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
        <br><label style="display: flex; gap: 5px; justify-content: center;">
            <input type="checkbox" style="width: fit-content; margin: 0px" value="remember-me" id="rememberMe" name="rememberMe" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}
          </label>
          <br><br><button class="fadeIn fourth" type="submit">{{ __('Login') }}</button>
      </form>
  
      <!-- Remind Passowrd -->
      <div id="formFooter">
        @if (Route::has('password.request'))
        <a class="underlineHover" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
      @endif
      </div>
  
    </div>
  </div>
</div>
@endsection
