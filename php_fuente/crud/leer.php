<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listar profesores</title>
        <script type="text/JavaScript">
            function borra_profesor(dni) {
                var answer = confirm('Are you sure?');
                if (answer) {
                    // if user clicked ok, 
                    // pass the id to delete.php and execute the delete query
                    window.location = 'borrar.php?dni=' + dni;
                }
            }
        </script> 

    </head>
    <body>

        <h1>Listado de Profesores</h1>

        <?php
// include database connection
        include 'conexion.php';
        $action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
        if ($action == 'deleted') {
            echo "<div>Record was deleted.</div>";
        }
// select all data
        $query = "SELECT dni, nombre, apellido1, apellido2, login, email, familia, tel1, tel2 "
                . "FROM profesores "
                . "ORDER BY apellido1, apellido2, nombre";
        if ($stmt = $conexion->prepare($query)) {
            if (!$stmt->execute()) {
                die('Unable to save record.' . $conexion->connect_error);
            }
// this is how to get number of rows returned
            $stmt->bind_result($dni, $nombre, $apellido1, $apellido2, $login, $email, $familia, $tel1, $tel2);
            // $stmt->num_rows; no funciona
// link to create record form
            echo "<div>";
            echo "<a href='crear.php'>Alta profesor</a>";
            echo "</div>";


            echo "<table>"; //start table
            //creating our table heading
            echo "<tr>";
            echo "<th>NIF</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido 1</th>";
            echo "<th>Apellido 2</th>";
            echo "<th>login</th>";
            echo "<th>email</th>";
            echo "<th>familia</th>";
            echo "<th>telefono 1</th>";
            echo "<th>telefono 2</th>";
            echo "</tr>";

            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($stmt->fetch()) {
                // extract row
                // this will make $row['firstname'] to
                // just $firstname only
                //extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>$dni</td>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1</td>";
                echo "<td>$apellido2</td>";
                echo "<td>$login</td>";
                echo "<td>$email</td>";
                echo "<td>$familia</td>";
                echo "<td>$tel1</td>";
                echo "<td>$tel2</td>";
                echo "<td>";
                // we will use this links on next part of this post
                echo "<a href='editar.php?dni=$dni'>Edita</a>";
                echo " / ";
                // we will use this links on next part of this post
                echo "<a href='javascript:borra_profesor(\"$dni\")'> Elimina </a>";
                echo "</td>";
                echo "</tr>\n";
            }
            // end table
            echo "</table>";

            $stmt->close();
        } else {
            die('Unable to prepare record.' . $conexion->connect_error);
        }
        ?> 


    </body>
</html>

