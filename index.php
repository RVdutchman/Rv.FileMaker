<?php
/*!
 * Php Rv.FileMaker 0.0.1
 *
 *
 * required files and folders:
 *  index.php     [file]
 *  makeCms.php   [file]
 *  assests       [folder]
 *
 * makes these files/directorys (result):
 *  <directorys>:
 *    css           files:
 *                    style.css;
 *    js           files:
 *                    jsFunctions.js;
 *    img          files:
 *
 *    media        files:
 *
 *
 *  <files>:
 *         index.php;
 *         readme.md;
 */
if (isset($_POST['submit']))//Check if submit button is clicked
{
$dir = $_POST['dir'];
$folders = scandir('.');
var_dump($folders);
if(!array_search("apps",$folders)) {
  mkdir("apps");
}
function MakeFiles() {
    /* Setting up some default variables */
    if (isset($_POST['jquery'])) {
        $jquery = "<script src='/assets/jquery/dist/jquery.min.js'></script><!-- jquery.js -->\n";
    } else {$jquery = '';}
    if (isset($_POST['jqueryUI'])) {
        $jqueryUI = "<script src='/assets/bootstrap/dist/js/bootstrap.min.js'></script><!-- bootstrap.js -->\n<script src='/assets/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'></script><!-- jquery-ui-touch-punch -->\n";
        $jquery = "<script src='/assets/jquery/dist/jquery.min.js'></script><!-- jquery.js -->\n";
    } else {$jqueryUI = '';}
    if (isset($_POST['bootstrap'])) {
        $bootstrap_css = "<link rel='stylesheet' href='/assets/bootstrap/dist/css/bootstrap.min.css'><!-- bootstrap.css -->\n<link rel='stylesheet' href='/assets/bootstrap/dist/css/bootstrap-switch.min.css'><!-- bootstrap switch -->\n";
        $bootstrap_js = "<script src='/assets/bootstrap/dist/js/bootstrap.min.js'></script><!-- bootstrap.js -->\n<script src='/assets/bootstrap/dist/js/bootstrap-switch.min.js'></script><!-- bootstrap switch -->\n";
        $jquery = "<script src='/assets/jquery/dist/jquery.min.js'></script><!-- jquery.js -->\n";
    } else {$bootstrap_css = ''; $bootstrap_js = '';}
    if (isset($_POST['animate'])) {
        $animate = "<link rel='stylesheet' href='/assets/animate/animate.min.css'><!-- animate.css -->\n";
    } else {$animate = '';}
    if (isset($_POST['awesome'])) {
        $font_awesome = "<link rel='stylesheet' href='/assets/font-awesome/css/font-awesome.min.css'><!-- font-awesome.css -->\n";
    } else {$font_awesome = '';}
    $dir = $_POST['dir'];
/* include file content */
$readme_file = '# '.$dir.'
made with Rv.FileMaker
';
$index_file = '<!DOCTYPE html>
<html>
  <head>
    <title>Rv.'.$dir.'</title>
    <meta charset="utf-8">
    '.$bootstrap_css.''.$animate.''.$font_awesome.''.$jquery.''.$jqueryUI.''.$bootstrap_js.'
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jsFunctions.js"></script>
  </head>
  <body>
    <p>If text is green <strong>css works</strong></p>
    <div id="test">javascripts don\'t work</div>
    <script>
      test();
    </script>
  </body>
</html>

';
$style_file = 'html, head, body {
  font-size: 30px;
}
p {
  color: green;
}
';
$jsFunctions_file = 'function test() {
var test = document.getElementById("test");
test.innerHTML = "javascripts works";
}
';

//end file content

    //Make dirs
    mkdir("apps/$dir");
    mkdir("apps/$dir/css");
    mkdir("apps/$dir/js");
    mkdir("apps/$dir/img");
    mkdir("apps/$dir/media");

    //root files
    $index = fopen("apps/$dir/index.php","wb");
      fwrite($index,$index_file);
      fclose($index);
    $readme = fopen("apps/$dir/README.md","wb");
      fwrite($readme,$readme_file);
      fclose($readme);
    //css
    $style = fopen("apps/$dir/css/style.css","wb");
      fwrite($style,$style_file);
      fclose($style);
    //Js
    $jsFunctions = fopen("apps/$dir/js/jsFunctions.js","wb");
      fwrite($jsFunctions,$jsFunctions_file);
      fclose($jsfunctions);

    header("Location: index.php");
  }//end function MakeFiles()
  if(!array_search($dir, scandir("apps"))) {
    MakeFiles();
  } else {
    echo "That folder name has already been used";
  }
}//end if (isset($_POST['submit']))
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rv.FileMaker</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css"><!-- bootstrap.css -->
  <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap-switch.min.css"><!-- bootstrap switch -->
  <link rel="stylesheet" href="/assets/animate/animate.min.css"><!-- animate.css -->
  <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css"><!-- font-awesome.css -->
  <script src="/assets/jquery/dist/jquery.min.js"></script><!-- jquery.js -->
  <script src="/assets/jquery-ui/jquery-ui.min.js"></script><!-- jquery-ui.js -->
  <script src="/assets/bootstrap/dist/js/bootstrap.min.js"></script><!-- bootstrap.js -->
  <script src="/assets/bootstrap/dist/js/bootstrap-switch.min.js"></script><!-- bootstrap switch -->
  <script src="/assets/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script><!-- jquery-ui-touch-punch -->
  <style media="screen">
    .checkbox > label {
      width: 270px;
    }
    body {
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  <div class="jumbotron bg-success">
    <h1 class="text-center">Rv.FileMaker</h1>
    <p class="text-center">by RV_dutchman</p>
  </div>
  <div class="alert alert-info text-center">
    <p>Make sure you have the <strong>assets</strong> folder and the <strong>makeCms.php</strong> file</p>
  </div>
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-8">
          <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
              <label for="usrname"><span class="fa fa-folder-open"></span>Folder name:</label>
              <div class="input">
                <input type="text" name="dir" class="form-control" id="exampleInputAmount" placeholder="Folder" required="required">
              </div>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" name="bootstrap">Use Bootstrap</label>
              <label><input type="checkbox" name="animate" value="">Use animate.css</label>
              <label><input type="checkbox" name="awesome" value="">Use font-awesome.css</label>
              <label><input type="checkbox" name="jquery" value="">Use jquery</label>
              <label><input type="checkbox" name="jqueryUI" value="">Use jqueryUI</label>
            </div><br>
              <button type="submit" name="submit" class="btn btn-success btn-block"><span class="fa fa-check"></span>Make Folder</button>
          </form>
    </div>
    <div class="col-sm-2 bg-info" style="float:right; border-radius:10px;">
      <h3>Your Projects:</h3>
      <ul style="list-style:none;">
        <?php
        foreach(glob('apps/*', GLOB_ONLYDIR) as $dir) {
            $dirname = basename($dir);
            echo "<li><i class='fa fa-folder-open'></i><a href='apps/" . $dirname . "'>" . $dirname . "</a></li>";
        }
        ?>
      </ul>
    </div>
    <div class="col-sm-1">
    </div>
  </div>
  <script type="text/javascript">
      $.fn.bootstrapSwitch.defaults.size = 'small';
      $.fn.bootstrapSwitch.defaults.onColor = 'success';
      $.fn.bootstrapSwitch.defaults.offColor = 'danger';
      $.fn.bootstrapSwitch.defaults.onInit = function(event, state) {console.log("Init");}
      $("[name='bootstrap']").bootstrapSwitch();
      $("[name='animate']").bootstrapSwitch();
      $("[name='awesome']").bootstrapSwitch();
      $("[name='jquery']").bootstrapSwitch();
      $("[name='jqueryUI']").bootstrapSwitch();
  </script>
</body>
</html>
