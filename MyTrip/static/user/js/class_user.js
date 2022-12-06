/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/
class User {

    constructor(uname, pword, uemail, phone) {
        this.user = {"uname":"","pword":"","uemail":"","phone":""};
        this.user.uname = uname;
        this.user.pword = pword;
        this.user.uemail = uemail;
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

    getUserByEmail(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/user/getuserbyemail.php?email=" + this.user.uemail, true);
        xmlhttp.send();
    }

    delUserByEmail(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/user/deluserbyemail.php?email=" + this.user.uemail, true);
        xmlhttp.send();
    }

}


function addUser(){
    let uname = document.getElementById("uname").value;
    let pword = document.getElementById("pword").value;
    let uemail = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let user = new User(uname, pword, uemail, phone);
    user.addUser(xmlhttp);
  }

function updateUser(){
    let uname = document.getElementById("uname").value;
    let pword = document.getElementById("pword").value;
    let uemail = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let user = new User(uname, pword, uemail, phone);
    user.updateUser(xmlhttp);
}

function delUserByEmail(){
    let user = new User();
    user.user.uemail = document.getElementById("email").value;
    user.delUserByEmail(xmlhttp);
}