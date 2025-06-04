<?php include('partials/menu.php')?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Users</h1>
        <br><br>

        <table class='tbl-full'>
            <tr>
                <th>S.N</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Password Hash</th>
                <th>Reset Token</th>
                <th>Token Expiry</th>
    
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_user ORDER BY id ASC";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $count = mysqli_num_rows($result);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $password = $row['password'];
                        $reset_token = $row['reset_token'];
                        $reset_token_expiry = $row['reset_token_expiry'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($firstname); ?></td>
                            <td><?php echo htmlspecialchars($lastname); ?></td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                            <td><?php echo htmlspecialchars($mobile); ?></td>
                            <td><?php echo substr(htmlspecialchars($password), 0, 20) . '...'; ?></td>
                            <td><?php echo $reset_token ? htmlspecialchars(substr($reset_token, 0, 15)) . '...' : 'NULL'; ?></td>
                            <td><?php echo $reset_token_expiry ? htmlspecialchars($reset_token_expiry) : 'NULL'; ?></td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No users found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Failed to retrieve data: " . mysqli_error($conn) . "</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php')?>