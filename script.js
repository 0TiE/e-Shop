function changeView() {
    var signupBox = document.getElementById("signupBox");
    var signInBox = document.getElementById("signInBox");

    signupBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    // alert(gender.value);

    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = t;
            }
        }
    };



    r.open("POST", "signUpProcess.php", true);
    r.send(form);


}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);
    // alert(email.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
        }


    };
    r.open("POST", "signInProcess.php", true);
    r.send(form);
}
var bm;

function fogotpassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification Code sent to your Email.Please Check The inbox");
                var m = document.getElementById("fogotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }
        }
    };
    r.open("GET", "FogotPasswordProcess.php?e=" + email.value, true);
    r.send();
}

function showPassword1() {

    document.getElementById("np");
    document.getElementById("npb");

    if (npb.innerHTML == "show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "show";
    }
}

function showPassword2() {

    document.getElementById("rnp");
    document.getElementById("rnpb");

    if (rnpb.innerHTML == "show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "show";
    }
}



function reSetPassword() {
    var email2 = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");


    var form = new FormData();

    form.append("email2", email2.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);



    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                alert("Password Re-set Success");
                bm.hide();
            } else {
                alert(text);
            }
        }
    };


    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "home.php";

            }
        }
    };

    r.open("GET", "signOutProcess.php", true);
    r.send();

}



function showPassword3() {
    var pw = document.getElementById("pw");
    var icon = document.getElementById("icon");
    if (pw.type == "password") {
        pw.type = "text";
        icon.classList = ("bi bi-eye-slash-fill");

    } else {
        pw.type = "password";
        icon.classList = ("bi bi-eye-fill");

    }
}

function changeImage() {
    var image = document.getElementById("profileimg"); //file chooser
    var prev = document.getElementById("prev0"); //image tag 

    image.onchange = function() {
        var file0 = this.files[0];
        var ur10 = window.URL.createObjectURL(file0);

        prev.src = ur10;


    }

}


function updateProfile() {


    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var usercity = document.getElementById("usercity");
    var profileimg = document.getElementById("profileimg");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", addline1.value);
    form.append("a2", addline2.value);
    form.append("c", usercity.value);
    form.append("i", profileimg.files[0]);

    // alert(fname.value);
    // alert(lname.value);
    // alert(mobile.value);
    // alert(addline1.value);
    // alert(addline2.value);
    // alert(usercity.value);
    // alert(profileimg.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);
}


function changeProductimg() {
    // alert("Okk");
    var image = document.getElementById("imageUploader"); //img
    var view = document.getElementById("prev");


    image.onchange = function() {
        var file = this.files[0];
        view.src = window.URL.createObjectURL(file);

    }
}

function addProduct() {
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");


    var condition = 0;
    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }
    var color = 0;
    if (document.getElementById("clr1").checked) {
        color = 1;
    } else if (document.getElementById("clr2").checked) {
        color = 2;
    } else if (document.getElementById("clr3").checked) {
        color = 3;
    } else if (document.getElementById("clr4").checked) {
        color = 4;
    } else if (document.getElementById("clr5").checked) {
        color = 5;
    } else if (document.getElementById("clr6").checked) {
        color = 6;
    }
    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");


    // alert(condition);
    // alert(title.value);
    // alert(title.value);
    // alert(title.value);

    var f = new FormData();
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("img", image.files[0]);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                document.getElementById("msg2").innerHTML = text;
            } else {
                document.getElementById("msg").innerHTML = text;

            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);


}

function changeStatus(id) {
    var producId = id;
    // alert(producId);
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLable = document.getElementById("checkLable" + producId);

    var status;
    if (statusChange.checked) {
        status = 1;
    } else {
        status = 0;
    }
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "Deactivated") {
                statusLable.innerHTML = "Make your product Active";
            } else if (text == "Activated") {
                statusLable.innerHTML = "Make your product Dactive";
            }
        }
    };
    r.open("GET", "statusChangeProcess.php?p=" + producId + "&s=" + status, true);
    r.send();

}

function addFilters() {
    var search = document.getElementById("s");

    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("0").checked) {
        age = 2;
    } else {
        age = 0;
    }


    var qty;
    if (document.getElementById("1").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }
    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }
    var form = new FormData();
    form.append("s", search.value);
    form.append("a", age);
    form.append("q", qty);
    form.append("c", condition);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;



        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(form);
}

function clearfilters() {
    window.location = "myProducts.php";
}

function sendId(id) {
    var id1 = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "Success") {
                window.location = "updateProduct.php"
            }
        }
    };
    r.open("GET", "sendProductProcess.php?id=" + id1, true);
    r.send();
}

function updateProduct() {

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");


    var f = new FormData();
    f.append("t", title.value);
    f.append("qty", qty.value);
    f.append("c", cost.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("i", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };


    r.open("POST", "updateProcess.php", true);
    r.send(f);
}



function advancedSearch(x) {
    var searchtext = document.getElementById("s1");
    var category = document.getElementById("ca1");
    var barnd = document.getElementById("br1");
    var model = document.getElementById("mo1");
    var condition = document.getElementById("co1");
    var colour = document.getElementById("col1");
    var pricefrom = document.getElementById("pf1");
    var priceTo = document.getElementById("pf2");
    var sort = document.getElementById("sort");


    var form = new FormData;
    form.append("page", x);
    form.append("s", searchtext.value);
    form.append("ca", category.value);
    form.append("b", barnd.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", colour.value);
    form.append("pf", pricefrom.value);
    form.append("pt", priceTo.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("results").innerHTML = t;
        }
    };


    r.open("POST", "advanceSearhProcess.php", true);
    r.send(form);

}
//basic_search


function basicSearch(x) {
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    var form = new FormData();

    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResults").innerHTML = t;
            // alert(t);
        }
    };
    r.open("POST", "basicearchProcess.php", true);
    r.send(form);

}

function loadmainimg(id) {
    var pid = id;
    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");
    mainimg.style.backgroundImage = "url(" +
        img + ")";
}

function qty_inc(qty) {
    var qty1 = qty;
    var input = document.getElementById("qtyinput");

    if (input.value < qty1) {

        var newvalue = parseInt(input.value) + 1;
        input.value = newvalue.toString();

    } else {
        alert("Maximum qantity has achieved")

    }
}

function qty_dec() {
    var input = document.getElementById("qtyinput");
    if (input.value > 1) {

        var newvalue = parseInt(input.value) - 1;
        input.value = newvalue.toString();

    } else {
        alert("Minimum qantity has achieved")

    }
}

function check_val(qty) {

    var input = document.getElementById("qtyinput");
    if (input.value > qty) {

        alert("Insufficinet qantity")
        input.value = qty;

    }
}

function addToWatchlist(id) {
    var wid = id;


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("NewProduct has added to the watchlist.");
                document.getElementById("heart" + id).style.color = "red";
                window.location.reload();
            } else if (t == "success2") {
                alert("Product has removed to the watchlist.");
                document.getElementById("heart" + id).style.color = "white";
                window.location.reload();
            } else { alert(t); }

        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();

}
//watchlist
function deleteFromWatchlist(id) {
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addToWatchlistProcessProcess.php?+id=" + pid, true);
    r.send();

}
//watchlist

//cart
function cart() {
    window.location = "cart.php";
}

function addToCart(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "please SignIn First") {
                alert(t);
                window.location = "index.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}
//cart

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product Added to the Recent Successfully");
                alert("Product removed from the Cart Successfully");
                window.location = "cart.php";
            }
        }
    };
    r.open("GET", "removCartProcess.php?id=" + id, true);
    r.send();

}

//print

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
    //     alert("Hi");
}
//messages

function viewRecent() {
    // alert("Hello");
    var msgbox = document.getElementById("message_box");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }

    };
    r.open("GET", "viewRecentMsgProcess.php", true);
    r.send();

}
var k;

function adminVerification() {

    var e = document.getElementById("e").value;

    var form = new FormData();
    form.append("e", e);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                var verificationmodel = document.getElementById("verification_model");
                k = new bootstrap.Modal(verificationmodel);
                k.show();
            } else {
                alert(t);
            }

        }
    };
    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);
}

function veryfy() {

    var v = document.getElementById("vcode");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "adminpanel.php";
            } else { alert(t); }

        }
    };

    r.open("GET", "veriyProcess.php?id=" + v.value, true);
    r.send();
}


var mm;

function viewmsgmodel(email) {

    var m = document.getElementById("viewmsgmodel");
    mm = new bootstrap.Modal(m);
    mm.show();

    var form = new FormData();
    form.append("email", email);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_model").innerHTML = t;

        }
    };

    r.open("POST", "viewmsgmodel.php", true);
    r.send(form);
}

var pm;

function viewProductMoidel(id) {
    var m = document.getElementById("viewproductmodel" + id);
    pm = new bootstrap.Modal(m);
    pm.show();

}


var cm;

function addnewcategory() {

    var m = document.getElementById("addcategorymodel");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;

var newcategory
var uemail;

function categoryVerifyModal() {

    newcategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;


    var form = new FormData();
    form.append("n", newcategory);
    form.append("e", uemail);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var m = document.getElementById("addcategorymodelVerification");
                cvm = new bootstrap.Modal(m);

                cm.hide();
                cvm.show();
            } else { alert(t); }


        }
    };
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(form);





}

function saveCategory() {

    var txt = document.getElementById("txt").value;

    var form = new FormData();
    form.append("t", txt);
    form.append("c", newcategory);
    form.append("e", uemail);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // 
            if (t == "success") {
                cvm.hide();
                alert("New Category Added.");
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "savenewcategoryProcess.php", true);
    r.send(form);


}

function productBlock(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            window.location = "manageproducts.php"
                //alert(text);
        }

    };


    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();
}

function userBlock(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            window.location = "manageusers.php"
                // alert(text);
        }

    };


    request.open("GET", "userBlockProcess.php?id=" + id, true);
    request.send();
}



function changeInvoiceId(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                window.location = "sellingHistory.php";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                window.location = "sellingHistory.php";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shiping";
                window.location = "sellingHistory.php";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).setAttribute = "disabled";
                window.location = "sellingHistory.php";
            }
        }
    };
    r.open("GET", "changeInvoiceIdProcess.php?id=" + id, true);
    r.send();


}

function viewMessages(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("chat_box").innerHTML = t;

        }

    };
    r.open("GET", "viewMessagesProcess.php?email=" + email, true);
    r.send();
}


function sendMsg() {

    var recever_mail = document.getElementById("rmail");

    var msg_text = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("r", recever_mail.innerHTML);
    f.append("m", msg_text.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "message.php"
                alert(t);
            } else { alert(t); }

        }
    };
    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

function sendMsgAdmin() {
    var recever_mail = document.getElementById("rmail");

    var msg_text = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("r", recever_mail.innerHTML);
    f.append("m", msg_text.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php"

            } else { alert(t); }

        }
    };
    r.open("POST", "sendMsgAdminProcess.php", true);
    r.send(f);
}

function saveFeed(id) {

    var type;
    if (document.getElementById("r1").checked) {
        type = 1;
    } else if (document.getElementById("r2").checked) {
        type = 2;
    } else if (document.getElementById("r3").checked) {
        type = 3;
    }
    var email = document.getElementById("e").value;
    var feedback = document.getElementById("f").value;
    var pid = id;
    var f = new FormData();
    f.append("t", type);
    f.append("e", email);
    f.append("f", feedback);
    f.append("i", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "singleProductView.php?id=" + id;
            } else {
                alert(t);
            }
        };
    }

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);

}

function buynow(id) {

    var product_id = id;


    var f = new FormData();
    f.append("pid", product_id);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "invoice.php?order_id=" + t;

        }
    }
    r.open("POST", "buyNowProcess.php", true);
    r.send(f);

}


function checkOut(id) {

    var product_id = id;
    var product_qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("pid", product_id);
    f.append("pqty", product_qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            window.location = "checkout.php?pid=" + t;
        }
    }
    r.open("POST", "checkOutProcess.php", true);
    r.send(f);

}