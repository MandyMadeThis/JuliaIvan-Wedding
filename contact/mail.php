 <?php
     $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $from = "From: BabesGetMarried"; 
        $to = "hello@babesgetmarried.com"; 
        $subject = "Hello";
        $human = $_POST["human"];
          
        $body = "From: $name\n E-Mail: $email\n Message:\n $message";
            
      if ($_POST["submit"]) {
          if ($name != '' && $email != '') {
              if ($human == "5") {         
                  if (mail ($to, $subject, $body, $from)) { 
                echo "<p>Your message has been sent!</p>";
            } else { 
                echo "<p>Oh dear! Something has gone wrong. Please try again.</p>"; 
            } 
        } else if ($_POST["submit"] && $human != "5") {
            echo "<p>Opps! Looks like you've answered the anti-spam question incorrectly.</p>";
        }
          } else {
              echo "<p>Please fill in all required fields.</p>";
          }
      }
  ?>