<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

class SortHelper extends Helper
{
    protected array $helpers = ['Paginator', 'Html'];

    /**
     * Buat link sort dengan ikon (FontAwesome)
     */
    public function link(string $field, string $title): string
    {
        $request = $this->getView()->getRequest();
        $currentSort = $request->getQuery('sort');
        $currentDir  = strtolower((string)$request->getQuery('direction'));

        $isSorted = ($currentSort === $field);
        $icon = '<i class="fas fa-sort text-muted ms-1"></i>';

        if ($isSorted) {
            if ($currentDir === 'asc') {
                $icon = '<i class="fas fa-sort-up ms-1"></i>';
            } elseif ($currentDir === 'desc') {
                $icon = '<i class="fas fa-sort-down ms-1"></i>';
            }
        }

        $link = $this->Paginator->sort($field, $title, [
            'escape' => true,
            'class'  => 'text-decoration-none text-reset'
        ]);

        return $link . $icon;
    }
	
}
