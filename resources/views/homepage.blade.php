<x-layout>
    <!-- Add necessary CSS libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Hero Section with Animated Background -->
    <div class="hero-section">
        <div class="animated-bg">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1 class="animate__animated animate__fadeInDown">YETAMAX <span class="year-text">2029</span></h1>
                    <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                        Experience the future of college festivals. Join us for an unforgettable celebration of talent, innovation, and creativity.
                    </p>
                    <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="/allevents" class="btn-primary">
                            <span>Explore Events</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#register" class="btn-secondary">
                            <span>Register Now</span>
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                    
                    <div class="event-stats">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="stat-number counter" data-target="{{$events->count()}}">0</div>
                            <div class="stat-label">Events</div>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-number counter" data-target="{{$users->count()}}">0</div>
                            <div class="stat-label">Participants</div>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="stat-number counter" data-target="3">0</div>
                            <div class="stat-label">Days</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="registration-card" id="register">
                        <div class="card-blob"></div>
                        <div class="card-header">
                            <h2>Join YETAMAX 2029</h2>
                            <p>Create your account to participate in events</p>
                        </div>
                        
                        <form action="/register" method="POST" id="registration-form" class="registration-form">
                            @csrf
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input value="{{old('name')}}" name="name" id="name-register" class="form-control" type="text" placeholder="Enter your name" autocomplete="off" />
                                @error('name')
                                <p class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <input value="{{old('roll_no')}}" name="roll_no" id="roll_no-register" class="form-control" type="text" placeholder="Enter your roll no" autocomplete="off" />
                                @error('roll_no')
                                <p class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input value="{{old('email')}}" name="email" id="email-register" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
                                @error('email')
                                <p class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <input name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
                                <div class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </div>
                                @error('password')
                                <p class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirm password" />
                                <div class="password-toggle">
                                    <i class="fas fa-eye"></i>
                                </div>
                                @error('password_confirmation')
                                <p class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <button type="submit" class="submit-btn">
                                <span>Sign up for YETAMAX</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">
                <span class="gradient-text">Why Join YETAMAX?</span>
            </h2>
            
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Exciting Competitions</h3>
                    <p>Participate in a wide range of competitions and showcase your talents to win amazing prizes.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Team Building</h3>
                    <p>Form teams with your friends and classmates to tackle challenges together and build lasting connections.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Innovation Hub</h3>
                    <p>Explore cutting-edge technologies and innovative ideas through workshops and exhibitions.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3>Cultural Extravaganza</h3>
                    <p>Experience a vibrant celebration of arts, music, and culture with performances from talented artists.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add necessary JS libraries -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation library
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
            
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.dataset.target;
                const increment = target / 20;
                
                const updateCounter = () => {
                    const count = +counter.innerText;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCounter, 100);
                    } else {
                        counter.innerText = target;
                    }
                };
                
                updateCounter();
            });
            
            // Password toggle
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #4cc9f0;
            --accent-color: #f72585;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --text-color: #333;
            --border-radius: 10px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        /* Global Styles */
        body {
            font-family: 'Source Sans Pro', sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            padding: 100px 0;
            overflow: hidden;
            background-color: #f8f9fa;
        }
        
        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            animation: float 15s infinite ease-in-out;
        }
        
        .shape-1 {
            width: 400px;
            height: 400px;
            background: var(--primary-color);
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 300px;
            height: 300px;
            background: var(--secondary-color);
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }
        
        .shape-3 {
            width: 200px;
            height: 200px;
            background: var(--accent-color);
            top: 50%;
            left: 30%;
            animation-delay: -10s;
        }
        
        .shape-4 {
            width: 250px;
            height: 250px;
            background: var(--success-color);
            bottom: 20%;
            right: 20%;
            animation-delay: -7s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }
        
        .year-text {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
        }
        
        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            color: #555;
            max-width: 90%;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }
        
        .btn-primary, .btn-secondary {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }
        
        .btn-secondary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            text-decoration: none;
        }
        
        .btn-primary i, .btn-secondary i {
            margin-left: 0.5rem;
            transition: transform 0.3s;
        }
        
        .btn-primary:hover i, .btn-secondary:hover i {
            transform: translateX(5px);
        }
        
        /* Event Stats */
        .event-stats {
            display: flex;
            gap: 2rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            font-size: 1rem;
            color: #555;
            font-weight: 600;
        }
        
        /* Registration Card */
        .registration-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .card-blob {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(76, 201, 240, 0.1));
            border-radius: 50%;
            z-index: -1;
            animation: blob-morph 10s infinite alternate;
        }
        
        @keyframes blob-morph {
            0% {
                border-radius: 50%;
                transform: scale(1);
            }
            50% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: scale(1.05);
            }
            100% {
                border-radius: 40% 60% 70% 30% / 40% 70% 30% 60%;
                transform: scale(1);
            }
        }
        
        .card-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .card-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .card-header p {
            color: #6c757d;
        }
        
        .registration-form .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 1;
        }
        
        .registration-form .form-control {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border-radius: 30px;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
            transition: var(--transition);
        }
        
        .registration-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
            background: white;
        }
        
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            z-index: 1;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
        }
        
        .error-message {
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            margin-left: 1rem;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 0.5rem;
        }
        
        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem;
            border-radius: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }
        
        .submit-btn i {
            margin-left: 0.5rem;
            transition: transform 0.3s;
        }
        
        .submit-btn:hover i {
            transform: translateX(5px);
        }
        
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: white;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(76, 201, 240, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.75rem;
            color: var(--primary-color);
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .feature-card p {
            color: #6c757d;
            font-size: 0.95rem;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 3rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .registration-card {
                margin-top: 3rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 50px 0;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .event-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</x-layout>