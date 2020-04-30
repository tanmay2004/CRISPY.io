<!-- crisp.io/crispy.io depending on which one is available -->
<?php
  include_once("connection.php");
  $is_dir_made = false;
  
  function getDirName ($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) { 
      $index = rand(0, strlen($characters) - 1); 
      $randomString .= $characters[$index]; 
    } 

    return $randomString; 
  }

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $url = $_POST["url"];
    $index_php = "<?php header('location: " . $url . "'); ?>";
    
    $exists_query = "SELECT * from links WHERE url = '$url'";
    $result_exists = $conn->query($exists_query);
    $directory = null;
    
    while ($row = mysqli_fetch_array($result_exists, MYSQLI_ASSOC)) {
      $directory = $row['directory'];
    }
    
    if ($directory == null) {
      $directory = getDirName(5);
      while (is_dir($directory)) {
        $directory = getDirName(5);
      }
      mkdir($directory);
      file_put_contents("$directory/index.php", $index_php);
      
      $links_sql = "INSERT INTO links(`url`, `directory`) VALUES('$url', '$directory')";
      $query = $conn->query($links_sql);
    }
    
    $is_dir_made = true;
  }
?>

<html>
  <head>
    <title>Crisp.io | Get Crispy URLs!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Make your URLs Short and CRISP for Free!">
    <meta name="keywords" content="url-shortener,free,simple,crispy,crisp">
  </head>
  
  <body>
    <form method="post" onsubmit="return validate();">
      <input type="text" name="url" id="link" placeholder="Enter your URL"></input>
      <input type="submit"></input>
    </form>
    
    <?php if ($is_dir_made) { ?>
      <div id="result" style="font-size: 20px;">
        <b>https://crisp.io/<?php echo $directory; ?></b>
        <a href="<?php echo $directory; ?>" target="_blank">Click Me</a>
        <br><img src="giphy.gif">
      </div>
    <?php } ?>
    
  </body>
  
  <script>
    function validate () {
      var url = document.getElementById("link").value;
      var res = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
      return (res !== null)
    }
  </script>
</html>