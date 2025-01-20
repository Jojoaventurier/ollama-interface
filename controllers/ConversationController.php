<?php
require_once 'models/Conversation.php';
require_once 'models/ConversationRepository.php';

class ConversationController {

    public function listConversations() {
        $repository = new ConversationRepository(Database::getConnection());
        $conversations = $repository->getAllConversations();

        require 'views/chat/index.php';
    }

    public function saveConversation() {
        $name = $_POST['name'];
        $content = $_POST['content'];

        $repository = new ConversationRepository(Database::getConnection());
        $repository->save($name, $content);

        header('Location: /chat');
    }
}