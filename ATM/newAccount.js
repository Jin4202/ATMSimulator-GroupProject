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
  var htmls = "<table><tr><th> Account Name </th><th> Type </th><th> Balance </th></tr>";
  for(let i = 0; i < accountList.length; i++) {
    let account = accountList[i];
    let accountName = account.accountName;
    let balance = account.balance;
    let type = account.type;
    htmls +=
    "<tr><td><input type=\"text\" class=\"maInput\" name=\""+(i+1)+"\" value=\""+ accountName +"\" disabled></td> <td>"+ type +"</td> <td> $"+balance+"</td></tr>";
  }
  htmls += "</table>"
  document.getElementsByClassName("managingTable")[0].innerHTML = htmls;
}

function edit() {
  for(let i = 0; i < document.getElementsByClassName("maInput").length; i++) {
    document.getElementsByClassName("maInput")[i].disabled = !document.getElementsByClassName("maInput")[i].disabled;
  }
}
