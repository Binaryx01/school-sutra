<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - School Sutra</title>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background: linear-gradient(to bottom right, #dbeafe, #f0f9ff);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #1e3a8a;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            color: #374151;
        }

        input[type='email'],
        input[type='password'] {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            outline: none;
            font-size: 1rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: #3b82f6;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #2563eb;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2><i class="fas fa-lock"></i> Login</h2>

        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    autofocus
                    value="{{ old('email') }}"
                />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required />
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>
