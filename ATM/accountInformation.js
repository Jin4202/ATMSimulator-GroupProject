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


  var accountList = user.accountList;
  var htmls = "";
  for(let i = 0; i < accountList.length; i++) {
    let account = accountList[i];
    let accountName = account.accountName;
    let balance = account.balance;
    let type = account.type;
    htmls +=
    "<span style=\"font-weight:bold\">"+ accountName +"</span>  <span>"+ type +"</span><br><span>Balance: $ <span>"+ balance +"</span></span> <br>";
  }

  document.getElementById("accountList").innerHTML = htmls;

}
