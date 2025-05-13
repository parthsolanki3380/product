
<style type="text/css">
    body {
        margin: 50px auto;
        font-family: 'Poppins', sans-serif;
        color: #d9dcd6;
        
        background-image: url('img/background.jpg');
        /*background-color:black;*/
        background-repeat: no-repeat;
        background-size: cover;
    }

    .h3{

        color: orange;
    }

 /*   .registration {
        margin: auto;
        max-width: 800px;
        background-color: rgba(51, 54, 52, 0.8);
        border-radius: 10px 10px 0 0;
        border: 1px solid black;
        border-radius: 10px 10px 0 0;
        color: white;
    }*/

    header {
        text-align: center;

    }

    #add_form {

        display: flex;
        flex-direction: column;
        padding: 10px 50px;
        

    }

    .top-label {
        margin-top: 10px;
        font-size: 17px;
    }

    .top-input {
        margin-top: 10px;
        height: 38px;
        width: 100%;
        font-size: 14px;
        border-radius: 5px;
        padding: 7px;
        font-family: 'Poppins';

    }


    #dropdown-div {
        margin: 10px 0 20px;
    }


    #dropdown {
        width: 100%;
        height: 25px;
    }

    textarea {
        font-family: 'Poppins', sans-serif;
    }

    fieldset {

        padding-bottom: 20px;
        border: none;
    }

    fieldset a {
        text-decoration: none;
        color: #adb5bd;
    }

    #contact {
        display: flex;
        flex-direction: column;
    }


    .button {
        margin: 20px auto 10px;
        background-color: white;
        border-radius: 5px;
        border-style: none;
        color:black;
        cursor: pointer;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.5;
        max-width: 200px;
        min-height: 44px;
        min-width: 100px;
        outline: none;
        overflow: hidden;
        padding: 11px 29px 9px;
        text-align: center;
    }

    .button:hover,
    .button:focus {
        opacity: .75;
    }



</style>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">


    
</head>

<body>
   
        <header>
            <img src="img/logo-name.png" style="text-align: center;">
            <h3 style="color: orange; text-align: center;">ONLINE REGISTRATION FORM</h3>

        </header>
     <form action="" id="add_form" class="add_form" enctype="multipart/form-data" method="POST">
             @csrf

            <label id="name-label" class="top-label">Name </label><input id="name" class="top-input" type="text" placeholder="Enter Name" name="name"></input>

            <label id="brand-label" class="top-label">Brand </label><input id="name" class="top-input" type="text" name="brand" placeholder="Enter Brand" ></input>

             <label id="gst-label" class="top-label">GST </label><input id="gst" class="top-input" type="text" placeholder="Enter GST" name="gst"></input>

            <label id="email-label" class="top-label">Email </label><input id="email" class="top-input" type="email" placeholder="Enter  email" name="email"></input>


            <label id="photo-label" class="top-label">Photo </label><input id="photo" class="top-input" type="file"  name="photo"></input>

               <label id="number-label" class="top-label">Number </label><input id="number" class="top-input" type="number" name="number" placeholder="Enter Number" maxlength="12"></input>

            <button id="submit" class="button submit">Submit</button>
        </form>
  
</body>

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script type="text/javascript">
    


    $(".submit").on("click",function(e){
        e.preventDefault();

        if($(".add_form").valid())
        {
            $.ajax({

                type: "POST",
                url: "{{route('register.add')}}",
                data: new FormData($('.add_form')[0]),
                processData: false,
                contentType: false,


                success: function(data){
                    if(data.status === 'success')
                    {
                        
                        location.reload();

                        
                    }
                    else if(data.status === 'error')
                    {
                          toastr["error"]("Unsuccessfull", "Error");
                         location.reload();
                      
                    }
                        
                }

            });

        }else{
            e.preventDefault();
        }

    });



</script>
