let general_data, contacts_data;

let team_s_form = document.getElementById("team_s_form");
let member_name_inp = document.getElementById("member_name_inp");
let member_picture_inp = document.getElementById("member_picture_inp");

function alert(type, msg) {
  let alertContainer = document.getElementById("alert-container");
  let bgColor = type === "success" ? "#d4edda" : "#f8d7da";
  let textColor = type === "success" ? "#155724" : "#721c24";
  let borderColor = type === "success" ? "#c3e6cb" : "#f5c6cb";

  let alertDiv = document.createElement("div");
  alertDiv.className = "alert alert-dismissible fade show";
  alertDiv.style.cssText = `background-color: ${bgColor}; color: ${textColor}; border: 1px solid ${borderColor}; border-radius: 0.25rem; min-width: 300px;`;
  alertDiv.innerHTML = `
                <strong>${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

  alertContainer.innerHTML = "";
  alertContainer.appendChild(alertDiv);

  setTimeout(function () {
    let bsAlert = new bootstrap.Alert(alertDiv);
    bsAlert.close();
  }, 4000);
}

function get_general() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    general_data = JSON.parse(this.responseText);

    document.getElementById("site_title").innerText = general_data.site_title;
    document.getElementById("site_about").innerText = general_data.site_about;

    document.getElementById("site_title_inp").value = general_data.site_title;
    document.getElementById("site_about_inp").value = general_data.site_about;

    document.getElementById("shutdown-toggle").checked =
      general_data.shutdown == 1;
  };
  xhr.send("get_general=1");
}

function resetModal() {
  document.getElementById("site_title_inp").value = general_data.site_title;
  document.getElementById("site_about_inp").value = general_data.site_about;
}

document
  .getElementById("general_s_form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    let site_title_val = document.getElementById("site_title_inp").value;
    let site_about_val = document.getElementById("site_about_inp").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      let modalElement = document.getElementById("general-s");
      let modal = bootstrap.Modal.getInstance(modalElement);

      if (this.responseText == 1) {
        alert("success", "Changes saved!");
        get_general();
        modal.hide();
      } else {
        alert("error", "No changes made!");
      }
    };

    xhr.send(
      "site_title=" +
        encodeURIComponent(site_title_val) +
        "&site_about=" +
        encodeURIComponent(site_about_val) +
        "&upd_general=1"
    );
  });

function upd_shutdown() {
  let isChecked = document.getElementById("shutdown-toggle").checked;
  let shutdownValue = isChecked ? 1 : 0;

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      if (shutdownValue == 1) {
        alert("success", "Site has been shutdown!");
      } else {
        alert("success", "Shutdown mode off!");
      }
      get_general();
    } else {
      alert("error", "Failed to update shutdown status!");
      document.getElementById("shutdown-toggle").checked = !isChecked;
    }
  };

  xhr.send("upd_shutdown=" + shutdownValue);
}

function get_contacts() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    contacts_data = JSON.parse(this.responseText);

    document.getElementById("address").innerText = contacts_data.address;
    document.getElementById("gmap").innerText = contacts_data.gmap;
    document.getElementById("pn1").innerText = contacts_data.pn1;
    document.getElementById("pn2").innerText = contacts_data.pn2;
    document.getElementById("email").innerText = contacts_data.email;
    document.getElementById("fb").innerText = contacts_data.fb;
    document.getElementById("ig").innerText = contacts_data.ig;
    document.getElementById("tt").innerText = contacts_data.tt;
    document.getElementById("iframe").src = contacts_data.iframe;

    contacts_inp(contacts_data);
  };
  xhr.send("get_contacts=1");
}

function contacts_inp(data) {
  document.getElementById("address_inp").value = data.address;
  document.getElementById("gmap_inp").value = data.gmap;
  document.getElementById("pn1_inp").value = data.pn1;
  document.getElementById("pn2_inp").value = data.pn2;
  document.getElementById("email_inp").value = data.email;
  document.getElementById("fb_inp").value = data.fb;
  document.getElementById("ig_inp").value = data.ig;
  document.getElementById("tt_inp").value = data.tt;
  document.getElementById("iframe_inp").value = data.iframe;
}

document
  .getElementById("contact_s_form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    let formData =
      "address=" +
      encodeURIComponent(document.getElementById("address_inp").value) +
      "&gmap=" +
      encodeURIComponent(document.getElementById("gmap_inp").value) +
      "&pn1=" +
      encodeURIComponent(document.getElementById("pn1_inp").value) +
      "&pn2=" +
      encodeURIComponent(document.getElementById("pn2_inp").value) +
      "&email=" +
      encodeURIComponent(document.getElementById("email_inp").value) +
      "&fb=" +
      encodeURIComponent(document.getElementById("fb_inp").value) +
      "&ig=" +
      encodeURIComponent(document.getElementById("ig_inp").value) +
      "&tt=" +
      encodeURIComponent(document.getElementById("tt_inp").value) +
      "&iframe=" +
      encodeURIComponent(document.getElementById("iframe_inp").value) +
      "&upd_contacts=1";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      let modalElement = document.getElementById("contacts-s");
      let modal = bootstrap.Modal.getInstance(modalElement);

      if (this.responseText == 1) {
        alert("success", "Changes saved!");
        get_contacts();
        modal.hide();
      } else {
        alert("error", "No changes made!");
      }
    };
    xhr.send(formData);
  });

team_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_member();
});

function add_member() {
  let data = new FormData();
  data.append("name", member_name_inp.value);
  data.append("picture", member_picture_inp.files[0]);
  data.append("add_member", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);

  xhr.onload = function () {
    let modalElement = document.getElementById("team-s");
    let modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();

    if (this.responseText == "inv_img") {
      alert("error", "Only JPG and PNG images are allowed!");
    } else if (this.responseText == "inv_size") {
      alert("error", "Image should be less than 2MB!");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Image upload failed!");
    } else if (this.responseText == 1) {
      alert("success", "New member added!");
      member_name_inp.value = "";
      member_picture_inp.value = "";
      get_members();
    } else {
      alert("error", "Server error!");
    }
  };

  xhr.send(data);
}

function get_members() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    document.getElementById("team-data").innerHTML = this.responseText;
  };
  xhr.send("get_members=1");
}

function rem_member(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Member removed!");
      get_members();
    } else {
      alert("error", "Server down!");
    }
  };

  xhr.send("rem_member=" + val);
}

window.onload = function () {
  get_general();
  get_contacts();
  get_members();
};
