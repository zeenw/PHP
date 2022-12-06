/**
 * create by Zeen Wu
 * on June 1, 2022
*/

function startup() {
    showUser();

}


function readMore(id, m_id, btn) {
  var dots = document.getElementById(id);
  var moreText = document.getElementById(m_id);
  var btnText = document.getElementById(btn);

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}