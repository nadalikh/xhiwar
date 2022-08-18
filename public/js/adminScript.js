var s = -1;
function analyze(x, email=''){  
    var req = JSON.stringify({x:x, email:email});

    for (const key in sessionStorage) {
        if(key == 'func'){
            f = true;
            sessionStorage.removeItem("func");
        }
    }
    sessionStorage.setItem('func', x);
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.responseText){
            if(this.responseText != -1){
                if(this.responseText != 0){
                    if(s != x)
                        createRealtimeSearch(x);
                    creatingTable(JSON.parse(this.responseText));
                    s = x;
                }else{
                    alert("موردی یافت نشد");
                    var body;
                    while(body = document.getElementById('body'))
                        body.remove()
                }
                }else{
                    alert("we have problem in system");
                }
            }
        }
    
    http.open('POST', 'requests.php');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('analyze='+req);
}



function creatingTable(orders){
    var check_table = document.getElementById('table');
    if(check_table != null){
        check_table.remove();
    }
    var table = document.createElement('table');
    table.setAttribute('id', 'table');
    var thead = document.createElement('thead');
    thead.setAttribute('id', 'head');
    for (const key_u in orders) {
        var tbody = document.createElement("tbody");
        tbody.setAttribute('id','body');
        for (const key in orders[key_u]) {
            //creating headers
            if(key_u == 0){
                var th = document.createElement('th');
                th.innerHTML = getHeadTable(key);
                thead.appendChild(th);
            }
            //creating body
            var td = document.createElement('td');
            if(key == "order_status"){
                assingButtonsTotd(td, orders[key_u][key], orders[key_u]["code"]);
            }else{
                td.innerHTML = orders[key_u][key];
            }
            tbody.appendChild(td);
        }
        if(key_u == 0){
            table.appendChild(thead);
        }
        table.appendChild(tbody);
    }
    var main = document.getElementById("main");
    main.appendChild(table);
}

function createRealtimeSearch(id){
    var x ;
    if(x = document.getElementById('0'))
        x.remove();
    else if(x = document.getElementById('1'))
            x.remove();
        else if(x = document.getElementById('2'))
                x.remove();
    
    var input = document.createElement('input');
    input.setAttribute('id', id);
    input.setAttribute('class', 'realtimeSearch');
    input.setAttribute('placeholder', 'test@test.com');
    input.setAttribute('oninput', "realTime(" + id + ")");
    input.setAttribute('dir', 'ltr');
    var main = document.getElementById('main');
    main.appendChild(input);
}

function realTime(func){
    var search = document.getElementById(func).value;
    analyze(func, search);
}

function getHeadTable(x){
    switch (x) {
        case "name": return"نام";     
            break;
        case "phonenumber": return"شماره تماس";
            break;
        case "email": return"ایمیل";
            break;
        case "address": return"ادرس";
            break;
        case "zipcode": return"کدپستی";
            break;
        case "totalprice": return"قیمت تراکنش";
            break;
        case "code": return"کدپیگیری";
            break;
        case "payment_status": return"وضعیت تراکنش";
            break;
        case "isbn": return"شابک";
            break;
        case "title": return"عنوان";
            break;
        case "number": return"تعداد کتاب";
            break;
        case "date": return"تاریخ و زمان";
            break;
        case "refid": return"شماره تراکنش";
            break;
        case "order_status": return"وضعیت سفارش";
            break;
        
    }
}

function assingButtonsTotd(td, status, code){
    if(status == 4){
        td.innerHTML='ارسال شده';
        return;
    }
    var disable_icon = ['seen-disable.png', 'call-disable.png', 'post-disable.png', 'send-disable.png'];
    for(var i = 0; i < 4; i++){
        var button = document.createElement('button');
        var img = document.createElement('img');
        img.setAttribute('src', "../site_images/"+disable_icon[i]);
        if(i == status){
            button.setAttribute("onclick", "orderManagement('"+code+"')");
            button.className = 'active';
        }else{
            button.disabled = true;
            
        }
        button.style.background='transparent';
        button.appendChild(img);
        td.appendChild(button);
    }
}

function orderManagement(code){
    var http = new XMLHttpRequest();
    http.onload = function(){
        if(this.responseText && this.status == 200){
            if(this.responseText == 1){
                alert("به مشتری اطلاع رسانی شد");
                for (const key in sessionStorage){
                   if(key == 'func'){
                    analyze(sessionStorage.getItem(key));
                    break;
                   }
                }
            }else if(this.responseText == -1)
                alert("به دلیل خطای سیستمی مشتری اطلاع رسانی نشده");
        }
    }
    http.open("POST", "requests.php");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("orderManagement="+code);
}