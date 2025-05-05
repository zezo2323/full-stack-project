<?php
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database_schema_final';
        
        try {
            mysqli_report(MYSQLI_REPORT_OFF);
            $this->conn = new mysqli($host, $username, $password, $database);
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
            if ($this->conn->connect_error) {
                die("Database connection failed: " . $this->conn->connect_error);
            }
        
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            die("Error connecting to database. Please try again later.");
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
    
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            
            if (!empty($params)) {
                $types = '';
                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= 'i';
                    } elseif (is_float($param)) {
                        $types .= 'd';
                    } elseif (is_string($param)) {
                        $types .= 's';
                    } else {
                        $types .= 'b';
                    }
                }
                
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            error_log("Query error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->query($sql, $params);
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("FetchAll error: " . $e->getMessage());
            return [];
        }
    }
    
    public function fetchOne($sql, $params = []) {
        try {
            $stmt = $this->query($sql, $params);
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("FetchOne error: " . $e->getMessage());
            return null;
        }
    }
    
    public function insert($sql, $params = []) {
        try {
            $stmt = $this->query($sql, $params);
            return $this->conn->insert_id;
        } catch (Exception $e) {
            error_log("Insert error: " . $e->getMessage());
            return false;
        }
    }
    
    public function update($sql, $params = []) {
        try {
            $stmt = $this->query($sql, $params);
            return $stmt->affected_rows;
        } catch (Exception $e) {
            error_log("Update error: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete($sql, $params = []) {
        try {
            $stmt = $this->query($sql, $params);
            return $stmt->affected_rows;
        } catch (Exception $e) {
            error_log("Delete error: " . $e->getMessage());
            return false;
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Helper functions
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

function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>