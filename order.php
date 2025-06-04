<?php 
include('config/constants.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Not logged in → redirect to login
    header("Location: login.php?redirect=order");
    exit();
}

// Initialize variables
$title = "";
$price = 0;
$image_name = "";
$food_id = 0;

// Check whether food_id is set
if(isset($_GET['food_id'])) {
    $food_id = mysqli_real_escape_string($conn, $_GET['food_id']);
    
    // Get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";
    $res = mysqli_query($conn, $sql);
    
    // Check if food exists
    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // Food not found, redirect to home
        header('Location: ' . SITEURL);
        exit();
    }
} else {
    // No food_id provided, redirect to home
    header('Location: ' . SITEURL);
    exit();
}

// Handle form submission
if(isset($_POST['submit'])) {
    // Get form data
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_id = $_SESSION['user_id'];
    
    // Calculate total
    $total = $price * $qty;
    
    // Insert order into database
    $order_sql = "INSERT INTO tbl_order (food, price, quantity, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
                  VALUES ('$title', $price, $qty, $total, NOW(), 'Ordered', '$full_name', '$contact', '$email', '$address')";
    
    $order_res = mysqli_query($conn, $order_sql);
    
    if($order_res) {
        // Order placed successfully
        $_SESSION['order']="<div class='success'>Food Ordered Successfully </div>";
        header('location:'.SITEURL.'dashboard.php');
    } else {

        $_SESSION['order']="<div class='failed'>Failed to order food</div>";
        header('location:'.SITEURL);
        
    }
}
?>

<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search" style="position: relative; padding: 13% 0;">
    <!-- Background image with overlay div -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
        <img src="slider/bg.webp" style="width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.65);"></div>
    </div>
    
    <div class="container">
        <h2 class="text-center text-white" style="color: white;">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend style="color: white;">Selected Food</legend>

                <div class="food-menu-img">
                    <?php if($image_name != ""): ?>
                        <img src="<?php echo SITEURL; ?>slider/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="imgres img-curve">
                    <?php else: ?>
                        <img src="slider/pizza.jpg" alt="<?php echo $title; ?>" class="imgres img-curve">
                    <?php endif; ?>
                </div>

                <div class="food-menu-description">
                    <h3 style="color: white;"><?php echo $title; ?></h3>
                    <p class="food-price" style="color: white;">
                        Unit Price: $<span id="unit-price"><?php echo $price; ?></span>
                    </p>
                    <p class="food-total" style="color: white; font-weight: bold; font-size: 1.2em;">
                        Total: $<span id="total-price"><?php echo $price; ?></span>
                    </p>

                    <div class="order-label" style="color: white;">Quantity</div>
                    <input type="number" name="qty" id="quantity" class="input-responsive" value="1" min="1" required onchange="calculateTotal()">
                </div>
            </fieldset>

            <fieldset>
                <legend style="color: white;">Delivery Details</legend>
                
                <div class="order-label" style="color: white;">Full Name</div>
                <input type="text" name="full-name" placeholder="Your Name" class="input-responsive" 
                       value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>" required>

                <div class="order-label" style="color: white;">Phone Number</div>
                <input type="tel" name="contact" placeholder="98xxxxxxxx" class="input-responsive" required>

                <div class="order-label" style="color: white;">Email</div>
                <input type="email" name="email" placeholder="Your gmail address" class="input-responsive" 
                       value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" required>

                <div class="order-label" style="color: white;">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                
                <br><br>
                <!-- Hidden field to pass food_id -->
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                <input type="submit" name="submit" value="Confirm Order" class="button button-primary">
            </fieldset>
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

<script>
function calculateTotal() {
    // Get the unit price and quantity
    const unitPrice = parseFloat(document.getElementById('unit-price').textContent);
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    
    // Calculate total
    const total = unitPrice * quantity;
    
    // Update the total price display
    document.getElementById('total-price').textContent = total.toFixed(2);
}

// Also trigger calculation on input (for typing)
document.getElementById('quantity').addEventListener('input', calculateTotal);

// Initialize calculation on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateTotal();
});
</script>