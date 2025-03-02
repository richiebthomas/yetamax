<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>YETAMAX 2029</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/main.css" />
    <style>
      /* Enhanced Navbar Styles */
      .header-bar {
        background-color: #1a1a2e;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        height: 70px; /* Fixed height for consistency */
      }
      
      .navbar {
        height: 70px; /* Match header-bar height */
      }
      
      .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff !important;
        text-decoration: none;
        transition: color 0.3s ease;
      }
      
      .navbar-brand:hover {
        color: #4cc9f0 !important;
      }
      
      .nav-btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-left: 0.5rem;
        height: 40px; /* Fixed height for buttons */
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
      
      .btn-profile {
        background-color: #4361ee;
        border-color: #4361ee;
        color: white;
      }
      
      .btn-profile:hover {
        background-color: #3a56d4;
        border-color: #3a56d4;
        transform: translateY(-2px);
      }
      
      .btn-create:hover {
        background-color: #3db8df;
        border-color: #3db8df;
        transform: translateY(-2px);
      }
      
      .btn-signout {
        background-color: #f72585;
        border-color: #f72585;
        color: white;
      }
      
      .btn-signout:hover {
        background-color: #e61a76;
        border-color: #e61a76;
        transform: translateY(-2px);
      }
      
      .login-form input {
        border-radius: 4px;
        padding: 0.5rem;
        border: 1px solid #3a3a5c;
        background-color: #252542;
        color: white;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        height: 40px; /* Fixed height for inputs */
      }
      
      .login-form input::placeholder {
        color: #a0a0a0;
      }
      
      .btn-signin {
        background-color: #4cc9f0;
        border-color: #4cc9f0;
        color: #1a1a2e;
      }
      
      .btn-signin:hover {
        background-color: #3db8df;
        border-color: #3db8df;
      }

      /* Responsive navbar styles */
      .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.3);
        margin-left: 0.5rem;
        height: 40px; /* Fixed height for toggler */
      }

      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      }

      /* Always visible items */
      .always-visible {
        display: flex !important;
        align-items: center;
        height: 100%; /* Full height of navbar */
      }

      /* Login form container - ensure it's always visible */
      .login-container {
        display: flex !important;
        align-items: center;
        height: 100%;
      }

      @media (max-width: 767.98px) {
        .navbar {
          flex-wrap: wrap;
          height: auto;
          min-height: 70px;
          padding-top: 0.5rem;
          padding-bottom: 0.5rem;
        }
        
        .header-bar {
          height: auto;
          min-height: 70px;
        }
        
        .navbar-brand {
          margin-right: auto;
        }
        
        .always-visible {
          order: 2;
          margin-top: 0.5rem;
          margin-bottom: 0.5rem;
          width: 100%;
          justify-content: center;
        }
        
        .login-container {
          order: 3;
          width: 100%;
          margin-top: 0.5rem;
          justify-content: center;
        }
        
        .login-form {
          display: flex;
          flex-direction: column;
          align-items: center;
          width: 100%;
        }
        
        .login-form input, 
        .login-form button {
          margin-bottom: 0.5rem;
          width: 100%;
          max-width: 300px;
        }

        .navbar-collapse {
          order: 4;
          margin-top: 0.5rem;
          padding-top: 0.5rem;
          border-top: 1px solid rgba(255, 255, 255, 0.1);
          width: 100%;
        }
        
        .navbar-nav {
          width: 100%;
          display: flex;
          flex-direction: column;
          align-items: center;
        }
        
        .navbar-toggler {
          order: 1;
          margin-left: auto;
        }
      }
    </style>
  </head>
  <body>
    <header class="header-bar mb-3">
      <div class="container h-100">
        <nav class="navbar navbar-expand-md p-0 h-100">
          <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="navbar-brand">YETAMAX 2029</a></h4>
          
          <!-- Always visible items -->
          <div class="always-visible mr-2">
            <a href="/allevents" class="btn nav-btn">
              <i class="fas fa-calendar-alt mr-2"></i>
              <span>All Events</span>
            </a>
            
            @auth
            <a href="/profile/{{auth()->user()->roll_no}}" class="btn nav-btn btn-profile">
              <i class="fas fa-user mr-1"></i> Profile
            </a>
            @endauth
          </div>
          
          @auth
          <!-- Toggler for authenticated users -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!-- Collapsible content for authenticated users -->
          <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav ml-auto">
              @if(auth()->user()->isAdmin())
              <a href="/admin/dashboard" class="btn nav-btn mb-2 mb-md-0">
                <i class="fas fa-user-shield mr-1"></i> Admin
              </a>
              @endif
              
              @if(auth()->user()->isEventAdmin1())
              <a href="/event-admin/dashboard" class="btn nav-btn mb-2 mb-md-0">
                <i class="fas fa-user-cog mr-1"></i> Event Admin
              </a>
              @endif
              
              <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button class="btn nav-btn btn-signout mb-2 mb-md-0">
                  <i class="fas fa-sign-out-alt mr-1"></i> Sign Out
                </button>
              </form>
            </div>
          </div>
          @else
          <!-- Login form for non-authenticated users (always visible) -->
          <div class="login-container ml-auto">
            <form action="/login" method="POST" class="login-form">
              @csrf
              <input name="loginroll_no" type="text" placeholder="Roll No" autocomplete="off" />
              <input name="loginpassword" type="password" placeholder="Password" />
              <button class="btn btn-signin nav-btn">
                <i class="fas fa-sign-in-alt mr-1"></i> Sign In
              </button>
            </form>
          </div>
          @endauth
        </nav>
      </div>
    </header>
    <!-- header ends here -->

    @if (session()->has('Success'))
    <div class="container container--narrow">
      <div class="alert alert-success text-center">
        {{session('Success')}}
      </div>
    </div>
    @endif

    @if (session()->has('failure'))
    <div class="container container--narrow">
      <div class="alert alert-danger text-center">
        {{session('failure')}}
      </div>
    </div>
    @endif

    {{$slot}}

    <!-- footer begins -->
    <footer class="border-top text-center small text-muted py-3">
      <p class="m-0">Copyright &copy; {{date('Y')}} <a href="/" class="text-muted">YETAMAX 2029</a>. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>