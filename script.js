function flipCard() {
  var card = document.getElementById("card");
  card.classList.toggle("flipped");
}
function signUp() {
  var n = document.getElementById("name");
  var e = document.getElementById("email");
  var p = document.getElementById("password");
  var m = document.getElementById("mobile");
  var g = document.getElementById("gender");

  var f = new FormData();
  f.append("name", n.value);
  f.append("email", e.value);
  f.append("password", p.value);
  f.append("mobile", m.value);
  f.append("gender", g.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        Swal.fire({
          title: 'Alert',
          text: t,
          icon: 'success',
          confirmButtonText: 'OK'
      });
      } else {
        Swal.fire({
          title: 'Alert',
          text: t,
          icon: 'info',
          confirmButtonText: 'OK'
      });
      }
    }
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(f);
}

function signin() {
  var email = document.getElementById("loginemail");
  var password = document.getElementById("loginepass");
  var rememberme = document.getElementById("rememberme");

  var f = new FormData();
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      } else {
        Swal.fire({
          title: 'Alert',
          text: t,
          icon: 'error',
          confirmButtonText: 'OK'
      });
      }
    }
  };

  r.open("POST", "Signinprocess.php", true);
  r.send(f);
}

var ftPasswordModal;
function forgotpassword() {

 
  
  var email = document.getElementById("loginemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if(t == "success") {
        var modal = document.getElementById("forgotPasswordModal");
        ftPasswordModal = new bootstrap.Modal(modal);
        ftPasswordModal.show();

      }else{
        alert(t);
      }

    }
  };

  r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function showPassword() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
  } else {
    np.type = "password";
    npb.innerHTML = '<i class="bi bi-eye"></i>';
  }
}

function showPassword2() {
  var rnp = document.getElementById("rnp");
  var rnpb = document.getElementById("rnpb");

  if (rnp.type == "password") {
    rnp.type = "text";
    rnpb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
  } else {
    rnp.type = "password";
    rnpb.innerHTML = '<i class="bi bi-eye"></i>';
  }
}

function ResetPassword() {
  var email = document.getElementById("loginemail");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vcode");

  var f = new FormData();
  f.append("e", email.value);
  f.append("np", np.value);
  f.append("rnp", rnp.value);
  f.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        ftPasswordModal.hide();
        alert("Your password has been updated.");
        window.location.reload();
      } else {
        alert(t + "\n error copied to clipboard");
      }
    }
  };

  r.open("POST", "ResetPasswordProcess.php", true);
  r.send(f);
}

function signout(){
  var r = new XMLHttpRequest();
 
    r.onreadystatechange = function () {
      
        if (r.readyState == 4 && r.status == 200) {
          
            var t = r.responseText;
            
            if (t == "success") {

              Swal.fire({
                title: 'Alert',
                text: 'Successfully Signed Out!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                
                  location.reload();
              }
          });
                

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "SignoutProcess.php", true);
    r.send();
}

function changeprofilepic(){

  var img = document.createElement("profileImage");

  img.onchange = function(){
    var file = this.file[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  }



}

function updateprofile(){
  var profile_img = document.getElementById("profileImage");
    var name = document.getElementById("Name");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email = document.getElementById("email");
    var line_1 = document.getElementById("line1");
    var line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var zcode = document.getElementById("zip");

    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("n", name.value);
    f.append("mn", mobile_no.value);
    f.append("pw", password.value);
    f.append("ea", email.value);
    f.append("al1", line_1.value);
    f.append("al2",line_2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("zp", zcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "updated" || t == "saved") {
              window.location.reload();
            } else if (t=="you have not selected any image."){
              
              Swal.fire({
                title: 'Alert',
                text: t,
                icon: 'info',
                confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                
                  location.reload();
              }
          });
            }else{
              Swal.fire({
                title: 'Alert',
                text: t,
                icon: 'info',
                confirmButtonText: 'OK'
            });
            }

        }
    }

    r.open("POST", "userProfileUpdateProcess.php", true);
    r.send(f);
  
}



function loadBrands() {
  

  var category = document.getElementById("catergory").value;
  

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
  
          document.getElementById("brand").innerHTML = t;

      }
  }

  r.open("GET", "loadBrandProcess.php?c=" + category, true);
  r.send();

}
function changeProductImage() {

  var images = document.getElementById("imageuploader");

  images.onchange = function () {

      var file_count = images.files.length;

      if (file_count <= 3) {

          for (var x = 0; x < file_count; x++) {
              var file = this.files[x];
              var url = window.URL.createObjectURL(file);
              document.getElementById("prodpic" + x).src = url;
          }

      } else {
          alert(file_count + " files uploaded. You are proceed to upload 03 or less than 03 files.");
      }

  }

}


function listproduct(){
  var category = document.getElementById("Category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("productname");
    var condition = document.getElementById("inputCondition");
    var clr = document.getElementById("Color");
    var storage = document.getElementById("Storage");
    var qty = document.getElementById("Qty");
    var cost = document.getElementById("price");
    var dwc = document.getElementById("decolo");
    var doc = document.getElementById("deoutcolo");
    var desc = document.getElementById("Description");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition.value);
    f.append("col", clr.value);
    f.append("str", storage.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
              Swal.fire({
                title: 'Alert',
                text: 'product added succesfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                
                window.location = "products.php";
              }
          });
              
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "AddProductProcess.php", true);
    r.send(f);


}



function sort(x) {

  var search = document.getElementById("s");
  var time = "0";

  if (document.getElementById("n").checked) {
      time = "1";
  } else if (document.getElementById("o").checked) {
      time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
      qty = "1";
  } else if (document.getElementById("l").checked) {
      qty = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
      condition = "1";
  } else if (document.getElementById("u").checked) {
      condition = "2";
  }else if (document.getElementById("ob").checked) {
    condition = "3";
  }

  var f = new FormData();
  f.append("s", search.value);
  f.append("t", time);
  f.append("q", qty);
  f.append("c", condition);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;

          document.getElementById("sort").innerHTML = t;

      }
  }

  r.open("POST", "sortProcess.php", true);
  r.send(f);

}

function clearSort() {
  window.location.reload();
}

function sendId(id) {
 

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
              window.location = "updateProduct.php";
          } else {
            Swal.fire({
              title: 'Alert',
              text: t,
              icon: 'info',
              confirmButtonText: 'OK'
          });
          }
      }
  }

  r.open("GET", "sendIdProcess.php?id=" + id, true);
  r.send();

}
function updateproduct() {
  var title = document.getElementById("t");
  var qty = document.getElementById("q");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var price = document.getElementById("newprice");
  var description = document.getElementById("d");
  var image = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("t", title.value);
  f.append("q", qty.value);
  f.append("dwc", dwc.value);
  f.append("doc", doc.value);
  f.append("d", description.value);
  f.append("np",price.value);

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
      f.append("i" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;

          if (t == "success") {
            Swal.fire({
              title: 'Alert',
              text: 'product Updated succesfully!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
              window.location = "products.php";
            }
        });
          } else if (t == "Invalid Image Count") {

              if (confirm("Don't you want to update Product Images?") == true) {
                Swal.fire({
                  title: 'Alert',
                  text: 'product added succesfully!',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  
                  window.location = "products.php";
                }
            });
              } else {
                   Swal.fire({
                title: 'Alert',
                text: 'Select Images!',
                icon: 'info',
                confirmButtonText: 'OK'
            });
              }
          } else {
            Swal.fire({
              title: 'Alert',
              text: t,
              icon: 'info',
              confirmButtonText: 'OK'
          });
          }
      }
  }

  r.open("POST", "updateProductProcess.php", true);
  r.send(f);
}
function advancedSearch(x) {
 

 
  var category = document.getElementById("c1");
  var brand = document.getElementById("b1");
  var model = document.getElementById("m");
  var condition = document.getElementById("c2");
  var color = document.getElementById("c3");
  var from = document.getElementById("pf");
  var to = document.getElementById("pt");
  var sort = document.getElementById("s");

  var f = new FormData();


  f.append("cat", category.value);
  f.append("b", brand.value);
  f.append("mo", model.value);
  f.append("con", condition.value);
  f.append("col", color.value);
  f.append("pf", from.value);
  f.append("pt", to.value);
  f.append("s", sort.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          document.getElementById("view_area").innerHTML = t;
      }
  }

  r.open("POST", "advancedsearchprocess.php", true);
  r.send(f);

}

function basicSearch(x){
  var text = document.getElementById("search_text").value;
  

  var f = new FormData();
  f.append("t", text);
   f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
                 document.getElementById("basicSearchResult").innerHTML = t;
                
      }
  }

  r.open("POST", "basicSearchProcess.php", true);
  r.send(f);

}

function addwatchlist(id){
  
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "Added") {
            
              document.getElementById(id).innerHTML = "Added to watchlist";
            Swal.fire({
                title: 'Alert',
                text: 'Added to watchlist!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                
                  location.reload();
              }
          });
          } else if (t == "Removed") {
            Swal.fire({
              title: 'Alert',
              text: 'Product Removed from to watchlist!',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
          } else {
              alert(t);
              window.location.reload();

          }

      }
  }

  r.open("GET", "addWatchListProcess.php?id=" + id, true);
  r.send();

  
}

function addtocart(id){
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "Product quantity updated in the cart") {
            Swal.fire({
              title: 'Alert',
              text: 'Product quantity updated in the cart!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
              
          } else if (t == "Product added to cart") {
            Swal.fire({
              title: 'Alert',
              text: 'Product added to cart!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
              
          } else {
              alert(t); 
          }
      }
  }

  r.open("GET", "addToCartProcess.php?id=" + id, true);
  r.send();



}

function removefromcart(id){
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "Product quantity updated") {
            Swal.fire({
              title: 'Alert',
              text: 'Product quantity updated!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
          } else if (t == "Product removed from cart") {
            Swal.fire({
              title: 'Alert',
              text: 'Product removed from cart!',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
              
          } else {
              alert(t); 

          }
      }
  }

  r.open("GET", "removefromcartprrocess.php?id=" + id, true);
  r.send();



}

function removecustomer(email){
 
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "Customer succesfully removed from the Database") {
            Swal.fire({
              title: 'Alert',
              text: 'Customer Removed from Database!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
                     
          } else {
            Swal.fire({
              title: 'Alert',
              text: t,
              icon: 'info',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
          }
      } 
  }

  r.open("GET", "removecustomerprocess.php?email=" + email, true);
  r.send();



}
function removeproduct(id){
  
 
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.status == 200 && r.readyState == 4) {
          var t = r.responseText;
          if (t == "product succesfully removed from the Database") {
            Swal.fire({
              title: 'Alert',
              text: 'product succesfully removed from the Database!',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              
                location.reload();
            }
        });
                     
          } else {
              alert(t); 
              window.location.reload();

          }
      } 
  }

  r.open("GET", "removeproductprocess.php?id=" + id, true);
  r.send();



}

