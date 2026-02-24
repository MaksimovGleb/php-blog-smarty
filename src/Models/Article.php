<?php

namespace App\Models;

use PDO;

class Article extends BaseModel {
    public function getLatestByCategory($categoryId, $limit = 3) {
        $sql = "SELECT a.* FROM articles a
                JOIN article_categories ac ON a.id = ac.article_id
                WHERE ac.category_id = ?
                ORDER BY a.created_at DESC
                LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory($categoryId, $sort = 'created_at', $order = 'DESC', $limit = 10, $offset = 0) {
        $allowedSorts = ['created_at', 'views'];
        if (!in_array($sort, $allowedSorts)) $sort = 'created_at';
        $order = ($order === 'ASC') ? 'ASC' : 'DESC';

        $sql = "SELECT a.* FROM articles a
                JOIN article_categories ac ON a.id = ac.article_id
                WHERE ac.category_id = :cat_id
                ORDER BY a.{$sort} {$order}
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countByCategory($categoryId) {
        $sql = "SELECT COUNT(*) FROM article_categories WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function incrementViews($id) {
        $stmt = $this->db->prepare("UPDATE articles SET views = views + 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getRelated($articleId, $limit = 3) {
        $sql = "SELECT DISTINCT a.* FROM articles a
                JOIN article_categories ac ON a.id = ac.article_id
                WHERE ac.category_id IN (
                    SELECT category_id FROM article_categories WHERE article_id = :id_sub
                ) AND a.id != :id_main
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_sub', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':id_main', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategories($articleId) {
        $sql = "SELECT c.* FROM categories c
                JOIN article_categories ac ON c.id = ac.category_id
                WHERE ac.article_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$articleId]);
        return $stmt->fetchAll();
    }
}
