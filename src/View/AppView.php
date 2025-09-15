<?php
declare(strict_types=1);

namespace App\View;

use Cake\View\View;

class AppView extends View
{
    public function initialize(): void
    {
        parent::initialize();

        // Helpers bawaan
        $this->loadHelper('Html', [
            'className' => 'Cake\View\Helper\HtmlHelper'
        ]);
        $this->loadHelper('Form', [
            'className' => 'Cake\View\Helper\FormHelper'
        ]);
        $this->loadHelper('Paginator', [
            'className' => 'Cake\View\Helper\PaginatorHelper'
        ]);
        $this->loadHelper('Number', [
            'className' => 'Cake\View\Helper\NumberHelper'
        ]);
        $this->loadHelper('Time', [
            'className' => 'Cake\View\Helper\TimeHelper'
        ]);

        // Helper custom Sort (sudah kita buat di App\View\Helper\SortHelper.php)
        $this->loadHelper('Sort');
		$this->loadHelper('Status'); // helper baru

    }
}
