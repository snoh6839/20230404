<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #FFE0AC;
            --button-bg-color: #6886C5;
            --button-text-color: #fff;
            --default-text-color: #846A52;
            --active-button-color: #FFACB7;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            width: 100vw;
            height: 100vh;
        }

        /* 사이드 바 */
        .sidebar {
            background-color: var(--bg-color);
            border-radius: 15px;
            padding: 20px;
            width: 20%;
            margin-right: 20px;
            height: 80vh;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: var(--button-text-color);
            text-decoration: none;
            background-color: var(--button-bg-color);
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: var(--active-button-color);
            color: var(--button-text-color);
        }

        /* 로그인 화면 */
        .login {

            background-color: var(--bg-color);
            border-radius: 15px;
            padding: 20px;
            width: 60%;
            height: 80vh;
        }

        .login input[type="text"],
        .login input[type="password"] {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 80%;
        }

        .login button {
            padding: 10px;
            background-color: var(--button-bg-color);
            border: none;
            border-radius: 5px;
            color: var(--button-text-color);
        }

        .login button:hover {
            background-color: var(--active-button-color);
        }

        /* 반응형 */
        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                margin-right: 0;
                margin-bottom: 20px;
                width: 100%;
            }

            .login {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <a href="#" class="active">홈</a>
            <a href="#">리스트</a>
            <a href="#">디테일</a>
            <a href="#">캘린더</a>
        </div>

        <div class="login">
            <h1>Login Page</h1>
            <form method="post" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
</body>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // DB 연결 정보
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root506";
    $dbname = "todoist";

    try {
        // PDO 객체 생성
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);

        // PDO 예외 처리 모드 설정
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 쿼리 실행
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        // 결과 확인
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['username'] = $result["username"];
            echo "<div class='success'>Welcome, {$_SESSION['username']}! You have successfully logged in.</div>";
            exit();
        } else {
            $login_error = "Invalid username or password.";
            echo "<div class='error'>$login_error</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // 연결 종료
    $conn = null;
}
?>

</html>