<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search" style="position: relative; padding: 13% 0;">
        <!-- Background image with overlay div -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
            <img src="slider/bg.webp" style="width: 100%; height: 100%; object-fit: cover;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.65);">
            </div>
        </div>
        <div class="container">

            <h2 class="text-center text-white" style="color: white;">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend style="color: white;">Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="slider/image3.jpg" alt="Pizza" class="imgres img-curve">
                    </div>

                    <div class="food-menu-description">
                        <h3 style="color: white;">Food Title</h3>
                        <p class="food-price" style="color: white;">$2.3</p>

                        <div class="order-label" style="color: white;">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend style="color: white;">Delivery Details</legend>
                    <div class="order-label" style="color: white;">Full Name</div>
                    <input type="text" name="full-name" placeholder="Your Name" class="input-responsive"
                        required>

                    <div class="order-label" style="color: white;">Phone Number</div>
                    <input type="tel" name="contact" placeholder="98xxxxxxxx" class="input-responsive" required>

                    <div class="order-label" style="color: white;">Email</div>
                    <input type="email" name="email" placeholder="Your gmail address" class="input-responsive"
                        required>

                    <div class="order-label" style="color: white;">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                        required></textarea>
                    <br><br>
                    <input type="submit" name="submit" value="Confirm Order" class="button button-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   <?php include('partials-front/footer.php');?>