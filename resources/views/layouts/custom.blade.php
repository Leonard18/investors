<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <!-- CSRF token section -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="#1 Trusted platform by serial investors">
  <!-- Styles section -->

  <!-- Materialize section -->
  <link rel="stylesheet" href="{{ asset('custom/materialize/css/materialize.css') }}">
  <link rel="stylesheet" href="{{ asset('custom/materialize/css/materialize.min.css') }}">

  <!-- Font awesome section -->
  <link rel="stylesheet" href="{{ asset('custom/fontawesome/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('custom/fontawesome/css/all.min.css') }}">

  <!-- Main CSS styles section -->
  <link rel="stylesheet" href="{{ asset('css/custom/main.css') }}">

  <!-- Laravel default Bootstrap stylesheet and script -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}"></script>


  <title>@yield('title')</title>

  @yield('styleAndScripts')

</head>
<body>



     <div class="contaner">


       <div class="navbar-fixed">

         <nav class="teal">
           <div class="nav-wrapper">
             <a href="#" class="brand-logo center">Investors</a>
              <a class="sidenav-trigger" data-target="slide-out" href="#"><i class="fa fa-bars fa-2x"></i></a>
              <!-- Main nav ul items -->
            <div class="container">
              <ul class="right">

                <li><a href="#"><i class="fas fa-user" style="font-size: 20px !important;"></i></a></li>
                <li><a href="#"><i class="fas fa-bell" style="font-size: 20px !important;"></i></a></li>
                <li class="hide-on-small-only"><a href="#"><i class="fas fa-comments" style="font-size: 20px !important;"></i></a></li>
              </ul>
            </div>
           </div>
         </nav>

       </div>

       <ul class="sidenav teal sidenav-fixed" id="slide-out">
         <li>
           <div class="user-view">
             <div class="background">
               <img src="{{ asset('img/22.jpg') }}">
             </div>
             <a class="user" href="#"><img class="circle" src="{{ asset('img/30.jpg') }}" /></a>
             <a class="white-text name" href="#">{{ auth()->user()->name }}</a>
             <a class="white-text email" href="#">{{ auth()->user()->email }}</a>
           </div>
         </li>
          <li class="{{ Route::is('/dashboard') ? 'active' : '' }}"><a class="white-text" href="{{ route('dashboard.index') }}"><i class="fas fa-user mr-3"></i> My Account</a></li>

          <li><a class="white-text deposits dropdown" data-target="deposits" href="#"><i class="fas fa-money-bill-alt mr-3"></i> Deposits <i class="fas fa-caret-down ml-3"></i></a></li>

          <!-- Deposits dropdown -->
          <ul class="dropdown-content deposits-content teal lighten-2" id="deposits">
            <li><a class="white-text" href="{{ route('dashboard.alldeposits') }}">All Deposits</a></li>
            <div class="divider"></div>
            <li><a class="white-text" href="{{ route('dashboard.newdeposits') }}">New Deposit</a></li>
            
          </ul>

          <li class="new-dropdown-parent"><a class="white-text dropdown transactions" id="transactions" href="#"><i class="fas fa-chart-bar mr-3"></i> Transactions <i class="fas fa-caret-down ml-3"></i></a>

          <!-- Transactions dropdown -->
          <ul class="dropdown-menu teal lighten-2 new-dropdown" id="transactions">
            <li><a class="white-text" href="{{ route('dashboard.alltrans') }}">All Transactions</a></li>
            <li><a class="white-text" href="#}">Due Transactions</a></li>
            <div class="diviver"></div>
            <li><a class="white-text" href="#">Running Investments</a></li>
            
          </ul>

          </li>


          <li><a class="white-text" href="#"><i class="fas fa-suitcase mr-3"></i> Commissions</a></li>

          <li><a class="white-text" href="#"><i class="fas fa-university mr-3"></i> Withdrawals</a></li>

          <li><a class="white-text" href="{{ route('dashboard.supports') }}"><i class="fas fa-question-circle mr-3"></i> Support Ticket</a></li>

          <li><a class="white-text" href="#"><i class="fas fa-box mr-3"></i> Returns</a></li>

          <li><a class="white-text" href="#"><i class="fas fa-cogs mr-3"></i> Settings</a></li>


          <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="white-text margin-top">Logout <i class="fa fa-sign-out-alt ml-3"></i>
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

       </ul>


       <!-- Main content begins here -->
       <main class="main-content mb-5">
          <!-- This is where all the content of the main page will go into and make sure not to ruin this section  -->

          @yield('pageContent')
       </main>


     </div>






    <!-- JQuery section -->
    <script src="{{ asset('js/custom/jquery.js') }}"></script>

    <!-- Main JS file -->
    <script src="{{ asset('js/custom/main.js') }}"></script>

    <!-- Chart JS file -->
    <script src="{{ asset('js/custom/Chart.min.js') }}"></script>

    <!-- Font Awesome file -->
    <script src="{{ asset('custom/fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('custom/fontawesome/js/all.min.js') }}"></script>

    <!-- Materialize files -->
    <script src="{{ asset('custom/materialize/js/materialize.min.js') }}"></script>
    <script src="{{ asset('custom/materialize/js/materialize.js') }}"></script>



    <div class="second-main-section">
        @yield('secondSection')
      </div>

</body>
</html>
