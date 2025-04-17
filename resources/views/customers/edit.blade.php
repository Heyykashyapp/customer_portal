<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Customer</title>
  <style>
    * {
      box-sizing: border-box;
      
    }

    body {
      background: linear-gradient(135deg, #fef6e4, #fcd5ce);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      animation: fadeIn 1s ease-in-out;
    }

    .form-container {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      animation: slideUp 0.6s ease-out;
    }

    h2 {
      margin-bottom: 20px;
      color: #ff7b00;
      text-align: center;
    }

    label {
      margin-top: 10px;
      font-weight: 600;
      display: block;
      color: #333;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus {
      border-color: #ff7b00;
      box-shadow: 0 0 5px rgba(255, 123, 0, 0.4);
      outline: none;
    }

    button {
      margin-top: 20px;
      width: 100%;
      background: #ff7b00;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #e06b00;
      transform: translateY(-2px);
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    @keyframes slideUp {
      0% { transform: translateY(40px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Customer</h2>
    <form id="editForm">
      <label>First Name
        <input type="text" name="first_name" required>
      </label>
      <label>Last Name
        <input type="text" name="last_name" required>
      </label>
      <label>Email
        <input type="email" name="email" required>
      </label>
      <label>Age
        <input type="number" name="age" required>
      </label>
      <label>DOB
        <input type="date" name="dob" required>
      </label>
      <button type="submit">Update</button>
    </form>
  </div>

  <script>
    const id = {{ $id }};
    const form = document.getElementById('editForm');

    fetch(`/api/customers/${id}`)
      .then(res => res.json())
      .then(c => {
        form.first_name.value = c.first_name;
        form.last_name.value = c.last_name;
        form.email.value = c.email;
        form.age.value = c.age;
        form.dob.value = c.dob;
      });

    form.onsubmit = e => {
      e.preventDefault();
      const data = Object.fromEntries(new FormData(form).entries());

      fetch(`/api/customers/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      }).then(() => window.location.href = '/customers');
    };
  </script>
</body>
</html>
