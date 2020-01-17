<html>
<head>
	<title></title>
</head>
<body>
	<?php
            try {
                $servername = "localhost";
                $username = "alba";
                $password = "P@ssw0rd";
                $dbname = "m7uf3";

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage() . "\n";
                exit;
            }
            
    ?>
    <h1>Crea una taula</h1>
    <form method='POST' action='Exercici1.php'>
        <label><strong>Introdueix el nom de la taula</strong></label>
        <input type="text"  name="name"  required>
        <br>
        <br>
        <label><strong>Introdueix els camp (max=10)</strong></label>
        </br></br>
        <?php
        $types=["VARCHAR","INT","FLOAT"];
        for ($i=1; $i < 11 ; $i++) { 
             echo "<label><strong> Camp ".$i." </strong></label>";
             echo "</br>";
             echo "<label> Nom Camp: </label>";
             echo '<input type="text"  name="camp'.$i.'" >';
             echo '<select name="type'.$i.'">';

                for ($x=0; $x < count($types) ; $x++) {
                    echo '<option value="'.$types[$x].'">'.$types[$x].'</option>';
                    
                }
             echo '</select>';
             echo "</br> </br>";

         } 
        ?>
        
        <br>
        <br>
        <input type=submit name='data'></input>

    <?php

        if (isset($_POST['name'])) {
            $contador=0;
            $table_name=$_POST['name'];
            $consulta="CREATE TABLE $table_name (";
            for ($m=1; $m <11 ; $m++) { 
                if(isset($_POST['camp'.$m])){
                    if ($_POST['camp'.$m]!="") {
                        if ($_POST['type'.$m]=="FLOAT") {
                            $consulta=$consulta.$_POST['camp'.$m]." ".$_POST['type'.$m]."(7,5), ";
                        }else{
                        $consulta=$consulta.$_POST['camp'.$m]." ".$_POST['type'.$m]."(75), ";}
                        $contador= $contador+1;   
                    }   
                }
            }
            $consulta= substr($consulta,0,-2);
            $consulta=$consulta. ')';

            if ($contador!=0) {
                try{
                $conn->exec($consulta);
                }
                catch(PDOException $e)
                {
                echo $sql . "<br>" . $e->getMessage();
                }
            }else{
                echo "No puedes insertar una tabla sin campos";
            }

        }
 
            ?>
        
        
	

</body>
</html>