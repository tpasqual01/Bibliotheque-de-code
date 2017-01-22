<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" media="all" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function() {
    $('.check_ok').hide();
    $('.check_false').hide();
    
    $('#form').submit(function(){
      var pseudo = $('#pseudo').val();
      var dataString = 'pseudo='+pseudo;
      
      $.ajax({
        type: 'POST',
        url: 'check.php',
        data: dataString,
        success:function(data){
          var responseData = jQuery.parseJSON(data)
          if(responseData.status=='error')
          {
            $('.check_ok').hide();
            $('.check_false').fadeIn();
            $('.check_false').text(responseData.message);
          }
          else
          {
            $('.check_false').hide();
            $('.check_ok').fadeIn();
            $('.check_ok').text(responseData.message);
          }
        }
      });
      return false;
    });
});
  
  </script>
  <title></title>
</head>
<body>
  <div id="content">
    
    <form id="form" action="check.php" method="post">
      
      <label for="pseudo">Pseudo:</label>
      <span class="check_ok"></span>
      <span class="check_false"></span>
      <input type="text" name="pseudo" id="pseudo" />
      
      <input type="submit" class="submit" id="submit" value="Check" />
      
    </form>
    
  </div>
</body>
</html>