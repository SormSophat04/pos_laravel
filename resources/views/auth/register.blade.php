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

        .card-add-staff {
            width: 1030px;
            /* Increased width */
            padding: 40px;
            /* More padding */
            border-radius: 20px;
            background: white;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
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

        .form-group select {
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
    <div class="d-flex justify-content-center gap-5">
        <div class="card-add-staff">
            <h1 class="mb-4 text-start">List Staff</h1>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="max-h-[880px] overflow-y-auto">
                    <table class="w-full table-auto border-collapse" id="product-table">
                        <thead class="bg-blue-50 text-blue-700 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-sm">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Name</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Email</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Time</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">Role</th>
                                <th class="px-4 py-3 text-center font-semibold text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-gray-700">{{ $user->id }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->time }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $user->role }}</td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex justify-center gap-2">
                                            <form action="{{ route('product.showup', $user->id) }}" method="get">
                                                @csrf
                                                <button type="submit"
                                                    class=" items-center px-3 py-1 bg-warning text-white rounded-md hover:bg-blue-600 transition-colors duration-150"
                                                    title="{{ __('message.edit') }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('{{ __('message.confirm_delete') }}')"
                                                    type="submit"
                                                    class="items-center px-3 py-1 bg-danger text-white rounded-md hover:bg-red-600 transition-colors duration-150"
                                                    title="{{ __('message.delete') }}">
                                                   <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <h1 class="mb-4">Add Staff</h1>
            <form action="{{ route('show.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <i class="bi bi-person-circle"></i>
                    <input name="name" type="text" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <i class="bi bi-clock"></i>
                    <input name="time" type="text" class="form-control" placeholder="Time" required>
                </div>
                <div class="form-group">
                    <i class="bi bi-envelope"></i>
                    <input name="email" type="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                    <i class="bi bi-lock"></i>
                    <input name="password" type="password" id="password" class="form-control" placeholder="Password"
                        required>
                </div>
                <div class="form-group">
                    <i class="bi bi-people"></i>
                    <select name="role" class="form-control" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="cashier">Cashier</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </form>
        </div>
    </div>
</body>

</html>
