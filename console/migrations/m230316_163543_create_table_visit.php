<?php

use yii\db\Migration;

/**
 * Class m230316_163543_create_table_visit
 */
class m230316_163543_create_table_visit extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%visit}}', [
				'id' => $this->primaryKey(),
				'client_id' => $this->integer()->notNull(),
				'stuff_id' => $this->integer()->notNull(),
				'visit_date' => $this->integer()->notNull(),
				'visit_sum' => $this->float()->notNull()->defaultValue(0),
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%visit}}');
	}
}
