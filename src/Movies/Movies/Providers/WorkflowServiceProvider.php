<?php

namespace Movies\Movies\Providers;

use Litepie\Contracts\Workflow\Workflow as WorkflowContract;
use Litepie\Foundation\Support\Providers\WorkflowServiceProvider as ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * The validators mappings for the package.
     *
     * @var array
     */
    protected $validators = [
        // Bind Movie validator
        \Movies\Movies\Models\Movie::class => \Movies\Movies\Workflow\MovieValidator::class,

        // Bind Genre validator
        \Movies\Movies\Models\Genre::class => \Movies\Movies\Workflow\GenreValidator::class,
    ];

    /**
     * The actions mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        // Bind Movie actions
        \Movies\Movies\Models\Movie::class => \Movies\Movies\Workflow\MovieAction::class,

        // Bind Genre actions
        \Movies\Movies\Models\Genre::class => \Movies\Movies\Workflow\GenreAction::class,
    ];

    /**
     * The notifiers mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
       // Bind Movie notifiers
        \Movies\Movies\Models\Movie::class => \Movies\Movies\Workflow\MovieNotifier::class,

        // Bind Genre notifiers
        \Movies\Movies\Models\Genre::class => \Movies\Movies\Workflow\GenreNotifier::class,
    ];

    /**
     * Register any package workflow validation services.
     *
     * @param \Litepie\Contracts\Workflow\Workflow $workflow
     *
     * @return void
     */
    public function boot(WorkflowContract $workflow)
    {
        parent::registerValidators($workflow);
        parent::registerActions($workflow);
        parent::registerNotifiers($workflow);
    }
}
