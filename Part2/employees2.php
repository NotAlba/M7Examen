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
    <h1>Llista de caps de departament</h1>
    <?php
 
            

            $consulta= "SELECT e.first_name,e.last_name,d.dept_name FROM employees e,dept_manager dm,departments d WHERE e.emp_no=dm.emp_no and d.dept_no=dm.dept_no;";

            $query = $conn->prepare($consulta);
            $query->execute();
            $registre = $query->fetch();
            ?>
            <ul>
            <?php

                while ($registre) {
                    echo '<li>'.$registre['first_name'].' '.$registre['last_name'].' = '.$registre['dept_name'] .'</li>';
                    $registre = $query->fetch();
                }
                
            ?>
        </ul>
        
	

</body>
</html>