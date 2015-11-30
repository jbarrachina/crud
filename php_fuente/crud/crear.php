<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Añadir profesores</title>

    </head>
    <body>

        <!-- just a header -->
        <h1>Alta Profesor</h1>

        <?php
        if ($_POST) {
            // include database connection
            include 'conexion.php';
            // insert query
            $query = "REPLACE INTO profesores "
                    . "SET dni=?, nombre=?, apellido1=?, apellido2=?, "
                    . "login=?, email=?, familia=?, "
                    . "tel1=?, tel2=? ";
            echo $query,"<br>"; 
            // prepare query for execution
            if ($stmt = $conexion->prepare($query)){
                   echo "<div>Record prepared.</div>";
            } else {
                
                die('Unable to prepare record.'.$conexion->connect_error);
            }
            
            // bind the parameters
            $stmt->bind_param('sssssssss',$_POST['nif'],$_POST['nombre'],$_POST['apellido1'],$_POST['apellido2'],$_POST['login'],$_POST['email'],$_POST['familia'],$_POST['telefono1'],$_POST['telefono2']);

            // Execute the query
            if ($stmt->execute()) {
                echo "<div>Record was saved.</div>";
            } else {
                die('Unable to save record.');
            }
        }
        ?>
        <form action='crear.php' method='post'>
            <table border='0'>
                <tr>
                    <td>NIF</td>
                    <td><input type='text' name='nif' /></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type='text' name='nombre' /></td>
                </tr>
                <tr>
                    <td>1er Apellido</td>
                    <td><input type='text' name='apellido1'></textarea></td>
                </tr>
                <tr>
                    <td>2º Apellido</td>
                    <td><input type='text' name='apellido2'></textarea></td>
                </tr>
                <tr>
                    <td>login</td>
                    <td><input type='text' name='login' /></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td><input type='text' name='email' /></td>
                </tr>
                <tr>
                    <td>familia</td>
                    <td><input type='text' name='familia' /></td>
                </tr>
                <tr>
                    <td>telefono</td>
                    <td><input type='text' name='telefono1' /></td>
                </tr>
                <tr>
                    <td>telefono</td>
                    <td><input type='text' name='telefono2' /></td>
                </tr>
                <tr>
                    <td>activo</td>
                    <td><input type='text' name='activo' /></td>
                </tr>
                <tr>
                    <td>tutoria</td>
                    <td><input type='text' name='tutoria' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' /> 
                        <a href='leer.php'>Back to read records</a>
                    </td>
                </tr>
            </table>
        </form>

    </body>
</html>
