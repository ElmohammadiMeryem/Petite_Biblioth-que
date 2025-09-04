<?php
require_once '../src/db.php';
require_once '../src/BookModel.php';
require_once '../src/helpers.php';

// Créer une instance du modèle
$bookModel = new BookModel($pdo); 

// Récupérer tous les livres
$books = $bookModel->All(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Petite Bibliothèque - Liste des livres</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Petite Bibliothèque</h1>
        <nav>
            <a href="add.php" class="btn">Ajouter un livre</a>
        </nav>
    </header>

    <main>
        <?php if (!empty($books)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Année</th>
                        <th>ISBN</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php htmlspecialchars($book['title']); ?></td>
                                <td><?php htmlspecialchars($book['author']); ?></td>
                                <td><?php htmlspecialchars($book['year']); ?></td>
                                <td><?php htmlspecialchars($book['isbn']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $book['id']; ?>">Modifier</a>
                                    <form action="delete.php" method="POST" style="display:inline;">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?');">Supprimer</a>
                                </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
            </table>
            <?php else: ?>
            <p>Aucun livre trouvé. <a href="add.php">Ajoute-en un !</a></p>
            <?php endif; ?>
    </main>
</body>
</html>
