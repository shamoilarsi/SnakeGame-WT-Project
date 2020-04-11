
(function ($) {
    "use strict";


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function () {
        var check = true;
        

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        if (check) {
            let username = document.getElementById('username').value;
            let password = document.getElementById('pass').value;
            let email = document.getElementById('email');
            let dia = document.getElementById('error_message');
    
            console.log(username)
            console.log(password)

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    console.log(this.responseText.trim())
                    let arr = this.responseText.trim().split('#')
                    console.log(arr)

                    if(arr[0] == "OK"){
                        dia.style.color = "green"
                        dia.innerHTML = arr[0]

                        document.cookie = "username=" + username;
                        document.cookie = "max=" + arr[1];

                        window.location.href = "http://localhost/snake/index.html"

                    }
                    else if(email == null) {
                        dia.style.color = "red"
                        dia.innerHTML = arr[0]
                    }
                    else {
                        dia.style.color = "red"
                        dia.innerHTML = "Error - Username already taken"
                    }
                }
            };
            
            if(email == null)
                xmlhttp.open("POST", "./php/login_ajax.php?username=" + username + "&password=" + password, true);
            else
                xmlhttp.open("POST", "./php/signup_ajax.php?username=" + username + "&password=" + password + "&email=" + email.value, true);
            xmlhttp.send();
        }
        return false;
});


$('.validate-form .input100').each(function () {
    $(this).focus(function () {
        hideValidate(this);
    });
});

function validate(input) {
    if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
        if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            return false;
        }
    }
    else {
        if ($(input).val().trim() == '') {
            return false;
        }
    }
}

function showValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).addClass('alert-validate');
}

function hideValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).removeClass('alert-validate');
}    

}) (jQuery);