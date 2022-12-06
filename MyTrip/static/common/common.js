/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/
const PATH = "http://localhost:8088/php";


function generateNavbar(list){
    html = '';
    html +='<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Country</a>';
    html += '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
    for(let i = 0; i < list.length; i++) {
      html += '<li><a class="dropdown-item" onclick="setMySession(\'cid\','+list[i]["cate_id"]+')" href="../product/product.html">'+ list[i]["category"] +'</a></li>';
    }
    html += '</ul></li>';
    return html;
}

function setMySession(key, value){
    sessionStorage.setItem(key, value);
}

class Category {

    constructor(id, name) {
        this.category = {"id":"","name":""};
        this.category.id = id;
        this.category.name = name;
        this.jsonObj = JSON.stringify(this.category);
    }

    getCategories(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/category/getcategories.php", true);
        xmlhttp.send();
    }

}

function userLogin() {
    let uemail = document.getElementById("email").value;
    let pword = document.getElementById("pword").value;
    login = {
        "uemail": uemail,
        "pword": pword
    }
    jsonObj = JSON.stringify(login);
    const xmlhttp_login = new XMLHttpRequest();
    xmlhttp_login.open("POST", PATH + "/api/user/login.php");
    xmlhttp_login.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp_login.send("login=" + jsonObj);

    xmlhttp_login.onload = function() {
        const output = JSON.parse(this.responseText);
    
        if(output.flag > 0){
            document.getElementById("user").innerHTML = "Welcome: <a href='../user/userprofile.html'> &nbsp;" 
            + output.obj.uemail 
            + " &nbsp;</a> <a href='../cart/cart.html'> <img src='../common/images/cart.png' width='30'> </a>" 
            + logoff();
            setMySession('login', JSON.stringify(output));
        }else if(output.flag==-1){
            location.replace(PATH + "/static/manage/home.html");
        }else{
            alert(output.message);
            //document.getElementById("user").innerHTML = output.message;
        }
    }
}


function logoff(){
    let html = '&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-outline-success" type="button" id="logoff" onclick="logoff();">Logoff</button>';
    let elm = document.getElementById("logoff");
    if(elm == null){
        return html;
    }else{
        setMySession('login', null);
        window.location.href = PATH;
    }
    
}

const xmlhttp = new XMLHttpRequest();
let category = new Category();
category.getCategories(xmlhttp);

xmlhttp.onload = function() {
    const list = JSON.parse(this.responseText);
    document.getElementById("categoryList").innerHTML = generateNavbar(list);
    

    if(sessionStorage.getItem('login')!="null" && sessionStorage.getItem('login') != null){
        let output = JSON.parse(sessionStorage.getItem('login'));
        if(output.flag > 0){
            document.getElementById("user").innerHTML = "Welcome: <a href='../user/userprofile.html'> &nbsp;" 
            + output.obj.uemail 
            + " &nbsp;</a> <a href='../cart/cart.html'> <img src='../common/images/cart.png' width='30'> </a>" 
            + logoff();
        }
    }else{
        document.getElementById("login").addEventListener("click", userLogin);
    }    
}
  
