<!DOCTYPE html>looos
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <title>Coordinates</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form action="main_coords.php" method="post">
					Цвет
					<input type="checkbox" name="Red" value="Red" />Красный<br />
					<input type="checkbox" name="Blue" value="Blue" />Синий<br />
					<input type="submit" name="formSubmit" value="Submit" />
				</form> 
<?php
//header ("Content-type: image/png");

$foo_x=$_POST['foo_x'];
$foo_y=$_POST['foo_y'];
echo "X=$foo_x, Y=$foo_y ";

?>

<div class="map_wrapper">

    <div class="map">
        <form action='' method=post>

            <?php
            @$coords_X=file_get_contents("coords_X.txt");
            $array_X = explode("|", $coords_X);
            if(count($array_X)>1)
            {
                echo "  <input type=\"image\" alt=' Finding coordinates of an image' src=\"points.php\" name=\"foo\"/>";
            }
            else {
                echo "  <input type=\"image\" alt=' Finding coordinates of an image' src=\"image001.jpg\" name=\"foo\"/>";
            }
            ?>


        </form>

    </div>
    <!--    <img style="position: absolute; top: 0; left: 0" src="points.php">-->
    <?php
    $submit=$_POST['foo_x'];
    $i=0;
    if (isset($submit)) {
//header("Location: " . $_SERVER["REQUEST_URI"] . "");

//<!------------ ДОБАВЛЕНИЕ ТОЧКИ----------->
        file_put_contents('coords_X.txt', "$foo_x|", FILE_APPEND);
        file_put_contents('coords_Y.txt', "$foo_y|", FILE_APPEND);
        $coords_X=file_get_contents("coords_X.txt");
        $coords_Y=file_get_contents("coords_Y.txt");

        $array_X = explode("|", $coords_X);
        $array_Y = explode("|", $coords_Y);
        //var_dump($array_X);

        while($i<200)
        {
            if(($array_Y[$i]!=0) && ($array_X[$i]!=0))
            {
                $distance_X=abs($array_X[$i]-$array_X[$i-1]);
                $distance_Y=abs($array_Y[$i]-$array_Y[$i-1]);
                				
			
					  
					  					  
					if(isset($_POST['Red']) && $_POST['Red'] == 'Red'){

                        print "<div style='position: absolute; top: <?php echo$array_Y[$i]-8?>px; left: <?echo $array_X[$i]-8?>px'>
                            <img class = 'dot' src='red_dot.png' />
                        </div>"; //вот тут беда с экранированием

                    }
						
					elseif(isset($_POST['Blue']) && $_POST['Blue'] == 'Blue'){


						print "<div style='position: absolute; top: <?phph echo$array_Y[$i]-8?>px; left: <?echo $array_X[$i]-8?>px'>
							<img class = 'dot' src='blue_dot.png' />
						</div>"; //вот тут беда с экранированием
				    }
            

            $i++;

            }

        }
    ?>
</div>
<form  action='' method=post>
    <input class="reset_button" type="submit"  name="delete" value="Reset"/>
</form>
<div class="info">
    <?php

            if(count($array_X)>1)
            echo "X=$foo_x, Y=$foo_y ";

        if(count($array_X)>2)
        {
            $distance=round(sqrt(pow($distance_X,2)+pow($distance_Y,2)));

            echo "<br>Расстояние:$distance пикселей";
        }

        $reset=$_POST['delete'];
        if (isset($reset)) {
            @unlink('coords_X.txt');
            @unlink('coords_Y.txt');
            header("Location: " . $_SERVER["REQUEST_URI"] . "");
        }
    ?>
    <div/>
