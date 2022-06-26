<x-app>
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
    </div>
</x-app>
