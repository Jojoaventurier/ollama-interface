<?php
class ConversationRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllConversations() {
        $stmt = $this->db->query('SELECT * FROM conversations ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Conversation');
    }

    public function save($name, $content) {
        $stmt = $this->db->prepare('INSERT INTO conversations (name, content, created_at) VALUES (?, ?, NOW())');
        $stmt->execute([$name, $content]);
    }
}