
<?php
include('config/constants.php');

include('partials-front/menu.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

// Get user's orders from database
$order_sql = "SELECT * FROM tbl_order WHERE customer_email = '$user_email' ORDER BY order_date DESC";
$order_res = mysqli_query($conn, $order_sql);
?>

<?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - YumKart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        .dashboard-header {
            background: whitesmoke;
            color: black;
            padding: 2rem 0;
            text-align: center;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .dashboard-nav {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .nav-links a.active {
            background-color: rgb(247, 118, 118);
            color: white;
        }
        .nav-links a:hover{
            background: crimson;
            color: white;
        }
        .dashboard-content {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .content-header {
            background: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .orders-table th,
        .orders-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .orders-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .orders-table tr:hover {
            background: #f8f9fa;
        }
        
        .status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .status.ordered {
            background: #fff3cd;
            color: #856404;
        }
        
        .status.confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        .status.delivered {
            background: #d4edda;
            color: #155724;
        }
        
        .status.cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .no-orders {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }
        
        .order-total {
            font-weight: bold;
            color: #28a745;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: black;
        }
        
        .stat-label {
            color: #6c757d;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .orders-table {
                font-size: 0.875rem;
            }
            
            .orders-table th,
            .orders-table td {
                padding: 0.5rem;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }
            .success{

                color: green;

            }
            .failed{

                color:red;

            }
        }
    </style>
</head>
<body>
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <h1>Welcome, <?php echo $user_name; ?>!</h1>
            <p>Manage your orders and account settings</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="dashboard-nav">
        <div class="container">
            <div class="nav-links">
                <a href="dashboard.php" class="active">My Orders</a>
                <a href="<?php echo SITEURL; ?>">Browse Food</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Calculate statistics
        $total_orders = mysqli_num_rows($order_res);
        $total_spent = 0;
        $recent_orders = 0;
        
        // Reset result pointer and calculate stats
        mysqli_data_seek($order_res, 0);
        while($stat_row = mysqli_fetch_assoc($order_res)) {
            $total_spent += $stat_row['total'];
            // Count orders from last 30 days
            if(strtotime($stat_row['order_date']) > strtotime('-30 days')) {
                $recent_orders++;
            }
        }
        
        // Reset pointer again for main display
        mysqli_data_seek($order_res, 0);
        ?>

        <!-- Statistics Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_orders; ?></div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">$<?php echo number_format($total_spent, 2); ?></div>
                <div class="stat-label">Total Spent</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $recent_orders; ?></div>
                <div class="stat-label">Orders This Month</div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="dashboard-content">
            <div class="content-header">
                <h2>Order History</h2>
                <p>Track all your food orders and their current status</p>
            </div>

            <?php if(mysqli_num_rows($order_res) > 0): ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Food Item</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($order = mysqli_fetch_assoc($order_res)): ?>
                        <tr>
                            <td>#<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></td>
                            <td>
                                <strong><?php echo $order['food']; ?></strong><br>
                                <small>$<?php echo $order['price']; ?> per item</small>
                            </td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td class="order-total">$<?php echo number_format($order['total'], 2); ?></td>
                            <td><?php echo date('M j, Y g:i A', strtotime($order['order_date'])); ?></td>
                            <td>
                                <span class="status <?php echo strtolower($order['status']); ?>">
                                    <?php echo $order['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div><?php echo $order['customer_name']; ?></div>
                                <small><?php echo $order['customer_contact']; ?></small>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-orders">
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet. <a href="<?php echo SITEURL; ?>">Start browsing our delicious food!</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php include('partials-front/footer.php');?>