<?php include('partials-front/menu.php');?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            line-height: 1.6;
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            
        }

        .about-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .hero-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            background: black ;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .hero-section .subtitle {
            font-size: 1.3rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .content-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .content-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: rgb(247, 118, 118);
            border-radius: 2px;
        }

        .content-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 15px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .feature-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-3px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .feature-item h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 10px;
        }

        .feature-item p {
            color: #666;
            font-size: 1rem;
        }

        .team-section {
            text-align: center;
            margin-top: 50px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .team-member {
            background: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-5px);
        }

        .team-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: bold;
        }

        .cta-section {
            text-align: center;
            margin-top: 50px;
            padding: 40px;
            background: rgb(247, 118, 118);
            border-radius: 20px;
            color: white;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 35px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .cta-button:hover {
            background: crimson;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .about-card {
                padding: 25px;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="about-card">
            <div class="hero-section">
                <h1>About Yumkart</h1>
                <p class="subtitle">Bringing delicious food experiences right to your doorstep with passion, quality, and innovation.</p>
            </div>

            <div class="content-grid">
                <div class="content-section">
                    <h2>Our Story</h2>
                    <p>Founded with a simple mission to connect food lovers with exceptional culinary experiences, FoodWeb has grown from a small local initiative to a comprehensive food delivery platform.</p>
                    <p>We believe that great food brings people together, and every meal should be an adventure worth savoring.</p>
                </div>

                <div class="content-section">
                    <h2>Our Mission</h2>
                    <p>To revolutionize the way people experience food by providing seamless access to diverse, high-quality meals from the best local restaurants and chefs.</p>
                    <p>We're committed to supporting local businesses while ensuring customers receive fresh, delicious food delivered with care.</p>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-item">
                    <span class="feature-icon">🍕</span>
                    <h3>Quality Food</h3>
                    <p>Carefully selected restaurants and verified quality standards</p>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">🚀</span>
                    <h3>Fast Delivery</h3>
                    <p>Quick and reliable delivery service to your location</p>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">💎</span>
                    <h3>Premium Experience</h3>
                    <p>User-friendly platform with exceptional customer service</p>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">🌱</span>
                    <h3>Local Support</h3>
                    <p>Supporting local restaurants and sustainable practices</p>
                </div>
            </div>

            <div class="team-section">
                <h2>Meet Our Team</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="team-avatar">PB</div>
                        <h3>Pragati Basnet</h3>
                        <p>Backend Developer</p>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar">AN</div>
                        <h3>Aakriti Neupane</h3>
                        <p>Data Analyst</p>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar">KB</div>
                        <h3>Kanchan Budathoki</h3>
                        <p>Frontend Developer</p>
                    </div>
                    <div class="team-member">
                        <div class="team-avatar">ND</div>
                        <h3>Nisha Dahal</h3>
                        <p>Frontend Developer</p>
                    </div>
                </div>
            </div>

            <div class="cta-section">
                <h2 style='color:white;'>Ready to Experience FoodWeb?</h2>
                <p>Join thousands of satisfied customers who trust us with their food delivery needs.</p>
                <a href="<?php echo SITEURL;?>categories.php" class="cta-button">Browse Food</a>
            </div>
        </div>
    </div>
<?php include('partials-front/footer.php');?>