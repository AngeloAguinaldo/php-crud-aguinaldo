<?php
require 'config/db.php';

$id = $_GET['id'] ?? null;
$message = '';

if ($id) {
  $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
  $stmt->execute([$id]);
  $student = $stmt->fetch();

  if (!$student) {
    $message = "⚠️ Student not found.";
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_no = trim($_POST['student_no']);
    $fullname   = trim($_POST['fullname']);
    $branch     = trim($_POST['branch']);
    $email      = trim($_POST['email']);
    $contact    = trim($_POST['contact']);

    if ($student_no && $fullname && $branch && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $stmt = $pdo->prepare("UPDATE students SET student_no=?, fullname=?, branch=?, email=?, contact=? WHERE id=?");
      $stmt->execute([$student_no, $fullname, $branch, $email, $contact, $id]);
      
      $message = "✅ Student record updated successfully! Redirecting...";
      
      echo "<meta http-equiv='refresh' content='2;url=read.php'>";
    } else {
      $message = "⚠️ Please fill all required fields correctly.";
    }
  }
} else {
  $message = "⚠️ No student ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Student</title>
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
input {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: none;
  border-radius: 8px;
  background: rgba(255,255,255,0.15);
  color: #fff;
  box-sizing: border-box;
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
    <h2>Update Student</h2>
    <a href="read.php" class="back">← Back to Records</a>
  </div>

  <?php if ($message): ?><p class="message"><?= $message ?></p><?php endif; ?>

  <?php if (!empty($student)): ?>
  <form method="post">
    <input name="student_no" value="<?= htmlspecialchars($student['student_no']) ?>" placeholder="Student Number" required>
    <input name="fullname" value="<?= htmlspecialchars($student['fullname']) ?>" placeholder="Full Name" required>
    <input name="branch" value="<?= htmlspecialchars($student['branch']) ?>" placeholder="Branch" required>
    <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" placeholder="Email" required>
    <input name="contact" value="<?= htmlspecialchars($student['contact']) ?>" placeholder="Contact (optional)">
    <button type="submit">Save Changes</button>
  </form>
  <?php endif; ?>
</div>
</body>
</html>