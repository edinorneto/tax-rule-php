# 📊 ICMS Tax Rule Simulator (PHP)

**Note:** This project uses **synthetic data** (fictional tax rates and values) generated for simulation purposes only. It is designed as a technical exercise to consolidate backend logic.

This project focuses on applying **PHP Fundamentals**—specifically **Control Structures** and **Operators**—to solve a real-world micro-problem in the fiscal sector: determining and calculating applicable ICMS rates for interstate operations. 

The goal is to demonstrate the "Study, Apply, and Share" methodology by converting theoretical concepts from the **PHP Manual** into a functional business tool. [9, 10]

### 🛠 Technologies & Concepts
*   **Language:** PHP 8.x (Basic Syntax, Variables, and Types)
*   **Control Structures:** `if/else`, `switch case`, Ternary Operator, and Null Coalescing (`??`) 
*   **Business Logic:** Implementation of fiscal rules for ICMS and FCP (Poverty Combat Fund).
*   **Version Control:** Git & GitHub following professional commit standards. [1, 14]

### 📁 Project Structure
The project is organized to separate logical processing from data entry, following early best practices for modularity.
*   `index.php`: HTML interface with a form to capture simulation data (Value, Origin, Destination).
*   `process.php`: The core engine that processes tax rules and returns calculated results.
*   `README.md`: Technical documentation and project overview.

### 🧩 Business Rules & Logic Implementation
To demonstrate mastery of **PHP Expressions and Operators**, this simulator validates:
1.  **Operation Type:** Uses `if/else` to compare Origin and Destination UFs to identify if the operation is Internal or Interstate.
2.  **Dynamic Rate Selection:** A `switch` block maps the destination state to its specific tax rate, ensuring efficient code organization.
3.  **FCP (Poverty Combat Fund):** Employs the **Ternary Operator** to determine surcharge eligibility based on simple logic.
4.  **Data Integrity:** Uses **Null Coalescing** (`??`) to handle empty inputs and ensure the system doesn't crash if data is missing.

### 🚀 Getting Started
1.  **Clone the project:**
    ```bash
    git clone https://github.com/your-username/icms-tax-simulator.git
    ```
2.  **Access the folder:**
    ```bash
    cd icms-tax-simulator
    ```
3.  **Run with PHP's built-in server:**
    ```bash
    php -S localhost:8000
    ```
4.  Open `http://localhost:8000` in your browser.

### 📈 Learning Outcomes
*   Consolidated knowledge of **PHP Syntax** and **Expressions**.
*   Applied **Conditional Structures** to complex tax scenarios. 
*   Practiced **Clean Code** by naming variables and functions descriptively.
*   Documented technical evolution as part of a structured **Career Plan**.

---
👨‍💻 **Author:** Edinor de Souza Neto - https://www.linkedin.com/in/edinor-de-souza-neto/ 
