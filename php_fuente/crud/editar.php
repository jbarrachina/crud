<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar un registro</title>
    </head>
    <body>

        <!-- just a header label -->
        <h1>Editar</h1>

        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
        $dni = isset($_GET['dni']) ? $_GET['dni'] : die('ERROR: Registro no encontrado.');

//include database connection
        include 'conexion.php';

// check if form was submitted
        if ($_POST) {
            // write update query
            // in this case, it seemed like we have so many fields to pass and 
            // it is better to label them and not use question marks
            $query = "UPDATE profesores 
                    SET nombre=?, apellido1=?, apellido2=?
                    WHERE dni = ?";

            // prepare query for excecution
            $stmt = $conexion->prepare($query);

            // bind the parameters
            $stmt->bind_param('ssss', $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['nif']);
            // Execute the query
            if ($stmt->execute()) {
                echo "Record was updated.";
            } else {
                echo 'Unable to update record. Please try again.';
            }
        } else {
            // read current record's data
            // prepare select query
            $query = "SELECT dni, nombre, apellido1, apellido2, login, email, familia, tel1, tel2 "
                    . "FROM profesores  "
                    . "WHERE dni = ? "
                    . "LIMIT 0,1";
            if ($stmt = $conexion->prepare($query)) {

                // this is the first question mark
                $stmt->bind_param('s', $dni);

                // execute our query
                $stmt->execute();
                $stmt->bind_result($dni, $nombre, $apellido1, $apellido2, $login, $email, $familia, $tel1, $tel2);
                // store retrieved row to a variable
                $stmt->fetch();
            }
        }
        ?>
        <form action='editar.php?dni=<?php echo htmlspecialchars($dni); ?>' method='post' border='0'>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td><input type='text' name='nombre' value="<?php echo htmlspecialchars($nombre, ENT_QUOTES); ?>" /></td>
                </tr>
                <tr>
                    <td>1er Apellido</td>
                    <td><input type="text" name='apellido1' value="<?php echo htmlspecialchars($apellido1, ENT_QUOTES); ?>" /></td>
                </tr>
                <tr>
                    <td>2º Apellido</td>
                    <td><input type='text' name='apellido2' value="<?php echo htmlspecialchars($apellido2, ENT_QUOTES); ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' />
                        <a href='leer.php'>Volver a Listado Profesorado</a>
                    </td>
                </tr>
            </table>
        </form>

    </body>
</html>

