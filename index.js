
function validateform() {
    var returnval = true;
    var letters = /^[A-Za-z]+$/;
    var name = document.forms['myform']["name"].value;
    var email = document.forms['myform']["email"].value;
    var pass = document.getElementById('pass').value;
    var checkbox = document.forms['myform']['box'];
    var pass_valid = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,16}$/;

    // Email field validation 

    var email_valid = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (email.match(email_valid)) {
        returnval = true;
        // Name field validation


        if (name.match(letters)) {
            returnval = true;
            // password validation 


            if (pass.match(pass_valid)) {
                returnval = true;

                // checkbox validation code 
                
                for(var i=0; i<checkbox.length; i++){
                    if (checkbox[0].checked == true){
                        returnval = true;

                    }
                    else{
                        returnval = false;
                        document.getElementsByClassName('error')[3].innerHTML= "*Select at least one Hobbies";
                    }
                }
            }
            else {
                returnval = false;
                document.getElementsByClassName('error')[2].innerHTML = "*Use valid password";

            }
        }
        else {
            returnval = false;
            document.getElementsByClassName('error')[1].innerHTML = "*Use only Charecter";
            console.log('Only letter');
        }
    }
    else {
        returnval = false;
        document.getElementsByClassName('error')[0].innerHTML = "*Enter valid email address";
    }


    

    return returnval;

}




// password requirement line display 

document.getElementsByClassName('title')[0].style.display = "none";

pass.addEventListener('click', display);

function display() {
    document.getElementsByClassName('title')[0].style.display = "block";
}








function error(id, error) {

    element = document.getElementById(id);
    document.getElementsByClassName('error')[0].innerhtml = error;

}

