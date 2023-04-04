<?php
function db_get_pdo()
{
    $host = 'localhost';
    $port = '3306';
    $dbname = 'phtw';
    $charset = 'utf8';
    $username = 'root';
    $db_pw = "root506";
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $db_pw);
    $db_option   = array(
        PDO::ATTR_EMULATE_PREPARES    => false //DB의 prepared statement 기능을 사용하도록 설정
        , PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION //PDO Exception을 Thorws 하도록 설정
        , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // 연상배열로 Fetch를 하도록 설정  
    );
    $param_conn = new PDO($dsn, $username, $db_pw, $db_option);
    return $pdo;
}

function db_select($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $st->execute($param);
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_insert($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $last_id = $pdo->lastInsertId();
        $pdo = null;
        if ($result) {
            return $last_id;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

function db_update_delete($query, $param = array())
{
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        $pdo = null;
        return $result;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null;
    }
}

$login_id = isset($_POST['login_id']) ? $_POST['login_id'] : null;
$login_pw = isset($_POST['login_pw']) ? $_POST['login_pw'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null){    
    header("Location: /login.php");
    exit();
}

// 회원 데이터
$member_data = db_select("SELECT * from tbl_member where login_id = ?", array($login_id));

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0){
    header("Location: /login.php");
    exit();
}

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['login_pw']);

// 비밀번호 불일치
if ($is_match_password === false){
    header("Location: /login.php");
    exit();
}

session_start();
$_SESSION['member_id'] = $member_data[0]['member_id'];

// 목록으로 이동
header("Location: /list.php");

$login_id = isset($_POST['login_id']) ? $_POST['login_id'] : null;
$login_pw = isset($_POST['login_pw']) ? $_POST['login_pw'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null) {
    header("Location: /login.php");
    exit();
}

// 회원 데이터
$member_data = db_select("SELECT * from tbl_member where login_id = ?", array($login_id));

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0) {
    header("Location: /login.php");
    exit();
}

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['login_pw']);

// 비밀번호 불일치
if ($is_match_password === false) {
    header("Location: /login.php");
    exit();
}

session_start();
$_SESSION['member_id'] = $member_data[0]['member_id'];

// 목록으로 이동
header("Location: /list.php");
?>