/**
 * create by Zeen Wu
 * on June 1, 2022
*/


const xhr_category = new XMLHttpRequest();
xhr_category.open("get", PATH + "/api/category/getallcategories.php", true);
xhr_category.send();

xhr_category.onload = function() {
    const list = JSON.parse(this.responseText);
    document.getElementById("categoryList").innerHTML = generateList(list);
    
}

window.addEventListener("load", startup);
function startup() {
    document.getElementById("btn_add").addEventListener("click", addCategory);
    document.getElementById("btn_update").addEventListener("click", updateCategory);
}

function updateCategory(){
    
    let rdo_flag = "";
    let cate_id = document.getElementById("cate_id").value;
    let cate_name = document.getElementById("cate_name").value;
    radios = document.getElementsByName('rdo_flag');
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            rdo_flag = radios[i].value;
            break;
        }
    }

    let category = {
        "cate_id": cate_id,
        "category": cate_name,
        "flag": rdo_flag
    }

    let xhr = new XMLHttpRequest()
    xhr.open("POST", PATH + "/api/category/updatecategory.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("category=" + JSON.stringify(category));
    setTimeout(location.reload(), 1000);
    

}

function addCategory(){
    
    let rdo_flag = "";
    let cate_name = document.getElementById("cate_name").value;
    radios = document.getElementsByName('rdo_flag');
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            rdo_flag = radios[i].value;
            break;
        }
    }

    let category = {
        "category": cate_name,
        "flag": rdo_flag
    }

    let xhr = new XMLHttpRequest()
    xhr.open("POST", PATH + "/api/category/addcategory.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("category=" + JSON.stringify(category));
    setTimeout(location.reload(), 1000);

}

function generateList(list){
    let html = "";
      html += '<table id="tbl_list" class="table table-dark table-striped">';
      html += '<thead><tr><th scope="col">#</th>';
      html += '<th scope="col"> Category ID </th>';
      html += '<th scope="col"> Category Name </th>';
      html += '<th scope="col"> Available / Disable </th>';
      html += '</tr></thead><tbody>';
  
      for(let i = 0; i < list.length; i++) {
          html += '<tr><td>'+ (i+1) +'</td>';
          for(let key in list[i]){
              html += '<td>'+ list[i][key]+'</td>';
          }
          html += '</tr>'
      }
      html += '</tbody></table>'
    return html;
}

