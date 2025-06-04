<?php include('partials/menu.php')?>

<div class="main">
    <div class="wrapper">
        <h1>Received Feedback</h1>
        <br><br>

        <table class='tbl-full'>
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Received At</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_contact ORDER BY submitted_at DESC";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $count = mysqli_num_rows($result);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $full_name = $row['full_name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $subject = $row['subject'];
                        $message = $row['message'];
                        $submitted_at = $row['submitted_at'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($full_name); ?></td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                            <td><?php echo htmlspecialchars($phone); ?></td>
                            <td><?php echo htmlspecialchars($subject); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($message)); ?></td>
                            <td><?php echo $submitted_at; ?></td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No feedback found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Failed to retrieve data.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php')?>
