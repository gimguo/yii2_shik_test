<?php

use yii\db\Migration;

/**
 * Class m240125_185217_shik_test
 */
class m240125_185217_shik_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'sum' => $this->decimal(),
            'created_at' => $this->timestamp(),
        ]);

        $sql = file_get_contents(__DIR__ . '/order.sql');
        $command = Yii::$app->db->createCommand($sql);
        $command->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%order}}');
    }
}
