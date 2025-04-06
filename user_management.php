<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #6a11cb;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px 0;
        }
        input, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            color: white;
        }
        td a {
            text-decoration: none;
            color: red;
            font-weight: bold;
            cursor: pointer;
        }
        .navbar {
    width: 100%;
    text-align: center;
    margin: 20px 0;
}

.home-button {
    display: inline-block;
    padding: 12px 20px;
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
    color: white;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.home-button:hover {
    background: linear-gradient(135deg, #ff7eb3, #ff758c);
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

.home-button:active {
    transform: scale(0.95);
}

    </style>
</head>
<body>

<h2>User Management</h2>

<!-- Form thêm người dùng -->
<form id="userForm">
    <input type="text" id="username" placeholder="Username" required>
    <input type="email" id="email" placeholder="Email" required>
    <input type="password" id="password" placeholder="Password" required>
    <button type="submit">Add User</button>
</form>

<div class="navbar">
    <a href="web.php" class="home-button">🏠 Back to Home</a>
</div>

<!-- Danh sách người dùng -->
<table id="userTable">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
</table>

<script>
// Lấy danh sách người dùng từ localStorage
function loadUsers() {
    let users = JSON.parse(localStorage.getItem("users")) || [];
    let table = document.getElementById("userTable");
    
    // Xóa danh sách cũ trước khi cập nhật
    table.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>`;

    users.forEach((user, index) => {
        let row = table.insertRow();
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td><a href="#" onclick="deleteUser(${index})">Delete</a></td>`;
    });
}

// Thêm người dùng vào localStorage
document.getElementById("userForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    
    if (!username || !email || !password) {
        alert("Please fill all fields");
        return;
    }

    let users = JSON.parse(localStorage.getItem("users")) || [];
    users.push({ username, email, password });
    localStorage.setItem("users", JSON.stringify(users));

    document.getElementById("userForm").reset();
    loadUsers();
});

// Xóa người dùng khỏi localStorage
function deleteUser(index) {
    let users = JSON.parse(localStorage.getItem("users")) || [];
    users.splice(index, 1);
    localStorage.setItem("users", JSON.stringify(users));
    loadUsers();
}

// Tải danh sách người dùng khi trang mở
loadUsers();
</script>

</body>
</html>
