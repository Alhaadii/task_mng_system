<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 1px solid #ddd;
        text-transform: uppercase;
        font-family: 'Courier New', Courier, monospace;
        margin-top: 20px;
    }

    ul {
        list-style-type: none;
        margin: 20px;
        padding: 20px;
        overflow: hidden;
    }

    ul>li {
        padding: 30px;
        width: 100%;

    }

    ul>li>a {
        color: #fff;
        padding: 30px;
        width: 100%;
        display: block;
        text-decoration: none;
        background-color: #333;
        font-size: 18px;
        transition: color 0.3s ease;
        text-transform: uppercase;
    }
</style>


<body>
    <nav>
        <h1>Task Management sytem</h1>
        <ul>
            <li><a href="./users.php">Users</a></li>
            <li><a href="./tasks.php">Tasks</a></li>
            <li><a href="./category.php">Categories</a></li>
        </ul>
    </nav>
</body>

</html>