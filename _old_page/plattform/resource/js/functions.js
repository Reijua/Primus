function fade() {
    $('div').fadeOut('slow');
    return true;
}

//Für Header beim Starten
function init() {
    window.addEventListener('scroll', function(e) {
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 50,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header, "smaller");
        } else {
            if (classie.has(header, "smaller")) {
                classie.remove(header, "smaller");
            }
        }
    });
}

function vanish()
{
	document.getElementById("survey-wrapper").style.display="none";
}


     $(document).ready(function(){
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".img").click(function(e){
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".img").hasClass("hover")) {
                $(this).closest(".img").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".img").mouseenter(function(){
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function(){
            $(this).removeClass("hover");
        });
    }
});

function checkLoginValue() { 
    var nickname = document.getElementById('login-nickname').value;
    var password = document.getElementById('login-password').value;
        if(!nickname.match(/\S/) && !password.match(/\S/)) {
        alert ('Bitte alle Felder ausfüllen!');
        return false;
        }
        else {
        return true;
        }
}

function checkvalue() { 
    var nickname = document.getElementById('nickname').value;
    var forename = document.getElementById('forename').value;
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var birthdate = document.getElementById('birthdate').value;
    var phonenumber = document.getElementById('phonenumber').value;
    var email = document.getElementById('email').value; 
    if(!nickname.match(/\S/) && !password.match(/\S/) && !birthdate.match(/\S/) && !phonenumber.match(/\S/) &&  !email.match(/\S/)  &&  !forename.match(/\S/) &&  !name.match(/\S/)) {
        alert ('Bitte alle Felder ausfüllen!');
        return false;
    } else {
        return true;
    }
}