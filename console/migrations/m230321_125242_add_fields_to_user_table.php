<?php

use yii\db\Migration;

/**
 * Class m230321_125242_add_fields_to_user_table
 */
class m230321_125242_add_fields_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('{{%user}}', 'phone', $this->string()->notNull()->unique()->after('email'));
		$this->addColumn('{{%user}}', 'discount', $this->integer()->defaultValue(0)->after('phone'));
	}


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230321_125242_add_fields_to_user_table cannot be reverted.\n";

        return false;
    }
}
