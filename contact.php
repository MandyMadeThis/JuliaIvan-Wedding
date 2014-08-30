<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact | Ivan &amp; Julia Druzic</title>
  <meta name="description" content="Photos and messages from the Druzic/MacPherson Wedding">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
 <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
   <!-- favicons -->
  <link rel="apple-touch-icon" sizes="57x57" href="favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="favicons/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="favicons/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="favicons/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="favicons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#f3efe6">
  <meta name="msapplication-TileImage" content="mstile-144x144.png">
</head>
<body class="contact-page">
  <nav class="mobile-nav">
    <a href="#" class="menu-trigger">&#9776;</a>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="instagram.html">Instagram Photos</a></li>
      <li><a href="photos.html">Wedding Photos</a></li>
      <li><a href="location.html">Location</a></li>
      <li><a href="#">Digital Guest Book</a></li>
    </ul>
  </nav>
    <header class="large-nav">
    <div class="logo-large">
      <a href="index.html"><img src="img/logo-metallic-med.png" alt="logo"></a>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="instagram.html">Instagram Photos</a></li>
        <li><a href="photos.html">Wedding Photos</a></li>
        <li><a href="location.html">Location</a></li>
        <li><a href="#">Digital Guest Book</a></li>
      </ul>
    </nav>
    <footer>
      <p>site designed &amp;  developed by <a href="http://mandymadethis.com" target="_blank">MandyMadeThis</a></p>
      <p>art direction by <a href="mailto:nickkopa@yahoo.com">Nicolas Kopachkov</a></p>
    </footer>
  </header>

  <div class="container">
  <h2>Sign the Digital Guest Book</h2>
  <p>Send a special note to Julia &amp; Ivan:</p>
   
    <div class="form-container paper-curl">
    <?php
    require('Mandrill.php');

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $from = "From: BabesGetMarried"; 
    $to = "hello@babesgetmerried.com"; 
    $subject = "Congratulations!";
    $human = $_POST["human"];

    $body = "From: $name\n E-Mail: $email\n Message:\n $message";

    $error = false;

    if (  isset($_POST["submit"] ) ) {

     //Check for Errors 
     if (empty($name) || empty($email)) {
        $error = true;
        echo "<p class='response'>Please fill in all required fields.</p>";
     }

     if ($human !== "5"){
      $error = true;
      echo "<p class='response'>Opps! Looks like you've answered the anti-spam question incorrectly.</p>";
     }

     if ($error == false) {   
       try {
         $mandrill = new Mandrill('P55J8FM29O_p8nL4WzGnxw');
         $message = array(        
           'text' => $body,
           'subject' => 'Congratulations!',
           'from_email' => 'hi@mandymadethis.com',
           'from_name' => 'BabesGetMarried',
           'to' => array(
             array(
               'email' => 'hello@babesgetmarried.com',
               'name' => 'Guest',
               'type' => 'to'
               )
             )
           );
         $async = false;
         // set template name here instead of 'messages'
         //  $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async);
         $result = $mandrill->messages->send($message, $async);
        // print_r($result);
         echo "<p class='response'>Your message was sent!</p>";

       }
       catch(Mandrill_Error $e) {  
         echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();    
         throw $e;
       }
     }
    }
    ?>
      <form method="post" action="contact.php">
        <fieldset>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required/>
          
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required/>
          
          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="4"></textarea>
          
          <div>
          <label class="anti-spam">*Anti-Spam Question: What is 3+2? </label>
          <input name="human" class="anti-spam-answer">
          </div>

          <div class="clear clearfix"></div>
          <button type="submit" id="submit" name="submit">Send</button>    
        </fieldset>
      </form>
    </div>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/scripts.min.js"></script>
</body>
</html>
