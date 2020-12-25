<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>deploy laravel application</title>
    </head>
    <body>
        <form method="GET" action="deploy/exec">
            <select name="env">
                <option value="laravel-ftp">laravel-ftp</option>
                <option value="laravel-ssh">laravel-ssh</option>
                <option value="laravel-git">laravel-git</option>
                <option value="laravel-gulp">laravel-gulp</option>
                <option value="laravel-heroku">laravel-heroku</option>
                <option value="laravel-bluemix">laravel-bluemix</option>
                <option value="laravel-db">laravel-db</option>
                <option value="laravel-ui">laravel-ui</option>
            </select>
            <button type="submit">deploy</button>
        </form>
    </body>
</html>
