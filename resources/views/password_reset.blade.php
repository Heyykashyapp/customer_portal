<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Password Reset</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h1 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 1rem;
      margin-bottom: 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      width: 100%;
      padding: 1rem;
      background-color: #4f46e5;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background-color: #4338ca;
    }

    .message {
      margin-top: 1rem;
      text-align: center;
    }

  </style>
</head>
<body>

  <div class="container">
    <h1>Password Reset</h1>
    <form id="reset-form">
      <input type="email" id="email" placeholder="Enter your email" required>
      <button type="submit">Send Password Reset Link</button>
    </form>

    <div id="message" class="message"></div>
  </div>

  <script>
    document.getElementById('reset-form').addEventListener('submit', async function(event) {
      event.preventDefault();

      const email = document.getElementById('email').value;
      const response = await fetch('/api/password/email', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email })
      });

      const data = await response.json();
      const messageElement = document.getElementById('message');

      if (response.ok) {
        messageElement.innerHTML = "<p>Password reset link sent to your email!</p>";
      } else {
        messageElement.innerHTML = `<p>Error: ${data.message}</p>`;
      }
    });
  </script>

</body>
</html>
