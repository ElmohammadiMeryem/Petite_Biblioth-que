<?php
require_once '../src/db.php';
require_once '../src/BookModel.php';
require_once '../src/helpers.php';

$pdo = getPDOConnection();
$BookModel = new BookModel($pdo);

$Book = BookModel->All();

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['_method ']) && $_POST['_method'] === 'DELETE') {
    if (isset($_POST['id'])) {


        // test
        $id = (int)$_POST['id'];
        if ($bookModel->delete($id)) {
            $_SESSION['flash_message'] = 'Livre supprimé avec succés!';
            $_SESSION['flash_type'] = 'sucess';
            header('Location: index.php');
            exit;
        }else{
            $_SESSION['flash_message'] = 'Erreur lors de la suppression du livre.';
            $_SESSION['flash_type'] = 'danger';
        }
    }
}

$flashMessage = '';
$flashType = ''; 
if (isset($_SESSION['flash_message'])){
    $flashMessage = $_SESSION['flash_message'];
    $flashType = $_SESSION['flash_type'];
    // Supprimer le message flash après l'avoir récupéré
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_type']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Petite Bibliothèque - Liste des livres</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
    <div class="container">
        <header>
            <h1>
                <span class="logo"></span>
                Petite Bibliothèque
            </h1>
            <a href="add.php" class="btn">Ajouter un livre</a>
        </header>

        <div class="card">
            <h2>Liste des livres</h2>
            <?php if (!empty($flashMessage)): ?>
                <div class="alert alert-<?php echo $flashType; ?>">
                    <?php echo htmlspecialchars($flashMessage); ?>
                </div>
                <?php endif; ?>

                <?php if (count($books) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Année</th>
                                <th>ISBN</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                                    <td><?php echo htmlspecialchars($book['year']); ?></td>
                                    <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                                    <td class="hidden">
                                        <a href="edit.php?id=<php>"></a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
        </div>
    </div>
</body>
</html>

