<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Data User</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
            </tr>
            <tr>
                <td>{{$d->user_id}}</td>
                <td>{{$d->username}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->level_id}}</td>
            </tr>
        </table>
    </body>
</html>