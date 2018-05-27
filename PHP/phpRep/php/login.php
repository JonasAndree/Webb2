
<div id="login-status">

	<div id="form-container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
			method="post">
			Mail: <input type="email" name="mail" required><br> Password: <input
				type="password" name="password" required><br> <input id="submit"
				type="submit">
		</form>
	</div>

	<div id="log-out">
		Mail:<b id="logedin-mail"></b>
		<button onclick="logout()">Log out</button>
	</div>
</div>

<?php
$mail = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alEnterd = true;
    if (! empty($_POST["mail"])) {
        $mail = test_input($_POST["mail"]);
    } else {
        $alEnterd = false;
        echo "Pleace select a mail! <br>";
    }
    if (! empty($_POST["password"])) {
        $password = test_input($_POST["password"]);
    } else {
        $alEnterd = false;
        echo "Pleace select a password! <br>";
    }
    if ($alEnterd == true) {
        $conn = new mysqli("localhost", "root", "", "herodb");
        if ($conn->connect_error) {
            die("<div id='failed'>Connection failed: " . $conn->connect_error . "<div><br>");
        } else {
            echo "<div id='success'>Connection successful.<div><br>";
        }
        $sql = "SELECT * FROM `users` WHERE mail='$mail' AND password='$password'";
        $users = $conn->query($sql);
        $user_array = $users->fetch_assoc();
        if (! empty($user_array)) {
            echo "<br>The username and password is ok!<br>";
            echo "<script>document.getElementById('logedin-mail').innerHTML = ' " . $user_array["mail"] . "'</script>";
            echo "<script>document.getElementById('form-container').style.display = 'none';</script>";
            echo "<script>document.getElementById('log-out').style.display = 'inline-block';</script>";
        } else {
            echo "<br>Incorrect password or mail.";
        }
        $conn->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

