let bootstrapModal;

function showLogInModal() {
    const loginModal = document.getElementById('login-modal');
    bootstrapModal = new bootstrap.Modal(loginModal);
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
            if (response === "Success") {
                alert("Log In Success");
                window.location.reload();
            } else {
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
    bootstrapModal = new bootstrap.Modal(signupModal);
    bootstrapModal.show();

}

function showLogInModal2() {
    bootstrapModal.hide();
    const loginModal = document.getElementById('login-modal');
    bootstrapModal = new bootstrap.Modal(loginModal);
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
            if (response === "Success") {
                alert("Verification send please check Your email");
                showVerificationModal();
            } else {
                alert(response);
            }
        }
    };
    request.open("post", "signUpProcess.php", true);
    request.send(form);
}

function showVerificationModal() {
    bootstrapModal.hide();
    const verificationModal = document.getElementById('verification-modal');
    bootstrapModal = new bootstrap.Modal(verificationModal);
    bootstrapModal.show();
}

function verifyEmail() {
    let email = document.getElementById('signup-email').value;
    let verificationCode = document.getElementById('verification-code').value;

    const form = new FormData();
    form.append('email', email);
    form.append('verificationCode', verificationCode);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response === 'Success') {
                alert("Email Verified Successfully!");
                showLogInModal2();
            } else {
                alert(response);
            }
        }
    };
    request.open("post", "emailVerification.php", true);
    request.send(form);
}

function signout() {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response === "Success") {
                window.location = 'index.php';
                window.location.reload();
            }
        }
    };
    request.open("get", "signOut.php", true);
    request.send();
}


function updateProfile() {

    let profileName = document.getElementById("profile-name").value;
    let profileCurrentPassword = document.getElementById("profile-current-password").value;
    let profileNewPassword = document.getElementById("profile-new-password").value;

    const form = new FormData();
    form.append("name", profileName);
    form.append("current-password", profileCurrentPassword);
    form.append("new-password", profileNewPassword);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                alert("Profile Updated Successfully");
            } else if (response == "No Update") {
                alert("No Updates Found");
            } else {
                alert(response);
            }
        }
    };
    request.open("post", "myProfileProcess.php", true);
    request.send(form);

}


function selectImage() {
    let profilePic = document.getElementById("profile-pic");
    let showProfilePic = document.getElementById("show-profile-pic");

    profilePic.onchange = function () {

        let imageFile = this.files[0];

        const form = new FormData();
        form.append("image", imageFile);


        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                const response = request.responseText;
                if (response == "Success") {
                    let imageUrl = window.URL.createObjectURL(imageFile);
                    showProfilePic.src = imageUrl;
                    window.location.reload();
                } else {
                    alert(response);
                }
            }
        };
        request.open("post", "profilePicProcess.php", true);
        request.send(form);





    }
}

function postAd() {

    let adTitle = document.getElementById("ad-title").value;
    let adPrice = document.getElementById("ad-price").value;
    let adDescription = document.getElementById("ad-description").value;
    let adCategory = document.getElementById("ad-category").value;

    let adPhoto1 = document.getElementById("ad-photo1").files[0];
    let adPhoto2 = document.getElementById("ad-photo2").files[0];
    let adPhoto3 = document.getElementById("ad-photo3").files[0];

    var form = new FormData();
    form.append("ad-title", adTitle);
    form.append("ad-price", adPrice);
    form.append("ad-description", adDescription);
    form.append("ad-category", adCategory);

    form.append("ad-photo1", adPhoto1);
    form.append("ad-photo2", adPhoto2);
    form.append("ad-photo3", adPhoto3);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                alert("Ad Posted Successfully!");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };

    request.open('post', 'postAdProcess.php', true);
    request.send(form);
}

function selectAdPhoto1() {
    let adPhoto1 = document.getElementById("ad-photo1");
    let adShowImage1 = document.getElementById("ad-show-image1");
    adPhoto1.onchange = function () {
        let adPhoto = adPhoto1.files[0];
        let adPhotoUrl = window.URL.createObjectURL(adPhoto);
        adShowImage1.src = adPhotoUrl;
    }
}

function selectAdPhoto2() {
    let adPhoto2 = document.getElementById("ad-photo2");
    let adShowImage2 = document.getElementById("ad-show-image2");
    adPhoto2.onchange = function () {
        let adPhoto = adPhoto2.files[0];
        let adPhotoUrl = window.URL.createObjectURL(adPhoto);
        adShowImage2.src = adPhotoUrl;
    }
}

function selectAdPhoto3() {
    let adPhoto3 = document.getElementById("ad-photo3");
    let adShowImage3 = document.getElementById("ad-show-image3");
    adPhoto3.onchange = function () {
        let adPhoto = adPhoto3.files[0];
        let adPhotoUrl = window.URL.createObjectURL(adPhoto);
        adShowImage3.src = adPhotoUrl;
    }
}

function showAddCategoryModal() {
    const addCategoryModal = document.getElementById('add-category-modal');
    bootstrapModal = new bootstrap.Modal(addCategoryModal);
    bootstrapModal.show();
}

function showCategoryImage() {
    let categoryImage = document.getElementById("category-image");
    let categoryShowImage = document.getElementById("category-show-image");
    categoryImage.onchange = function () {
        let categoryPic = categoryImage.files[0];
        let categoryPicUrl = window.URL.createObjectURL(categoryPic);
        categoryShowImage.src = categoryPicUrl;
    }
}

function addNewCategory() {

    let categoryName = document.getElementById("category-name").value;
    let categoryImage = document.getElementById("category-image").files[0];

    var form = new FormData();
    form.append("category-name", categoryName);
    form.append("category-image", categoryImage);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                alert("Category Added Successfully!");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };
    request.open('post', 'addCategoryProcess.php', true);
    request.send(form);

}

function changeStatus(id) {

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };
    request.open('get', 'changeStatusProcess.php?id=' + id, true);
    request.send();

}

function adminLogIn() {

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    var form = new FormData();
    form.append("email", email);
    form.append("password", password);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                window.location = 'dashboard.php';
            } else {
                alert(response);
            }
        }
    };
    request.open('post', 'adminLogInProcess.php', true);
    request.send(form);

}

function changeAdStatus(id) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            if (response == "Success") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };
    request.open('get', 'changeAdStatusProcess.php?id=' + id, true);
    request.send();

}

function viewSingleAd(id) {
    window.location = 'singleAdView.php?id=' + id;
}