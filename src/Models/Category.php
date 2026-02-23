<?php

namespace App\Models;

class Category extends BaseModel {
    public function getAllWithArticles() {
        $sql = "SELECT DISTINCT c.* FROM categories c 
                JOIN article_categories ac ON c.id = ac.category_id";
        return $this->db->query($sql)->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
