<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2">InnTrack</h3>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tenetur molestias laudantium aut distinctio provident similique quisquam ad sit voluptates, libero, error ex corporis, id sequi expedita dignissimos maxime quasi rem?
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="home.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a> <br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a> <br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow us</h5>
            <?php
            if ($contact_r['fb'] != '') {
                echo <<<data
                    <a href="$contact_r[fb]" target="_blank" class="d-inline-block text-dark text-decoration-none mb-2">
                        <i class="bi bi-facebook me-1"></i>
                        Facebook
                    </a> <br>
                    data;
            }
            ?>

            <a href="<?php echo $contact_r['ig'] ?>" target="_blank" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-instagram me-1"></i>
                Instagram
            </a> <br>
            <a href="<?php echo $contact_r['tt'] ?>" target="_blank" class="d-inline-block text-dark text-decoration-none">
                <i class="bi bi-tiktok me-1"></i>
                TikTok
            </a> <br>
        </div>
    </div>
</div>

<div class="text-center bg-dark text-white crt fs-md-6 fs-lg-6 p-3 m-0">Developed by Group 1</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


<script>
    function alert(type, msg) {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let bg_color = (type == 'success') ? '#d1e7dd' : '#f8d7da';
        let text_color = (type == 'success') ? '#0f5132' : '#842029';
        let border_color = (type == 'success') ? '#badbcc' : '#f5c2c7';

        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert" 
                style="background-color: ${bg_color}; color: ${text_color}; border: 1px solid ${border_color}; border-radius: 0.375rem; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); animation: slideInRight 0.3s ease-out;">
                <strong class="me-2">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Get or create alert container
        let container = document.getElementById('alert-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'alert-container';
            container.style.cssText = 'position: fixed; top: 80px; right: 25px; z-index: 1050; min-width: 350px;';
            document.body.appendChild(container);
        }

        container.appendChild(element);

        // Auto remove after 4 seconds
        // setTimeout(function() {
        //     element.querySelector('.alert').classList.remove('show');
        //     setTimeout(function() {
        //         element.remove();
        //     }, 150);
        // }, 4000);

        setTimeout(remAlert, 3000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }


    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('pincode', register_form.elements['pincode'].value);
        data.append('dob', register_form.elements['dob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'pass_mismatch') {
                alert('error', "Password Mismatch!");
            } else if(this.responseText == 'email_already') {
                alert('error', "Email is already registered!");
            } else if(this.responseText == 'phone_already') {
                alert('error', "Phone number is already registered!");
            } else if(this.responseText == 'inv_img') {
                alert('error', "Only JPG, WEBP, and PNG are allowed!");
            } else if(this.responseText == 'upd_failed') {
                alert('error', "Image upload failed!");
            } else if(this.responseText == 'mail_failed') {
                alert('error', "Cannot send confirmation email! Server down!");
            } else if(this.responseText == 'ins_failed') {
                alert('error', "Regisration failed! Server down!");
            } else {
                alert('success', "Regisration successful. Confirmation link sent to email!");
                register_form.reset();
            }
        }

        xhr.send(data);
    });


    setActive();
</script>