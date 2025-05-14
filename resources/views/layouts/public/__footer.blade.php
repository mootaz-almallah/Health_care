<footer style="background-color: #212529; color: rgba(255, 255, 255, 0.7); padding: 1.5rem 0; font-size: 0.85rem;">
    <div class="container">
        <div class="footer-content" style="display: grid; grid-template-columns: 2fr 1fr 1fr 2fr; gap: 1.5rem;">
            <!-- Company Info -->
            <div>
                <h5 style="color: white; font-weight: 600; margin-bottom: 0.75rem; position: relative; font-size: 0.95rem;">HealthCare</h5>
                <p class="mb-2" style="font-size: 0.8rem;">We provide comprehensive healthcare services and electronic pharmacy solutions.</p>
                <div class="social-links" style="display: flex; gap: 10px; margin-top: 10px;">
                    <a href="{{ route('welcome') }}" style="display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; background-color: rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; font-size: 0.8rem;"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ route('welcome') }}" style="display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; background-color: rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; font-size: 0.8rem;"><i class="fab fa-twitter"></i></a>
                    <a href="{{ route('welcome') }}" style="display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; background-color: rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; font-size: 0.8rem;"><i class="fab fa-instagram"></i></a>
                    <a href="{{ route('welcome') }}" style="display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; background-color: rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; font-size: 0.8rem;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h5 style="color: white; font-weight: 600; margin-bottom: 0.75rem; position: relative; font-size: 0.95rem;">Quick Links</h5>
                <ul class="footer-links" style="list-style: none; padding-left: 0; margin-bottom: 0;">
                    <li style="margin-bottom: 5px;"><a href="{{ route('welcome') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">Home</a></li>
                    <li style="margin-bottom: 5px;"><a href="{{ route('about') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">About Us</a></li>
                    <li style="margin-bottom: 5px;"><a href="{{ route('doctors') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">Doctors</a></li>
                </ul>
            </div>
            
            <!-- Services -->
            <div>
                <h5 style="color: white; font-weight: 600; margin-bottom: 0.75rem; position: relative; font-size: 0.95rem;">Services</h5>
                <ul class="footer-links" style="list-style: none; padding-left: 0; margin-bottom: 0;">
                    <li style="margin-bottom: 5px;"><a href="{{ route('pharma.index') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">Pharmacy</a></li>
                    <li style="margin-bottom: 5px;"><a href="{{ route('doctors') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">Consultations</a></li>
                    <li style="margin-bottom: 5px;"><a href="{{ route('contact') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s ease;">Support</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h5 style="color: white; font-weight: 600; margin-bottom: 0.75rem; position: relative; font-size: 0.95rem;">Contact Us</h5>
                <div class="contact-items" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <div class="contact-item" style="display: flex; align-items: center;">
                        <div class="contact-icon" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; margin-right: 8px; font-size: 0.7rem;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text" style="font-size: 0.8rem;">Amman, Jordan</div>
                    </div>
                    <div class="contact-item" style="display: flex; align-items: center;">
                        <div class="contact-icon" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; margin-right: 8px; font-size: 0.7rem;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text" style="font-size: 0.8rem;">+962 79 123 4567</div>
                    </div>
                    <div class="contact-item" style="display: flex; align-items: center;">
                        <div class="contact-icon" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; margin-right: 8px; font-size: 0.7rem;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text" style="font-size: 0.8rem;">info@healthcare.com</div>
                    </div>
                    <div class="contact-item" style="display: flex; align-items: center;">
                        <div class="contact-icon" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 50%; margin-right: 8px; font-size: 0.7rem;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-text" style="font-size: 0.8rem;">Sun-Thu: 9am-6pm</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="copyright" style="text-align: center; padding-top: 0.75rem; margin-top: 0.75rem; border-top: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.75rem;">
            <p class="mb-0">&copy; {{ date('Y') }} HealthCare. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Doctors slider
        new Splide('#doctors-slider', {
            type: 'loop',
            perPage: 4,
            perMove: 2,
            autoplay: true,
            interval: 3000,
            gap: '20px',
            padding: '50px',
            pagination: false,
            breakpoints: {
                1200: { perPage: 3, gap: '50px', padding: '40px' },
                1024: { perPage: 2, gap: '40px', padding: '30px' },
                768: { perPage: 2, perMove: 1, gap: '30px', padding: '20px' },
                568: { perPage: 1, perMove: 1, gap: '40px', padding: '80px' },
                400: { perPage: 1, perMove: 1, gap: '40px', padding: '60px' }
            }
        }).mount();

        // Testimonials slider
        new Splide('#testimonials-slider', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            autoplay: true,
            interval: 3000,
            gap: '20px',
            padding: '50px',
            pagination: false,
            breakpoints: {
                1200: { perPage: 3, gap: '20px', padding: '40px' },
                1024: { perPage: 2, gap: '20px', padding: '30px' },
                768: { perPage: 1, gap: '20px', padding: '20px' },
                568: { perPage: 1, gap: '20px', padding: '10px' },
                400: { perPage: 1, gap: '20px', padding: '10px' }
            }
        }).mount();

        // Counter animation
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>