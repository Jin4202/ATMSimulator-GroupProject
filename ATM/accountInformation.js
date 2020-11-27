var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
     setText(this.responseText);
  }
};
xmlhttp.open("GET", "userInfo.php", true);
xmlhttp.send();

function setText(str) {
    console.log(str);
  var user = JSON.parse(str);
  document.getElementById("fname").innerHTML = user.firstname;
  document.getElementById("lname").innerHTML = user.lastname;
  document.getElementById("email").innerHTML = user.email;
  document.getElementById("pw").innerHTML = user.password;
  document.getElementById("phone").innerHTML = user.phone;
  document.getElementById("ssn").innerHTML = user.ssn;
  document.getElementById("balance").innerHTML = user.balance;
  let type;
  if(user.type == 0) {
    type = "Checking"
  } else {
    type = "Saving"
  }

  document.getElementById("type").innerHTML = type;

}
