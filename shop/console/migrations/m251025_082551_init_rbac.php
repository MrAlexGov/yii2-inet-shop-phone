<?php

use yii\db\Migration;

class m251025_082551_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Создаем роли
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $auth->add($manager);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        // Создаем разрешения
        $manageProducts = $auth->createPermission('manageProducts');
        $manageProducts->description = 'Управление товарами';
        $auth->add($manageProducts);

        $manageOrders = $auth->createPermission('manageOrders');
        $manageOrders->description = 'Управление заказами';
        $auth->add($manageOrders);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Управление пользователями';
        $auth->add($manageUsers);

        // Назначаем разрешения ролям
        $auth->addChild($admin, $manageProducts);
        $auth->addChild($admin, $manageOrders);
        $auth->addChild($admin, $manageUsers);

        $auth->addChild($manager, $manageProducts);
        $auth->addChild($manager, $manageOrders);

        // Назначаем роль user всем пользователям по умолчанию (если нужно)
        // $auth->assign($user, 1); // Пример для пользователя с id=1
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
         echo "m251025_082551_init_rbac cannot be reverted.\n";

         return false;
    }
    */
}
