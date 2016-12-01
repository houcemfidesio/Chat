<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Authentification</title>
    </head>
    <body>
        <H3>J'ai un compte</H3>
        <form action="authentification.php" method="POST">
            <input type="text" name="pseudo" required placeholder="Pseudo" value="">
            <input type="password" name="password" required placeholder="Password" value="">
            <input type="submit" value="Connexion">
        </form>
        <H3>Nouveau compte</H3>
        <form action="inscription.php" method="POST">
            <input type="text" name="pseudo" required placeholder="Pseudo">
            <input type="password" name="password" required placeholder="Password">
            <input type="password" name="password2" required placeholder="re-Password">
            <input type="submit" value="Inscription">
        </form>
    </body>
</html>