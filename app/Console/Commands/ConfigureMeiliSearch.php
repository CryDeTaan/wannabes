<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;
use MeiliSearch\Client as MeiliSearch;

class ConfigureMeiliSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:configure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure MeiliSearch options';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $config = config('scout');
        $client = new MeiliSearch($config['meilisearch']['host'], $config['meilisearch']['key']);

        $index = $config['prefix'] . 'snippets';
        $response = $client->index($index)->updateRankingRules([
            "words",
            "typo",
            "proximity",
            "attribute",
            "exactness",
            "streetcred_count:desc"
        ]);

        $update['status'] = 'enqueued';
        while ($update['status'] === 'enqueued' || $update['status'] === 'processing') {
            $update = $client->index($index)->getUpdateStatus($response['updateId']);
        }

        if ($update['status'] === 'failed') {
            $this->error('Something went wrong: ' . $update['message']);
            return 0;
        }

        $this->info('The command was successful!');

    }
}
