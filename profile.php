<?php
session_start();
include 'config.php';

$user_id = 1;


$check_user = mysqli_query($conn, "SELECT user_id FROM users WHERE user_id = 1");
if (!$check_user || mysqli_num_rows($check_user) == 0) {
    // Create default test user
    $create_user = "INSERT INTO users (user_id, username, full_name, email, phone, location, status, created_at) 
                    VALUES (1, 'testuser', 'Test User', 'test@example.com', '09123456789', 'Manila', 'Active', NOW())";
    mysqli_query($conn, $create_user);
}

// user info
$user_sql = "SELECT * FROM users WHERE user_id = $user_id";
$user_result = mysqli_query($conn, $user_sql);

if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user = mysqli_fetch_assoc($user_result);
} else {
    $user = [
        'user_id' => 1,
        'username' => 'testuser',
        'full_name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '',
        'location' => '',
        'status' => 'Active',
        'created_at' => date('Y-m-d H:i:s')
    ];
}

// medical info
$med_sql = "SELECT * FROM medical_info WHERE user_id = $user_id";
$med_result = mysqli_query($conn, $med_sql);

if ($med_result && mysqli_num_rows($med_result) > 0) {
    $medical = mysqli_fetch_assoc($med_result);
} else {
    $medical = [
        'age' => '',
        'gender' => '',
        'blood_type' => '',
        'organ_type' => ''
    ];
}

// forms
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $section = $_POST['section'];

    if ($section === "account") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);

        if (!empty($username) && !empty($full_name) && !empty($email)) {
            $sql = "UPDATE users SET username='$username', full_name='$full_name', email='$email', phone='$phone', location='$location' WHERE user_id=$user_id";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Account information updated successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Please fill in all required fields!');</script>";
        }
    }

    if ($section === "medical") {
        $age = intval($_POST['age']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $blood_type = mysqli_real_escape_string($conn, $_POST['blood_type']);
        $organ_type = mysqli_real_escape_string($conn, $_POST['organ_type']);

        $check = mysqli_query($conn, "SELECT * FROM medical_info WHERE user_id=$user_id");
        if (mysqli_num_rows($check) > 0) {
            $sql = "UPDATE medical_info SET age=$age, gender='$gender', blood_type='$blood_type', organ_type='$organ_type' WHERE user_id=$user_id";
        } else {
            $sql = "INSERT INTO medical_info (user_id, age, gender, blood_type, organ_type)
                    VALUES ($user_id, $age, '$gender', '$blood_type', '$organ_type')";
        }
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Medical information saved successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }

    
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLink - Donor Profile</title>
    <link rel="stylesheet" href="donor_style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        * 
<?php
session_start();
include 'config.php';

$user_id = 1;

$check_user = mysqli_query($conn, "SELECT user_id FROM users WHERE user_id = 1");
if (!$check_user || mysqli_num_rows($check_user) == 0) {
    $create_user = "INSERT INTO users (user_id, username, full_name, email, phone, location, status, created_at) 
                    VALUES (1, 'testuser', 'Test User', 'test@example.com', '09123456789', 'Manila', 'Active', NOW())";
    mysqli_query($conn, $create_user);
}

$user_sql = "SELECT * FROM users WHERE user_id = $user_id";
$user_result = mysqli_query($conn, $user_sql);

if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user = mysqli_fetch_assoc($user_result);
} else {
    $user = [
        'user_id' => 1,
        'username' => 'testuser',
        'full_name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '',
        'location' => '',
        'status' => 'Active',
        'created_at' => date('Y-m-d H:i:s')
    ];
}

$med_sql = "SELECT * FROM medical_info WHERE user_id = $user_id";
$med_result = mysqli_query($conn, $med_sql);

if ($med_result && mysqli_num_rows($med_result) > 0) {
    $medical = mysqli_fetch_assoc($med_result);
} else {
    $medical = [
        'age' => '',
        'gender' => '',
        'blood_type' => '',
        'organ_type' => ''
    ];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $section = $_POST['section'];

    if ($section === "account") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);

        if (!empty($username) && !empty($full_name) && !empty($email)) {
            $sql = "UPDATE users SET username='$username', full_name='$full_name', email='$email', phone='$phone', location='$location' WHERE user_id=$user_id";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Account information updated successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Please fill in all required fields!');</script>";
        }
    }

    if ($section === "medical") {
        $age = intval($_POST['age']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $blood_type = mysqli_real_escape_string($conn, $_POST['blood_type']);
        $organ_type = mysqli_real_escape_string($conn, $_POST['organ_type']);

        $check = mysqli_query($conn, "SELECT * FROM medical_info WHERE user_id=$user_id");
        if (mysqli_num_rows($check) > 0) {
            $sql = "UPDATE medical_info SET age=$age, gender='$gender', blood_type='$blood_type', organ_type='$organ_type' WHERE user_id=$user_id";
        } else {
            $sql = "INSERT INTO medical_info (user_id, age, gender, blood_type, organ_type)
                    VALUES ($user_id, $age, '$gender', '$blood_type', '$organ_type')";
        }
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Medical information saved successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }

    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeLink - Donor Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #E1E1E1;
            width: 100%;
        }

        /* NAVIGATION BAR - EXACT MATCH FROM LANDING PAGE */
        .nav-bar {
            display: flex;
            align-items: center;
            height: 80px;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            background-color: #35475B;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 80px;
            padding: 0 20px;
            max-width: 1600px;
            position: fixed;
            overflow-x: auto;
            overflow-y: hidden;
            scrollbar-width: none;
            -ms-overflow-style: none;
            -webkit-overflow-scrolling: touch;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 10px;
        }

        .web-title {
            color: #2DAF89;
            position: relative;
            font-size: 24px;
            font-weight: 600;
        }

        .nav-container .nav-menu {
            display: flex;
            text-align: center;
            gap: 60px;
            list-style: none;
        }

        .nav-container .nav-menu .nav-link a {
            text-decoration: none;
            color: white;
            white-space: nowrap;
            position: relative;
            cursor: pointer;
        }

        .nav-link {
            font-size: 18px;
            cursor: pointer;
        }

        .nav-container::-webkit-scrollbar {
            display: none;
        }

        .nav-underline {
            margin-left: -6px;
            margin-right: -6px;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.25s ease-in-out;
            border: none;
            border-radius: 10px;
            height: 2.5px;
            background-color: #2DAF89;
        }

        .default-underline {
            margin-left: -6px;
            margin-right: -6px;
            transform: scaleX(1);
        }

        .nav-link:hover .nav-underline {
            transform: scaleX(1);
        }

        /* MAIN CONTENT */
        .main-content {
            padding-top: 100px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .profile-card {
            background-color: white;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #E1E1E1;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background-color: #35475B;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
        }

        .profile-info h2 {
            color: black;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #666;
            margin-bottom: 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #2DAF89;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .tabs {
            display: flex;
            gap: 0;
            margin-bottom: 30px;
        }

        .tab {
            flex: 1;
            padding: 15px 20px;
            background-color: #D9D9D9;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
            color: #666;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .tab:first-child {
            border-radius: 10px 0 0 0;
        }

        .tab:last-child {
            border-radius: 0 10px 0 0;
        }

        .tab.active {
            background-color: #B8B8B8;
            color: black;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .section-title {
            color: black;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .info-display {
            background-color: #F9F9F9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #E1E1E1;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label-display {
            font-weight: 600;
            color: #35475B;
        }

        .info-value-display {
            color: #333;
        }

        .edit-section {
            background-color: #F9F9F9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-weight: 500;
            color: #35475B;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            padding: 12px 15px;
            border: 1px solid #D9D9D9;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            background-color: white;
            transition: all 0.3s;
        }

        input::placeholder {
            color: #999;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2DAF89;
            background-color: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #2DAF89;
            color: white;
        }

        .btn-primary:hover {
            background-color: #258f6f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .toggle-edit-btn {
            background-color: #35475B;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .toggle-edit-btn:hover {
            background-color: #2c3a4a;
        }

            /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
           height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
           animation: fadeIn 0.3s;
        }

        .modal-content {
           background-color: white;
           margin: 5% auto;
           padding: 30px;
           border-radius: 10px;
          width: 90%;
         max-width: 600px;
         box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
         max-height: 80vh;
         overflow-y: auto;
         animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
            transform: translateY(-50px);
            opacity: 0;
        }
            to {
        transform: translateY(0);
        opacity: 1;
        }
}

        .close-modal {
        color: #666;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        line-height: 20px;
        }

        .close-modal:hover {
        color: #E74C3C;
    }

        .required {
            color: #E74C3C;
        }
    </style>
</head>
<body>

<!-- NAVIGATION BAR -->
<nav class="nav-bar">
    <div class="nav-container">
        <div class="logo">
            <img src="logo.png" alt="LifeLink Logo" class="logo-icon">
            <h2 class="web-title">LifeLink</h2>
        </div>
        <ul class="nav-menu">
            <li class="nav-link" onclick="location.href='donation.php'">
                <a>Donation</a>
                <hr class="nav-underline">
            </li>
            <li class="nav-link" onclick="location.href='notification.php'">
                <a>Notification</a>
                <hr class="nav-underline">
            </li>
            <li class="nav-link" onclick="location.href='history.php'">
                <a>Donation History</a>
                <hr class="nav-underline">
            </li>
            <li class="nav-link">
                <a>Profile</a>
                <hr class="nav-underline default-underline">
            </li>
        </ul>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div id="profile" class="page active">
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar">👤</div>
                <div class="profile-info">
                    <h2><?= htmlspecialchars($user['full_name'] ?? 'User') ?></h2>
                    <p><?= htmlspecialchars($user['email'] ?? 'email@example.com') ?></p>
                    <span class="status-badge"><?= htmlspecialchars($user['status'] ?? 'Active') ?></span>
                </div>
            </div>

            <div class="tabs">
                <button class="tab active" onclick="switchTab(0)">Account Info</button>
                <button class="tab" onclick="switchTab(1)">Medical Info</button>
            </div>

            <!-- ACCOUNT INFO TAB -->
            <div class="tab-content active" id="tab0">
                <h3 class="section-title">Account Information</h3>
                
                <!-- View Account Info -->
                <div class="info-display">
                    <div class="info-row">
                        <span class="info-label-display">User ID:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['user_id'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Username:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['username'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Full Name:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['full_name'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Email:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['email'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Phone Number:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['phone'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Location:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['location'] ?? 'N/A') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label-display">Account Created:</span>
                        <span class="info-value-display"><?= htmlspecialchars($user['created_at'] ?? 'N/A') ?></span>
                    </div>
                </div>

                <button class="toggle-edit-btn" onclick="openModal()">✏️ Edit My Account</button>

                <!-- Edit Account Info (Hidden by default) -->
                <div id="editModal" class="modal">
                   <div class="modal-content">
                        <span class="close-modal" onclick="closeModal()">&times;</span>
                            <h3 class="section-title">Edit Account Information</h3>
                                <form method="POST">
                                    <input type="hidden" name="section" value="account">


                        <label>
                            Username: <span class="required">*</span>
                            <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" placeholder="Enter username" required>
                        </label>

                        <label>
                            Full Name: <span class="required">*</span>
                            <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'] ?? '') ?>" placeholder="Enter your full name" required>
                        </label>

                        <label>
                            Email: <span class="required">*</span>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" placeholder="Enter your email" required>
                        </label>

                        <label>
                            Phone Number:
                            <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="e.g., 09123456789">
                        </label>

                        <label>
                            Location:
                            <input type="text" name="location" value="<?= htmlspecialchars($user['location'] ?? '') ?>" placeholder="e.g., Manila, Philippines">
                        </label>

                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- MEDICAL INFO TAB -->
            <div class="tab-content" id="tab1">
                <h3 class="section-title">Medical Information</h3>

                <form method="POST">
                    <input type="hidden" name="section" value="medical">

                    <div class="form-row">
                        <label>
                            Age:
                            <input type="number" name="age" value="<?= htmlspecialchars($medical['age'] ?? '') ?>" placeholder="e.g., 25" min="18" max="100">
                        </label>

                        <label>
                            Gender:
                            <select name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?= ($medical['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($medical['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= ($medical['gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            Blood Type:
                            <select name="blood_type">
                                <option value="">Select Blood Type</option>
                                <option value="A+" <?= ($medical['blood_type'] ?? '') == 'A+' ? 'selected' : '' ?>>A+</option>
                                <option value="A-" <?= ($medical['blood_type'] ?? '') == 'A-' ? 'selected' : '' ?>>A-</option>
                                <option value="B+" <?= ($medical['blood_type'] ?? '') == 'B+' ? 'selected' : '' ?>>B+</option>
                                <option value="B-" <?= ($medical['blood_type'] ?? '') == 'B-' ? 'selected' : '' ?>>B-</option>
                                <option value="AB+" <?= ($medical['blood_type'] ?? '') == 'AB+' ? 'selected' : '' ?>>AB+</option>
                                <option value="AB-" <?= ($medical['blood_type'] ?? '') == 'AB-' ? 'selected' : '' ?>>AB-</option>
                                <option value="O+" <?= ($medical['blood_type'] ?? '') == 'O+' ? 'selected' : '' ?>>O+</option>
                                <option value="O-" <?= ($medical['blood_type'] ?? '') == 'O-' ? 'selected' : '' ?>>O-</option>
                            </select>
                        </label>

                        <label>
                            Organ Type:
                            <select name="organ_type">
                                <option value="">Select Organ Type</option>
                                <option value="Kidney" <?= ($medical['organ_type'] ?? '') == 'Kidney' ? 'selected' : '' ?>>Kidney</option>
                                <option value="Liver" <?= ($medical['organ_type'] ?? '') == 'Liver' ? 'selected' : '' ?>>Liver</option>
                                <option value="Heart" <?= ($medical['organ_type'] ?? '') == 'Heart' ? 'selected' : '' ?>>Heart</option>
                                <option value="Lung" <?= ($medical['organ_type'] ?? '') == 'Lung' ? 'selected' : '' ?>>Lung</option>
                                <option value="Pancreas" <?= ($medical['organ_type'] ?? '') == 'Pancreas' ? 'selected' : '' ?>>Pancreas</option>
                                <option value="Cornea" <?= ($medical['organ_type'] ?? '') == 'Cornea' ? 'selected' : '' ?>>Cornea</option>
                                <option value="Bone Marrow" <?= ($medical['organ_type'] ?? '') == 'Bone Marrow' ? 'selected' : '' ?>>Bone Marrow</option>
                            </select>
                        </label>
                    </div>

                    <button class="btn btn-primary" type="submit">Save Medical Information</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
function switchTab(i) {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");
    
    tabs.forEach((tab, index) => {
        if (index === i) {
            tab.classList.add("active");
            contents[index].classList.add("active");
        } else {
            tab.classList.remove("active");
            contents[index].classList.remove("active");
        }
    });

}

function openModal() {
    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>

</body>
</html>

<?php
mysqli_close($conn);
?>
