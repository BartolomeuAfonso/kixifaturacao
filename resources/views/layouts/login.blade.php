@extends('layouts.logininicial')
<main>
    <div class="container">
       
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <div class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                                <span class="d-none d-lg-block">Kixi Faturação</span>
                            </div>
                        </div>
                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                </div>
                                @if ($errors->all())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                @if (session('error'))
                                    <div style="height:40px;background:#ffb459"
                                        class="alert icon-custom-alert  alert-outline-warning b-round fade show"
                                        role="alert">
                                        <div style="color:#000" class="alert-text">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif

                                <form method="post" class="row g-3 needs-validation"  action='{{ url("entrar") }}'>
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="yourUsername"
                                                >
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            >
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Entrar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>
