 $("document").ready(function() {
                $("#submit").attr("disabled",true);
                $(".check").bind("keyup blur",function(){
                    $.ajax({
                        type: "POST",
                        url: "../ajax/Controllo.php",
                        data: $("#form").serialize(),
                        success: function(response){
                            eval(response);
                        }
                    });
                });
                
                $(".check").focus(function(){                
                    switch($(this).attr("name")) {
                        case "username":
                            var info = "La username deve contenere da 5 a 8 caratteri alfanumerici"; 
                            break;
                        case "password":
                            var info = "La password deve contenere da 8 a 16 caratteri, almeno un numero, una lettera maiuscola e una minuscola"; 
                            break;
                    }
                    $("#info").html(info);
                });
}); 


