/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function syncAjax(u) {
    var obj = $.ajax(
            {url: u,
                async: false
            }   
    );
    return $.parseJSON(obj.responseText);   

}

function generate()
{
    alert(code);            
//    var qrcode = code;
    var code = getRandom();  
//      debugger;
    
//     debugger;
    jQuery('#qr').qrcode({      
        render: "table",
        text: code.toString() + " " + id.toString(),          
//        text: "hello",  
        background: "#00c7cc"     
    });          
}  
function verifyRegstration()
{
    var code = document.getElementById("code").value;  
    alert(code);

//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=3&code=" + code;

var u = "action.php?cmd=3&code=" + code;
    var r = syncAjax(u);
    if (r.result === 1)
    {
        alert("succes");

    }

    else if (r.result === 0)
    {
        slert("oopps");
    }
}

function saveSignUp()
{
    var mid = $("#day").val();
//   alert("this is the meeting is " + mid + " this is the did " + id ) 
    var u = "action.php?cmd=7&mid=" + mid + "&did=" + id;
    
//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=7&mid=" + mid + "&did=" + id;
//var u = "action.php?cmd=7&mid=" + mid + "&did=" + id;
    var r = syncAjax(u);

    if (r.result === 1)
    {
        alert("saved successfully");
        $('newlist').collapsible;

    }

}
 var code;  
function saveRegistration()
{
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var number = document.getElementById("phone_number").value;
    var organisation = document.getElementById("organisation").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    code = getRandom();
//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=1&name=" + name + "&email=" + email + "&phone_number=" + number + "&username=" + username + "&password=" + password + "&organisation=" + organisation + "&code=" + code;

var u = "action.php?cmd=1&name=" + name + "&email=" + email + "&phone_number=" + number + "&username=" + username + "&password=" + password + "&organisation=" + organisation + "&code=" + code;

//prompt("u",u); 
    var r = syncAjax(u);
//    var s = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=2&number=" + phone_number + "&code=" + code;  
         
    if (r.result === 1)       
    {
        alert("saved"); 
        var s = "action.php?cmd=2&number=" + number + "&code=" + code;  
//         prompt("s",s);
    try{
         syncAjax(s);
    }
       catch (err)   
       {
           
       }
        $.mobile.changePage('#popUp');
        alert("pop");
    }
    else if (r.result === 0)
    {
        alert("not saved");
    }
}

function goToLoginPage()
{
    $.mobile.changePage('#loginPage');
}
function getRandom() {
    thisNumber = Math.floor(Math.random() * 9999);
    if (thisNumber < 999) {
        getRandom();
    } else {
        return thisNumber;
    }
}

var id;
function login_delegate()
{
    alert("login page");      
    var username = document.getElementById("usernameLogin").value;
    var password = document.getElementById("passwordLogin").value;   

    var u = "action.php?cmd=4&username=" + username + "&password=" + password;  
//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=4&username=" + username + "&password=" + password;    
//    prompt("u", u);  
    var r = syncAjax(u);

    if (r.result === 1)
    {
        id = r.id;
        $.mobile.changePage("#delegate_view");

    }
    else if (r.result === 0)
    {

    }
}
  
function goToRegisterPage()
{
    $.mobile.changePage('#register_page');
}
function check_save(name, email, number, organisation, username, password)
{
    var u = "action.php?cmd=1&name=" + name + "&email=" + email + "&phone_number=" + number + "&username=" + username + "&password=" + password + "&organisation=" + organisation;
//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=1&name=" + name + "&email=" + email + "&phone_number=" + number + "&username=" + username + "&password=" + password + "&organisation=" + organisation;
    return syncAjax(u);
}   
  
function getWords(str) {
    return str.split(/\s+/).slice(0, 5).join(" ");
}

    

$(document).on("pagecreate", "#delegate_view", function () {

    var u = "action.php?cmd=5";
    var u2 = "action.php?cmd=6&id=" + id;
//    var u = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=5";
//    var u2 = "http://50.63.128.135/~csashesi/class2015/kutorkor-kotey-afutu/FinalProjectMobileWeb/action.php?cmd=6&id=" + id;
    var r = syncAjax(u);
    var r2 = syncAjax(u2);  

    alert("this is the id " + id);
    for (var i in r)
    {
        var teaser = getWords(r[i].description);
        var mydate = new Date(r[i].date);
        var str = mydate.toString("dddd MMMM dd yyyy");
//   window.alert(str);
//   var start = ''; 

        $('#day').append($('<option>', {
            value: r[i].id,
            text: r[i].name
        }));   
        var blogpost = '<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-d ui-li-has-count ui-first-child">' + str + '<span class="ui-li-count ui-body-inherit"></span></li><li><a href="index.html" class="ui-btn ui-btn-icon-right ui-icon-carat-r"> <h3>' + r[i].name + '</h3> <p><strong>' + teaser + '</strong></p><p>0' + r[i].phone_number + '</p> <p class="ui-li-aside"></p></a></li>';  

        $('#ul').append(blogpost).trigger("create");
    }   
    for (var i in r2)   
    {
        var newList = '<div data-role="collapsible" data-collapsed="true"><h3>' + r2[i].name + '</h3>'
                + '<p>Date: ' + r2[i].date + '<br>'
                + r2[i].description + '</p></div>';

        $('#registeredMeetings').append(newList).trigger("create");
    }


});

$(document).on("pagecreate", "#upcoming_meetings", function () {
    var u = "action.php?cmd=5";
    var r = syncAjax(u);
    for (var i in r)
    {
        var teaser = getWords(r[i].description);
        var mydate = new Date(r[i].date);
        var str = mydate.toString("dddd MMMM dd yyyy");
//   window.alert(str);
//   var start = ''; 

        $('#day').append($('<option>', {
            value: r[i].id,
            text: r[i].name  
        }));   
        var blogpost = '<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-d ui-li-has-count ui-first-child">' + str + '<span class="ui-li-count ui-body-inherit"></span></li><li><a href="index.html" class="ui-btn ui-btn-icon-right ui-icon-carat-r"> <h3>' + r[i].name + '</h3> <p><strong>' + teaser + '</strong></p><p><a href= "tel:0' + r[i].phone_number + '</a></p> <p class="ui-li-aside"></p></a></li>';  

        $('#meetings').append(blogpost).trigger("create");  
    }   
    });

      

