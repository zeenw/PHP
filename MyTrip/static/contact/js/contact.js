/**
 * create by Zeen Wu
 * on June 1, 2022
*/

function startup() {
    showUser();

}

function isValidate() {
  let feedback;
  let rs = true;
  let o_name = document.getElementById('name');
  let v_name = o_name.value;
  let o_phone = document.getElementById('phone');
  let v_phone = o_phone.value;
  let o_email = document.getElementById('email');
  let v_email = o_email.value;
  let o_message = document.getElementById('message');
  let v_message = o_message.value;
  let div_common_msg = document.getElementById('div_common_msg');
  let div_email_msg = document.getElementById('div_email_msg');
  let div_phone_msg = document.getElementById('div_phone_msg');
  let div_name_msg = document.getElementById('div_name_msg');


  // focus order depends the input controller order in web page
  if(v_message == '') {
    o_message.focus(); 
    div_message_msg.innerHTML = MSG_EMPTY_NICE;
    div_message_msg.style.color = 'red';
    rs = false;
  } else {
    div_message_msg.innerHTML = '';
  }

  if(isEmail(v_email)) {
    div_email_msg.innerHTML = '';
  }else{
    o_email.value = v_email;
    o_email.focus(); 
    div_email_msg.innerHTML = MSG_INVALIDEMAIL;
    div_email_msg.style.color = 'red';
    rs = false;
  }

  if(v_phone == '') {
    o_phone.focus(); 
    div_phone_msg.innerHTML = MSG_EMPTY;
    div_phone_msg.style.color = 'red';
    rs = false;
  } else if(ck_Phone(v_phone)){
    div_phone_msg.innerHTML = '';
    o_phone.value = ck_Phone(v_phone);
  } else {
    o_phone.focus(); 
    div_phone_msg.innerHTML = MSG_INVALIDPHONE;
    div_phone_msg.style.color = 'red';
  }

  if(v_name == '') {
    o_name.focus(); 
    div_name_msg.innerHTML = MSG_EMPTY;
    div_name_msg.style.color = 'red';
    rs = false;
  } else {
    div_name_msg.innerHTML = '';
  }

  if( rs ) {
    document.getElementById('div_msg_success').style.visibility = 'visible';
    feedback = {
      "name": v_name,
      "phone": v_phone,
      "email": v_email,
      "message": v_message
    }
    localStorage.setItem('feedback', feedback);
  } else {
    document.getElementById('div_msg_success').style.visibility = 'hidden';
  }

}
  
  
  