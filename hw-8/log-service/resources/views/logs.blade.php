<html>
<head>
    <meta charset="UTF-8">
    <title>Логи</title>
{{--    <style>--}}
{{--        td:nth-child(5),td:nth-child(6){text-align:center;}--}}
{{--        table{position:absolute; border-spacing:0; border-collapse: collapse; width: 70%; box-shadow: 0px 4px 180px rgb(255 255 255 / 25%);}--}}
{{--    </style>--}}
{{--    <style>--}}
{{--        .table {--}}
{{--            width: 100%;--}}
{{--            margin-bottom: 20px;--}}
{{--            border: 5px solid #fff;--}}
{{--            border-top: 5px solid #fff;--}}
{{--            border-bottom: 3px solid #fff;--}}
{{--            border-collapse: collapse;--}}
{{--            outline: 3px solid #ffd300;--}}
{{--            font-size: 15px;--}}
{{--            background: #fff!important;--}}
{{--        }--}}
{{--        .table th {--}}
{{--            font-weight: bold;--}}
{{--            padding: 7px;--}}
{{--            background: #ffd300;--}}
{{--            border: none;--}}
{{--            text-align: left;--}}
{{--            font-size: 15px;--}}
{{--            border-top: 3px solid #fff;--}}
{{--            border-bottom: 3px solid #ffd300;--}}
{{--        }--}}
{{--        .table td {--}}
{{--            padding: 7px;--}}
{{--            border: none;--}}
{{--            border-top: 3px solid #fff;--}}
{{--            border-bottom: 3px solid #fff;--}}
{{--            font-size: 15px;--}}
{{--        }--}}
{{--        .table tbody tr:nth-child(even){--}}
{{--            background: #f8f8f8!important;--}}
{{--        }--}}


{{--    </style>--}}
    <style>
                body {
                    font-family: Arial, sans-serif;
                }

                h2 {
                    margin-left: 100px;
                }

                table {
                    margin: 20px;
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
<h2>HTTP Request Logs</h2>
<?php
$db_server = '127.0.0.1:3319'; $db_user = 'root'; $db_password = ""; $db_name = 'project-00';
try {
    $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, time, duration, ip, url, method, input FROM logs";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result_array = $statement->fetchAll();
    echo "<div class=\"table\">";
    echo "<table><tr><th>ID</th><th>Time</th><th>Duration</th><th>IP</th><th>URL</th><th>Method</th><th>Input</th></tr>";
    foreach ($result_array as $result_row) {
        echo "<tr>";
        echo "<td align=\"center\">" . $result_row["id"] . "</td>";
        echo "<td align=\"center\">" . $result_row["time"] . "</td>";
        echo "<td align=\"center\">" . $result_row["duration"] . "</td>";
        echo "<td align=\"center\">" . $result_row["ip"] . "</td>";
        echo "<td align=\"center\">" . $result_row["url"] . "</td>";
        echo "<td align=\"center\">" . $result_row["method"] . "</td>";
        echo "<td align=\"center\">" . $result_row["input"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}
catch (PDOException $e) {
    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
}
$db = null;
?>
</body>
</html>
