<x-base title="Login" active="">
    <x-slot name="title">Login</x-slot>
    <div class="container">
        <div class="row">
            <div class="col s12 mt-5">
                <div class="card">
                    <div class="card-content">
                        <div class="center">
                            <img src="{{asset('img/logo.png')}}" width="10%" alt="">
                        </div>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">person_outline</i>
                                        <input type="email" id="email" required name="email" class="@error('email') invalid @enderror" value="{{old('email')}}">
                                        <label for="email">Email</label>
                                        @error('email')
                                            <blockquote class="ml-5">
                                                {{$message}}
                                            </blockquote>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">lock_outline</i>
                                        <input type="password" id="password" required name="password" class="@error('password') invalid @enderror" value="{{old('password')}}">
                                        <label for="password">Password</label>
                                        @error('password')
                                            <blockquote class="ml-5">
                                                {{$message}}
                                            </blockquote>
                                        @enderror
                                    </div>
                                    <div class="col s12">
                                        <button type="submit" class="btn waves-effect white waves-effect black-text">
                                            Login <i class="material-icons right">keyboard_tab</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
</x-base>
