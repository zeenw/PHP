/**
 * create by Zeen Wu
 * on Jul 3, 2022
*/


const xhr_allusers = new XMLHttpRequest();
xhr_allusers.open("get", PATH + "/api/user/getallusers.php", true);
xhr_allusers.send();

xhr_allusers.onload = function() {
    const list = JSON.parse(this.responseText);
    document.getElementById("userList").innerHTML = generateList(list);
    
}


function generateList(list){

    let html = "";
      html += '<table id="tbl_list" class="table table-dark table-striped">';
      html += '<thead><tr><th scope="col">#</th>';
      html += '<th scope="col"> Member ID </th>';
      html += '<th scope="col"> Membership</th>';
      html += '<th scope="col"> Email </th>';
      html += '<th scope="col"> Phone </th>';
      html += '<th scope="col"> First Name</th>';
      html += '<th scope="col"> Last Name </th>';
      html += '<th scope="col"> Membership Expire Date </th>';
      html += '</tr></thead><tbody>';
  
      for(let i = 0; i < list.length; i++) {
            html += '<tr><td>'+ (i+1) +'</td>';

            html += '<td>'+ list[i]["user_id"]+'</td>';
            html += '<td>'+ list[i]["member_type"]+'</td>';
            html += '<td>'+ list[i]["uemail"]+'</td>';
            html += '<td>'+ list[i]["phone"]+'</td>';
            html += '<td>'+ list[i]["fname"]+'</td>';
            html += '<td>'+ list[i]["lname"]+'</td>';
            html += '<td>'+ list[i]["expire_date"]+'</td>';
          
            html += '</tr>'
      }
      html += '</tbody></table>'
    return html;
}

