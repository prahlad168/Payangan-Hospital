<?php
/**
 * WhatsApp Broadcast Script
 * Untuk mengirim pesan broadcast ke banyak kontak
 * 
 * Penggunaan:
 * 1. Isi daftar nomor di $contacts array
 * 2. Edit pesan di $message
 * 3. Set API Token Fonnte di $fonnte_token
 * 4. Jalankan: php whatsapp-broadcast.php
 */

// Konfigurasi
$fonnte_token = 'YOUR_FONNTE_TOKEN_HERE';
$fonnte_url = 'https://api.fonnte.com/send';

// Daftar nomor tujuan (format: 62xxxxxxxxxx)
$contacts = [
    // Tambahkan nomor HP di sini
    // Contoh: '6281234567890',
    // '6282345678901',
];

// Pesan broadcast
$message = "
🌍 *FREE CONSULTATION - AI Solutions*

Halo!

Saya *Made* dari Bali, Indonesia 🇮🇩

Saya membantu bisnis meningkatkan *revenue* dengan AI Automation.

*Hasil untuk client saya:*
✅ RS di Bali: +30% patient registrations
✅ Hotel di Jakarta: +50% bookings  
✅ Klinik di Surabaya: +40% patient retention

*PROMO SPESIAL:*
🎁 Website + AI Chatbot = Rp 5.000.000
🎁 AI Automation System = Rp 15.000.000
🎁 Konsultasi GRATIS (30 menit)

Mau saya bantu analisis bisnis Anda?

Balas *YES* atau hubungi langsung:
📱 +62 819 3635 8087

Terima kasih 🙏
";

// Fungsi kirim pesan
function sendWhatsApp($fonnte_token, $fonnte_url, $target, $message) {
    $data = [
        'target' => $target,
        'message' => $message,
    ];
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $fonnte_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => [
            'Authorization: ' . $fonnte_token
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if ($err) {
        return ['success' => false, 'error' => $err];
    }
    
    return ['success' => true, 'response' => $response];
}

// Kirim broadcast
echo "🚀 Starting WhatsApp Broadcast...\n";
echo "Total kontak: " . count($contacts) . "\n\n";

$success = 0;
$failed = 0;

foreach ($contacts as $index => $contact) {
    $result = sendWhatsApp($fonnte_token, $fonnte_url, $contact, $message);
    
    if ($result['success']) {
        $success++;
        echo "✅ [" . ($index + 1) . "/" . count($contacts) . "] Sent to $contact\n";
    } else {
        $failed++;
        echo "❌ [" . ($index + 1) . "/" . count($contacts) . "] Failed to $contact: " . $result['error'] . "\n";
    }
    
    // Delay untuk menghindari rate limit
    sleep(3);
}

echo "\n========================================\n";
echo "📊 BROADCAST COMPLETE\n";
echo "✅ Success: $success\n";
echo "❌ Failed: $failed\n";
echo "========================================\n";
?>
