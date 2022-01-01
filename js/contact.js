document.getElementById("contactButton").addEventListener("click", function(){
    var displayName = document.getElementById("displayName").value;
    var rule1 = /^[a-zA-Z0-9-_.]{5,18}$/;
    var title = document.getElementById("title").value;
    var rule2 = /[\S][^\w\d.*]*/;
    var textArea = document.getElementById("textArea").value;
    var rule3 = /[\S][^\w\d.*]*/;

    if(rule1.test(displayName) && rule2.test(title) && rule3.test(textArea) == true){
        document.querySelector(".form").submit();
    }

    else{

        if(rule1.test(displayName)){
            document.getElementById("displayNameSpan").style.color = "green";
            document.getElementById("displayNameSpan").innerHTML = "Good!";
        }
    
        else if(displayName.length == 0){
            document.getElementById("displayNameSpan").style.color = "blue";
            document.getElementById("displayNameSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("displayNameSpan").style.color = "red";
            document.getElementById("displayNameSpan").innerHTML = "Invalid";
        }
    


        
        if(rule2.test(title)){
            document.getElementById("titleSpan").style.color = "green";
            document.getElementById("titleSpan").innerHTML = "Good!";
        }
    
        else if(title.length == 0){
            document.getElementById("titleSpan").style.color = "blue";
            document.getElementById("titleSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("titleSpan").style.color = "red";
            document.getElementById("titleSpan").innerHTML = "Invalid!";
        }



        if(rule3.test(textArea)){
            document.getElementById("textAreaSpan").style.color = "green";
            document.getElementById("textAreaSpan").innerHTML = "Good!";
        }
    
        else if(textArea.length == 0){
            document.getElementById("textAreaSpan").style.color = "blue";
            document.getElementById("textAreaSpan").innerHTML = "Empty!";
        }
            
        else{
            document.getElementById("textAreaSpan").style.color = "red";
            document.getElementById("textAreaSpan").innerHTML = "Invalid!";
        }
    }
})
    