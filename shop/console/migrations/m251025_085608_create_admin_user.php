<?php

use yii\db\Migration;

class m251025_085608_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Ищем пользователя admin
        $user = \common\models\User::findOne(['username' => 'admin']);

        if (!$user) {
            // Создаем админ пользователя, если его нет
            $this->insert('{{%user}}', [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password_hash' => Yii::$app->security->generatePasswordHash('password123'),
                'auth_key' => Yii::$app->security->generateRandomString(),
                'status' => 10, // Active
                'created_at' => time(),
                'updated_at' => time(),
            ]);

            $userId = $this->db->lastInsertID;
        } else {
            $userId = $user->id;
        }

        // Назначаем роль admin
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('admin');
        if ($adminRole) {
            // Проверяем, не назначена ли уже роль
            if (!$auth->getAssignment('admin', $userId)) {
                $auth->assign($adminRole, $userId);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем админ пользователя и его роли
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('admin');

        if ($adminRole) {
            $user = \common\models\User::findOne(['username' => 'admin']);
            if ($user) {
                $auth->revoke($adminRole, $user->id);
                // Удаляем пользователя только если он был создан этой миграцией
                // (проверяем по email, который мы используем)
                if ($user->email === 'admin@example.com') {
                    $user->delete();
                }
            }
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_085608_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
