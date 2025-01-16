<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de voiture</title>
</head>

<body>
    <h1>Ajout voiture</h1>

    <form action="<?= BASE_URL ?>car/addcar" method="POST">
        <label for="type">Type de voiture : </label>&nbsp;&nbsp;
        <input type="number" id="type" name="type" required><br><br>

        <label for="registration">Immatriculation du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="registration" name="registration" required><br><br>

        <label for="name">Nom du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="name" name="name" required> <br><br>

        <label for="mark">Marque du voiture : </label>&nbsp;&nbsp;
        <input type="text" id="mark" name="mark" required><br><br>

        <label for="price_day">Prix par jour : </label>&nbsp;&nbsp;
        <input type="number" id="price_day" name="price_day" required><br><br>

        <button type="submit">Ajouter</button>
    </form>
</body>

</html>