<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .register-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"],
        .register-form input[type="tel"],
        .register-form select {
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .register-form input[type="submit"] {
            border-radius: 5px;
            padding: 12px 0;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include ("Lib/header.php") ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-container">
                    <h2 class="register-title">Đăng ký tài khoản</h2>
                    <form class="register-form" method="POST" action="register_process.php">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    placeholder="Họ và tên" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="username" class="form-label">Tên tài khoản</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Tên tài khoản" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Mật khẩu" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Giới tính</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="" disabled selected>Giới tính</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                    placeholder="Số điện thoại" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Địa chỉ" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check mb-6">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms" style="font-size:13px;">Tôi đã đọc và
                                        đồng ý với <a href="#" class="text-decoration-none">Điều kiện sử dụng - Thỏa
                                            thuận người dùng</a> của website.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include ("Lib/footer.php") ?>
</body>

</html>