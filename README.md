# VulnWeb: Corporate Portal (2012 Edition)

**⚠️ EDUCATIONAL WARNING ⚠️** This application contains **INTENTIONAL, CRITICAL SECURITY VULNERABILITIES**. It is built strictly for educational purposes, security training, and portfolio demonstration. **DO NOT** deploy this code in a production environment. Passwords are intentionally stored in plaintext to demonstrate fundamental flaws.

## Project Description
VulnWeb is a small, realistic PHP web application designed to mimic an internal corporate portal from the 2012-2015 era. It serves as a practical playground for understanding common web vulnerabilities by reviewing vulnerable source code and exploiting it in a safe, local environment.

## Features
* Classic 2012-era corporate UI.
* User Registration and Authentication.
* Employee Dashboard and Profile Views.
* Employee Directory Search.
* Automated SQLite database provisioning.

## Technologies
* **Backend:** PHP 8 (Vanilla/No Frameworks)
* **Database:** SQLite3
* **Frontend:** HTML5, CSS3, Vanilla JavaScript

## Existing Vulnerabilities
This initial version includes the following intentional vulnerabilities:
1. **SQL Injection (SQLi):** Authentication bypass on the login page.
2. **Insecure Direct Object Reference (IDOR):** Unauthorized access to other users' profiles via the profile ID parameter.
3. **Reflected Cross-Site Scripting (XSS):** Unsanitized input reflection on the search page.

## Project Structure
```text
/
├── index.php         # Landing page
├── login.php         # Vulnerable login (SQLi)
├── register.php      # User registration
├── dashboard.php     # Authenticated dashboard
├── profile.php       # Vulnerable profile view (IDOR)
├── search.php        # Vulnerable search (Reflected XSS)
├── logout.php        # Session termination
├── includes/
│   ├── config.php    # Global configuration
│   ├── db.php        # SQLite connection
│   └── setup.php     # DB initialization and demo data
├── assets/
│   ├── style.css     # 2012 Corporate UI styling
│   └── script.js     # Basic frontend logic
└── README.md
