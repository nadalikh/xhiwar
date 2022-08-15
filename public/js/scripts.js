    AOS.init({
        duration:1200,
        once:true,
        offset:0,
        easing:'ease-in-out-back'
    });
    
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


function addtobasket(isbn, email){
    var parameter = {isbn:isbn , email:email};
    if(!email)
        alert('ابتدا به حساب کاربری خود وارد شوید');
    else{
        var http = new XMLHttpRequest();
        http.onload = function(){
            if(this.status == "200"){
                if(this.responseText != '1' && this.responseText != '2')
                    alert('سفارش به دلیل خطا به سبد خرید اضافه نشد');
                else if(this.responseText != '2')
                    alert('سفارش به سبد خرید اضافه شد');
                else
                    alert('این محصول قبلا اضافه شده است');
            }else{
                alert('سفارش به دلیل خطا به سبد خرید اضافه نشد');
            }
        }
        http.open("POST", 'requests.php');
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send('addbasket='+ JSON.stringify(parameter));

        numof_books(email);
    }   
}

function startOnBP(email) {
    pro = {};  
    getBPs(email, pro)
    setTimeout(()=>showProducts(pro.response, email), 1000);
}



function showProducts(products, email){

    var table = document.getElementById("table");
    for(var item in products) {
        var tbody = document.createElement("tbody");
        tbody.setAttribute('id', products[item].isbn);
        

        var td_isbn = document.createElement("td");
        td_isbn.appendChild(document.createTextNode(products[item].isbn));
        tbody.appendChild(td_isbn);
        
        var td_title = document.createElement("td");
        td_title.appendChild(document.createTextNode(products[item].title));
        tbody.appendChild(td_title);

        var td_auhtor = document.createElement("td");
        td_auhtor.appendChild(document.createTextNode(products[item].authors[0]));
        tbody.appendChild(td_auhtor);

        var td_price = document.createElement("td");
        td_price.appendChild(document.createTextNode(products[item].price));
        tbody.appendChild(td_price);

        var td = document.createElement('td');
        var input = document.createElement("input");
        input.setAttribute('id', 'in-'+products[item].isbn);
        input.setAttribute('type', 'number');
        input.setAttribute('value','1');
        input.setAttribute('min','1');
        td.appendChild(input);
        tbody.appendChild(td);
        
        var tdl = document.createElement('td');
        var img  = document.createElement("img");
        img.setAttribute("src", "site_images/delete.png");
        var button = document.createElement("button");
        button.setAttribute('style', "background:transparent; border:none");      
        button.setAttribute("onclick", "deletep('"+email+"', '"+ products[item].isbn+"')");
        button.appendChild(img);
        tdl.appendChild(button);
        tbody.appendChild(tdl);
        table.appendChild(tbody);
    }
}

function getBPs(email, pro){
    if(email){
        var http = new XMLHttpRequest();
        http.onload = function(){
            if(this.status == '200'){
                 pro.response = JSON.parse(this.responseText);                
            }
        }
        http.open("post", "requests.php");
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send("showBP="+email);
    }else
        alert('ابتدا به حساب کاربری خود وارد شوید');
}

function deletep(email ,isbn){
    var temp = {email:email, isbn:isbn};
    var string = JSON.stringify(temp);
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.status == "200"){
            if(this.responseText == '1')
                document.getElementById(isbn).style.display="none";
                numof_books(email);
        }
    }
    http.open("post", "requests.php");
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("deleteBP="+string);
}

function cal(email){
    var pro = {};
    getBPs(email, pro);
    setTimeout(()=>updateNum(email, pro.response), 1000);
    setTimeout(()=>sumPrice(email), 1000);
}


function updateNum(email, pro){
    var isbn_num = {};
    for (const key in pro) {
        temp = {};
        var num = document.getElementById("in-"+pro[key].isbn).value;
        isbn_num[pro[key].isbn] = num;        
    }
    isbn_num['email'] = email;
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.status == "200"){
            console.log(this.responseText);
            if(this.responseText == '1')
                alert('سفارش شما با موفقیت بررسی شد.اطلاعات زیر را وارد بفرمایید');
            else 
                alert('خطا در ثبت سفارش');
        }
    }
    http.open("post", "requests.php");
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("updateNum="+JSON.stringify(isbn_num));
}

function sumPrice(email){
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.status == "200"){
            openTicket(this.responseText, email);
        }
    }
    http.open("post", "requests.php");
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("sumPrice="+email);
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

function numof_books(email){
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.status == "200"){
            if(this.responseText != "-1")
            document.getElementById("book-counter").innerHTML = this.responseText;
        } 
               
    }

    http.open("POST", "requests.php");
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("basketCount="+email);    
}

function showexactsearch(x){  
    if(x == 0){
        document.getElementById("exact-search").style.display = "block";
        var y = document.getElementById("b-e-s");
        y.setAttribute("onclick", "showexactsearch(1)");

    }else{
        document.getElementById("exact-search").style.display = "none";
        var y = document.getElementById("b-e-s");
        y.setAttribute("onclick", "showexactsearch(0)");
    }
}

function session_set(){
    sessionStorage.setItem('s','true');
}

function fillEmail(email){
    x = document.getElementById('e');
    x.setAttribute('value', email);
}

function getReadyToResetPass(){
    document.getElementById('p2').style.display='none';
    document.getElementById('sub-sign').style.display='none';
    document.getElementById('sub-reset-pass').style.display='block';

}