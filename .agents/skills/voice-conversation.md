# Voice Conversation System

## Overview

Sistem percakapan suara (voice conversation) untuk berinteraksi dengan AI Agent. Dibuat khusus untuk **CEO i Made Purna Ananda (Pak Pur)** - sehingga bisa ngobrol pakai suara, bukan text!

---

## Tujuan

1. **Voice Recognition** - AI mengenali suara Pak Pur sebagai CEO & Admin IT
2. **Voice Response** - AI menjawab pakai suara, bukan text
3. **Hands-free** - Tidak perlu ketik, cukup bicara

---

## Identifikasi User

| User | Suara | Role |
|------|-------|------|
| **i Made Purna Ananda** | Suara CEO | CEO & Admin IT |
| **Admin** | Suara Admin | Administrator |
| **Guest** | Tidak dikenali | Guest User |

---

## Text-to-Speech (TTS) Setup

### Konfigurasi TTS untuk Bahasa Indonesia

```javascript
// Contoh TTS Configuration
const ttsConfig = {
  provider: 'google', // atau 'aws', 'azure', 'elevenlabs'
  language: 'id-ID',
  voice: {
    name: 'id-ID-Standard-A', // untuk CEO
    gender: 'MALE',
    speakingRate: 0.9,
    pitch: -2
  },
  audioFormat: 'mp3'
};

// Text yang akan diucapkan
const greetingText = `
Selamat datang, Bapak CEO i Made Purna Ananda.

Saya Agent AI Anda, siap membantu.

Ada yang bisa saya bantu hari ini?
`;
```

---

## Speech-to-Text (STT) Setup

### Konfigurasi STT untuk Bahasa Indonesia

```javascript
// Contoh STT Configuration  
const sttConfig = {
  provider: 'google', // atau 'aws', 'azure'
  language: 'id-ID',
  model: 'latest_long',
  interimResults: true,
  singleUtterance: false
};

// Callback untuk hasil recognisi
function onSpeechResult(event) {
  const transcript = event.results[0][0].transcript;
  console.log('Pak Pur said:', transcript);
  
  // Process command
  processVoiceCommand(transcript);
}
```

---

## Web Voice API Implementation

### Browser-based Voice Chat (HTML + JavaScript)

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Voice Chat - RS Payangan AI</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px;
            background: linear-gradient(135deg, #0d7377, #14ffec);
            color: white;
        }
        .chat-container {
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(10px);
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            margin: 10px;
            transition: all 0.3s;
        }
        .mic-on { background: #ff4757; color: white; }
        .mic-off { background: #2ed573; color: white; }
        .mic-on:hover { transform: scale(1.05); }
        .mic-off:hover { transform: scale(1.05); }
        .message {
            padding: 15px;
            margin: 10px 0;
            border-radius: 15px;
            background: rgba(255,255,255,0.2);
        }
        .user-msg { text-align: right; }
        .ai-msg { text-align: left; }
        #status {
            text-align: center;
            font-size: 14px;
            opacity: 0.8;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>Voice Chat AI - RS Payangan</h1>
        <h2>Halo Pak Pur!</h2>
        
        <div id="messages"></div>
        
        <div style="text-align: center;">
            <button id="micBtn" class="mic-off" onclick="toggleMic()">
                Mulai Ngobrol
            </button>
        </div>
        
        <div id="status">Siap menerima perintah suara...</div>
    </div>

    <script>
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = true;
        recognition.lang = 'id-ID';
        
        let isListening = false;
        
        function toggleMic() {
            if (isListening) {
                recognition.stop();
                document.getElementById('micBtn').innerHTML = 'Mulai Ngobrol';
                document.getElementById('micBtn').className = 'mic-off';
                isListening = false;
            } else {
                recognition.start();
                document.getElementById('micBtn').innerHTML = 'Stop';
                document.getElementById('micBtn').className = 'mic-on';
                isListening = true;
                
                // Sapaan awal
                speak('Halo Pak Pur! Saya Agent AI Anda. Silakan bicara.');
            }
        }
        
        recognition.onresult = function(event) {
            const transcript = event.results[event.results.length-1][0].transcript;
            showMessage(transcript, 'user');
            
            // Process and respond
            const response = processCommand(transcript);
            setTimeout(() => {
                showMessage(response, 'ai');
                speak(response);
            }, 500);
        };
        
        function showMessage(text, sender) {
            const div = document.createElement('div');
            div.className = 'message ' + sender + '-msg';
            div.innerHTML = '<strong>' + (sender === 'user' ? 'Pak Pur' : 'AI') + ':</strong> ' + text;
            document.getElementById('messages').appendChild(div);
        }
        
        function speak(text) {
            const synth = window.speechSynthesis;
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID';
            utterance.rate = 0.95;
            synth.speak(utterance);
        }
        
        function processCommand(text) {
            const t = text.toLowerCase();
            if (t.includes('halo') || t.includes('hai')) 
                return 'Halo Pak Pur! Ada yang bisa saya bantu?';
            if (t.includes('deploy') || t.includes('update')) 
                return 'Baik Pak Pur! Deploy website dimulai.';
            if (t.includes('laporan') || t.includes('report')) 
                return 'Saya akan buatkan laporan untuk Pak Pur.';
            if (t.includes('status')) 
                return 'Website RS Payangan aktif. Semua sistem berjalan normal.';
            if (t.includes('optimasi') || t.includes('qa')) 
                return 'Baik! Saya jalankan 13 QA agents untuk optimasi.';
            return 'Maaf Pak Pur, bisa ulangi?';
        }
    </script>
</body>
</html>
```

---

## Voice Command Processing

### Command List untuk Pak Pur

| Command Suara | Aksi |
|---------------|------|
| "Halo" / "Hai" | Sapaan balik |
| "Deploy website" | Trigger deploy ke hosting |
| "Buat laporan" | Generate daily report |
| "Cek status" | Baca status sistem |
| "Buka dashboard" | Buka rs-admin dashboard |
| "Optimasi website" | Jalankan 13 QA agents |
| "Tutup" / "Stop" | Akhiri percakapan |

---

## Voice Profile untuk Pak Pur

```javascript
const ceoProfile = {
    name: 'i Made Purna Ananda',
    title: 'CEO & Admin IT',
    nickname: 'Pak Pur',
    voiceSettings: {
        rate: 0.9,      // Kecepatan bicara
        pitch: -1,      // Nada suara
        volume: 1.0     // Volume
    },
    greetings: [
        'Selamat datang, Pak Pur!',
        'Halo Pak Pur! Senang mendengar suara Bapak.',
        'Pak Pur! Ada yang bisa saya bantu?'
    ]
};
```

---

## Trigger Phrases

Skill ini aktif ketika user mengatakan:

- "voice chat"
- "ngobrol pakai suara"
- "bicara dengan ai"
- "pak pur voice"
- "aktifkan suara"
- "voice command"

---

## Requirements

1. **Browser support** - Chrome, Edge, Safari (Web Speech API)
2. **Microphone access** - Permission untuk akses mikrofon
3. **Internet connection** - Untuk cloud STT/TTS (optional)

---

## Troubleshooting

### Mikrofon tidak terdeteksi?
```javascript
navigator.mediaDevices.getUserMedia({ audio: true })
    .then(stream => console.log('Microphone connected'))
    .catch(err => console.error('Microphone error:', err));
```

### TTS tidak berbahasa Indonesia?
```javascript
utterance.lang = 'id-ID';
```

### Suara terlalu cepat/lambat?
```javascript
utterance.rate = 0.8; // Lebih lambat
utterance.rate = 1.1; // Lebih cepat
```

---

**Created:** 2026-07-05  
**Version:** 1.0.0  
**Owner:** i Made Purna Ananda (Pak Pur)  
**Purpose:** Voice conversation dengan AI Agent
