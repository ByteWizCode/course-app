@extends('layout.auth.app',[
'title' => 'Register'
])
@section('content')
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg mx-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                @include('layout.component.alert-dismissible')
                            </div>
                            <form class="user" method="POST" action="{{ route('login.register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required type="" name="name" class="form-control"
                                        id="name"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input required name="email" type="email" class="form-control"
                                        id="email" aria-describedby="emailHelp"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="pw">Password</label>
                                    <input required name="password" type="password" class="form-control"
                                        id="pw" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="zzgender">Gender</label>
                                    <select required name="gender" id="zzgender" class="form-control">
                                        <option disabled="">- PILIH GENDER -</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                 </div>
                                <button class="btn btn-primary btn btn-block">
                                    Register
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@stop