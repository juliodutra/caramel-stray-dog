use Migrations\AbstractMigration;

class CreateDonationsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('donations');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('description', 'text')
            ->addColumn('photo_path', 'string')
            ->addColumn('latitude', 'float')
            ->addColumn('longitude', 'float')
            ->addColumn('status', 'string', ['default' => 'pending_validation'])
            ->addColumn('picked_up_by', 'integer', ['null' => true])
            ->addTimestamps()
            ->addForeignKey('user_id', 'users', 'id')
            ->create();
    }
}