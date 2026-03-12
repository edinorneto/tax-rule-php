# 💼 Cadastro de Produtos & Consulta Fiscal para NF — PHP Web App

> **Disclaimer:** This project uses **synthetic (fictional) data** for learning purposes only. It is a technical exercise and **must not** be used for real tax calculation or compliance. Always consult a tax specialist.

A PHP 8.x web application for product registration and fiscal consultation for invoice issuance (NF-e). The system allows registering products and automatically retrieving the correct tax data (ICMS, IPI, PIS, COFINS) based on the tax regime and destination region — all through a browser interface.

This project is a web reimagining of a [previous terminal-based Python solution](https://github.com/edinorneto/cadastro-consulta), rebuilt in PHP/HTML/CSS to deepen back-end web fundamentals and reinforce separation of concerns in a multi-file architecture.

---

## 🎯 Purpose

This repository was built to practice **PHP fundamentals** in a realistic, multi-screen web context:

- Control structures: `if/else`, `switch`, ternary operator `?:`
- Operators: comparisons, arithmetic, and **null coalescing** `??`
- Data persistence with **JSON** via `file_get_contents` / `file_put_contents`
- Multi-file architecture with clear separation between UI, engine, and data layers
- HTML forms, POST handling, and user input validation in PHP
- Version control: Git & GitHub

---

## 🛠 Tech Stack

- **PHP 8.x**
- **HTML5 + CSS3** (custom design system, no frameworks)
- **JSON** for persistent product storage
- **Git & GitHub**

---

## 📁 Project Structure

```
├── index.php               # Main menu: register or consult
├── cadastro.php            # HTML form to register a new product
├── process_cadastro.php    # Receives POST, validates and saves to JSON
├── consulta.php            # Product selection, regime and region form
├── process_consulta.php    # Crosses product + regime + region, returns fiscal data
├── tax_rules.php               # Associative array with fictional tax rules (ICMS, IPI, PIS, COFINS)
├── config.php              # Global constants (JSON file path, settings)
├── data.php                # Read/write functions for JSON — isolated data layer
├── style.css               # Full design system (dark fintech theme)
├── produtos.json           # Persistent product database (auto-generated)
└── README.md               # Documentation
```
---

## 🧩 Business Rules (Simulation)

### 1. Product Registration
- Collects: name, description, price, category, stock, unit, NCM (8 digits), active status
- Auto-generates: sequential ID, registration timestamp (America/Sao_Paulo)
- Persists data to `produtos.json` via `file_put_contents`

### 2. Fiscal Consultation
- User selects a registered product, a tax regime and a destination region
- System crosses this data against `tax_rules.php` to retrieve:
  - **CFOP** — Fiscal Operation Code
  - **CST** — Tax Situation Code
  - **ICMS Taxation Code**
  - **Tax rates:** ICMS, IPI, PIS, COFINS
  - **Legal description** of the applied rule

### 3. Tax Regimes (Fictional)
- **Convênio XX** — simulates exemption (internal) and base reduction (interstate)
- **TTD XX** — simulates deferral for all destinations

### 4. Destination Regions
- Internal: SC
- Interstate: PR, RS, MT, MS

> Note: All rates and rules are intentionally simplified and fictional.

---

## ✅ Requirements

- PHP **8.x**
- Write permission on the project folder (for JSON persistence)

---

## 🚀 Getting Started

1. **Clone the repository**
   ```bash
   git clone https://github.com/edinorneto/cadastro-fiscal-php.git
   cd cadastro-fiscal-php
   ```

2. **Run with PHP built-in server**
   ```bash
   php -S localhost:8000
   ```

3. **Open in your browser**
   ```
   http://localhost:8000
   ```

4. **Use the menu to:**
   - Register a new product (name, NCM, price, stock, etc.)
   - Consult fiscal data for an invoice — select product, regime and destination

---

## 🧪 Example Flow

1. Register a product:
   - Name: `Ureia Agrícola`
   - NCM: `31021010`
   - Price: `R$ 1500,00` | Stock: `1000 kg`

2. Consult for invoice:
   - Product: `Ureia Agrícola`
   - Regime: `Convênio XX`
   - Destination: `Externa / PR`

3. System returns:
   ```
   CFOP:       6102 – Venda interestadual nacional
   CST:        7 - Importada sem similar nacional
   Cód. Trib.: 020
   ICMS:       6,0%  |  IPI: 0%  |  PIS: 0%  |  COFINS: 0%
   ```

---

## 👨‍💻 Author

**Edinor de Souza Neto**
LinkedIn: https://www.linkedin.com/in/edinor-de-souza-neto/
