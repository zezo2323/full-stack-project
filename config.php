<?php
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'ecommerce_db';
        
        try {
            mysqli_report(MYSQLI_REPORT_OFF);
            $this->conn = new mysqli($host, $username, $password, $database);
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
            if ($this->conn->connect_error) {
                die("فشل الاتصال بقاعدة البيانات: " . $this->conn->connect_error);
            }
        
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            die("حدث خطأ أثناء الاتصال بقاعدة البيانات. يرجى المحاولة مرة أخرى لاحقاً.");
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    private function executeStatement($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            throw new mysqli_sql_exception("خطأ في إعداد الاستعلام: " . $this->conn->error . " SQL: " . $sql);
        }
        
        if (!empty($params)) {
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_double($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
            }
            $stmt->bind_param($types, ...$params);
        }
        
        if (!$stmt->execute()) {
             throw new mysqli_sql_exception("خطأ في تنفيذ الاستعلام: " . $stmt->error . " SQL: " . $sql);
        }
        
        return $stmt;
    }
    
    public function fetchAll($sql, $params = []) {
        $stmt = $this->executeStatement($sql, $params);
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }
    public function fetchOne($sql, $params = []) {
        $stmt = $this->executeStatement($sql, $params);
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? $row : null;
    }
    public function execute($sql, $params = []) {
        $stmt = $this->executeStatement($sql, $params);
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $affected_rows;
    }
    public function insert($sql, $params = []) {
        $stmt = $this->executeStatement($sql, $params);
        $insert_id = $this->conn->insert_id;
        $stmt->close();
        return $insert_id;
    }
}
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function generateSessionToken() {
    return bin2hex(random_bytes(32));
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
