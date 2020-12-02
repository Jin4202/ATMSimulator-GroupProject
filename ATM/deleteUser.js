function confirmAccountDeletion() {
  if (confirm("Are you sure you want to delete your bank account?")) {
    deleteUser();
    alert("Thank you for deleting your bank account");
    window.location.href = "../index.html";
  }
}

function deleteUser() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

    }
  };
  xmlhttp.open("GET", "deleteUser.php", true);
  xmlhttp.send();
}
