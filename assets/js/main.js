let bootstrapModal;

function showLogInModal() {
    const loginModal = document.getElementById('login-modal');
    bootstrapModal =  new bootstrap.Modal(loginModal);
    bootstrapModal.show();

}

function logIn() {
    let email = document.getElementById("login-email").value;
    let password = document.getElementById("login-password").value;

    const form = new FormData();
    form.append("email", email);
    form.append("password", password);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response === "success") {
                alert ("Login Success");
            }else{
                alert(response);
            }
        }
    };
    request.open("post", "logInProcess.php", true);
    request.send(form);
}

function showSignUpModal() {
    bootstrapModal.hide();
    const signupModal = document.getElementById('signup-modal');
    bootstrapModal =  new bootstrap.Modal(signupModal);
    bootstrapModal.show();

}

function showLogInModal2() {
    bootstrapModal.hide();
    const loginModal = document.getElementById('login-modal');
    bootstrapModal =  new bootstrap.Modal(loginModal);
    bootstrapModal.show();
}

function signUp() {
    let name = document.getElementById("signup-name").value;
    let email = document.getElementById("signup-email").value;
    let password = document.getElementById("signup-password").value;

    const form = new FormData();
    form.append("name", name);
    form.append("email", email);
    form.append("password", password);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response === "success") {
                alert ("Verification send please check Your email");
            }else{
                alert(response);
            }
        }
    };
    request.open("post", "signUpProcess.php", true);
    request.send(form);
}