<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ค้นหาและเรียงลำดับ
$search = $_GET['search'] ?? '';
$order_by = $_GET['order_by'] ?? 'age';

// สร้างคำสั่ง SQL สำหรับการค้นหาและเรียงลำดับ
$sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age FROM users WHERE CONCAT(first_name, ' ', last_name) LIKE ? ORDER BY $order_by";
$stmt = $conn->prepare($sql);
$search_term = "%$search%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสมาชิก</title>
</head>
<body>
    <h1>รายการสมาชิก</h1>

    <!-- ฟอร์มค้นหาและการจัดเรียง -->
    <form action="list.php" method="get">
        <label for="search">ค้นหาชื่อ-นามสกุล:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <br>
        <label for="order_by">จัดเรียงตาม:</label>
        <select id="order_by" name="order_by">
            <option value="age" <?php if ($order_by == 'age') echo 'selected'; ?>>อายุ</option>
            <option value="first_name" <?php if ($order_by == 'first_name') echo 'selected'; ?>>ชื่อ</option>
            <option value="last_name" <?php if ($order_by == 'last_name') echo 'selected'; ?>>นามสกุล</option>
        </select>
        <button type="submit">ค้นหา</button>
    </form>

    <!-- แสดงผลข้อมูล -->
    <?php while ($row = $result->fetch_assoc()) { ?>
        <p>
            <?php echo htmlspecialchars($row['title']) . ' ' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?>
            - อายุ: <?php echo htmlspecialchars($row['age']); ?> ปี
        </p>
        <?php if ($row['profile_image']) { ?>
            <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Profile Image" width="100">
        <?php } ?>
        <br>
        <a href="update_form.php?id=<?php echo htmlspecialchars($row['id']); ?>">แก้ไข</a> |
        <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>">ลบ</a>
        <hr>
    <?php } ?>

    <?php
    $stmt->close();
    $conn->close();
 ?>
 <br>
 <br>
 <br>
 
 

<a href = 'insert.php'>กลับไปหน้าแรก</a>
</body>
</html>