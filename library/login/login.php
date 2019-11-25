<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Library_LogIn_Page">
    <meta name="keywords" content="Library_LogIn">
    <meta name="author" content="SeokHoKim">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginCSS.css">
</head>
<body>
    <form method="post">
        <p>ID <input type="text" id="idTextBox" name="idTextBox"></p>
        <p>Password <input type="password" id="pwTextBox" name="pwTextBox"></p>
        <input type="button" value="Sign In" onclick="signIn()">
        <input type="button" value="Sign Up" onclick="initSignUp()">
    </form>
    <div id="signUpModal" class="modal">
        <form id='signUpContent' class="modal-content" method="post">
            <p>ID <input type="text" id="idSignUpBox" name="idSignUpBox" placeholder="input id" required></p>
            <p>Password <input type="text" id="pwSignUpBox" name="pwSignUpBox" placeholder="input password" required></p>
            <p>Name <input type="text" id="nameSignUpBox" name="nameSignUpBox" placeholder="input name" required></p>
            <p>E-Mail <input type="email" id="emailSignUpBox" name="emailSignUpBox" placeholder="input e-mail" required></p>
            <p>Phone Number <input type="number" id="phoneSignUpBox" pattern="[0-9][0-9](|[0-9])-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]" placeholder="input phone number (include '-')" name="phoneSignUpBox" required></p>
            <p>Classification
                <input type="text" id="classificationSignUpBox" name="classificationSignUpBox" list="choices" required>
                <datalist id="choices">
                    <option value="학부"></option>
                    <option value="대학원"></option>
                    <option value="교직원"></option>
                </datalist></p>
            <input type="button" value="Cancel" onclick="cancelSignUp()">
            <input type="button" value="Done" onclick="signUp()">
        </form>
    </div>
    <script src="loginJS.js"></script>
</body>
</html>