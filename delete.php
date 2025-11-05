<?php
require 'config/db.php';

$id = $_GET['id'] ?? null;
$message = '';

if ($id) {
  $stmt = $pdo->prepare("SELECT fullname FROM students WHERE id = ?");
  $stmt->execute([$id]);
  $student = $stmt->fetch();

  if (!$student) {
    $message = "⚠️ Student not found.";
  }

  if (isset($_POST['confirm_delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $message = "🗑️ Student record deleted successfully! Redirecting...";
    echo "<meta http-equiv='refresh' content='2;url=read.php'>";
  }
} else {
  $message = "⚠️ No student ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Student</title>
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
  text-align: center;
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
.warning-box {
  background: rgba(255, 80, 80, 0.1);
  border: 1px solid rgba(255, 100, 100, 0.4);
  border-radius: 10px;
  padding: 20px;
  margin-top: 20px;
  color: #ffaaaa;
}
.warning-title {
  font-size: 1.2em;
  color: #ff5555;
  font-weight: bold;
}
button {
  padding: 12px 25px;
  margin: 10px;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  color: #fff;
  font-size: 1rem;
}
.btn-delete {
  background: linear-gradient(90deg, #ff0000, #ff6600);
}
.btn-cancel {
  background: linear-gradient(90deg, #5555ff, #9900ff);
  text-decoration: none;
  padding: 12px 25px;
  border-radius: 8px;
  display: inline-block;
}
a.back { color: #aaf; text-decoration: none; }
.message { margin-bottom: 15px; color: #ffd1d1; }
</style>
</head>
<body>
<div class="glass">
  <div class="header">
    <h2>Delete Student</h2>
    <a href="read.php" class="back">← Back to Records</a>
  </div>

  <?php if ($message): ?>
    <p class="message"><?= $message ?></p>
  <?php endif; ?>

  <?php if (!empty($student) && !isset($_POST['confirm_delete'])): ?>
    <div class="warning-box">
      <p class="warning-title">⚠️ Warning: This action cannot be undone!</p>
      <p>Are you sure you want to permanently delete the record for:</p>
      <h3 style="color:#fff;"><?= htmlspecialchars($student['fullname']) ?></h3>
    </div>

    <form method="post">
      <button type="submit" name="confirm_delete" class="btn-delete">Yes, Delete</button>
      <a href="read.php" class="btn-cancel">Cancel</a>
    </form>
  <?php endif; ?>
</div>
</body>
</html>