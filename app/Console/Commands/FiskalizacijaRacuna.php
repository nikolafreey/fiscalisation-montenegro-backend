<?php

namespace App\Console\Commands;

use App\Jobs\Fiskalizuj;
use App\Models\FailedJobsCustom;
use App\Models\Racun;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class FiskalizacijaRacuna extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'racuni:fiskalizacija';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $danasnjiNefiskalizovaniRacuni = Racun::whereDate('created_at', Carbon::today())->whereNull('jikr')->get();

        foreach ($danasnjiNefiskalizovaniRacuni as $racun) {
            try {
                Fiskalizuj::dispatch($racun, $racun->ikof)->onConnection('sync');

                FailedJobsCustom::where('payload', $racun->id)->delete();
            } catch (Exception $exception) {
                continue;
            }
        }

        return 0;
    }
}
