<?php
/**
 * Script untuk import database ke Railway MySQL
 * 
 * Usage di Railway:
 * php database/import-railway.php
 * 
 * Atau set sebagai startup command sementara:
 * php database/import-railway.php && php artisan serve --host=0.0.0.0 --port=$PORT
 */

$host = getenv('MYSQL_HOST') ?: 'trolley.proxy.rlwy.net';
$port = getenv('MYSQL_PORT') ?: '51434';
$username = getenv('MYSQLUSER') ?: getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: 'XVCsfIMalQZPutvibBHNBkToOiUajrWv';
$database = getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'railway';

// Jika menggunakan Railway MySQL service, ambil dari environment variables
if (getenv('MYSQL_HOST')) {
    $host = getenv('MYSQL_HOST');
    $port = getenv('MYSQL_PORT') ?: '3306';
    $username = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');
    $database = getenv('MYSQLDATABASE');
}

$sqlFile = __DIR__ . '/../../cl1kn4.sql';

echo "=== Import Database ke Railway MySQL ===\n\n";

try {
    // Baca file SQL
    if (!file_exists($sqlFile)) {
        // Coba cari di parent directory
        $sqlFile = __DIR__ . '/../../../cl1kn4.sql';
        if (!file_exists($sqlFile)) {
            die("❌ Error: File SQL tidak ditemukan. Pastikan file cl1kn4.sql ada di Downloads/\n");
        }
    }
    
    echo "📄 File SQL: $sqlFile\n";
    echo "🔌 Host: $host:$port\n";
    echo "📦 Database: $database\n\n";
    
    $sql = file_get_contents($sqlFile);
    
    if (empty($sql)) {
        die("❌ Error: File SQL kosong\n");
    }
    
    // Buat koneksi
    echo "🔌 Menghubungkan ke database...\n";
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        ]
    );
    
    // Buat database jika belum ada
    echo "📦 Membuat database '$database' jika belum ada...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$database`");
    
    echo "✅ Database '$database' siap.\n\n";
    echo "📥 Memulai import SQL...\n";
    
    // Hapus SET commands yang tidak perlu
    $sql = preg_replace('/^SET\s+[^;]+;$/m', '', $sql);
    $sql = preg_replace('/^START\s+TRANSACTION;$/m', '', $sql);
    $sql = preg_replace('/^COMMIT;$/m', '', $sql);
    
    // Hapus komentar
    $sql = preg_replace('/^--.*$/m', '', $sql);
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
    
    // Split by semicolon, handle string literals
    $statements = [];
    $current = '';
    $inString = false;
    $stringChar = '';
    $len = strlen($sql);
    
    for ($i = 0; $i < $len; $i++) {
        $char = $sql[$i];
        $current .= $char;
        
        // Handle string literals
        if (($char === '"' || $char === "'") && ($i === 0 || $sql[$i-1] !== '\\')) {
            if (!$inString) {
                $inString = true;
                $stringChar = $char;
            } elseif ($char === $stringChar) {
                $inString = false;
                $stringChar = '';
            }
        }
        
        // Split on semicolon when not in string
        if ($char === ';' && !$inString) {
            $stmt = trim($current);
            if (!empty($stmt) && strlen($stmt) > 5) {
                if (!preg_match('/^(SET|START|COMMIT|\/\*|\-\-)/i', $stmt)) {
                    $statements[] = $stmt;
                }
            }
            $current = '';
        }
    }
    
    // Add remaining statement
    if (!empty(trim($current))) {
        $stmt = trim($current);
        if (strlen($stmt) > 5 && !preg_match('/^(SET|START|COMMIT|\/\*|\-\-)/i', $stmt)) {
            $statements[] = $stmt;
        }
    }
    
    echo "📊 Ditemukan " . count($statements) . " statements untuk dieksekusi\n\n";
    
    $success = 0;
    $skipped = 0;
    $errors = 0;
    
    foreach ($statements as $index => $statement) {
        if (empty(trim($statement))) {
            continue;
        }
        
        try {
            $pdo->exec($statement);
            $success++;
            
            if (($index + 1) % 50 == 0) {
                echo "⏳ Progress: " . ($index + 1) . "/" . count($statements) . " statements...\n";
            }
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            
            // Skip errors untuk objects yang sudah ada
            if (strpos($errorMsg, 'already exists') !== false || 
                strpos($errorMsg, 'Duplicate') !== false ||
                (strpos($errorMsg, 'Table') !== false && strpos($errorMsg, 'doesn\'t exist') === false)) {
                $skipped++;
            } else {
                $errors++;
                if ($errors <= 5) {
                    echo "⚠️  Warning: " . substr($errorMsg, 0, 100) . "\n";
                }
            }
        }
    }
    
    echo "\n";
    echo "✅ Import selesai!\n";
    echo "   ✓ Berhasil: $success statements\n";
    echo "   ⊘ Dilewati: $skipped statements (sudah ada)\n";
    if ($errors > 0) {
        echo "   ✗ Error: $errors statements\n";
    }
    
    // Cek tables
    echo "\n📋 Daftar tabel di database:\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $count = $pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        echo "   - $table ($count rows)\n";
    }
    
    echo "\n✅ Database import berhasil!\n";
    
} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage() . "\n");
} catch (Exception $e) {
    die("❌ Error: " . $e->getMessage() . "\n");
}

