<?php

namespace App\Listeners;

use App\Events\WidgetGenerate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Session;
use App\Models\Widget;
class ComponentWidgetGenerate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WidgetGenerate  $event
     * @return void
     */
  
    public function handle(WidgetGenerate $event)
    {

        Widget::updateOrCreate($event->data_event);

    }
}
