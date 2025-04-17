<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome | Customer Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {

      background: #f4f4f4;
      margin: 0;
      padding: 0;
      transition: background 0.3s, color 0.3s;
    }

    .dark-mode {
      background: #121212;
      color: #f1f1f1;
    }

    .container {
      max-width: 400px;
      margin: 5vh auto;
      padding: 2rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .dark-mode .container {
      background: #1e1e1e;
      box-shadow: 0 0 0 1px #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    input {
      width: 94%;
      padding: 0.7rem;
      border-radius: 5px;
      border: 1px solid #ccc;
      outline: none;
      background: #fafafa;
    }

    .dark-mode input {
      background: #2e2e2e;
      border: 1px solid #444;
      color: #fff;
    }

    button {
      width: 100%;
      padding: 0.7rem;
      border: none;
      background: #4f46e5;
      color: white;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #4338ca;
    }

    .toggle-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #666;
      cursor: pointer;
    }

    .dark-toggle {
      position: absolute;
      top: 15px;
      right: 15px;
      cursor: pointer;
      font-size: 1.2rem;
    }
  </style>
</head>

<body>




  <div class="dark-toggle" onclick="toggleDarkMode()">🌙</div>

  
<section class="container" >
  <div  id="loginForm">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.submit') }}">
      @csrf
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <button type="submit">Login</button>

    </form>
    <div class="toggle-link" onclick="toggleForm()">Don't have an account? Register</div>
  </div>

  <div  id="registerForm" style="display: none;">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.submit') }}">
      @csrf
      <div class="form-group">
        <input type="text" name="name" placeholder="Name" required />
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <button type="submit">Register</button>



    </form>
    <div class="toggle-link" onclick="toggleForm()">Already have an account? Login</div>

   
  </div>
  @if(session('success'))
  <div id="successMsg" style="color: green; text-align: center; margin-bottom: 10px;">
    {{ session('success') }}
  </div>
  @endif


  @if($errors->any())
  <div id="errorMsg" style="color: red; text-align: center; margin-bottom: 10px;">
    <ul style="list-style: none; padding: 0;">
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  </section>
  <script>
    function toggleForm() {
      const loginForm = document.getElementById("loginForm");
      const registerForm = document.getElementById("registerForm");
      loginForm.style.display = loginForm.style.display === "none" ? "block" : "none";
      registerForm.style.display = registerForm.style.display === "none" ? "block" : "none";
    }

    function toggleDarkMode() {
      document.body.classList.toggle("dark-mode");
    }
  </script>


  <script>
    setTimeout(() => {
      const successBox = document.getElementById('successMsg');
      const errorBox = document.getElementById('errorMsg');
      if (successBox) successBox.style.display = 'none';
      if (errorBox) errorBox.style.display = 'none';
    }, 6000); 
  </script>

</body>

</html>