# 📊 ICMS Tax Rule Simulator (PHP)

> **Disclaimer:** This project uses **synthetic (fictional) data** for learning purposes only. It is a technical exercise to practice backend logic and **must not** be used for real tax calculation or compliance.

A small PHP 8.x simulator that determines whether an operation is **internal** or **interstate** and applies **ICMS** and (optionally) **FCP** rules based on simple conditional logic.

## 🎯 Purpose
This repository was built to practice **PHP fundamentals** (control structures and operators) by implementing a realistic micro-problem: selecting rates and calculating totals for an interstate operation scenario.

## 🛠 Tech Stack & Concepts
- **PHP 8.x**
- **Control Structures:** `if/else`, `switch`, ternary operator `?:`
- **Operators:** comparisons, arithmetic, and **null coalescing** `??`
- **Project organization:** simple separation between UI (`index.php`) and engine (`process.php`)
- **Version control:** Git & GitHub

## 📁 Project Structure
- `index.php` — Simple HTML interface with a form (value, origin UF, destination UF)
- `process.php` — Core engine: validates input, applies tax rules, returns calculated results
- `README.md` — Documentation

## 🧩 Business Rules (Simulation)
The simulator implements the following logic:

1. **Operation type (Internal vs Interstate)**
   - If **origin UF == destination UF** → Internal operation
   - Else → Interstate operation

2. **Rate selection (ICMS)**
   - A `switch` statement maps **destination UF** to a simulated ICMS rate.

3. **FCP (Poverty Combat Fund)**
   - A ternary condition decides whether an FCP surcharge applies (simulation rule).

4. **Data integrity**
   - Uses `??` (null coalescing) to safely handle missing form fields and prevent runtime errors.

> Note: The rates and conditions are intentionally simplified and fictional.

## ✅ Requirements
- PHP **8.x**

## 🚀 Getting Started
1. **Clone the repository**
   ```bash
   git clone https://github.com/edinorneto/tax-rule-php.git
   ```

2. **Enter the project folder**
   ```bash
   cd tax-rule-php
   ```

3. **Run with PHP built-in server**
   ```bash
   php -S localhost:8000
   ```

4. **Open in your browser**
   - `http://localhost:8000`

## 🧪 Example (Expected Flow)
1. Enter:
   - Value: `1000.00`
   - Origin: `SP`
   - Destination: `RJ`
2. The app:
   - Detects it as **interstate**
   - Selects the ICMS rate by destination UF
   - Applies FCP (if eligible by rule)
   - Shows calculated amounts and totals

*(The exact output depends on the fictional mapping inside `process.php`.)*

## 📌 Notes / Limitations
- This is a **learning project**, not a fiscal product.
- State rules are simplified and do not represent real ICMS legislation.
- If you want, you can extend it by:
  - moving rates to an array/config file,
  - adding UF validation,
  - adding automated tests,
  - returning results as JSON for a future frontend.

## 👨‍💻 Author
**Edinor de Souza Neto**  
LinkedIn: https://www.linkedin.com/in/edinor-de-souza-neto/