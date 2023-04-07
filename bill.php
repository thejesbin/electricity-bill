<?php

$conn = mysqli_connect("localhost", "root", "", "electricity");

if (isset($_POST['submit'])) {

    $phone = $_POST['phone'];
    $present = $_POST['present'];

    $check_account = mysqli_query($conn, "select * from consumer where phone='$phone'");
    if ($check_account) {
        if (mysqli_num_rows($check_account) > 0) {
            if ($data = mysqli_fetch_assoc($check_account)) {
                $previous = $data['previous'];
                $name = $data['name'];
                $id = $data['id'];
                $address = $data['address'];
                $bill = 0;
                if ($present <= 100) {
                    $bill = $present * 3;
                } else if ($present < 200) {
                    $bill = 100 * 3 + ($present - 100) * 4;
                } else {
                    $bill = (100 * 3) + (200 * 4) + ($present - 300) * 5;
                }
                $update_previous = mysqli_query($conn, "update consumer set previous='$bill' where phone='$phone'");
            }
        } else {
            echo '<script>window.alert("Account not registered");
        window.location="register.html"</script>';
        }
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Electricity Bill</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
    <center>
        <div class="section">
            <br>
            <h3>Electricity Bill</h3>

            <table>
                <br>
                <br>
                <tr>
                    <td>Consumer Name : </td>
                    <td>
                        <?php echo $name;  ?>
                    </td>
                </tr>
                <tr>
                    <td>Consumer Number : </td>
                    <td>
                        <?php echo $id;  ?>
                    </td>
                </tr>

                <tr>
                    <td>Phone Number : </td>
                    <td>
                        <?php echo $phone;  ?>
                    </td>
                </tr>
                <tr>
                    <td>Address : </td>
                    <td>
                        <?php echo $address;  ?>
                    </td>
                </tr>

                <tr>
                    <td>Present Reading : </td>
                    <td>
                        <?php echo $present;  ?>
                    </td>
                </tr>
                <tr>
                    <td>Previous Bill : </td>
                    <td>
                        <?php echo $previous;  ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h4>Your Bill : </h4>
                    </td>
                    <td>
                        <h4><?php echo $bill;  ?></h4>
                    </td>
                </tr>

            </table>

            <br>

        </div>
    </center>
</body>

</html>