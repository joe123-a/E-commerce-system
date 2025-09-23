<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .form-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-container w-full max-w-md p-8 rounded-lg shadow-lg bg-white">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>
        
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'space-y-6'],
            'fieldConfig' => [
                'errorOptions' => ['class' => 'error-message'],
            ],
        ]); ?>

        <div>
            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'class' => 'w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500',
                'placeholder' => 'Enter your username'
            ])->label('Username', ['class' => 'block text-sm font-medium text-gray-700']) ?>
        </div>

        <div>
            <?= $form->field($model, 'password')->passwordInput([
                'class' => 'w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500',
                'placeholder' => 'Enter your password'
            ])->label('Password', ['class' => 'block text-sm font-medium text-gray-700']) ?>
        </div>

        <div class="flex items-center justify-between">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "{input} <span class=\"text-sm text-gray-600\">{label}</span>\n{error}",
                'labelOptions' => ['class' => 'ml-2']
            ]) ?>
        </div>

        <div>
            <?= Html::submitButton('Login', [
                'class' => 'w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200'
            ]) ?>
        </div>

      

        <?php ActiveForm::end(); ?>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const username = document.getElementById('loginform-username').value;
            const password = document.getElementById('loginform-password').value;
            
            if (!username || !password) {
                e.preventDefault();
                alert('Please fill in both username and password fields.');
            }
        });
    </script>
</body>
</html>