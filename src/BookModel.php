<?php
class BookModel {
  private $pdo;
  public function __construct($pdo){ $this->pdo = $pdo; }

  public function all(){
    $stmt = $this->pdo->query("SELECT * FROM books ORDER BY created_at DESC");
    return $stmt->fetchAll();
  }

  public function find($id){
    $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  public function create($data){
    $stmt = $this->pdo->prepare("INSERT INTO books (title, author, year, isbn, description) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$data['title'],$data['author'],$data['year'],$data['isbn'],$data['description']]);
  }

  public function update($id, $data){
    $stmt = $this->pdo->prepare("UPDATE books SET title=?, author=?, year=?, isbn=?, description=? WHERE id=?");
    return $stmt->execute([$data['title'],$data['author'],$data['year'],$data['isbn'],$data['description'],$id]);
  }

  public function delete($id){
    $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
    return $stmt->execute([$id]);
  }
}