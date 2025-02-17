<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td:nth-child(5), td:nth-child(6) {
            text-align: center;
        }
        table {
            position: relative;
            border-spacing: 0;
            border-collapse: collapse;
            width: 70%;
            box-shadow: 0px 4px 180px rgb(255 255 255 / 25%);
        }
    </style>
</head>
<body>
<h1>HTTP Request Logs</h1>
<div class="table">
    <table>
        <tr>
            <th>ID</th>
            <th>Time</th>
            <th>Duration</th>
            <th>IP</th>
            <th>URL</th>
            <th>Method</th>
            <th>Input</th>
        </tr>
        @foreach($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->time }}</td>
                <td>{{ $log->duration }}</td>
                <td>{{ $log->ip }}</td>
                <td>{{ $log->url }}</td>
                <td>{{ $log->method }}</td>
                <td>{{ $log->input }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>


{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Логи</title>--}}
{{--    <style>--}}
{{--        td:nth-child(5),td:nth-child(6){text-align:center;}--}}
{{--        table{position:absolute; border-spacing:0; border-collapse: collapse; width: 70%; box-shadow: 0px 4px 180px rgb(255 255 255 / 25%);}--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<?php--}}
{{--$db_server = '127.0.0.1:3319'; $db_user = 'root'; $db_password = ''; $db_name = 'log-project-db';--}}
{{--try {--}}
{{--    $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));--}}
{{--    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);--}}
{{--    $sql = "SELECT id, time, duration, ip, url, method, input FROM logs";--}}
{{--    $statement = $db->prepare($sql);--}}
{{--    $statement->execute();--}}
{{--    $result_array = $statement->fetchAll();--}}
{{--    echo "<div class=\"table\">";--}}
{{--    echo "<table><tr><th>id</th><th>time</th><th>duration</th><th>ip</th><th>url</th><th>method</th><th>input</th></tr>";--}}
{{--    foreach ($result_array as $result_row) {--}}
{{--        echo "<tr>";--}}
{{--        echo "<td align=\"center\">" . $result_row["id"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["time"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["duration"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["ip"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["url"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["method"] . "</td>";--}}
{{--        echo "<td align=\"center\">" . $result_row["input"] . "</td>";--}}
{{--        echo "</tr>";--}}
{{--    }--}}
{{--    echo "</table>";--}}
{{--    echo "</div>";--}}
{{--}--}}
{{--catch (PDOException $e) {--}}
{{--    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();--}}
{{--}--}}
{{--$db = null;--}}
{{--?>--}}
{{--</body>--}}
{{--</html>--}}
