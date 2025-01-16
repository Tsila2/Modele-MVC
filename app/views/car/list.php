<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de voiture</title>
    <link rel="stylesheet" href="<?= BASE_URL?>assets/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Immatriculation</th>
            <th>Nom</th>
            <th>Marque</th>
            <th>Disponibilité</th>
            <th>Prix Jour</th>
            <th>Modification</th>
        </tr>
        <?php
        foreach ($data['cars'] as $car) {
            if ($car['available']) {
                $dispo = "Oui";
            } else {
                $dispo = "Non";
            }
            echo "
                <tr>
                    <td>" . $car['id_car'] . "</td>
                    <td>" . $car['name_type'] . "</td>
                    <td>" . $car['registration'] . "</td>
                    <td>" . $car['name_car'] . "</td>
                    <td>" . $car['mark'] . "</td>
                    <td>" . $dispo . "</td>
                    <td>" . $car['price_day'] . "</td>
                    <td><a href='./update/" . $car["id_car"] . "'>Modifier</a><a href='./delete/" . $car["id_car"] . "'>Supprimer</a></td>
                </tr>";
        }
        ?>
    </table>

    <img src="https://www.google.com/imgres?q=example&imgurl=https%3A%2F%2Ft3.ftcdn.net%2Fjpg%2F00%2F92%2F53%2F56%2F360_F_92535664_IvFsQeHjBzfE6sD4VHdO8u5OHUSc6yHF.jpg&imgrefurl=https%3A%2F%2Fstock.adobe.com%2Fbe_fr%2Fsearch%3Fk%3Dexample&docid=fyjvqSEl48RTYM&tbnid=ZGFAQlsrjXXzfM&vet=12ahUKEwjJ25vI7KGKAxXSQkEAHbcHKVEQM3oECBUQAA..i&w=719&h=360&hcb=2&ved=2ahUKEwjJ25vI7KGKAxXSQkEAHbcHKVEQM3oECBUQAA" alt="">

</body>

</html>