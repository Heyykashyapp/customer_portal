<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #74ebd5;
            --accent: #acb6e5;
            --text: #333;
            --error: #ff4d4d;
        }

        * {
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        body {
            margin: 0;
            
            background: linear-gradient(to right, var(--secondary), var(--accent));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.95);}
            to {opacity: 1; transform: scale(1);}
        }

        .form-container {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 500px;
            animation: slideUp 1s ease;
        }

        @keyframes slideUp {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h2 {
            text-align: center;
            color: var(--text);
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
            color: var(--text);
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
        }

        button {
            width: 100%;
            padding: 0.85rem;
            background-color: var(--primary);
            color: white;
            font-size: 1.1rem;
            margin-top: 1.8rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #357abd;
        }

        .back-link {
            display: block;
            margin-top: 1rem;
            text-align: center;
            color: var(--primary);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Create New Customer</h2>
    <form id="customerForm">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <button type="submit">Save Customer</button>
    </form>

    <a href="{{ route('customers.index') }}" class="back-link">← Back to Customer List</a>
</div>

<script>
    document.getElementById('customerForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const data = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            dob: document.getElementById('dob').value,
            age: document.getElementById('age').value,
            email: document.getElementById('email').value
        };

        const response = await fetch("/api/customers", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            window.location.href = "{{ route('customers.index') }}";
        } else {
            const error = await response.json();
            alert("Error: " + (error.message || "Something went wrong"));
        }
    });
</script>
</body>
</html>
