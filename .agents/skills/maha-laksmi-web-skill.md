# Maha Laksmi Web Development Skill

## рҹ“§ Adopsi dari MAHA-LAKSHMI-CORP

Skill ini mengadopsi kemampuan pengembangan website dari sistem **MAHA-LAKSHMI-CORP** (`github.com/prahlad168/MAHA-LAKSHMI-CORP`) untuk RS Payangan Hospital, mencakup:

- **Revenue Dashboard** - Tracking pendapatan real-time
- **Kasir API** - API untuk mencatat transaksi
- **Auto-Status System** - Status otomatis berubah berdasarkan aktivitas
- **Daily Report** - Laporan harian dengan WhatsApp integration
- **Command Center Dashboard** - Real-time monitoring
- **Multi-SBU Management** - Kelola hingga 10+ unit bisnis
- **10 AI Agents per SBU** - Otomatisasi penuh

---

## рҹ“Ӣ Overview

### Visi MAHA-LAKSHMI-CORP
```
"Tidak ada perusahaan yang berjalan sendiri.
Semua adalah SATU ECO-SYSTEM yang saling terhubung."
```

### Target Revenue
```
10 SBU x Rp 100.000.000/bulan = Rp 1.000.000.000/bulan
```

### Struktur AI Agents per SBU
```
Director (Human)
в”ңв”Җв”Җ Business AI     в†’ Analisis bisnis & strategi
в”ңв”Җв”Җ Marketing AI    в†’ Content, SEO, social media
в”ңв”Җв”Җ Sales AI       в†’ Lead generation & konversi
в”ңв”Җв”Җ Finance AI     в†’ Invoice & tracking keuangan
в”ңв”Җв”Җ Research AI     в†’ Riset pasar & tren
в”ңв”Җв”Җ Learning AI    в†’ Training & knowledge
в”ңв”Җв”Җ Automation AI   в†’ Workflow automation
в”ңв”Җв”Җ Customer AI    в†’ Support & service
в”ңв”Җв”Җ QA AI          в†’ Quality assurance
в””в”Җв”Җ Innovation AI   в†’ R&D & ide baru
```

---

## рҹ“Ғ File Structure Reference (dari Repository Asli)

```
MAHA-LAKSHMI-CORP/
рӣ• maha-lakshmi/                    # HOLDINGS HQ
рӣӮ   в”Ӯ   00-MASTER-UNIFIED.md       # Master config
рӣӮ   в”Ӯ   ceo-dashboard.html          # CEO dashboard
рӣӮ   в”Ӯ   api.php                    # Dashboard API
рӣӮ   в”Ӯ   data/
рӣӮ   в”Ӯ       в”Ӯ   companies.json          # All companies data
рӣӮ
рӣ• maha-factory/                    # AI FACTORY (16 modules)
рӣ• maha-command-center/              # MACC Dashboard
рӣ• .agents/                         # AI Agent configs
рӣ• sop/                            # SOP Library
рӣ• prompts/                        # Prompt Library
рӣ• knowledge/                       # Knowledge Base
рӣ• automation/                      # Automation workflows
```

---

## рҹ“§ API Endpoints (dari api.php)

### Real-Time Metrics API
```php
GET api.php

// Response:
{
    "success": true,
    "timestamp": "2026-07-04T06:47:00+08:00",
    "metrics": {
        "website_visits": 150,
        "api_calls": 320,
        "active_users": 18,
        "revenue_today": 750000
    },
    "total": {
        "revenue": 15000000,
        "leads": 245,
        "customers": 32
    }
}
```

### Per-Company Data
```json
{
    "id": 1,
    "name": "Gianyar Tech Solutions",
    "niche": "Software Development & SaaS",
    "status": "active",
    "progress": 22,
    "revenue": 3500000,
    "leads": 35,
    "customers": 7,
    "visits_today": 65,
    "conversion_rate": 5.2,
    "active_tasks": 4,
    "done_today": ["Setup dev environment", "Create API docs"],
    "doing_now": ["Building SaaS dashboard", "Payment integration"],
    "next_tasks": ["Launch MVP", "Get first 10 users"],
    "blockers": [],
    "health": "good"
}
```

---

## рҹ“§ Fitur Utama yang Diadopsi

### 1. Revenue Dashboard dengan Real-Time Metrics
```javascript
// Real-time dashboard dengan auto-refresh
const metrics = {
    website_visits: rand(50, 200),
    api_calls: rand(100, 500),
    active_users: rand(5, 30),
    revenue_today: rand(0, 1000000)
};
```

### 2. Kasir API dengan Auto-Status
```php
// Endpoint untuk mencatat transaksi
POST api/kasir.php?action=add
Body: {
    "company_id": "01",
    "amount": 500000,
    "description": "Pembayaran layanan"
}

// Auto-Status Logic:
if ($oldStatus === 'ready' && $amount > 0) {
    $companies['companies'][$companyIndex]['status'] = 'active';
    $companies['companies'][$companyIndex]['activeSince'] = date('Y-m-d');
}
```

### 3. Daily Report dengan WhatsApp Integration
```php
$CONFIG = [
    'wa_number' => '6281234567890',
    'wa_api_url' => 'https://api.fonnte.com/send',
    'wa_token' => 'YOUR_FONNTE_TOKEN',
    'use_wa' => true,
];

// Format pesan WhatsApp:
$msg = "рҹ“Ӣ *LAPORAN HARIAN*\n";
$msg .= "Maha Lakshmi - {$date}\n";
$msg .= "в”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯв”Ӯ\n\n";
$msg .= "рҹ’’ *TOTAL PENDAPATAN*\n";
$msg .= "Hari ini: Rp {$totalRevenue}\n";
$msg .= "Target: Rp {$target}\n";
$msg .= "Progress: {$report['summary']['progress_percent']}%\n";
```

### 4. Company Status Tracking
| Status | Kondisi |
|--------|---------|
| **active** | Ada transaksi/revenue |
| **ready** | Siap beroperasi, belum ada revenue |
| **pending** | Dalam pengembangan |

### 5. Task & Activity Tracking
```json
{
    "active_tasks": 4,
    "done_today": ["Task 1", "Task 2"],
    "doing_now": ["Current task 1", "Current task 2"],
    "next_tasks": ["Next task 1", "Next task 2"],
    "blockers": []
}
```

---

## рҹ“Ӣ SBU Structure untuk RS Payangan

### 10 Strategic Business Units RS Payangan

| ID | SBU Name | Type | Target |
|----|----------|------|--------|
| SBU-01 | Payangan AI Solutions | AI Automation | Rp 100M |
| SBU-02 | RS Payangan Medis | Healthcare Services | Rp 100M |
| SBU-03 | Gianyar Tech Solutions | Software House | Rp 100M |
| SBU-04 | Bali Digital Agency | Digital Marketing | Rp 100M |
| SBU-05 | Gianyar E-Commerce | E-Commerce | Rp 100M |
| SBU-06 | Bali EdTech | Education | Rp 100M |
| SBU-07 | Gianyar Finance | Fintech | Rp 100M |
| SBU-08 | Bali Logistics | Logistics | Rp 100M |
| SBU-09 | Gianyar Food Tech | Food Tech | Rp 100M |
| SBU-10 | Bali Travel | Travel | Rp 100M |

---

## рҹ“Ҹ Implementasi untuk RS Payangan

### 1. CEO Dashboard Integration
```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS Payangan - Command Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white">
    <!-- Real-time metrics bar -->
    <div class="bg-teal-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold"><i class="fas fa-hospital"></i> RS Payangan Command Center</h1>
            <div class="flex gap-6 text-sm">
                <span>рҹ‘Ё Visits: <span id="visits">0</span></span>
                <span>рҹ“Ҹ API Calls: <span id="apiCalls">0</span></span>
                <span>рҹ‘Ө Active: <span id="activeUsers">0</span></span>
                <span>рҹ’’ Today: <span id="revenueToday">Rp 0</span></span>
            </div>
        </div>
    </div>

    <!-- Company Cards Grid -->
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4" id="companiesGrid">
            <!-- Populated by JS -->
        </div>
    </div>

    <script>
        async function loadCommandCenter() {
            const res = await fetch('api.php');
            const data = await res.json();
            
            // Update metrics
            document.getElementById('visits').textContent = data.metrics.website_visits;
            document.getElementById('apiCalls').textContent = data.metrics.api_calls;
            document.getElementById('activeUsers').textContent = data.metrics.active_users;
            document.getElementById('revenueToday').textContent = 'Rp ' + data.metrics.revenue_today.toLocaleString('id-ID');
            
            // Update company cards
            const grid = document.getElementById('companiesGrid');
            grid.innerHTML = Object.values(data.companies).map(c => `
                <div class="bg-gray-800 rounded-lg p-4 border-l-4 ${c.health === 'excellent' ? 'border-green-500' : c.health === 'good' ? 'border-blue-500' : 'border-yellow-500'}">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-sm">${c.name}</h3>
                        <span class="px-2 py-0.5 text-xs rounded ${c.status === 'active' ? 'bg-green-600' : 'bg-gray-600'}">${c.status}</span>
                    </div>
                    <p class="text-xs text-gray-400 mb-2">${c.niche}</p>
                    <div class="space-y-1 text-xs">
                        <div class="flex justify-between">
                            <span>Progress</span>
                            <span class="font-bold">${c.progress}%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-1.5">
                            <div class="bg-teal-500 h-1.5 rounded-full" style="width: ${c.progress}%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span>Revenue</span>
                            <span class="text-green-400">Rp ${(c.revenue/1000000).toFixed(1)}M</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Leads</span>
                            <span>${c.leads}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Customers</span>
                            <span>${c.customers}</span>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-t border-gray-700">
                        <p class="text-xs text-gray-500">рҹ“» Doing: ${c.doing_now[0] || '-'}</p>
                    </div>
                </div>
            `).join('');
        }
        
        // Auto-refresh every 30 seconds
        loadCommandCenter();
        setInterval(loadCommandCenter, 30000);
    </script>
</body>
</html>
```

### 2. Revenue Services JSON untuk RS
```json
{
  "services": [
    {
      "id": "01",
      "name": "Pelayanan Medis",
      "type": "Healthcare Services",
      "status": "active",
      "revenue": 0,
      "target": 100000000,
      "progress": 0,
      "quarter": "Q2",
      "lastUpdated": "2026-07-04T00:00:00Z",
      "activeSince": "2026-07-04"
    },
    {
      "id": "02",
      "name": "Laboratorium",
      "type": "Lab Services",
      "status": "ready",
      "revenue": 0,
      "target": 50000000,
      "progress": 0,
      "quarter": "Q2"
    },
    {
      "id": "03",
      "name": "Farmasi",
      "type": "Pharmacy",
      "status": "ready",
      "revenue": 0,
      "target": 30000000,
      "progress": 0,
      "quarter": "Q2"
    },
    {
      "id": "04",
      "name": "Kamar Inap",
      "type": "Inpatient",
      "status": "pending",
      "revenue": 0,
      "target": 50000000,
      "progress": 0,
      "quarter": "Q3"
    }
  ]
}
```

---

## рҹ“Ӣ Profit Distribution (Diadopsi dari MAHA-LAKSHMI)

### Per SBU (@ Rp 100.000.000)
| Kategori | Persen | Jumlah | Tujuan |
|----------|--------|--------|--------|
| Owner Share | 60% | Rp 60.000.000 | BCA 6485086645 |
| Reinvestasi | 25% | Rp 25.000.000 | Company Reserve |
| Team Bonus | 10% | Rp 10.000.000 | Team Members |
| Charity | 5% | Rp 5.000.000 | CSR Account |

---

## рҹ“” Trigger Phrases

Skill ini aktif ketika user menyebutkan:
- "maha laksmi", "maha-laksmi", "MAHA-LAKSHMI-CORP"
- "revenue tracker", "command center", "dashboard"
- "kasir api", "sistem kasir"
- "auto status", "status otomatis"
- "laporan harian", "daily report"
- "WhatsApp laporan", "WA integration"
- "10 sbu", "multi company"
- "adopsi skill", "copy fitur dari maha"
- "github.com/prahlad168/MAHA-LAKSHMI-CORP"

---

## рҹ“§ Contoh Penggunaan

### 1. Buat Command Center Dashboard
```
User: "Buat command center dashboard seperti MAHA-LAKSHMI-CORP untuk RS Payangan"
AI: Membuat dashboard dengan real-time metrics, company cards, dan auto-refresh
```

### 2. Setup Revenue Tracking
```
User: "Implementasikan revenue tracker untuk semua layanan RS"
AI: Membuat API, dashboard, dan auto-status system
```

### 3. Daily Report dengan WhatsApp
```
User: "Setup laporan harian RS untuk direktur via WhatsApp"
AI: Membuat cron job dan WhatsApp integration dengan format pesan
```

### 4. Multi-SBU Management
```
User: "Kelola 10 unit bisnis RS dengan target Rp 1Miliar/bulan"
AI: Setup struktur SBU dengan 10 AI agents per unit
```

---

## рҹ“Ӣ Target System Integration

### Untuk RS Payangan Hospital
```
р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯ
рӮӨ                    вӮ№ MAHA LAKSHMI DIGITAL HOLDINGS                       рӮ№
рӮӨ                           CEO: i Made Purna Ananda                                  рӮ№
рӮӨ                         Target: Rp 1B/bulan                               рӮ№
р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯ

                                    вӮ№ CEO
                                       |
    вӮӣвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮ
    |                                  |                                  |
    вӮӨ                                  вӮӨ                                  вӮӨ
р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№  р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№  р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№
вӮё  COMMAND CENTER  вӮё    вӮё   10 SBUs        вӮё    вӮё  SHARED SERVICES  вӮё
вӮё  (Real-time)     вӮё    вӮё  (Revenue Units)  вӮё    вӮё  (Efficiency)     вӮё
р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№  р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№  р”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ”Ӯрҹ"рӮ№
         |                       |                       |
         вӮӨ                       вӮӨ                       вӮӨ
рӮӣвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№    вӮӣвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№    вӮӣвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№
рӮё GAURANGA Agent  рӮё    вӮё SBU-01 to SBU-10рӮё    рӮё AI Knowledge    рӮё
вӮё (Chief AI)      рӮё    вӮё Each with own    рӮё    рӮё Center          рӮё
вӮё                 рӮё    вӮё AI Agents        рӮё    вӮё                 рӮё
вӮё Daily Reports   рӮё    вӮё                 рӮё    вӮё SOP Library     рӮё
вӮё Strategy        рӮё    вӮё Director +      рӮё    вӮё Prompt Library  рӮё
вӮё Optimization    рӮё    вӮё 10 Sub-Agents   рӮё    вӮё Automation      рӮё
рӮё Innovation      рӮё    вӮё                 рӮё    вӮё Templates       рӮё
рӮ”вӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№    рӮ”вӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№    рӮ”вӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮвӮӮрӮ№
```

---

## рҹ“Ҹ Setup Instructions

### 1. Clone dari MAHA-LAKSHMI-CORP
```bash
# Clone repository
git clone https://github.com/prahlad168/MAHA-LAKSHMI-CORP.git

# Copy sistem yang diperlukan
cp -r MAHA-LAKSHMI-CORP/maha-lakshmi rs-payangan
cp -r MAHA-LAKSHMI-CORP/maha-command-center rs-payangan
```

### 2. Modify untuk RS Payangan
```bash
# Edit companies.json untuk layanan RS
vi data/services.json

# Update API endpoints
vi api.php
```

### 3. Setup Cron Job
```bash
# Laporan harian jam 8 pagi
0 8 * * * cd /home/payangan/public_html/rs-payangan && php api/daily-report.php >> /dev/null 2>&1
```

### 4. Configure WhatsApp
```php
// Edit api/daily-report.php
$CONFIG = [
    'wa_number' => '6281234567890',
    'wa_token' => 'YOUR_FONNTE_TOKEN',
    'use_wa' => true,
];
```

---

## рҹ“§ Quick Commands

### Test API
```bash
# List services
curl "https://payanganhospital.gianyarkab.go.id/rs-payangan/api/kasir.php?action=services"

# Add revenue
curl -X POST "https://payanganhospital.gianyarkab.go.id/rs-payangan/api/kasir.php?action=add" \
  -H "Content-Type: application/json" \
  -d '{"company_id": "01", "amount": 500000, "description": "Pemeriksaan darah"}'

# Generate daily report
curl "https://payanganhospital.gianyarkab.go.id/rs-payangan/api/daily-report.php?run=1"
```

### Trigger Daily Report Cron
```bash
# Via OpenHands automation
curl -X POST "https://app.all-hands.dev/api/automation/v1/{automation_id}/dispatch" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## рҹ“” Next Steps

- [ ] Integrasi dengan RS Admin Backend (rs-admin/)
- [ ] Koneksi ke database MySQL
- [ ] WhatsApp notification untuk antrean
- [ ] Real-time dashboard dengan WebSocket
- [ ] 10 AI Agents untuk setiap SBU
- [ ] Export laporan ke PDF/Excel
- [ ] Analytics dan predictive revenue

---

## рҹ“§ Reference Files dari Repository Asli

| File | URL |
|------|-----|
| Master Config | `maha-lakshmi/00-MASTER-UNIFIED.md` |
| MAHA OS | `MAHA-OS/01-MAHA-OS-v1.0.md` |
| CEO Dashboard | `maha-lakshmi/ceo-dashboard.html` |
| API | `maha-lakshmi/api.php` |
| Companies Data | `maha-lakshmi/data/companies.json` |
| Factory Index | `maha-factory/MAHA-FACTORY-INDEX.md` |

---

**Adopted from:** [MAHA-LAKSHMI-CORP](https://github.com/prahlad168/MAHA-LAKSHMI-CORP)
**Created:** 2026-07-04
**Version:** 2.0.0
**CEO:** i Made Purna Ananda
**Bank:** BCA 6485086645
