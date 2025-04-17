<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer List</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
    
      background: #f0f4f8;
      padding: 40px;
      color: #333;
      animation: fadeIn 1s ease-in-out;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 2rem;
      color: #007bff;
      animation: slideIn 0.8s ease-out;
    }

    .container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
      overflow: hidden;
      animation: fadeInUp 1.2s ease-out;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
    }

    .actions a {
      background: #28a745;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .actions a:hover {
      background: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background: #007bff;
      color: white;
      text-align: left;
      padding: 14px;
      font-size: 0.95rem;
    }

    td {
      padding: 14px;
      border-top: 1px solid #e9ecef;
      font-size: 0.93rem;
    }

    tr:hover {
      background: #f1faff;
      animation: highlightRow 0.3s ease-in-out;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 0.85rem;
      cursor: pointer;
      margin-right: 5px;
      text-decoration: none;
    }

    .edit-btn {
      background-color: #ffc107;
    }

    .edit-btn:hover {
      background-color: #e0a800;
    }

    .delete-btn {
      background-color: #dc3545;
    }

    .delete-btn:hover {
      background-color: #bd2130;
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    @keyframes slideIn {
      0% { transform: translateX(-30px); opacity: 0; }
      100% { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeInUp {
      0% { transform: translateY(30px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes highlightRow {
      0% { background: #f1faff; }
      100% { background: #d1ecf1; }
    }
  </style>
</head>
<body>

  <h2>Customer List</h2>

  <div class="container">
    <div class="actions">
      <div><strong>Manage your customers efficiently</strong></div>
      <a href="/customers/create">+ Add Customer</a>
    </div>

    <table id="customerTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Age</th>
          <th>DOB</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    fetch('/api/customers')
      .then(res => res.json())
      .then(data => {
        const tbody = document.querySelector('#customerTable tbody');
        tbody.innerHTML = data.map(c => `
          <tr>
            <td>${c.first_name} ${c.last_name}</td>
            <td>${c.email}</td>
            <td>${c.age}</td>
            <td>${c.dob}</td>
            <td>
              <a href="/customers/${c.id}/edit" class="btn edit-btn">Edit</a>
              <button class="btn delete-btn" onclick="deleteCustomer(${c.id})">Delete</button>
            </td>
          </tr>
        `).join('');
      });

    function deleteCustomer(id) {
      if (confirm('Are you sure you want to delete this customer?')) {
        fetch(`/api/customers/${id}`, { method: 'DELETE' })
          .then(() => location.reload());
      }
    }
  </script>

</body>
</html>
