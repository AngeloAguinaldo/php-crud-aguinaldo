<?php
require 'config/db.php';

$stmt = $pdo->query("SELECT * FROM students ORDER BY id ASC");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Students</title>
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
  padding: 30px;
  width: 90%;
  max-width: 1000px;
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
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  text-align: left;
}
th, td {
  padding: 12px 14px;
  border-bottom: 1px solid rgba(255,255,255,0.15);
  vertical-align: middle;
}
th {
  color: #ffccff;
  font-weight: 600;
}
td {
  color: rgba(255,255,255,0.9);
}
a.btn {
  display: inline-block;
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 6px;
  color: #fff;
  background: linear-gradient(90deg, #ff00cc, #3333ff);
  font-size: 0.9rem;
  transition: opacity 0.2s ease-in-out;
  margin-right: 8px;
  margin-bottom: 8px;
  min-width: 60px;
  text-align: center;
}
a.btn:hover {
  opacity: 0.85;
}
.back-link {
  text-decoration: none;
  color: #aaf;
  font-weight: 500;
}
</style>
</head>
<body>
<div class="glass">
  <div class="header">
    <h2>Student Records</h2>
    <a href="index.php" class="back-link">← Back to Menu</a>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Student No</th>
      <th>Full Name</th>
      <th>Branch</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Date Added</th>
      <th>Actions</th>
    </tr>

    <?php if (empty($students)): ?>
      <tr><td colspan="8" style="text-align:center;">No records found.</td></tr>
    <?php else: ?>
      <?php foreach ($students as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['student_no']) ?></td>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= htmlspecialchars($row['branch']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['contact']) ?></td>
          <td><?= htmlspecialchars($row['date_added']) ?></td>
          <td>
            <a href="update.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Delete this record?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</div>
</body>
</html>