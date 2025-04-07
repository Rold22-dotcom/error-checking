<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    
</body>
</html>
<?php
/*$plain = '123456789halohalo1';
$hash = '$2y$10$uNJehLzq0DOd6qOVBUw/BuZM6/v0YjnzcEpPOfZY.nD3rSsg6SDMa';

if (password_verify($plain, $hash)) {
    echo "Password is correct!";
} else {
    echo "Password is incorrect.";
} */
//$password = " 123456789halohalo1";
//$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//echo "Hashed Password: " . $hashedPassword;
?>
<?php
$password = '123456789halohalo1';
$hash = '$2y$10$tTu/G5zjGL3YkQEhLA.yXeHvc9p8YXAjIYGBuaJfyOVpm00YjZuXO'; //password_hash($password, PASSWORD_BCRYPT);

echo "Password: $password<br>";
echo "Generated Hash: $hash<br>";

if (password_verify($password, $hash)) {
    echo "✅ Match!";
} else {
    echo "❌ Mismatch.";
}


?>