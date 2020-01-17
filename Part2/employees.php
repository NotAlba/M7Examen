<html>
<head>
	<title></title>
</head>
<body>
	<?php
            try {
                $conn = new PDO("mysql:host=localhost;dbname=employees", "alba", "P@ssw0rd");
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage() . "\n";
                exit;
            }
            
    ?>
    <h1>Consulta empleats</h1>
    <form method='POST' action='employees.php'>
        <label>Introdueix l'any de contractació (YYYY)</label>
    	<input type="text"  name="year"  required>
        <br>
        <br>
        <label>Selecciona el mes</label>
        <select name="month">
            <?php 
                for ($i=1; $i < 13; $i++) {
                    if ($i<10) {
                        echo '<option value="0'.$i.'">0'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    
                    
                }
             ?>
        </select>
        <br>
        <br>
    	<input type=submit name='data'></input>

    </form>
    <?php
        if (isset($_POST['year']) && isset($_POST['month']) ) {

            $year=$_POST['year'];
            $month= $_POST['month'];
            $date= $year . "-" . $month."%"; 
            $consulta = "SELECT `first_name`,`last_name` FROM `employees` WHERE hire_date LIKE '".$date."';";
            $query = $conn->prepare($consulta);
            $query->execute();
            $registre = $query->fetch();
            ?>
            <ul>
            <?php

                while ($registre) {
                    echo '<li>'.$registre['first_name'].' '.$registre['last_name'] .'</li>';
                    $registre = $query->fetch();
                }
                
            ?>
        </ul>
            <?php
            
        }


      ?>
	

</body>
</html>