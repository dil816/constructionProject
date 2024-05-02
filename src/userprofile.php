<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: logIn.php'); // Redirect to the login page or any other page
    exit;
}

// Retrieve user data from the database

require_once './config/database.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE id='$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
}

// Handle form submission

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    

    // Sanitize inputs (You can use additional validation if needed)

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $mobile = mysqli_real_escape_string($conn, $mobile);

    // Update the user's details in the database

    $query = "UPDATE user SET fullname='$fullname', username='$username', nic='$nic',address='$address', email='$email', dob='$dob', mobile='$mobile',  WHERE ID='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) 
    {
        $user['fullname'] = $fullname;
        $user['username'] = $username;
        $user['nic'] = $nic;
        $user['address'] = $address;
        $user['email'] = $email;
        $user['dob'] = $dob;
        $user['mobile'] = $mobile;    
	
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./style/userprofile.css">
</head>
<body>
    <div class="container">
        <h2>User Profile</h2>
        <center><img src="./images/userprofile.jpeg" alt="Italian Trulli">
        </center>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['fullname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">User Name:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nic">NIC:</label>
                <input type="text" id="nic" name="nic" value="<?php echo $user['nic']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" readonly>
            </div>
            <div class="button-group">
                <button class="edit-button">Edit</button>
                <br/>
                <button class="delete-button">Delete</button>
            </div>
        </form>
        
    </div>
</body>
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete the user profile?')) {
            // Code to delete the user profile
            showNotification('User profile deleted successfully!', 'success');
        }
    }

    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.classList.add(type);
        setTimeout(() => {
            notification.textContent = '';
            notification.classList.remove(type);
        }, 3000); // Remove notification after 3 seconds
    }
</script>
</html>
