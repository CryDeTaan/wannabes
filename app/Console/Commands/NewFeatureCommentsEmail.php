<?php

namespace App\Console\Commands;

use App\Mail\NewFeature;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use Throwable;

class NewFeatureCommentsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:new-feature-comments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to all the users notifying them of the new comments feature.';

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
        $recipients = User::all('name', 'email');
        $this->info('Sending email to ' . $recipients->count() . ' users');

        $sent = 0;
        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient->email)->send(new NewFeature($recipient->name));
                $sent++;
            } catch (Throwable $exception) {
                $this->error('There was an error: ' . $exception);
            }
        }

        $this->info('Sent ' . $sent . ' new feature emails');

        return 0;
    }
}
