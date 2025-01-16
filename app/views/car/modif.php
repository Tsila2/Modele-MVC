<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de voiture</title>
</head>

<body>
    <h1>Modification du voiture n° </h1>

    <?php $car = $data['car'];
    
     ?>

    <form action="<?= BASE_URL ?>car/carupdate/<?= $car['id_car'] ?>" method="POST">
        <label for="type">Type de voiture : </label>&nbsp;&nbsp;
        <input type="number" id="type" name="type" value="<?= $car['id_type'] ?>" required><br><br>


        <select name='name_type' id='name_type'>
            <option>Choisir le type</option>
            <?php

            foreach ($data['types'] as $types) {

                if($car['id_type'] == $types['id_type']){
                    echo " 
                    <option value=" . $types['id_type'] . "   selected>" . $types['name_type'] . "</option>
                   
                    ";
                } else {
                    echo "
                    <option  value=" . $types['id_type'] . "  >" . $types['name_type'] . "</option>
                    ";
                }

                
            }
            ?>

        </select>

        <label for="registration">Immatriculation du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="registration" name="registration" value="<?= $car['registration'] ?>" required><br><br>

        <label for="name">Nom du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="name" name="name" value="<?= $car['name_car'] ?>" required> <br><br>

        <label for="mark">Marque du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="mark" name="mark" value="<?= $car['mark'] ?>" required><br><br>

        <label for="price_day">Prix par jour : </label>&nbsp;&nbsp;
        <input type="number" id="price_day" value="<?= $car['price_day'] ?>" name="price_day" required><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>

</html>