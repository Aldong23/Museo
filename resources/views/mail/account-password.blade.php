<style>
    .email-wrapper {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .email-header {
        background: #DC3848;
        color: #ffffff;
        text-align: center;
        padding: 20px;
        font-size: 22px;
        font-weight: bold;
    }

    .email-container {
        max-width: 600px;
        margin: 20px auto;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .email-content {
        padding: 20px;
        font-size: 16px;
        color: #333;
    }
    .email-content p {
        margin: 10px 0;
    }
    .email-highlight {
        font-weight: bold;
    }
    .email-password {
        color: #DC3848;
        font-weight: bold;
    }
    .email-button-container {
        text-align: center;
        margin: 20px 0;
    }
    .email-button {
        background: #DC3848;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
    }
</style>

<div class="email-wrapper">
    <div class="email-container">
        <div class="email-header">
            Museo De Urdaneta
        </div>
        <div class="email-content">
            <p><span class="email-highlight">Hello, {{ $user->fname . ' ' . $user->mname . ' ' . $user->lname . ' ' . $user->suffix }}!</span></p>
            <p>Your account has been successfully registered in <span class="email-highlight">Museo De Urdaneta</span>.</p>
            <br>
            <p>Here are your login credentials:</p>
            <p><span class="email-highlight">Email:</span> {{ $user->email }}</p>
            <p><span class="email-highlight">Password:</span> <span class="email-password">{{ $password }}</span></p>
            <br>
            <p>Please log in and update your password as soon as possible.</p>
            <div class="email-button-container">
                <a href="https://urdanetacitymuseum.com/login" class="email-button">Login at Museo De Urdaneta</a>
            </div>
            <p>If the button does not work, copy and paste the following URL into your browser:</p>
            <p>https://urdanetacitymuseum.com/login</p>
        </div>
    </div>
</div>
