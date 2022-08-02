<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form class="cmxform" id="commentForm" method="get" action="">
        <fieldset>
          <p>
            <label for="cname">Name </label>
            <input id="cname" name="name" minlength="2" type="text" required>
          </p>
          <p>
            <label for="cemail">E-Mail </label>
            <input id="cemail" type="email" name="email" required>
          </p>
          <p>
            <label for="curl">URL </label>
            <input id="curl" type="url" name="url" >
          </p>
          <p>
            <label for="ccomment">Your comment </label>
            <textarea id="ccomment" name="comment" required></textarea>
          </p>
          <p>
            <input class="submit" type="submit" value="Submit">
          </p>
        </fieldset>
      </form>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>

      <script>
      $("#commentForm").validate();
      </script> 
</body>
</html>