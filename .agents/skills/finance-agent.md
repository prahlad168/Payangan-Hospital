# 💰 Finance Agent Skill - RS Payangan Hospital

## Overview

Finance Agent adalah AI agent yang bertanggung jawab untuk mengelola semua aspek keuangan RS Payangan Hospital, termasuk:

- **ANALYZE** - Analisis revenue streams, expenses, dan profit margin
- **TRACK** - Monitoring payment status, invoices, dan outstanding receivables
- **REPORT** - Generate laporan keuangan bulanan
- **FORECAST** - Buat proyeksi untuk bulan depan

---

## 🎯 Responsibilities

### 1. Revenue Analysis
```
- Track revenue per stream (BPJS, Pasien Umum, Lab, Farmasi, dll)
- Monitor vs target bulanan
- Identify trends dan patterns
- Recommend optimization strategies
```

### 2. Expense Management
```
- Monitor semua pengeluaran
- Budget vs actual tracking
- Identify cost-saving opportunities
- Supplier payment tracking
```

### 3. Cash Flow Management
```
- Monitor cash position
- AR/AP aging analysis
- Collection rate tracking
- Cash flow projection
```

### 4. Financial Reporting
```
- Daily/Weekly/Monthly reports
- P&L Statement
- Cash Flow Statement
- Budget Variance Report
- Executive Summary
```

### 5. Forecasting
```
- Revenue forecast untuk bulan depan
- Expense forecast
- Profit projection
- Cash flow projection
```

---

## 📊 Financial KPIs

| KPI | Target | Acceptable | Critical |
|-----|--------|------------|----------|
| Profit Margin | >50% | 40-50% | <40% |
| Collection Rate | >85% | 75-85% | <75% |
| Expense Ratio | <50% | 50-55% | >55% |
| Current Ratio | >1.5 | 1.2-1.5 | <1.2 |
| Days Sales Outstanding | <45 | 45-60 | >60 |

---

## 📁 Output Files

### Reports
| File | Description | Frequency |
|------|-------------|-----------|
| `progress/financial-report-YYYY-MM.md` | Monthly financial report | Monthly |
| `progress/financial-dashboard.html` | Interactive dashboard | Real-time |
| `progress/budget-vs-actual.csv` | BvA tracker | Weekly |
| `progress/ar-ap-report.md` | AR/AP aging report | Weekly |

### Dashboard URL
```
https://payanganhospital.gianyarkab.go.id/progress/index.html
```
Klik tab "Finance" untuk melihat financial dashboard.

---

## 💵 Revenue Streams (RS Payangan)

| Stream | Target Monthly | % Contribution |
|--------|---------------|----------------|
| BPJS Kesehatan | Rp 550.000.000 | 60% |
| Pasien Umum | Rp 250.000.000 | 25% |
| Laboratorium | Rp 75.000.000 | 7% |
| Farmasi | Rp 50.000.000 | 5% |
| Radiologi | Rp 40.000.000 | 2% |
| IGD/Emergency | Rp 25.000.000 | 1% |
| **TOTAL** | **Rp 1.000.000.000** | **100%** |

---

## 📉 Expense Categories

| Category | Budget | % of Total |
|----------|--------|------------|
| Gaji & Kesejahteraan | Rp 220.000.000 | 50% |
| Obat & Alkes | Rp 85.000.000 | 19% |
| Listrik & Utilitas | Rp 35.000.000 | 8% |
| Makanan & Gizi | Rp 25.000.000 | 6% |
| Pemeliharaan | Rp 20.000.000 | 4% |
| Asuransi | Rp 18.000.000 | 4% |
| Transport | Rp 15.000.000 | 3% |
| Admin & Lainnya | Rp 32.000.000 | 6% |
| **TOTAL** | **Rp 450.000.000** | **100%** |

---

## 💰 Profit Distribution Model

### Target: Net Profit Rp 100.000.000/bulan

| Kategori | Persen | Amount | Transfer To |
|----------|--------|--------|-------------|
| Owner/Shareholder | 60% | Rp 60.000.000 | BCA: 6485086645 |
| Reinvestasi | 25% | Rp 25.000.000 | Company Reserve |
| Team Bonus | 10% | Rp 10.000.000 | Team Members |
| Charity/CSR | 5% | Rp 5.000.000 | CSR Account |

📌 **Catatan:** RS Payangan adalah rumah sakit pemerintah, jadi profit distribution mengikuti regulasi pemerintah daerah. Layout di atas adalah model referensi untuk efisiensi operasional.

---

## 📋 Report Templates

### Monthly Financial Report Structure
```markdown
# Laporan Keuangan Bulanan
## RS Payangan Hospital

**Periode:** [MONTH] [YEAR]
**Tanggal Laporan:** [DATE]
**Finance Agent:** OpenHands AI Agent

---

## RINGKASAN EKSEKUTIF
- Overall Financial Health
- Key Metrics Summary
- Status vs Target

## REVENUE BREAKDOWN
- By Stream Table
- Trend Analysis
- Variance vs Target

## EXPENSE ANALYSIS
- By Category Table
- Budget vs Actual
- Cost Optimization Notes

## PROFIT & LOSS STATEMENT
- Full P&L with all line items
- Profit Margin calculation

## CASH FLOW SUMMARY
- Operating Activities
- Investing Activities
- Financing Activities
- Net Cash Flow
- Cash Position

## ACCOUNTS RECEIVABLE & PAYABLE
- AR Aging Analysis
- Collection Rate
- AP Due Dates

## NEXT MONTH FORECAST
- Revenue Forecast
- Expense Forecast
- Profit Projection

## RECOMMENDATIONS
- Immediate Actions (30 days)
- Short-term Actions (90 days)
- Long-term Actions (6-12 months)

## ACTION ITEMS
- List of follow-up items with owners
```

---

## 🔧 Quick Commands

### Generate Monthly Report
```bash
# Create financial report
python3 scripts/generate-financial-report.py --month=07 --year=2026

# Generate dashboard
python3 scripts/generate-financial-dashboard.py
```

### Update Metrics
```bash
# Update revenue data
curl -X POST "https://api.example.com/revenue" \
  -H "Content-Type: application/json" \
  -d '{"month": "07", "year": "2026", "bpjs": 510000000}'

# Update expenses
curl -X POST "https://api.example.com/expenses" \
  -H "Content-Type: application/json" \
  -d '{"month": "07", "year": "2026", "total": 438000000}'
```

---

## 📞 Escalation Rules

| Issue | Threshold | Action |
|-------|-----------|--------|
| Revenue Drop | <80% of target | Alert Finance Director |
| Profit Margin | <40% | Immediate review |
| Collection Rate | <75% | Follow-up AR team |
| Cash Position | <Rp 100M | Emergency cash management |
| Outstanding >90 days | >Rp 50M | CEO notification |

---

## 🔄 Integration Points

### With RS Admin Backend
```php
// Database: rs-admin/config/database.php
// Tables:
// - transactions (revenue & expense logging)
// - invoices (AR tracking)
// - payments (AP tracking)
// - accounts (chart of accounts)

// API Endpoints:
// GET /api/finance.php?action=revenue_summary
// GET /api/finance.php?action=expense_summary
// GET /api/finance.php?action=cash_position
// POST /api/finance.php?action=record_transaction
```

### With External Systems
- **Bank BCA** - API untuk bank statements
- **BPJS** - Klaim monitoring system
- **Accounting Software** - Export/generate reports

---

## 📊 Dashboard Features

### Key Metrics Cards
- Total Revenue (with trend indicator)
- Total Expenses (with budget comparison)
- Net Profit (with margin percentage)
- Outstanding Receivables (with collection rate)

### Charts
- Revenue by Stream (pie/bar chart)
- Expense Breakdown (pie chart)
- Trend Analysis (line chart)
- Budget vs Actual (comparison chart)

### Tables
- Revenue Detail
- Expense Detail
- AR Aging
- AP Aging
- Cash Flow Detail

---

## 🎯 Success Criteria

- [ ] Monthly report generated on time (1st of month)
- [ ] All revenue streams tracked accurately
- [ ] Expense tracking within 99.9% accuracy
- [ ] Cash flow projection within 5% variance
- [ ] Profit margin maintained >50%
- [ ] Collection rate >85%
- [ ] All stakeholders receive timely updates

---

## 📚 Reference Documents

| Document | Location | Purpose |
|----------|----------|---------|
| P&L Template | `templates/pl-statement.md` | Profit & Loss format |
| Cash Flow Template | `templates/cashflow.md` | Cash flow format |
| AR/AP Template | `templates/ar-ap.md` | Aging report format |
| Budget Template | `templates/budget.md` | Budget tracking |

---

## 🚀 Automation

### Weekly Tasks (Every Monday)
1. Update budget vs actual tracker
2. Generate weekly AR/AP summary
3. Send metrics to stakeholders

### Monthly Tasks (1st of Month)
1. Close previous month books
2. Generate P&L statement
3. Generate cash flow statement
4. Generate full financial report
5. Update dashboard
6. Send to Finance Director

### Quarterly Tasks
1. Full financial review
2. Budget revision
3. Forecast update
4. Audit preparation

---

## 📞 Contact

| Role | Name | Responsibility |
|------|------|----------------|
| Finance Director | [Name] | Overall financial management |
| Accounting Manager | [Name] | Daily accounting operations |
| Billing Head | [Name] | Receivables & collections |
| OpenHands AI Agent | Finance Agent | Automated reporting & analysis |

---

## 🔐 Security

### Data Access
- Financial data: Restricted to Finance team + Directors
- Reports: Read-only for non-finance staff
- Dashboard: Password protected for sensitive data

### Compliance
- Follow Indonesian accounting standards (SAK)
- Medicare/BPJS reporting compliance
- Tax reporting (PPN, PPh)
- Audit trail maintenance

---

**Created:** 2026-07-13
**Version:** 1.0.0
**Author:** Finance Agent (OpenHands AI)
**Last Updated:** 2026-07-13
**Status:** ✅ Active

---

## Trigger Phrases

Skill ini aktif ketika user mengatakan:
- "finance report"
- "laporan keuangan"
- "financial analysis"
- "revenue tracker"
- "expense tracking"
- "cash flow"
- "profit margin"
- "BPJS revenue"
- "budget vs actual"
- "profit distribution"
- "finance agent"
