---
name: network-speed
description: This skill should be used when user says "internet cepat", "speed internet", "network optimization", "DNS cepat", "browser speed", "internet lambat", "optimasi internet", "wifi cepat", "download cepat", "browsing cepat", atau setiap kali user butuh bantuan untuk mempercepat koneksi internet secara legal.
---

# Network Speed Optimization Skill

## Overview

Panduan lengkap untuk mempercepat koneksi internet secara **legal** menggunakan metode optimization yang valid dan aman.

## ⚙️ This System Optimization

### Linux System Commands

```bash
# Check current DNS
cat /etc/resolv.conf

# Check network interfaces
ip addr

# Test DNS speed
dig cloudflare.com
dig google.com

# Speed test
curl -s https://raw.githubusercontent.com/sivel/speedtest-cli/master/speedtest.py | python3
```

### Quick Speed Test
```bash
# Method 1: Fast.com
curl -s https://api.fast.com/netflix/speedtest?https=true | python3 -m json.tool

# Method 2: Download test file
curl -o /dev/null -s -w "Speed: %{speed_download} bytes/sec\n" https://speed.hetzner.de/1MB.bin

# Method 3: iPerf3 (if available)
iperf3 -c speedtest.serverius.nl
```

### DNS Benchmark
```bash
# Benchmark DNS servers
time nslookup google.com

# Test different DNS
DNS_SERVER="1.1.1.1" dig @${DNS_SERVER} cloudflare.com +short
DNS_SERVER="8.8.8.8" dig @${DNS_SERVER} cloudflare.com +short
DNS_SERVER="9.9.9.9" dig @${DNS_SERVER} cloudflare.com +short
```

### Network Optimization Commands

```bash
# Flush DNS cache (Linux)
systemd-resolve --flush-caches

# Check MTU
ip link show | grep mtu

# Optimize TCP window
sysctl -w net.core.rmem_max=2500000
sysctl -w net.core.wmem_max=2500000

# Enable BBR congestion control
sysctl -w net.core.default_qdisc=fq
sysctl -w net.ipv4.tcp_congestion_control=bbr
```

### Browser Setup for Speed

```
Chrome/Firefox optimization:
1. Install "Fast.com" extension
2. Enable DNS over HTTPS (DoH)
3. Clear cache daily
4. Disable unused extensions
```

## ⚡ Quick Wins (Yang Langsung Bisa Dilakukan)

### 1. Ganti DNS untuk Speed Lebih Cepat

| DNS Provider | Primary | Secondary |
|--------------|---------|-----------|
| **Cloudflare** | 1.1.1.1 | 1.0.0.1 |
| **Google** | 8.8.8.8 | 8.8.4.4 |
| **Quad9** | 9.9.9.9 | 149.112.112.112 |

**Windows:**
```
Settings → Network & Internet → Adapter Options
→ IPv4 Properties → Use: 1.1.1.1, 1.0.0.1
```

**Mac:**
```
System Preferences → Network → Advanced → DNS
→ Add: 1.1.1.1, 1.0.0.1
```

### 2. Flush DNS Cache

```bash
# Windows (CMD as Admin)
ipconfig /flushdns

# Mac
sudo dscacheutil -flushcache
sudo killall -HUP mDNSResponder
```

### 3. Clear Browser Cache

**Chrome:** `Ctrl + Shift + Delete` → Select "All time" → Clear

### 4. Disable Startup Programs

```bash
# Windows
Task Manager → Startup → Disable unnecessary apps
```

## 🌐 DNS Optimization

### Mengapa DNS Affects Speed?

DNS resolver yang cepat = website load lebih cepat

### Setup DNS Steps

#### Windows 10/11
```
1. Open Settings → Network & Internet
2. Click "Change adapter options"
3. Right-click your connection → Properties
4. Select "Internet Protocol Version 4"
5. Click "Use the following DNS server addresses"
6. Enter: 1.1.1.1 and 1.0.0.1
7. Click OK → Done
```

#### Android
```
1. Settings → WiFi → Hold your network
2. Modify Network → Show advanced options
3. Set IP to Static
4. DNS1: 1.1.1.1
5. DNS2: 1.0.0.1
```

#### iPhone
```
1. Settings → WiFi → Tap your network
2. Configure DNS
3. Select "Manual"
4. Add: 1.1.1.1, 1.0.0.1
```

## 🔧 Browser Optimization

### Chrome Speed Tips

```
1. Enable QUIC protocol
   chrome://flags → #enable-quic → Enabled

2. Disable unnecessary extensions
   chrome://extensions → Disable non-essential

3. Preload websites
   Settings → Privacy → Preload pages

4. Limit tab usage
   Each tab = RAM & CPU usage
```

### Firefox Speed Tips

```
1. Enable HTTP/3
   about:config → network.http.http3.enabled → true

2. Disable middle-click search
   about:config → middlemouse.contentLoadURL → false

3. Clear cache regularly
   Ctrl + Shift + Delete
```

## 📊 Speed Test Sites

| Site | URL |
|------|-----|
| **Fast.com** | https://fast.com |
| **Speedtest** | https://speedtest.net |
| **Cloudflare** | https://speed.cloudflare.com |
| **nPerf** | https://nperf.com |

## 🏠 Router Optimization

### 1. Reboot Router
```
Matikan router 30 detik → Nyalakan lagi
Ini clear cache dan refresh connection
```

### 2. Optimal Router Placement
```
- Center rumah
- Tinggi dari lantai
- Jauh dari microwave/wireless devices
```

### 3. Change WiFi Channel
```
Login router: 192.168.1.1
Scan WiFi channels
Pilih channel yang kurang crowded
```

### 4. Use 5GHz Band
```
5GHz = Speed lebih cepat, range lebih pendek
2.4GHz = Speed lebih lambat, range lebih jauh
```

## 📱 Mobile Data Tips

### Android
```
1. Restrict background data
   Settings → Network → Data Saver → ON

2. Disable auto-sync
   Settings → Accounts → Auto-sync → OFF

3. Use Lite apps
   Facebook Lite, Instagram Lite, Twitter Lite
```

### iOS
```
1. Settings → Cellular → Disable unnecessary apps
2. Settings → Safari → Block pop-ups
3. Settings → WiFi → Ask to Join → OFF (save battery)
```

## 🔒 Security vs Speed

| Setting | Secure | Fast | Recommended |
|---------|--------|------|-------------|
| VPN | ✅ | ❌ | Only when needed |
| DNS over HTTPS | ✅ | ✅ | **Recommended** |
| Clear Cache | ✅ | ✅ | **Daily** |
| Incognito | ✅ | ✅ | For sensitive browsing |

## ⚙️ Windows Network Optimization

### Disable Nagle Algorithm
```reg
# Create file: naggle-fix.reg
Windows Registry Editor Version 5.00

[HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\Tcpip\Parameters\Interfaces\{YOUR-INTERFACE}]
"TcpAckFrequency"=dword:00000001
"TCPNoDelay"=dword:00000001
```

### Enable Network Auto-Tuning
```cmd
# Run as Admin
netsh interface tcp set global autotuninglevel=normal
```

### Reset Network Stack
```cmd
# Run as Admin
netsh winsock reset
netsh int ip reset
ipconfig /release
ipconfig /renew
ipconfig /flushdns
```

## 📋 Daily Maintenance Checklist

- [ ] Reboot router jika internet lambat
- [ ] Clear browser cache
- [ ] Flush DNS cache
- [ ] Close unused tabs
- [ ] Check for malware

## 🚀 Advanced: DNS over HTTPS (DoH)

### Chrome DoH Setup
```
1. chrome://settings/security
2. Scroll to "Advanced"
3. Enable "Use secure DNS"
4. Select "Cloudflare (1.1.1.1)"
```

### Firefox DoH Setup
```
1. about:preferences#general
2. Scroll to "Network Settings"
3. Click "Settings"
4. Enable "Enable DNS over HTTPS"
5. Select provider or custom
```

## 📝 Troubleshooting

### Problem: Internet Still Slow

1. **Restart everything**
   ```
   Modem → Router → Computer
   Wait 1 minute between each
   ```

2. **Check for throttling**
   ```
   ISP sometimes throttles certain traffic
   Try at different times of day
   ```

3. **Test different server**
   ```
   Speedtest to different servers
   Some servers are closer/faster
   ```

4. **Contact ISP**
   ```
   If all else fails, call provider
   Could be line/service issue
   ```

### Problem: DNS Not Working

1. Clear DNS cache
2. Check DNS addresses
3. Try alternate DNS
4. Reset router

## 📚 Resources

- Cloudflare: https://1.1.1.1/dns/
- Google DNS: https://developers.google.com/speed/public-dns
- Speedtest: https://speedtest.net
- Windows Network Docs: https://support.microsoft.com

## ⚠️ Warning

**Yang TIDAK dilakukan:**
- ❌ Crack WiFi password
- ❌ Use proxychains untuk illegal
- ❌ Bypass ISP restriction illegal
- ❌ Download pirated software untuk "speed"

**Yang WAJIB dilakukan:**
- ✅ Gunakan DNS legitimate
- ✅ Clear cache secara berkala
- ✅ Update router firmware
- ✅ Gunakan HTTPS/DoH

## ✅ Skill Summary

| Category | Action |
|----------|--------|
| DNS | Use 1.1.1.1 |
| Browser | Clear cache, disable extensions |
| Router | Reboot, 5GHz band |
| System | Flush DNS, reset network |
| Mobile | Data saver, Lite apps |

---

## 📚 Research & Learning

### Literasi Network (1 per menit)

** Sumber Belajar:**
1. Cloudflare Blog: https://blog.cloudflare.com
2. Google DNS Docs: https://developers.google.com/speed/public-dns
3. Speedtest Blog: https://www.speedtest.net/insights
4. How-To Geek: https://www.howtogeek.com
5. techradar: https://www.techradar.com

**Topik untuk dipelajari:**
- DNS optimization fundamentals
- TCP/IP performance tuning
- Browser rendering optimization
- Network latency reduction
- CDN benefits
- HTTP/2, HTTP/3, QUIC protocols
- Packet loss & retransmission
- Bandwidth management

---

**Legal disclaimer:** Semua tips di sini 100% legal dan aman. Tidak ada craking, hacking, atau aktivitas ilegal.
