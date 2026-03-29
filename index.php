<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-FIR Portal | Dispatcher</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --accent-blue: #0ea5e9;
            --accent-purple: #8b5cf6;
            --text-white: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-white);
            overflow: hidden;
        }

        .container {
            text-align: center;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 90%;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: #94a3b8;
            margin-bottom: 2.5rem;
        }

        .portal-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .portal-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            padding: 1.5rem;
            border-radius: 16px;
            text-decoration: none;
            color: var(--text-white);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .portal-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
            border-color: var(--accent-blue);
            box-shadow: 0 0 20px rgba(14, 165, 233, 0.2);
        }

        .icon {
            font-size: 2rem;
            color: var(--accent-blue);
        }

        .portal-card span {
            font-weight: 500;
            font-size: 1.1rem;
        }

        .admin-icon { color: var(--accent-purple); }
        .portal-card.admin:hover { border-color: var(--accent-purple); box-shadow: 0 0 20px rgba(139, 92, 246, 0.2); }

    </style>
</head>
<body>
    <div class="container">
        <h1>Gujarat Police E-FIR</h1>
        <p>Select the portal you wish to access</p>
        
        <div class="portal-links">
            <a href="FIR_project1/index.php" class="portal-card">
                <div class="icon">👤</div>
                <span>Citizen Portal</span>
            </a>
            <a href="Admin/login.php" class="portal-card admin">
                <div class="icon admin-icon">🛡️</div>
                <span>Admin Portal</span>
            </a>
        </div>
    </div>
</body>
</html>
