<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MFA Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      transition: background 0.3s, color 0.3s;
    }

    .dark-mode { background: #121212; color: #fff; }

    .container {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .dark-mode .container { background: #1e1e1e; }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    input {
      width: 94%;
      padding: 0.75rem;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      background: #fafafa;
      outline: none;
    }

    .dark-mode input {
      background: #2e2e2e;
      border: 1px solid #444;
      color: white;
    }

    button {
      width: 100%;
      padding: 0.75rem;
      font-weight: 600;
      background-color: #4f46e5;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background-color: #4338ca;
    }

    .dark-toggle {
      position: absolute;
      top: 20px;
      right: 20px;
      cursor: pointer;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

  <div class="dark-toggle" onclick="toggleDarkMode()">🌙</div>

  <div class="container">
    <h2>Enter MFA Code</h2>
    <p style="text-align:center; font-size: 0.95rem;">We sent a 6-digit code to your email</p>
    <form method="POST" action="{{ route('verify-mfa-submit') }}">
        @csrf
      <div class="form-group">
        <input type="text" name="token" placeholder="6-digit MFA Code" required maxlength="6">
      </div>
      <button type="submit">Verify</button>
    </form>
  </div>

  <script>
    function toggleDarkMode() {
      document.body.classList.toggle("dark-mode");
    }
  </script>

</body>
</html>
