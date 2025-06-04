<?php 
include('config/constants.php');
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $full_name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $sql = "INSERT INTO tbl_contact (full_name, email, phone, subject, message)
            VALUES ('$full_name', '$email', '$phone', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message sent and stored successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>


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

        .contact-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .animated-heading {
            font-size: 3rem;
            font-weight: bold;
            background: black;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            animation: fadeInUp 1s ease;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #666;
            animation: fadeInUp 1s ease 0.2s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 40px;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-info {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #667eea;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .contact-info h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 10px;
        }

        .contact-info h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: rgb(247, 118, 118);
            border-radius: 2px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateX(10px);
        }

        .contact-icon {
            font-size: 1.5rem;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-text {
            flex: 1;
        }

        .contact-text h4 {
            color: #333;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .contact-text p {
            color: #666;
            margin: 0;
        }

        .map-section {
            margin-top: 40px;
            text-align: center;
        }

        .map-placeholder {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 60px 20px;
            border: 2px dashed black;
            color: black;
            font-size: 1.2rem;
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
            .contact-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .animated-heading {
                font-size: 2.2rem;
            }
            
            .contact-card {
                padding: 25px;
            }
            
            .contact-form, .contact-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="contact-card">
            <div class="hero-section">
                <h1 class="animated-heading">Contact Us</h1>
                <p class="subtitle">We'd love to hear from you! Get in touch with our team.</p>
            </div>

            <div class="contact-content">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h3>Send us a Message</h3>
                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" required placeholder="Tell us how we can help you..."></textarea>
                        </div>
                        
                        <button type="submit" class="button button-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-text">
                            <h4>Address</h4>
                            <p>Jhamsikhel, Lalitpur<br>Bagmati Province, Nepal</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-text">
                            <h4>Phone</h4>
                            <p>+977-9811567890<br>+977-9861570967</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@yumkart.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-text">
                            <h4>Working Hours</h4>
                            <p>Mon - Fri: 9:00 AM - 8:00 PM<br>Sat - Sun: 10:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <h3>Find Us</h3>
                <div class="map-placeholder">
                    🗺️ Interactive Map Coming Soon<br>
                    <small>Location: Lalitpur, Nepal</small>
                </div>
            </div>
        </div>
    </div>

   
<?php include('partials-front/footer.php');?>