var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
     setText(this.responseText);
  }
};
xmlhttp.open("GET", "userInfo.php", true);
xmlhttp.send();

function setText(str) {
  var user = JSON.parse(str);
  var accountList = user.accountList;
  var htmls = "<table><tr><th></th><th>Account Number</th><th>Name</th><th>Type</th><th>Balance</th></tr>";
  for(let i = 0; i < accountList.length; i++) {
    let account = accountList[i];
    let name = account.accountName;
    let balance = account.balance;
    let type = account.type;
    let number = account.accountNumber;
    htmls +=
    "<tr><td><input type=\"radio\" name=\"accountIndex\" value=\""+ i +"\"></td><td>"+ number +"</td><td>"+ name +"</td><td>"+ type +"</td><td> $ "+balance+"</td></tr>";
  }
  htmls += "</table>";
  document.getElementById("accountList").innerHTML = htmls;

}
