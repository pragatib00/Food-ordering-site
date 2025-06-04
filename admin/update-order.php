<?php 
include('partials/menu.php');

// Get the order ID from URL
if(isset($_GET['id'])) {
    $order_id = $_GET['id'];
} else {
    // Redirect if no ID provided
    header('location: manage-order.php');
    exit();
}

// Get current order details
$sql = "SELECT * FROM tbl_order WHERE id = $order_id";
$res = mysqli_query($conn, $sql);

if($res && mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_assoc($res);
    $food_name = $row['food'];
    $current_status = $row['status'];
    $customer_name = $row['customer_name'];
    $customer_contact = $row['customer_contact'];
    $customer_email = $row['customer_email'];
    $customer_address = $row['customer_address'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $total = $row['total'];
} else {
    // Order not found
    $_SESSION['update'] = '<div class="error">Order not found.</div>';
    header('location: manage-order.php');
    exit();
}

// Process form submission
if(isset($_POST['submit'])) {
    $status = $_POST['status'];
    
    // Update query
    $sql2 = "UPDATE tbl_order SET status = '$status' WHERE id = $order_id";
    $res2 = mysqli_query($conn, $sql2);
    
    if($res2) {
        $_SESSION['update'] = '<div class="success">Order Status Updated Successfully.</div>';
        header('location: manage-order.php');
        exit();
    } else {
        $_SESSION['update'] = '<div class="error">Failed to Update Order Status.</div>';
        header('location: manage-order.php');
        exit();
    }
}
?>

<div class="main">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
        // Display session message if any
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food_name; ?></b></td>
                </tr>
                
                <tr>
                    <td>Customer Name</td>
                    <td><?php echo $customer_name; ?></td>
                </tr>
                
                <tr>
                    <td>Customer Contact</td>
                    <td><?php echo $customer_contact; ?></td>
                </tr>
                
                <tr>
                    <td>Customer Email</td>
                    <td><?php echo $customer_email; ?></td>
                </tr>
                
                <tr>
                    <td>Customer Address</td>
                    <td><?php echo $customer_address; ?></td>
                </tr>
                
                <tr>
                    <td>Quantity</td>
                    <td><?php echo $quantity; ?></td>
                </tr>
                
                <tr>
                    <td>Price</td>
                    <td>$<?php echo $price; ?></td>
                </tr>
                
                <tr>
                    <td>Total</td>
                    <td><b>$<?php echo $total; ?></b></td>
                </tr>
                
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="Ordered" <?php if($current_status == "Ordered") echo "selected"; ?>>Ordered</option>
                            <option value="On Delivery" <?php if($current_status == "On Delivery") echo "selected"; ?>>On Delivery</option>
                            <option value="Delivered" <?php if($current_status == "Delivered") echo "selected"; ?>>Delivered</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <br>
        <a href="manage-order.php" class="btn-primary">Back to Orders</a>
    </div>
</div>

<?php include('partials/footer.php'); ?>