

function myFunction() {
  var x = document.getElementById("my-nav");
  if (x.className === "ul")
    x.className += " responsive";
   else
    x.className = "ul";
}

function open_form(){
    document.getElementById("popup").style.display = "block";
    var y = document.getElementById("bod");
    if(y.className === ""){
        y.className = "body";
    }
    else{
        y.className +" body";

    }
    myFunction();
}

function close_form(){
    document.getElementById("popup").style.display = "none";
    var y = document.getElementById("bod");
    y.className = "";
}

function close_caution(){
    document.getElementById("caution").style.display = "none";
}


function startOnBP(email) {
    pro = {};
    getBPs(pro)
    setTimeout(()=>showProducts(pro.response, email), 1000);
}



function showProducts(products, email){

    var table = document.getElementById("table");
    for(var item in products) {
        var tbody = document.createElement("tbody");
        tbody.setAttribute('id', products[item].id);

        var td_title = document.createElement("td");
        td_title.appendChild(document.createTextNode(products[item].name));
        tbody.appendChild(td_title);

        var td_auhtor = document.createElement("td");
        td_auhtor.appendChild(document.createTextNode(products[item].brand));
        tbody.appendChild(td_auhtor);

        var td_price = document.createElement("td");
        td_price.appendChild(document.createTextNode(products[item].price));
        tbody.appendChild(td_price);

        var td = document.createElement('td');
        var input = document.createElement("input");
        input.setAttribute('id', 'in-'+products[item].id);
        input.setAttribute('type', 'number');
        input.setAttribute('value', products[item].number);
        input.setAttribute('min','1');
        td.appendChild(input);
        tbody.appendChild(td);

        var tdl = document.createElement('td');
        var img  = document.createElement("img");
        img.setAttribute("src", "../site_images/delete.png");
        var button = document.createElement("button");
        button.setAttribute('style', "background:transparent; border:none");
        button.setAttribute("onclick", "deletep('"+email+"', '"+ products[item].id+"')");
        button.appendChild(img);
        tdl.appendChild(button);
        tbody.appendChild(tdl);
        table.appendChild(tbody);
    }
}

function getBPs(pro){
        $.get('getBaskets', function(data){
            pro.response = data
        }).fail(function(){
            swal("عملیات ناموفق ", "ارسال اطلاعات با خطا مواجه شده است", "error")
        });
}

function deletep(email ,productId){
    var req = { productId:productId};
    $.get('deleteBasket', req, function(data){
        swal("عملیات ناموفق ", data.message, "success")
    }).fail(function(){
        swal("عملیات ناموفق ", "ارسال اطلاعات با خطا مواجه شده است", "error")
    });
    $("#"+productId).hide();

}

function cal(){
    var pro = {};
    getBPs(pro);
    setTimeout(()=>updateNum(pro.response), 1000);
    // setTimeout(()=>sumPrice(), 1000);
}


function updateNum(pro){
    var product_num = {};
    for (const key in pro) {
        temp = {};
        var num = document.getElementById("in-"+pro[key].id).value;
        product_num[pro[key].id] = parseInt(num);
    }

    $.get('totalPrice', product_num, function(data){
        openTicket(data.totalPrice, data.email);

    }).fail(function(){
        swal("عملیات ناموفق ", "ارسال اطلاعات با خطا مواجه شده است", "error")
    });
}


function openTicket(totalPrice, email) {
    document.getElementsByClassName("ticket")[0].style.display ="block";
    var emailElement = document.getElementById("email");
    emailElement.setAttribute("value", email);
    var priceElement = document.getElementById('price');
    priceElement.setAttribute('value', totalPrice);
}

function loaderoff(){
    document.getElementsByClassName("preloader")[0].style.display= "none";
}
