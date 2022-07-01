@extends('layouts.app')
@section('content')
<nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link active" >Home</router-link>
        </li>
        <li class="nav-item">
            <router-link to="/login" class="nav-link active" >Login</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/register" class="nav-link active" >Registrarse</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/about" class="nav-link active" >Acerca de</router-link>
          </li>
      </ul>
    </div>
  </nav>
        <router-view></router-view>
    </div>
    
@endsection