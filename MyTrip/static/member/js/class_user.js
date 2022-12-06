/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/
class User {

    constructor(uname, pword, email, phone) {
        this.user = {"uname":"","pword":"","email":"","phone":""};
        this.user.uname = uname;
        this.user.pword = pword;
        this.user.email = email;
        this.user.phone = phone;
        this.jsonObj = JSON.stringify(this.user);
    }

    addUser(xmlhttp) {
        xmlhttp.open("POST", PATH + "/api/user/adduser.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user=" + this.jsonObj);
    }

    updateUser(xmlhttp) {
        xmlhttp.open("POST", PATH + "/api/user/updateuser.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user=" + this.jsonObj);
    }

    getUsers(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/user/getusers.php", true);
        xmlhttp.send();
    }

    delUserByEmail(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/user/deluserbyemail.php?email=" + this.user.email, true);
        xmlhttp.send();
    }

}


function addUser(){
    let uname = document.getElementById("uname").value;
    let pword = document.getElementById("pword").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let user = new User(uname,pword,email,phone);
    user.addUser(xmlhttp);
  }

function updateUser(){
    let uname = document.getElementById("uname").value;
    let pword = document.getElementById("pword").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let user = new User(uname,pword,email,phone);
    user.updateUser(xmlhttp);
}

function delUserByEmail(){
    let user = new User();
    user.user.email = document.getElementById("email").value;
    user.delUserByEmail(xmlhttp);
}