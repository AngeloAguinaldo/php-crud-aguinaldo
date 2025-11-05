<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Branch Directory System</title>
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
}
.container {
  text-align: center;
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(16px);
  padding: 50px 60px;
  border-radius: 25px;
  box-shadow: 0 0 25px rgba(255,255,255,0.15);
  width: 90%;
  max-width: 500px;
}
h1 {
  font-size: 1.8em;
  margin-bottom: 30px;
  background: linear-gradient(90deg, #ff00cc, #3333ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.nav-menu {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
a.btn {
  text-decoration: none;
  color: #fff;
  background: linear-gradient(90deg, #ff00cc, #3333ff);
  padding: 12px 0;
  border-radius: 12px;
  font-weight: 500;
  transition: transform 0.2s, opacity 0.2s;
}
a.btn:hover {
  opacity: 0.85;
  transform: scale(1.03);
}
.footer {
  margin-top: 30px;
  font-size: 0.85em;
  color: rgba(255,255,255,0.7);
}
</style>
</head>
<body>
  <div class="container">
    <h1>Student Branch Directory System</h1>
    <div class="nav-menu">
      <a href="create.php" class="btn">➕ Add Student</a>
      <a href="read.php" class="btn">📋 View Students</a>
      <a href="read.php" class="btn">✏️ Update Student</a>
      <a href="read.php" class="btn">🗑️ Delete Student</a>
    </div>
  </div>
</body>
</html>