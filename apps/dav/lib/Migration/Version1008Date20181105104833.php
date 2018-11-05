<?php

declare(strict_types=1);

namespace OCA\DAV\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version1008Date20181105104833 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();
		if (!$schema->hasTable('calendarsubscriptions')) {
			return $schema;
		}

		$table = $schema->getTable('calendarsubscriptions');
		if (!$table->hasColumn('source_copy')) {
			return $schema;
		}

		$table->dropColumn('source');

		return $schema;
	}
}
