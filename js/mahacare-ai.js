/**
 * ==========================================
 * MAHACARE AI - PATIENT ASSISTANT
 * RS Payangan Hospital
 * ==========================================
 * 
 * Character: Friendly, Patient, High Empathy, Professional, Polite
 * Purpose: Help patients find information about services, doctors, schedules
 */

(function() {
    'use strict';

    const MAHACARE_CONFIG = {
        name: 'MahaCare AI',
        avatar: '🤖',
        greeting: `Selamat datang di Payangan Hospital. Saya <strong>MahaCare AI</strong>. 

Saya siap membantu Anda mencari informasi tentang:
• Layanan rumah sakit
• Jadwal dokter
• Cara membuat janji
• Pendaftaran
• Informasi umum

Apa yang bisa saya bantu hari ini?`,
        notUnderstood: 'Maaf, saya belum memahami pertanyaan Anda. Bisa tolong ajukan pertanyaan dengan cara lain?',
        disclaimer: '⚠️ Saya adalah AI assistant dan tidak memberikan diagnosis medis atau resep. Untuk gejala yang memerlukan penilaian medis, silakan hubungi tenaga kesehatan kami atau layanan gawat darurat.',
        errorMessage: 'Mohon maaf, terjadi kesalahan. Silakan coba beberapa saat lagi atau hubungi kami langsung.',
        rateQuestion: 'Apakah jawaban saya membantu?',
        quickReplies: [
            { text: 'Jadwal Dokter', value: 'jadwal dokter' },
            { text: 'Layanan RS', value: 'layanan rumah sakit' },
            { text: 'Buat Janji', value: 'cara membuat janji' },
            { text: 'BPJS', value: 'informasi bpjs' },
            { text: 'IGD 24 Jam', value: 'igd 24 jam' },
            { text: 'Kontak RS', value: 'kontak rumah sakit' }
        ]
    };

    // Knowledge base for responses
    const KNOWLEDGE_BASE = {
        jadwal_dokter: {
            keywords: ['jadwal', 'dokter', 'praktik', 'praktek', 'jam', 'waktu'],
            response: `📅 <strong>Jadwal Dokter Spesialis</strong>

Dokter kami praktik setiap hari kerja. Berikut informasi umum:

<strong>Poli Spesialis:</strong>
• Poli Umum
• Poli Anak
• Poli Kandungan
• Poli Penyakit Dalam
• Poli Bedah
• Poli Jantung
• Poli Saraf
• Poli THT
• Poli Gigi

<strong>Jam Praktik:</strong>
Senin - Jumat: 08:00 - 14:00
Sabtu: 08:00 - 12:00

Untuk jadwal lengkap, silakan kunjungi halaman <a href="dokter.html">Dokter Spesialis</a>

Apakah ada dokter tertentu yang ingin Anda ketahui jadwalnya?`
        },
        layanan_rs: {
            keywords: ['layanan', 'service', 'fasilitas', 'pelayanan', 'services'],
            response: `🏥 <strong>Layanan RS Payangan Hospital</strong>

<strong>Pelayanan Rawat Jalan:</strong>
• 10 Poli Spesialis
• Konsultasi Dokter Umum & Spesialis
• Tindakan Kecil

<strong>Pelayanan Rawat Inap:</strong>
• Kamar Kelas I, II, III
• Kamar VIP
• Kamar ICU

<strong>Pelayanan Gawat Darurat:</strong>
• IGD 24 Jam
• Ambulans
• Dokter On-Call

<strong>Fasilitas Penunjang:</strong>
• Laboratorium
• Radiologi
• Farmasi 24 Jam

Apakah ada layanan tertentu yang ingin Anda ketahui lebih lanjut?`
        },
        bpjs: {
            keywords: ['bpjs', 'kesehatan', 'asuransi', 'jaminan', 'kartu'],
            response: `🏛️ <strong>Informasi BPJS Kesehatan</strong>

RS Payangan Hospital telah<b> terakreditasi</b> dan melayani pasien BPJS Kesehatan.

<strong>Dokumen yang diperlukan:</strong>
• Kartu BPJS Kesehatan asli
• KTP/SIM
• Surat rujukan dari Faskes Tingkat I (jika diperlukan)
• KK (Kartu Keluarga)

<strong>Prosedur:</strong>
1. Datang ke loket BPJS
2. Tunjukkan kartu BPJS
3. Ambil nomor antrean poli
4. Konsultasi dokter

Apakah ada informasi lain tentang BPJS yang ingin Anda ketahui?`
        },
        igd: {
            keywords: ['igd', 'darurat', 'emergency', 'gawat', '24 jam', 'ambulans'],
            response: `🚨 <strong>IGD (Instalasi Gawat Darurat) 24 Jam</strong>

<strong>Layanan IGD kami:</strong>
• Dokter Spesialis On-Call
• Perawat Emergensi
• Ambulans Siaga
• Ruang Tindakan
• Ruang Resusitasi

<strong>Kontak Darurat:</strong>
📞 <strong>0361-XXXX</strong> (Hubungi untuk ambulans)
📱 <strong>WhatsApp:</strong> [Nomor RS]

<strong>Catatan:</strong>
Untuk kondisi gawat darurat, segera ke IGD atau hubungi nomor darurat di atas.

Apakah Anda membutuhkan bantuan darurat?`
        },
        kontak: {
            keywords: ['kontak', 'telepon', 'alamat', 'lokasi', 'whatsapp', 'email'],
            response: `📞 <strong>Kontak RS Payangan Hospital</strong>

<strong>Alamat:</strong>
JL. Raya Payangan, Gianyar, Bali

<strong>Telepon:</strong>
📞 (0361) XXXXXX
📞 (0361) XXXXXX

<strong>WhatsApp:</strong>
💬 [Nomor WhatsApp]

<strong>Email:</strong>
📧 info@payanganhospital.gianyarkab.go.id

<strong>Jam Operasional:</strong>
Senin - Jumat: 07:00 - 20:00
Sabtu: 07:00 - 14:00
IGD: 24 Jam

<strong>Google Maps:</strong>
<a href="https://goo.gl/maps/xxxx" target="_blank">Lihat di Maps</a>`
        },
        janji: {
            keywords: ['janji', 'booking', 'buat', 'daftar', 'appoint', 'reservasi'],
            response: `📋 <strong>Cara Membuat Janji Temu</strong>

<strong>Metode Pendaftaran:</strong>

1️⃣ <strong>Online:</strong>
• Melalui website: <a href="antrean.html">Form Pendaftaran</a>
• WhatsApp: Kirim pesan ke nomor RS

2️⃣ <strong>Telepon:</strong>
• Hubungi (0361) XXXXXX
• Pukul 07:00 - 15:00 WIB

3️⃣ <strong>Langsung:</strong>
• Kunjungi loket pendaftaran RS
• Ambil nomor antrean

<strong>Yang perlu dibawa:</strong>
• KTP / Identitas
• Kartu BPJS (jika ada)
• Surat rujukan (jika ada)

Apakah Anda ingin langsung membuat janji?`
        },
        umum: {
            keywords: ['tentang', 'about', 'rs', 'rumah sakit', 'info'],
            response: `🏨 <strong>Tentang RS Payangan Hospital</strong>

RS Payangan Hospital adalah <strong>Rumah Sakit Pemerintah Daerah</strong> yang melayani masyarakat Gianyar dan sekitarnya.

<strong>Visi:</strong>
Menjadi rumah sakit yang modern dengan sentuhan humanis

<strong>Misi:</strong>
• Memberikan pelayanan kesehatan berkualitas
• Tenaga medis profesional
• Fasilitas modern
• Harga terjangkau

<strong>Keunggulan:</strong>
✅ 22+ Dokter Spesialis
✅ IGD 24 Jam
✅ Fasilitas Modern
✅ Harga Terjangkau
✅ Lokasi Strategis

Kunjungi halaman <a href="about.html">About Us</a> untuk informasi lebih lanjut.`
        }
    };

    class MahaCareAI {
        constructor() {
            this.isOpen = false;
            this.conversationHistory = [];
            this.isTyping = false;
            this.startTime = null;
            this.createWidget();
            this.bindEvents();
        }

        createWidget() {
            // Chat button
            this.chatButton = document.createElement('div');
            this.chatButton.id = 'mahacare-button';
            this.chatButton.innerHTML = `
                <div class="mahacare-badge" id="mahacare-badge">0</div>
                <div class="mahacare-avatar">
                    <span>${MAHACARE_CONFIG.avatar}</span>
                </div>
            `;
            document.body.appendChild(this.chatButton);

            // Chat window
            this.chatWindow = document.createElement('div');
            this.chatWindow.id = 'mahacare-window';
            this.chatWindow.innerHTML = `
                <div class="mahacare-header">
                    <div class="mahacare-header-info">
                        <div class="mahacare-header-avatar">${MAHACARE_CONFIG.avatar}</div>
                        <div>
                            <div class="mahacare-header-name">${MAHACARE_CONFIG.name}</div>
                            <div class="mahacare-header-status">
                                <span class="mahacare-status-dot"></span>
                                Online
                            </div>
                        </div>
                    </div>
                    <button class="mahacare-minimize" id="mahacare-minimize">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <div class="mahacare-messages" id="mahacare-messages">
                    <div class="mahacare-message mahacare-message-bot">
                        <div class="mahacare-message-content">
                            <p>${MAHACARE_CONFIG.greeting.replace(/\n/g, '<br>')}</p>
                            <div class="mahacare-quick-replies" id="mahacare-quick-replies"></div>
                        </div>
                        <div class="mahacare-message-time">${this.formatTime()}</div>
                    </div>
                </div>
                <div class="mahacare-disclaimer">${MAHACARE_CONFIG.disclaimer}</div>
                <div class="mahacare-input-area">
                    <div class="mahacare-input-container">
                        <input type="text" id="mahacare-input" placeholder="Ketik pertanyaan Anda..." autocomplete="off">
                        <button class="mahacare-send" id="mahacare-send">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(this.chatWindow);

            // Add styles
            this.addStyles();
            
            // Populate quick replies
            this.populateQuickReplies();
        }

        addStyles() {
            const styles = document.createElement('style');
            styles.textContent = `
                /* Chat Button */
                #mahacare-button {
                    position: fixed;
                    bottom: 24px;
                    right: 24px;
                    z-index: 9999;
                    cursor: pointer;
                }

                .mahacare-badge {
                    position: absolute;
                    top: -5px;
                    right: -5px;
                    background: #ef4444;
                    color: white;
                    font-size: 11px;
                    font-weight: 700;
                    width: 22px;
                    height: 22px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    transform: scale(0);
                    transition: all 0.3s ease;
                }

                .mahacare-badge.show {
                    opacity: 1;
                    transform: scale(1);
                }

                .mahacare-avatar {
                    width: 60px;
                    height: 60px;
                    background: linear-gradient(135deg, #2563eb, #0ea5e9);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 28px;
                    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4);
                    transition: all 0.3s ease;
                }

                #mahacare-button:hover .mahacare-avatar {
                    transform: scale(1.1);
                    box-shadow: 0 6px 30px rgba(37, 99, 235, 0.5);
                }

                /* Chat Window */
                #mahacare-window {
                    position: fixed;
                    bottom: 100px;
                    right: 24px;
                    width: 380px;
                    max-width: calc(100vw - 48px);
                    height: 550px;
                    max-height: calc(100vh - 140px);
                    background: white;
                    border-radius: 20px;
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                    display: flex;
                    flex-direction: column;
                    overflow: hidden;
                    z-index: 9998;
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(20px) scale(0.95);
                    transition: all 0.3s ease;
                }

                #mahacare-window.open {
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0) scale(1);
                }

                /* Header */
                .mahacare-header {
                    background: linear-gradient(135deg, #2563eb, #0ea5e9);
                    color: white;
                    padding: 16px 20px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .mahacare-header-info {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .mahacare-header-avatar {
                    width: 44px;
                    height: 44px;
                    background: rgba(255,255,255,0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 22px;
                }

                .mahacare-header-name {
                    font-weight: 700;
                    font-size: 16px;
                }

                .mahacare-header-status {
                    font-size: 12px;
                    opacity: 0.9;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                }

                .mahacare-status-dot {
                    width: 8px;
                    height: 8px;
                    background: #22c55e;
                    border-radius: 50%;
                    animation: pulse-dot 2s infinite;
                }

                @keyframes pulse-dot {
                    0%, 100% { opacity: 1; }
                    50% { opacity: 0.5; }
                }

                .mahacare-minimize {
                    background: rgba(255,255,255,0.2);
                    border: none;
                    color: white;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: background 0.2s;
                }

                .mahacare-minimize:hover {
                    background: rgba(255,255,255,0.3);
                }

                /* Messages */
                .mahacare-messages {
                    flex: 1;
                    overflow-y: auto;
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    gap: 16px;
                }

                .mahacare-message {
                    display: flex;
                    flex-direction: column;
                    max-width: 85%;
                }

                .mahacare-message-user {
                    align-self: flex-end;
                }

                .mahacare-message-bot {
                    align-self: flex-start;
                }

                .mahacare-message-content {
                    padding: 12px 16px;
                    border-radius: 16px;
                    font-size: 14px;
                    line-height: 1.5;
                }

                .mahacare-message-user .mahacare-message-content {
                    background: linear-gradient(135deg, #2563eb, #0ea5e9);
                    color: white;
                    border-bottom-right-radius: 4px;
                }

                .mahacare-message-bot .mahacare-message-content {
                    background: #f1f5f9;
                    color: #1e293b;
                    border-bottom-left-radius: 4px;
                }

                .mahacare-message-content p {
                    margin: 0 0 8px;
                }

                .mahacare-message-content p:last-child {
                    margin-bottom: 0;
                }

                .mahacare-message-content a {
                    color: #2563eb;
                    text-decoration: underline;
                }

                .mahacare-message-time {
                    font-size: 11px;
                    color: #94a3b8;
                    margin-top: 4px;
                    padding: 0 4px;
                }

                /* Quick Replies */
                .mahacare-quick-replies {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 8px;
                    margin-top: 12px;
                }

                .mahacare-quick-reply {
                    background: white;
                    border: 1px solid #e2e8f0;
                    padding: 8px 14px;
                    border-radius: 20px;
                    font-size: 12px;
                    color: #2563eb;
                    cursor: pointer;
                    transition: all 0.2s;
                }

                .mahacare-quick-reply:hover {
                    background: #2563eb;
                    color: white;
                    border-color: #2563eb;
                }

                /* Typing Indicator */
                .mahacare-typing {
                    display: flex;
                    align-items: center;
                    gap: 4px;
                    padding: 12px 16px;
                    background: #f1f5f9;
                    border-radius: 16px;
                    width: fit-content;
                }

                .mahacare-typing span {
                    width: 8px;
                    height: 8px;
                    background: #94a3b8;
                    border-radius: 50%;
                    animation: typing-bounce 1.4s infinite ease-in-out;
                }

                .mahacare-typing span:nth-child(1) { animation-delay: 0s; }
                .mahacare-typing span:nth-child(2) { animation-delay: 0.2s; }
                .mahacare-typing span:nth-child(3) { animation-delay: 0.4s; }

                @keyframes typing-bounce {
                    0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
                    40% { transform: scale(1); opacity: 1; }
                }

                /* Disclaimer */
                .mahacare-disclaimer {
                    padding: 10px 16px;
                    background: #fef3c7;
                    font-size: 11px;
                    color: #92400e;
                    text-align: center;
                }

                /* Input Area */
                .mahacare-input-area {
                    padding: 16px;
                    background: white;
                    border-top: 1px solid #e2e8f0;
                }

                .mahacare-input-container {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    background: #f1f5f9;
                    border-radius: 24px;
                    padding: 4px;
                }

                #mahacare-input {
                    flex: 1;
                    border: none;
                    background: transparent;
                    padding: 10px 16px;
                    font-size: 14px;
                    outline: none;
                }

                #mahacare-input::placeholder {
                    color: #94a3b8;
                }

                .mahacare-send {
                    width: 40px;
                    height: 40px;
                    background: linear-gradient(135deg, #2563eb, #0ea5e9);
                    border: none;
                    border-radius: 50%;
                    color: white;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.2s;
                }

                .mahacare-send:hover {
                    transform: scale(1.05);
                }

                .mahacare-send:disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }

                /* Rating */
                .mahacare-rating {
                    display: flex;
                    gap: 8px;
                    margin-top: 12px;
                }

                .mahacare-rating button {
                    background: white;
                    border: 1px solid #e2e8f0;
                    padding: 6px 12px;
                    border-radius: 16px;
                    cursor: pointer;
                    transition: all 0.2s;
                }

                .mahacare-rating button:hover {
                    border-color: #2563eb;
                    color: #2563eb;
                }

                .mahacare-rating button.positive {
                    background: #dcfce7;
                    border-color: #22c55e;
                    color: #16a34a;
                }

                .mahacare-rating button.negative {
                    background: #fee2e2;
                    border-color: #ef4444;
                    color: #dc2626;
                }

                /* Responsive */
                @media (max-width: 480px) {
                    #mahacare-button {
                        bottom: 16px;
                        right: 16px;
                    }

                    .mahacare-avatar {
                        width: 54px;
                        height: 54px;
                        font-size: 24px;
                    }

                    #mahacare-window {
                        bottom: 90px;
                        right: 16px;
                        width: calc(100vw - 32px);
                        height: calc(100vh - 120px);
                    }
                }
            `;
            document.head.appendChild(styles);
        }

        bindEvents() {
            // Toggle chat
            this.chatButton.addEventListener('click', () => this.toggle());
            document.getElementById('mahacare-minimize').addEventListener('click', () => this.toggle());

            // Send message
            const input = document.getElementById('mahacare-input');
            const sendBtn = document.getElementById('mahacare-send');

            sendBtn.addEventListener('click', () => this.sendMessage());
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') this.sendMessage();
            });
        }

        toggle() {
            this.isOpen = !this.isOpen;
            this.chatWindow.classList.toggle('open', this.isOpen);
            
            if (this.isOpen) {
                document.getElementById('mahacare-input').focus();
                if (!this.startTime) this.startTime = Date.now();
            }
        }

        populateQuickReplies() {
            const container = document.getElementById('mahacare-quick-replies');
            container.innerHTML = MAHACARE_CONFIG.quickReplies.map(qr => 
                `<button class="mahacare-quick-reply" data-value="${qr.value}">${qr.text}</button>`
            ).join('');

            container.querySelectorAll('.mahacare-quick-reply').forEach(btn => {
                btn.addEventListener('click', () => {
                    this.sendMessage(btn.dataset.value);
                });
            });
        }

        sendMessage(text = null) {
            const input = document.getElementById('mahacare-input');
            const message = text || input.value.trim();
            
            if (!message) return;

            input.value = '';
            this.addMessage(message, 'user');
            this.showTyping();

            // Find matching response
            setTimeout(() => {
                this.hideTyping();
                const response = this.findResponse(message);
                this.addMessage(response, 'bot');
            }, 1000 + Math.random() * 1000);
        }

        findResponse(message) {
            const lowerMessage = message.toLowerCase();
            
            for (const [key, data] of Object.entries(KNOWLEDGE_BASE)) {
                const matchCount = data.keywords.filter(kw => 
                    lowerMessage.includes(kw.toLowerCase())
                ).length;
                
                if (matchCount > 0) {
                    return data.response;
                }
            }
            
            return MAHACARE_CONFIG.notUnderstood;
        }

        addMessage(content, sender) {
            const messagesContainer = document.getElementById('mahacare-messages');
            const quickReplies = document.getElementById('mahacare-quick-replies');
            
            // Hide quick replies after first message
            if (quickReplies && this.conversationHistory.length === 0) {
                quickReplies.style.display = 'none';
            }

            const messageEl = document.createElement('div');
            messageEl.className = `mahacare-message mahacare-message-${sender}`;
            messageEl.innerHTML = `
                <div class="mahacare-message-content">
                    <p>${content}</p>
                </div>
                <div class="mahacare-message-time">${this.formatTime()}</div>
            `;

            messagesContainer.appendChild(messageEl);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            this.conversationHistory.push({ sender, content, time: new Date() });
            this.updateBadge();
        }

        showTyping() {
            if (this.isTyping) return;
            this.isTyping = true;

            const messagesContainer = document.getElementById('mahacare-messages');
            const typingEl = document.createElement('div');
            typingEl.className = 'mahacare-message mahacare-message-bot';
            typingEl.id = 'mahacare-typing';
            typingEl.innerHTML = `
                <div class="mahacare-typing">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;
            messagesContainer.appendChild(typingEl);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        hideTyping() {
            this.isTyping = false;
            const typingEl = document.getElementById('mahacare-typing');
            if (typingEl) typingEl.remove();
        }

        updateBadge() {
            const badge = document.getElementById('mahacare-badge');
            if (this.conversationHistory.length > 0) {
                badge.textContent = this.conversationHistory.length;
                badge.classList.add('show');
            }
        }

        formatTime() {
            const now = new Date();
            return now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }

        getConversationHistory() {
            return this.conversationHistory;
        }

        getSessionDuration() {
            if (!this.startTime) return 0;
            return Math.floor((Date.now() - this.startTime) / 1000);
        }
    }

    // Initialize
    let mahacare;
    document.addEventListener('DOMContentLoaded', () => {
        mahacare = new MahaCareAI();
        window.mahacareAI = mahacare;
    });

})();
