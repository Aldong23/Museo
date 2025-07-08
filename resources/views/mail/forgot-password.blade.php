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
</style>

<div class="email-wrapper">
    <div class="email-container">
        <div class="email-header">
            Museo De Urdaneta
        </div>
        <div class="email-content">
            <p><span class="email-highlight">Hello, {{ $user->fname . ' ' . $user->mname . ' ' . $user->lname . ' ' . ($user->suffix ?? '') }}!</span></p>
            <br>
            <p>Your verification code is:</p>
            <p><span class="email-password">{{ $password }}</span></p>
            <p>Please use this code to proceed with your request.</p>
        </div>
    </div>
</div>