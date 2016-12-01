<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Chat en PHP</title>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <h3>Discussion</h3>
                    <table width="100%" id="table_messages">
                        <tr>
                            <th width="20%">Pseudo</th>
                            <th width="20%">Date</th>
                            <th>Message</th>
                        </tr>
                        <?php foreach ($messages as $message) {
                            ; ?>
                            <tr>
                                <td><?php print $message["pseudo"]; ?></td>
                                <td><?php print $message['date_post']; ?></td>
                                <td><?php print $message['message']; ?></td>
                            </tr>
                        <?php }; ?>
                    </table>
                </div>
                <div class="col-md-4">
                    <h3>Liste Connectés</h3>
                    <table width="100%" id="table_users">
                        <tr>
                            <th>Pseudo</th>
                        </tr>
                        <?php foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?php print $user["pseudo"]; ?></td>
                            </tr>
                            <?php
                        } ?>
                    </table>
                </div>
            </div>

            <br>
            <form action="chat.php" method="POST">
                <input type="submit" value="Recharger">
            </form>
            <br><br>
            <form action="chat.php" method="POST">
                <h3><?php print $_SESSION['pseudo'] . ':'; ?> </h3>
                <textarea id="message_area" name="message" placeholder="Votre message" required></textarea>
                <input type="submit" value="Envoyer">
            </form>
            <br>

            <br>
            <a href="authentification.php">Déconnexion</a>
        </div>
    </body>
</html>


<style>
    table {
        border-width: 1px;
        border-style: solid;
        border-color: black;
    }

    td {
        border-width: 1px;
        border-style: solid;
        border-color: red;
    }
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {
        $.ajax(
            {
                type : "POST",
                dataType : "json",
                url : "../controleurs/refresh.php",
                success : function (data) {
                    messages = data['messages'];
                    users = data['users'];

                    contenu_table_messages = '<tr><th width="20%">Pseudo</th><th ' +
                        'width="20%">Date</th><th>Message</th></tr>';
                    for (var i = 0; i < messages.length; i++) {
                        contenu_table_messages += '<tr><td>' + messages[i]['pseudo'] + '</td>';
                        contenu_table_messages += '<td>' + messages[i]['date_post'] + '</td>';
                        contenu_table_messages += '<td>' + messages[i]['message'] + '</td>'
                    }
                    contenu_table_messages += '</tr>';

                    $('#table_messages').html(contenu_table_messages);

                    contenu_table_users = '<tr><th>Pseudo</th></tr>';
                    for (var i = 0; i < users.length; i++) {
                        contenu_table_users += '<tr><td>' + users[i]['pseudo'] + '</td></tr>';
                    }

                    $('#table_users').html(contenu_table_users);
                }
            }
        );
    }


</script>