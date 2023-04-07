<?php
$conn = mysqli_connect("localhost", "root", "", "electricity");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id = rand(1111111111, 9999999999);
    $check_account = mysqli_query($conn, "select * from consumer where phone='$phone'");
    if ($check_account) {
        if (mysqli_num_rows($check_account) > 0) {
            echo '<script>window.alert("Phone number is already used");
            window.location="register.html"</script>';
        } else {
            $register = mysqli_query($conn, "insert into consumer(id,name,phone,address,previous) values('$id','$name','$phone','$address','0')");
            if ($register) {
                echo '<script>window.alert("Consumer registered successfully");
                window.location="index.html"</script>';
            } else {
                echo '<script>window.alert("Registration Failed");
                window.location="register.html"</script>';
            }
        }
    }
}
