/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/
const xmlhttp2 = new XMLHttpRequest();
let product = new Product();
product.product.pid = sessionStorage.getItem("pid");
product.getProductByPid(xmlhttp2);
xmlhttp2.onload = function() {
    let pruduct = JSON.parse(this.responseText);
    document.getElementById("div_product").innerHTML = generateProduct(pruduct);

    getComments();
    document.getElementById("btn_review").addEventListener("click", sendReview);  
    document.getElementById("btn_book").addEventListener("click", addToCart);
}


function addToCart(){
    if(sessionStorage.getItem("login")!=null && sessionStorage.getItem("login")!="null"){
        let login = JSON.parse(sessionStorage.getItem("login"));
        let uid = login.obj.user_id;
        let pid = sessionStorage.getItem("pid");
        let quantity = document.getElementById("i_quantity").value;
        let cart = {
            "flag" : 1,
            "uid" : uid,
            "pid" : pid,
            "quantity" : quantity
        };
        
        const xhr_addToCart = new XMLHttpRequest();
        xhr_addToCart.open("POST", PATH + "/api/cart/addtocart.php", true);
        xhr_addToCart.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_addToCart.send("cart="+JSON.stringify(cart));


        xhr_addToCart.onload = function() {

            //alert(this.responseText);
            location.replace("../cart/cart.html");
        }
    }else{
        alert("Please login your account.");
    }
}


function sendReview(){
    let uid = 0;
    if(sessionStorage.getItem("login")!="null" && sessionStorage.getItem("login")!=null){
        uid = JSON.parse(sessionStorage.getItem("login")).obj.user_id;
    }
    
    let pid = sessionStorage.getItem("pid");
    let score = document.getElementById("i_score").value;
    let comment = document.getElementById("review").value;
    let review = {
        "uid": uid,
        "pid": pid,
        "score": score,
        "comment": comment
    }
    let xhr = new XMLHttpRequest()
    xhr.open("POST", PATH + "/api/comment/addcomment.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(JSON.stringify(review));
    location.reload();
}


function generateProduct(product) {
    let html ='';
    if (product) {
        html = '<div class="card col-12" ><img src="images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><p class="card-text">Price: ' 
        + product['price'] + '  <br />Total views: ' 
        + product['views'] + '</p></div></div>';
    }                           

    document.getElementById("p_desc").innerHTML = product['description'];
    document.getElementById("h3_title").innerHTML = product['product_name'];
    return html;
}

function getComments(){
    let pid = sessionStorage.getItem("pid");
    $.ajax({
        type : "get",
        url : `${PATH}/api/comment/getcommentbypid.php?pid=${pid}`,
        dataType : "json",
        success : function(data) {
            showComments(data);
        }
    });
}

function showComments(list) {
    let html = '';
    let score = 0;
    for(let i = 0; i < list.length; i++) { 
        html += '<hr>'
        html += '<h6> Rating: '+ generateReviewScore(list[i]['score']) +'</h6>';
        if (list[i]['uid']==0){
            html += '<h6> Write by anonymous</h6>'; 
        }else{
           html += '<h6> Write by user '+ list[i]['uid']+'</h6>'; 
        }
        
        html += '<div><p>'+ list[i]['comment']+'</p></div>';
        score += list[i]['score'];
    }
    html += '<hr>';
    let element = document.getElementById("comment_list");
    element.innerHTML = html;
    document.getElementById("div_rate").innerHTML = generateReviewScore(score/list.length);
    showReviewStar(score/list.length);
}



function showReviewStar(score){
  let review_star = document.getElementById("review_star");
  review_star.innerHTML = generateReviewStar(score);
  document.getElementById("i_score").value=score;
  
}


function generateReviewStar(score){
    let html="";
    for(let i = 0; i < 5; i++){
      if(i<score){
        html+='<span class="fa fa-star checked" onclick="showReviewStar('+(i+1)+')">&nbsp;</span>';
      }else{
        html+='<span class="fa fa-star" onclick="showReviewStar('+(i+1)+')">&nbsp;</span>';
      }
    }
    return html;
}
function generateReviewScore(score){
let html="";
for(let i = 0; i < 5; i++){
    if(i<score){
    html+='<span class="fa fa-star checked">&nbsp;</span>';
    }else{
    html+='<span class="fa fa-star">&nbsp;</span>';
    }
}
return html;
}