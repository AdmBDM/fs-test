<?php

use yii\db\Migration;

/**
 * Class m230316_163406_create_table_client
 */
class m230316_163406_create_table_client extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%client}}', [
				'id' => $this->primaryKey(),
				'user_id' => $this->integer()->notNull(),
				'username' => $this->string()->notNull(),
				'phone' => $this->string()->notNull()->unique(),
				'discount' => $this->integer()->defaultValue(0),
				'created_at' => $this->integer()->notNull(),
				'updated_at' => $this->integer()->notNull(),
				'deleted_at' => $this->integer()->defaultValue(null),
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%client}}');
	}
}
