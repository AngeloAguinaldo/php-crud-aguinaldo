<?php
require 'config/db.php';
$branches = ['Quezon City Branch','Antipolo City Branch','Binalonan Branch','North Manila Branch','Guimba Branch'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $student_no = trim($_POST['student_no']);
  $fullname   = trim($_POST['fullname']);
  $branch     = trim($_POST['branch']);
  $email      = trim($_POST['email']);
  $contact    = trim($_POST['contact']);

  if ($student_no && $fullname && $branch && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $pdo->prepare("INSERT INTO students (student_no, fullname, branch, email, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$student_no, $fullname, $branch, $email, $contact]);
    $message = "✅ Student added successfully!";
  } else {
    $message = "⚠️ Please fill out all required fields correctly.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Student</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: radial-gradient(circle at 20% 20%, #3a0066, #000);
  color: #fff;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
}
.glass {
  background: rgba(255,255,255,0.08);
  backdrop-filter: blur(16px);
  border-radius: 20px;
  padding: 40px;
  width: 90%;
  max-width: 600px;
  box-shadow: 0 0 25px rgba(255,255,255,0.15);
}
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
.header h2 {
  margin: 0;
}
input, select {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: none;
  border-radius: 8px;
  background: rgba(255,255,255,0.15);
  color: #fff;
  box-sizing: border-box;
}
select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='white' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  padding-right: 35px;
}
button {
  width: 70%;
  padding: 15px;
  border: none;
  border-radius: 8px;
  background: linear-gradient(90deg, #ff00cc, #3333ff);
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  display: block;
  margin: 0 auto;
}
button:hover { opacity: 0.9; }
a.back { color: #aaf; text-decoration: none; }
.message { margin-bottom: 15px; color: #ffd1d1; }
</style>
</head>
<body>
<div class="glass">
  <div class="header">
    <h2>Add Student</h2>
    <a href="index.php" class="back">← Back to Menu</a>
  </div>

  <?php if ($message): ?><p class="message"><?= $message ?></p><?php endif; ?>

  <form method="post">
    <input name="student_no" placeholder="Student Number" required>
    <input name="fullname" placeholder="Full Name" required>
    <select name="branch" required>
      <option value="">Select Branch</option>
      <?php foreach ($branches as $b): ?>
      <option value="<?= $b ?>"><?= $b ?></option>
      <?php endforeach; ?>
    </select>
    <input type="email" name="email" placeholder="Email" required>
    <input name="contact" placeholder="Contact Number">
    <button type="submit">Add Student</button>
  </form>
</div>
</body>
</html>