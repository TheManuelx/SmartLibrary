<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-image: url('/image/Background.png');
                background-size: cover;
                background-position: center;
                text-align: center;
            }
            .input-group {
                padding: 5px;
                margin: 5px;
            }
            .input-form {
                border: 1px solid black;
                border-radius: 25px;
                display: inline-block;
                padding: 20px;
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <div>
            <form class="input-form" method="POST" action="{{ route('validate') }}">
                @csrf
                <h1>Login</h1>
                <div class="input-group">
                    <label>Email : </label>
                    <input type="email" name="email" required autofocus>
                </div>
                <div class="input-group">
                    <label>Password : </label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>