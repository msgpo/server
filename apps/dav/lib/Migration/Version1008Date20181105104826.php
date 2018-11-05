<?php

declare(strict_types=1);

namespace OCA\DAV\Migration;


use Closure;
use Doctrine\DBAL\Types\Type;
use OCP\DB\ISchemaWrapper;
use OCP\IDBConnection;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version1008Date20181105104826 extends SimpleMigrationStep {

	/** @var IDBConnection */
	private $connection;

	/**
	 * Version1007Date20181007225117 constructor.
	 *
	 * @param IDBConnection $connection
	 */
	public function __construct(IDBConnection $connection) {
		$this->connection = $connection;
	}

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
		$column = $table->getColumn('source');
		if ($column->getLength() === null) {
			return $schema;
		}

		$table->addColumn('source_copy', Type::TEXT, [
			'notnull' => false,
			'length' => null,
		]);

		return $schema;
	}

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function postSchemaChange(IOutput $output, Closure $schemaClosure, array $options) {
		$qb = $this->connection->getQueryBuilder();
		$qb->update('calendarsubscriptions')
			->set('source_copy', 'source')
			->execute();
	}
}
