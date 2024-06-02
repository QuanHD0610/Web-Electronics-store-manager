<?php
session_start();
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle Add/Edit customer
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

        if (isset($_POST['customer_id']) && $_POST['customer_id'] != '') {
            // Edit customer
            $customer_id = intval($_POST['customer_id']);
            $sql = "UPDATE customer SET customer_name = :name, phone_number = :phone, email = :email, address = :address, gender = :gender WHERE customer_id = :customer_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name' => $name, ':phone' => $phone, ':email' => $email, ':address' => $address, ':gender' => $gender, ':customer_id' => $customer_id]);
        } else {
            // Add customer
            $sql = "INSERT INTO customer (customer_name, phone_number, email, address, gender) VALUES (:name, :phone, :email, :address, :gender)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name' => $name, ':phone' => $phone, ':email' => $email, ':address' => $address, ':gender' => $gender]);
        }
    }

    if (isset($_GET['delete_id'])) {
        // Handle delete customer
        $customer_id = intval($_GET['delete_id']);
        $sql = "DELETE FROM customer WHERE customer_id = :customer_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':customer_id' => $customer_id]);
    }

    // Fetch all customers
    $sql = "SELECT * FROM customer";
    $stmt = $pdo->query($sql);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch customer for edit
    $customer_to_edit = null;
    if (isset($_GET['edit_id'])) {
        $customer_id = intval($_GET['edit_id']);
        $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':customer_id' => $customer_id]);
        $customer_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Custom styles */
        .main-content {
            min-height: calc(100vh - 56px);
            /* Subtract navbar height */
            padding-top: 56px;
            /* Same height as navbar */
        }

        .sidebar {
            height: calc(100vh - 56px);
            /* Subtract navbar height */
            overflow-y: auto;
            /* Enable scrollbar if content overflows */
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            bottom: 0;
            width: 100%;
        }

        .sidebar.fixed-left {
            position: fixed;
            top: 56px;
            /* Height of navbar */
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
        }

        .main-content.fixed-left {
            padding-left: 200px;
            /* Width of sidebar */
        }

        /* CSS */
        .fixed-left {
            position: fixed;
            top: 56px;
            /* Chiều cao của navbar */
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            padding-top: 15px;
            /* Điều chỉnh khoảng cách giữa đỉnh cửa sổ và sidebar */
        }

        .main-content {
            padding-left: 200px;
            /* Chiều rộng của sidebar */
        }

        @media (max-width: 768px) {

            /* Đảm bảo rằng sidebar sẽ không cố định ở trên các thiết bị di động */
            .fixed-left {
                position: relative;
                top: auto;
                bottom: auto;
                left: auto;
                z-index: auto;
                overflow-y: visible;
                padding-top: 0;
            }

            .main-content {
                padding-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-content">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-2 col-lg-2 d-md-block bg-dark sidebar fixed-left">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Admin/oder_view.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="brand_view.php">Brand</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Category_view.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customer_view.php">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Integrations</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="col-md-10 col-lg-10" style="margin-left:100px">
                <div class="container">
                    <h1>Customer Management</h1>

                    <form method="post" class="mb-3">
                        <input type="hidden" name="customer_id"
                            value="<?php echo isset($customer_to_edit['customer_id']) ? htmlspecialchars($customer_to_edit['customer_id']) : ''; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?php echo isset($customer_to_edit['customer_name']) ? htmlspecialchars($customer_to_edit['customer_name']) : ''; ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?php echo isset($customer_to_edit['phone_number']) ? htmlspecialchars($customer_to_edit['phone_number']) : ''; ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo isset($customer_to_edit['email']) ? htmlspecialchars($customer_to_edit['email']) : ''; ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?php echo isset($customer_to_edit['address']) ? htmlspecialchars($customer_to_edit['address']) : ''; ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male" <?php echo isset($customer_to_edit['gender']) && $customer_to_edit['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo isset($customer_to_edit['gender']) && $customer_to_edit['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo isset($customer_to_edit['gender']) && $customer_to_edit['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="btn btn-success"><?php echo isset($customer_to_edit) ? 'Update Customer' : 'Add Customer'; ?></button>
                        <?php if (isset($customer_to_edit)): ?>
                            <a href="customer_management.php" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                                    <td><?php echo htmlspecialchars($customer['customer_name']); ?></td>
                                    <td><?php echo htmlspecialchars($customer['phone_number']); ?></td>
                                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                                    <td><?php echo htmlspecialchars($customer['address']); ?></td>
                                    <td><?php echo htmlspecialchars($customer['gender']); ?></td>
                                    <td>
                                        <a href="customer_view.php?edit_id=<?php echo htmlspecialchars($customer['customer_id']); ?>"
                                            class="btn btn-primary">Edit</a>
                                        <a href="customer_view.php?delete_id=<?php echo htmlspecialchars($customer['customer_id']); ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            &copy; 2024 Admin Dashboard. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>