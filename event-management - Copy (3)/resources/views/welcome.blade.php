<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planwise - Effortless Event Management</title>
    <meta name="description" content="Plan, organize, and execute your events with ease using Planwise's powerful event management platform.">
    <!-- Fonts + Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                            url('https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glassy {
            background: rgba(255,255,255,0.15);
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .feature-icon {
            background: rgba(37, 99, 235, 0.1);
            border-radius: 50%;
            padding: 12px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-outline {
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: white;
            color: #2563eb;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col bg-gray-50">
    <!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                <span class="text-2xl font-bold text-white tracking-tight" style="font-family:'Instrument Sans',sans-serif;">
                    Planwise
                </span>
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <nav class="hidden md:flex space-x-6">
                <a href="#features" class="text-white hover:text-blue-200 font-medium transition">Features</a>
                <a href="#testimonials" class="text-white hover:text-blue-200 font-medium transition">Testimonials</a>
                

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-200 font-medium transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-200 font-medium transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 inline-block btn-primary text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Register</a>
                    @endif
                @endauth
            @endif
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</header>

    <!-- Hero Section -->
    <main class="flex-grow hero-bg pt-32 pb-20 md:pt-40 md:pb-28">
        <div class="w-full h-full flex items-center justify-center px-4 sm:px-6">
            <div class="max-w-3xl text-center" data-aos="fade-up" data-aos-delay="100">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight mb-6 text-white" style="letter-spacing: -0.02em; line-height: 1.2;">
                    Effortless Event Management <span class="text-blue-300">Made Simple</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    Plan, organize, and execute flawless events with our intuitive platform. Save time, reduce stress, and delight your attendees.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold text-lg">
                        Get Started - It's Free
                    </a>
                    <a href="#features" class="btn-outline border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg">
                        Explore Features
                    </a>
                </div>
                <div class="mt-8 flex items-center justify-center space-x-2 text-gray-300">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                    </div>
                    <span class="text-sm">Join 1,000+ happy event planners</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Powerful Features for <span class="text-blue-600">Seamless Events</span></h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Everything you need to create, manage, and analyze successful events in one place.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-calendar-alt text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Intuitive Scheduling</h3>
                        <p class="text-gray-600">
                            Easily create and manage events with our drag-and-drop calendar. Set up recurring events, reminders, and deadlines in seconds.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-users text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Attendee Management</h3>
                        <p class="text-gray-600">
                            Track attendees, manage RSVPs, and send personalized invitations. Export attendee lists with all the details you need.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Real-time Analytics</h3>
                        <p class="text-gray-600">
                            Get insights into attendance rates, engagement levels, and other key metrics to measure your event's success.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-ticket-alt text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Ticketing System</h3>
                        <p class="text-gray-600">
                            Sell tickets directly through our platform with customizable ticket types, pricing tiers, and secure payment processing.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Automated Communications</h3>
                        <p class="text-gray-600">
                            Send automated confirmation emails, reminders, and follow-ups to keep your attendees informed and engaged.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="feature-icon w-14 h-14 flex items-center justify-center mb-4">
                            <i class="fas fa-mobile-alt text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Mobile Friendly</h3>
                        <p class="text-gray-600">
                            Manage your events on the go with our fully responsive design. Everything works perfectly on any device.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Trusted by <span class="text-blue-600">Event Professionals</span></h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it. Here's what our users have to say.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                        <div>
                            <h4 class="font-bold text-gray-900">Sarah Johnson</h4>
                            <p class="text-gray-600 text-sm">Event Coordinator</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "Planwise has completely transformed how we manage our corporate events. What used to take days now takes hours!"
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/men/54.jpg" alt="Michael Chen">
                        <div>
                            <h4 class="font-bold text-gray-900">Michael Chen</h4>
                            <p class="text-gray-600 text-sm">Wedding Planner</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "The attendee management tools are a game-changer. My clients love the professional RSVP system and automated reminders."
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez">
                        <div>
                            <h4 class="font-bold text-gray-900">Emily Rodriguez</h4>
                            <p class="text-gray-600 text-sm">Nonprofit Director</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "As a small nonprofit, we needed an affordable solution that didn't compromise on features. Planwise delivered perfectly."
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Transform Your Event Planning?</h2>
            <p class="text-xl text-blue-100 mb-8">
                Join thousands of event professionals who trust Planwise to make their events unforgettable.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 transition">
                    Start Your Free Trial
                </a>
                <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition">
                    Schedule a Demo
                </a>
            </div>
        </div>
    </section>

   <!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                    <span class="text-2xl font-bold tracking-tight">Planwise</span>
                </div>
                <p class="text-gray-400">
                    Making event planning simple, efficient, and enjoyable for everyone.
                </p>
            </div>
            <!-- Rest of the footer content remains the same -->
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Features</a></li>
                      
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Integrations</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Updates</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Tutorials</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Community</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Press</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Planwise. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>