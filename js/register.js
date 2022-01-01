document.getElementById("registerButton").addEventListener("click", function(){
    var username = document.getElementById("username").value;
    var rule1 = /^[a-zA-Z0-9-_.]{5,18}$/;
    var password = document.getElementById("password").value;
    var rule2 = /^[a-zA-Z0-9-_.]{5,18}$/;
    var email = document.getElementById("email").value;
    var rule3 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var displayName = document.getElementById("displayName").value;
    var rule4 = /^[a-zA-Z0-9-_.]{5,18}$/;
    var passwordConfirm = document.getElementById("passwordConfirm").value;
    var rule5 = password == passwordConfirm;

    if(rule1.test(username) && rule2.test(password) && rule3.test(email) && rule4.test(displayName) && rule5 == true){
        document.querySelector(".form").submit();
    }

    else{

        if(rule1.test(username)){
            document.getElementById("usernameSpan").innerHTML = "";
        }
    
        else if(username.length == 0){
            document.getElementById("usernameSpan").style.color = "blue";
            document.getElementById("usernameSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("usernameSpan").style.color = "red";
            document.getElementById("usernameSpan").innerHTML = "Invalid";
        }




        if(rule2.test(password)){
            document.getElementById("passwordSpan").innerHTML = "";
        }
    
        else if(password.length == 0){
            document.getElementById("passwordSpan").style.color = "blue";
            document.getElementById("passwordSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("passwordSpan").style.color = "red";
            document.getElementById("passwordSpan").innerHTML = "Invalid";
        }



        
        if(rule3.test(email)){
            document.getElementById("emailSpan").innerHTML = "";
        }
    
        else if(email.length == 0){
            document.getElementById("emailSpan").style.color = "blue";
            document.getElementById("emailSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("emailSpan").style.color = "red";
            document.getElementById("emailSpan").innerHTML = "Invalid";
        }




        if(rule4.test(displayName)){
            document.getElementById("displayNameSpan").innerHTML = "";
        }
    
        else if(displayName.length == 0){
            document.getElementById("displayNameSpan").style.color = "blue";
            document.getElementById("displayNameSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("displayNameSpan").style.color = "red";
            document.getElementById("displayNameSpan").innerHTML = "Invalid";
        }




        if(rule5 == false){
            document.getElementById("passwordConfirmSpan").style.color = "red";
            document.getElementById("passwordConfirmSpan").innerHTML = "Not Matching!";
        }

        else if(passwordConfirm.length == 0){
            document.getElementById("passwordConfirmSpan").style.color = "blue";
            document.getElementById("passwordConfirmSpan").innerHTML = "Empty!";
        }
        
        else{
            document.getElementById("passwordConfirmSpan").style.color = "green";
            document.getElementById("passwordConfirmSpan").innerHTML = "Matching!";
        }
    }

})
    