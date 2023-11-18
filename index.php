<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Post</title>
</head>
<body>
    <h1>Nuevo Post</h1>
    <form method="post" action="procesar_post.php">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
        <br>
        <label for="contenido">Contenido:</label>
        <textarea name="contenido" id="contenido" required></textarea>
        <br>
        <input type="submit" value="Crear Post">
    </form>
</body>
</html>