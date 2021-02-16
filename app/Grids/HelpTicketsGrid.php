<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class HelpTicketsGrid extends Grid implements HelpTicketsGridInterface
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'HelpTickets';

    /**
     * List of buttons to be generated on the grid
     *
     * @var array
     */
    protected $buttonsToGenerate = [
        'refresh',
        'export',
        'view',
    ];

    /**
     * Specify if the rows on the table should be clicked to navigate to the record
     *
     * @var bool
     */
    protected $linkableRows = false;

    /**
     * Set the columns to be displayed.
     *
     * @return void
     * @throws \Exception if an error occurs during parsing of the data
     */
    public function setColumns()
    {
        $this->columns = [
            "id" => [
                "label" => __(" ID "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "="
                ],
                "styles" => [
                    "column" => "grid-w-10"
                ]
            ],
            "priority" => [
                "label" => __(" Priority "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "like"
                ],
                "presenter" => function ($columnData, $columnName) {

                    return $columnData->priority->name;
                },
            ],
            "department" => [
                "label" => __(" Department "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "like"
                ],
                "presenter" => function ($columnData, $columnName) {

                    return $columnData->department->name;
                },
            ],
            "title" => [
                "label" => __(" Title "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "like"
                ],
            ],
            "agents" => [
                "label" => __(" Agents "),
                "filter" => [
                    "enabled" => false
                ],
                "presenter" => function ($columnData, $columnName) {

                    $data = $columnData->agents()->map(function ($agent) {

                        return sprintf(
                            '<a href="%s" class="btn btn-link">%s</a>',
                            route('admin.admins.show', $agent->admin),
                            $agent->admin->name
                        );
                    });

                    if ($data->count() < 1) return __(" No Agents Yet ");

                    return join('</br>', $data->toArray());
                },
                'raw' => true
            ],
            "user" => [
                "label" => __(" User "),
                "filter" => [
                    "enabled" => false,
                ],
                "presenter" => function ($columnData, $columnName) {

                    $user = $columnData->user;

                    return sprintf(
                        '<a href="%s" class="btn btn-link">%s</a>',
                        route('admin.users.show', $user),
                        $user->name
                    );
                },
                'raw' => true
            ],
            "is_open" => [
                "label" => __(" Status "),
                "filter" => [
                    "enabled" => true,
                    "operator" => "like"
                ],
                "presenter" => function ($columnData, $columnName) {

                    $status = $columnData->is_open ? __(' Open ') : __(' Closed ');

                    return sprintf(
                        '<p class="text-center p-2 %s">%s</p>',
                        $columnData->is_open ? 'bg-success' : 'bg-danger',
                        $status
                    );
                },
                "raw" => true,
            ],
            "created_at" => [
                "label" => __(" Created At "),
                "sort" => false,
                "date" => "true",
                "filter" => [
                    "enabled" => false,
                    "type" => "date",
                    "operator" => "<="
                ]
            ]
        ];
    }

    /**
     * Set the links/routes. This are referenced using named routes, for the sake of simplicity
     *
     * @return void
     */
    public function setRoutes()
    {
        // searching, sorting and filtering
        $this->setIndexRouteName('admin.helpdesk.list');

        // crud support
        $this->setCreateRouteName('admin.helpdesk.list');
        $this->setDeleteRouteName('admin.helpdesk.list');
        $this->setViewRouteName('admin.helpdesk.show');

        // default route parameter
        $this->setDefaultRouteParameter('id');
    }

    /**
     * Return a closure that is executed per row, to render a link that will be clicked on to execute an action
     *
     * @return Closure
     */
    public function getLinkableCallback(): Closure
    {
        return function ($gridName, $item) {
            return route($this->getViewRouteName(), [$gridName => $item->id]);
        };
    }

    /**
     * Configure rendered buttons, or add your own
     *
     * @return void
     */
    public function configureButtons()
    {
        // call `addRowButton` to add a row button
        // call `addToolbarButton` to add a toolbar button
        // call `makeCustomButton` to do either of the above, but passing in the button properties as an array

        // call `editToolbarButton` to edit a toolbar button
        // call `editRowButton` to edit a row button
        // call `editButtonProperties` to do either of the above. All the edit functions accept the properties as an array
    }

    /**
     * Returns a closure that will be executed to apply a class for each row on the grid
     * The closure takes two arguments - `name` of grid, and `item` being iterated upon
     *
     * @return Closure
     */
    public function getRowCssStyle(): Closure
    {
        return function ($gridName, $item) {
            // e.g, to add a success class to specific table rows;
            // return $item->id % 2 === 0 ? 'table-success' : '';
            return "";
        };
    }
}
