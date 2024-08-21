<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูล</title>
</head>
<body>
    <h1>บันทึกข้อมูลผู้ใช้</h1>
    <form action="insertdata.php" method="post" enctype="multipart/form-data">
        <label for="title">คำนำหน้าชื่อ:</label>
        <select id="title" name="title" required>
            <option value="นาย">นาย</option>
            <option value="นาง">นาง</option>
            <option value="นางสาว">นางสาว</option>
        </select>
        <br>
        <label for="first_name">ชื่อ:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>
        <label for="last_name">นามสกุล:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>
        <label for="birth_date">วันเดือนปีเกิด:</label>
        <input type="date" id="birth_date" name="birth_date" required>
        <br>
        <label for="profile_image">รูปภาพโปรไฟล์:</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*">
        <br>
        <button type="submit">บันทึกข้อมูล</button>
    
    </form>
    <br>
    <a href = "list.php">แสดงการบันทึก</a>
</body>
</html>