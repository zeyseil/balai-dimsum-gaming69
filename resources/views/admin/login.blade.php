<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Dimsum Login</title>

<style>
    body {
        margin: 0;
        padding: 0;
        background: #E9E9E9;
        font-family: 'Arial', sans-serif;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Judul */
    .balai-login-title {
        font-size: 32px;
        font-weight: 800;
        margin-top: 40px;
        margin-bottom: 25px;
        text-align: center;
        width: 100%;
    }

    /* Wrapper card */
    .balai-login-wrapper {
        width: 820px;
        height: 430px;
        background: white;
        border-radius: 22px;
        box-shadow: 0px 7px 18px rgba(0,0,0,0.15);
        display: flex;
        overflow: hidden;
        justify-content: center;
        align-items: center;
    }

    .balai-panel-left {
        width: 55%;
        padding: 45px 50px;
    }

    .balai-panel-right {
        width: 45%;
        background: #8B1C1C;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 60px;
        right: 20px;
        border-radius: 22px;
    }

    /* Input Label */
    .balai-input-group {
        margin-bottom: 25px;
    }

    .balai-input-label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
    }

    /* Input Field */
    .balai-input-field {
        width: 100%;
        padding: 12px 15px;
        background: #D9D9D9;
        border: none;
        border-radius: 20px;
        outline: none;
    }

    /* Tombol */
    .balai-submit-btn {
        width: 50%;
        background: #DD4747;
        padding: 12px 0;
        border-radius: 22px;
        border: none;
        font-size: 17px;
        font-weight: bold;
        color: white;
        box-shadow: 0px 6px 0px #B83D3D;
        cursor: pointer;
        transition: 0.2s;
        
    }

    .balai-submit-btn:active {
        transform: translateY(3px);
        box-shadow: 0px 3px 0px #B83D3D;
    }
</style>

</head>

<body>

<h1 class="balai-login-title">Balai Dimsum Dasboard</h1>

<div class="balai-login-wrapper">

    <div class="balai-panel-left">

        <form method="POST" action="#">

            <div class="balai-input-group">
                <label class="balai-input-label">username</label>
                <input type="text" name="username" class="balai-input-field" placeholder="Masukan Username">
            </div>

            <div class="balai-input-group">
                <label class="balai-input-label">password</label>
                <input type="password" name="password" class="balai-input-field" placeholder="Masukan Password">
            </div>

            <button class="balai-submit-btn">MASUK</button>
        </form>
    </div>

    <div class="balai-panel-right">
        <div>
            <h2>Selamat Datang</h2>
            <p>di Balai Dimsum dashboard<br>harap login terlebih dahulu</p>
        </div>
    </div>

</div>

</body>
</html>
