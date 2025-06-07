<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #6c13f7, #a845ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 450px;
            /* Increased width */
            padding: 40px;
            /* More padding */
            border-radius: 20px;
            background: white;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 18px 50px;
            /* Bigger padding */
            border-radius: 30px;
            border: 1px solid #ccc;
            outline: none;
            background: #f3f3f3;
            font-size: 18px;
            /* Larger text */
        }

        .form-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c13f7;
            font-size: 22px;
            /* Bigger icons */
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            /* Bigger button */
            border-radius: 30px;
            background: linear-gradient(145deg, #6c13f7, #a845ff);
            border: none;
            font-size: 22px;
            /* Bigger button text */
            font-weight: bold;
        }

        .text-muted {
            margin-top: 15px;
            font-size: 16px;
        }

        .form-group input[type="file"] {
            padding: 12px 50px;
            font-size: 16px;
            background: #f3f3f3;
            border-radius: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="card">
    <h1 class="mb-4">Login</h1>
    <form action="{{route('show.login')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <i class="bi bi-person-circle"></i>
            <input name="name" type="text" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
            <i class="bi bi-lock"></i>
            <input name="password" type="password" id="password" class="form-control" placeholder="Password"
                   required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">LOGIN</button>
    </form>
</div>
</body>
</html>
