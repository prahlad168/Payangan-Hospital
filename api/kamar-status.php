<?php
/**
 * API: Kamar Status - RS Payangan Hospital
 * Returns real-time room availability data
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../rs-admin/config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

$action = $_GET['action'] ?? 'read';

if ($action === 'read') {
    // Get all rooms with availability
    $sql = "SELECT * FROM kamar ORDER BY lantai, kelas, nomor";
    $result = $conn->query($sql);
    
    $rooms = [];
    $summary = [
        'lantai_1' => ['total' => 0, 'terpakai' => 0, 'tersedia' => 0],
        'lantai_2' => ['total' => 0, 'terpakai' => 0, 'tersedia' => 0],
        'lantai_3' => ['total' => 0, 'terpakai' => 0, 'tersedia' => 0],
        'isolasi' => ['total' => 0, 'terpakai' => 0, 'tersedia' => 0],
        'total' => ['total' => 0, 'terpakai' => 0, 'tersedia' => 0]
    ];
    
    while ($row = $result->fetch_assoc()) {
        $row['tersedia'] = $row['kapasitas'] - $row['terpakai'];
        $rooms[] = $row;
        
        // Update summary
        if ($row['lantai'] == 1) {
            $key = 'lantai_1';
        } elseif ($row['lantai'] == 2) {
            $key = 'lantai_2';
        } elseif ($row['lantai'] == 3) {
            $key = 'lantai_3';
        } else {
            $key = 'isolasi';
        }
        
        $summary[$key]['total'] += $row['kapasitas'];
        $summary[$key]['terpakai'] += $row['terpakai'];
        $summary[$key]['tersedia'] += $row['tersedia'];
        $summary['total']['total'] += $row['kapasitas'];
        $summary['total']['terpakai'] += $row['terpakai'];
        $summary['total']['tersedia'] += $row['tersedia'];
    }
    
    echo json_encode([
        'success' => true,
        'data' => [
            'rooms' => $rooms,
            'summary' => $summary,
            'last_updated' => date('Y-m-d H:i:s')
        ]
    ]);
    exit;
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update room status - requires authentication
    require_once __DIR__ . '/../rs-admin/includes/auth.php';
    require_login();
    require_role(['direktur', 'admin', 'karyawan']);
    
    $input = json_decode(file_get_contents('php://input'), true);
    $kamar_id = intval($input['kamar_id'] ?? 0);
    $terpakai = intval($input['terpakai'] ?? 0);
    $status = $input['status'] ?? 'available';
    
    if (!$kamar_id) {
        echo json_encode(['success' => false, 'message' => 'ID kamar tidak valid']);
        exit;
    }
    
    // Validate status
    $valid_status = ['available', 'full', 'maintenance'];
    if (!in_array($status, $valid_status)) {
        $status = 'available';
    }
    
    $sql = "UPDATE kamar SET terpakai = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $terpakai, $status, $kamar_id);
    
    if ($stmt->execute()) {
        log_activity('update_kamar_status', 'kamar', "Updated kamar ID: $kamar_id, terpakai: $terpakai, status: $status");
        
        echo json_encode([
            'success' => true,
            'message' => 'Status kamar berhasil diperbarui',
            'data' => ['kamar_id' => $kamar_id, 'terpakai' => $terpakai, 'status' => $status]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status kamar']);
    }
    exit;
}

if ($action === 'batch_update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Batch update multiple rooms
    require_once __DIR__ . '/../rs-admin/includes/auth.php';
    require_login();
    require_role(['direktur', 'admin', 'karyawan']);
    
    $input = json_decode(file_get_contents('php://input'), true);
    $updates = $input['updates'] ?? [];
    
    if (empty($updates) || !is_array($updates)) {
        echo json_encode(['success' => false, 'message' => 'Data update tidak valid']);
        exit;
    }
    
    $success_count = 0;
    $error_count = 0;
    
    $conn->begin_transaction();
    
    try {
        $sql = "UPDATE kamar SET terpakai = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        foreach ($updates as $update) {
            $kamar_id = intval($update['kamar_id'] ?? 0);
            $terpakai = intval($update['terpakai'] ?? 0);
            $status = $update['status'] ?? 'available';
            
            if (!$kamar_id) continue;
            
            $valid_status = ['available', 'full', 'maintenance'];
            if (!in_array($status, $valid_status)) {
                $status = 'available';
            }
            
            $stmt->bind_param("isi", $terpakai, $status, $kamar_id);
            if ($stmt->execute()) {
                $success_count++;
            } else {
                $error_count++;
            }
        }
        
        $conn->commit();
        
        log_activity('batch_update_kamar', 'kamar', "Updated $success_count rooms, $error_count errors");
        
        echo json_encode([
            'success' => true,
            'message' => "Update selesai: $success_count berhasil, $error_count gagal",
            'data' => ['success' => $success_count, 'error' => $error_count]
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Gagal batch update: ' . $e->getMessage()]);
    }
    exit;
}

// Invalid action
echo json_encode(['success' => false, 'message' => 'Invalid action']);
