<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydata";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$title = $_POST['title'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birth_date = $_POST['birth_date'];

// คำนวณอายุ
$birthDate = new DateTime($birth_date);
$today = new DateTime();
$age = $today->diff($birthDate)->y;

// จัดการไฟล์รูปภาพ
$profile_image = "";
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    $name = basename($_FILES['profile_image']['name']);
    $profile_image = "uploads/" . $name;
    move_uploaded_file($tmp_name, $profile_image);
}


$sql = "INSERT INTO users (title, first_name, last_name, birth_date, profile_image)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $title, $first_name, $last_name, $birth_date, $profile_image);

if ($stmt->execute()) {
    echo "บันทึกข้อมูลสำเร็จ"."<br>";
    echo "<a href = 'insert.php'>กลับไปหน้าแรก</a>";
} else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>